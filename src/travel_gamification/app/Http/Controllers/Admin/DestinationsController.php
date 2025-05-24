<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TravelType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Helpers\GeoHelper;
use App\Models\Utility;
use App\Models\DestinationUtility;
use App\Services\DistanceService;

class DestinationsController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        // return view('admin.destination.list',compact('destinations'));

        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.destination.list', compact('destinations'))->render();
        }
    
        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.destination.list', compact('destinations'));
    
    }

    public function create()
    {
        $travel_types = TravelType::all(); // Lấy danh sách các loại hình

        return view('admin.destination.add', compact('travel_types',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, DistanceService $distanceService)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:destinations,name',
            'price' => 'required|string|max:255',
            'id_type' => 'required|exists:travel_types,id', // Kiểm tra id có tồn tại trong bảng types
            'tinh' => 'required', // Tỉnh
            'quan' => 'required', // Huyện
            'phuong' => 'required', // Xã
            'highlights' => 'nullable|string',
            'best_time' => 'nullable|string',
            'local_cuisine' => 'nullable|string',
            'transportation' => 'nullable|string',
        ], [
            'name.required' => 'Bạn chưa nhập tên.',
            'name.unique' => 'Tên địa điểm đã tồn tại.',
            'price.required' => 'Bạn chưa nhập giá.',
            'id_type.required' => 'Bạn chưa chọn loại hình.',
            'tinh.required' => 'Bạn chưa chọn tỉnh.',
            'quan.required' => 'Bạn chưa chọn huyện.',
            'phuong.required' => 'Bạn chưa chọn xã.',
        ]);

        // Hàm lấy tên từ API Esgoo
        function getNameFromEsgoo($level, $parentId, $targetId)
        {
            $response = Http::get("https://esgoo.net/api-tinhthanh/{$level}/{$parentId}.htm");
            $data = $response->json()['data'] ?? [];

            foreach ($data as $item) {
                if ((int)$item['id'] === (int)$targetId) {
                    return $item['full_name'];
                }
            }

            return null;
        }

        // Lấy tên tỉnh, huyện, xã bằng cách tìm theo ID
        $province = getNameFromEsgoo(1, 0, $request->tinh);
        $district = getNameFromEsgoo(2, $request->tinh, $request->quan);
        $ward = getNameFromEsgoo(3, $request->quan, $request->phuong);

        // Kiểm tra nếu không tìm thấy tên
        if (!$province || !$district || !$ward) {
            return redirect()->back()->withErrors(['error' => 'Không thể lấy thông tin địa chỉ từ API.']);
        }

        // Nối địa chỉ theo thứ tự xã, huyện, tỉnh
        $address = trim("{$ward}, {$district}, {$province}");

        // Nối tên địa điểm với địa chỉ
        $fullAddress = trim("{$request->name}, {$address}");

        // Lấy tọa độ từ OpenCage Geocoding API
        $apiKey = env('OPENCAGE_API_KEY'); // Lấy API Key từ file config
        $response = Http::get("https://api.opencagedata.com/geocode/v1/json", [
            'q' => $fullAddress, // Địa chỉ đầy đủ
            'key' => $apiKey,
            'language' => 'vi', // Ngôn ngữ (vi: tiếng Việt)
            'pretty' => 1, // Tùy chọn để dễ đọc (không bắt buộc)
        ]);

        // Ghi log toàn bộ kết quả trả về để kiểm tra nếu có lỗi
        logger()->info('📍 Địa chỉ gửi lên OpenCage: ' . $fullAddress);
        logger()->info('📦 OpenCage API response: ', $response->json());

        // Kiểm tra nếu không tìm thấy kết quả
        if (empty($response->json()['results'])) {
            logger()->error('❌ Không tìm thấy tọa độ cho địa chỉ: ' . $fullAddress);
            $location = null;
        } else {
            $location = $response->json()['results'][0]['geometry'] ?? null;
        }

        // Tạo mới Destination
        $destination = new Destination();
        $destination->name = $request->name;
        $destination->price = $request->price;
        $destination->travel_type_id = $request->id_type;
        $destination->address = $address;
        $destination->latitude = $location['lat'] ?? null; // Lưu tọa độ latitude từ API
        $destination->longitude = $location['lng'] ?? null; // Lưu tọa độ longitude từ API
        $destination->status = 0;
        $destination->highlights = $request->highlights;
        $destination->best_time = $request->best_time;
        $destination->local_cuisine = $request->local_cuisine;
        $destination->transportation = $request->transportation;
        $destination->user_id = auth()->id();
        $destination->save();

        // Tính khoảng cách và lưu vào bảng trung gian
        $distanceService->calculateAndSaveDistances(
            $destination->latitude,
            $destination->longitude,
            'destination',
            $destination->id
        );

        return redirect()->route('destinations.index')->with('success', 'Địa điểm đã được thêm thành công.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $destination = Destination::findOrFail($id);

        // Lấy danh sách tiện ích gần địa điểm
        $nearbyUtilities = DestinationUtility::where('destination_id', $id)
            ->where('distance', '<=', 20) // Chỉ lấy tiện ích trong bán kính 5km
            ->with('utility') // Lấy thông tin tiện ích qua quan hệ
            ->get();

        return view('user.layout.detail_destination', compact('destination', 'nearbyUtilities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $destination = Destination::find($id);
        $travel_types = TravelType::all(); 

        // Tách địa chỉ thành xã, huyện, tỉnh
        $addressParts = explode(', ', $destination->address);
        $phuong = $addressParts[0] ?? ''; // Xã
        $quan = $addressParts[1] ?? '';   // Huyện
        $tinh = $addressParts[2] ?? '';   // Tỉnh
    return view('admin.destination.edit', compact('destination', 'travel_types', 'tinh', 'quan', 'phuong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:destinations,name,' . $id,
            'price' => 'required|string|max:255',
            'id_type' => 'required|exists:travel_types,id', // Kiểm tra id có tồn tại trong bảng types
            'highlights' => 'nullable|string',
            'best_time' => 'nullable|string',
            'local_cuisine' => 'nullable|string',
            'transportation' => 'nullable|string',
        ], [
            'name.required' => 'Bạn chưa nhập tên.',
            'name.unique' => 'Tên địa điểm đã tồn tại.',
            'price.required' => 'Bạn chưa nhập giá.',
            'id_type.required' => 'Bạn chưa chọn loại hình.',
        ]);

        $destination = Destination::find($id);

        if (!$destination) {
            return redirect()->route('utilities.index')->with('error', 'destination not found!');
        }

        // Tạo địa chỉ đầy đủ từ request
        $address = trim(($request->phuong_text ?? '') . ', ' . ($request->quan_text ?? '') . ', ' . ($request->tinh_text ?? ''));
        $fullAddress = trim(($request->name ?? '') . ', ' . $address);

        // Gọi OpenCage Geocoding API để lấy tọa độ
        $apiKey = env('OPENCAGE_API_KEY'); // Lấy API Key từ file .env
        $response = Http::get("https://api.opencagedata.com/geocode/v1/json", [
            'q' => $fullAddress, // Địa chỉ đầy đủ
            'key' => $apiKey,
            'language' => 'vi', // Ngôn ngữ (vi: tiếng Việt)
            'pretty' => 1, // Tùy chọn để dễ đọc (không bắt buộc)
        ]);

        // Ghi log toàn bộ kết quả trả về để kiểm tra nếu có lỗi
        logger()->info('📍 Địa chỉ gửi lên OpenCage: ' . $fullAddress);
        logger()->info('📦 OpenCage API response: ', $response->json());

        // Kiểm tra nếu không tìm thấy kết quả
        if (empty($response->json()['results'])) {
            logger()->error('❌ Không tìm thấy tọa độ cho địa chỉ: ' . $fullAddress);
            $location = null;
        } else {
            $location = $response->json()['results'][0]['geometry'] ?? null;
        }

        // Kiểm tra và xóa ảnh cũ nếu có
        if ($destination->image && $request->hasFile('image1') && $destination->image !== 'default.jpg') {
            Storage::delete('public/destination_image/' . $destination->image);
        }

        // Cập nhật thông tin địa điểm
        $destination->address = $address ?: null; // Nếu địa chỉ rỗng, gán null
        $destination->name = $request->name ?: null; // Nếu tên rỗng, gán null
        $destination->price = $request->price ?: null; // Nếu giá rỗng, gán null
        $destination->latitude = $location['lat'] ?? null; // Lưu tọa độ latitude từ API
        $destination->longitude = $location['lng'] ?? null; // Lưu tọa độ longitude từ API
        $destination->highlights = $request->highlights ?: null;
        $destination->best_time = $request->best_time ?: null;
        $destination->local_cuisine = $request->local_cuisine ?: null;
        $destination->transportation = $request->transportation ?: null;
        $destination->travel_type_id = $request->id_type ?: null;
        $destination->status = $request->has('status') ? $request->status : $destination->status;

        $destination->save();

        // Tính lại khoảng cách và lưu vào bảng trung gian nếu có thay đổi vị trí
        app(\App\Services\DistanceService::class)->calculateAndSaveDistances(
            $destination->latitude,
            $destination->longitude,
            'destination',
            $destination->id
        );

        return redirect()->route('destinations.index')->with('success', 'Địa điểm đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tìm người dùng theo ID
        $destination = Destination::find($id);


        // Xóa người dùng
        $destination->delete();

        // Chuyển hướng về trang danh sách người dùng
        return redirect()->route('destinations.index');
    }
}
