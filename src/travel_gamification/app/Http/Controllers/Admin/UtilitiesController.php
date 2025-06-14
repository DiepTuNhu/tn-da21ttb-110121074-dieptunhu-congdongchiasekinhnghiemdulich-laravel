<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utility;
use App\Models\UtilityType;
use App\Models\Destination;
use App\Models\DestinationUtility;
use App\Helpers\GeoHelper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Services\DistanceService;

class UtilitiesController extends Controller
{
    public function index()
    {
        
        $utilities = Utility::all();
        
        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.utility.list',compact('utilities'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.utility.list',compact('utilities'));
    }

    public function create()
    {
        $utility_types = UtilityType::all(); // Lấy danh sách các loại hình

        return view('admin.utility.add', compact('utility_types'));
    }

    
    public function store(Request $request, DistanceService $distanceService)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|max:100|unique:utilities,name',
            'id_typeofutility' => 'nullable|exists:utility_types,id',
            'tinh' => 'required|numeric',
            'quan' => 'required|numeric',
            'phuong' => 'required|numeric',
            'price' => 'nullable|string',
            'time' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        function getNameFromEsgoo($level, $parentId, $targetId) {
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
        
        // Nối địa chỉ theo thứ tự xã, huyện, tỉnh
        $address = trim("{$ward}, {$district}, {$province}");

        // Nối tên tiện ích với địa chỉ
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

        // Tạo mới một tiện ích
        $utility = new Utility();
        $utility->name = $request->name;
        $utility->utility_type_id = $request->id_typeofutility;
        $utility->address = $address; // Lưu địa chỉ đã nối
        $utility->latitude = $location['lat'] ?? null; // Lưu tọa độ latitude
        $utility->longitude = $location['lng'] ?? null; // Lưu tọa độ longitude
        $utility->price = $request->price;
        $utility->time = $request->time;
        $utility->description = $request->description;
        $utility->status = 0;  // Gán status là 0
        
        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/utility_image', $imageName);
            $utility->image = $imageName;
        } else {
            $utility->image = 'default_hotel.jpg'; // Nếu không có ảnh thì lấy ảnh mặc định
        }

        // Lưu tiện ích vào cơ sở dữ liệu
        $utility->save();

        // Tính khoảng cách và lưu vào bảng trung gian
        $distanceService->calculateAndSaveDistances(
            $utility->latitude,
            $utility->longitude,
            'utility',
            $utility->id
        );

        return redirect()->route('utilities.index')->with('success', 'Tiện ích đã được thêm thành công!');
    }

    public function edit(string $id)
    {
        $utility = Utility::find($id);
    
        if (!$utility) {
            return redirect()->route('utilities.index')->with('error', 'Utility not found!');
        }
    
        // Tách địa chỉ thành xã, huyện, tỉnh
        $addressParts = explode(', ', $utility->address);
        $phuong = $addressParts[0] ?? ''; // Xã
        $quan = $addressParts[1] ?? '';   // Huyện
        $tinh = $addressParts[2] ?? '';   // Tỉnh
    
        $utility_types = UtilityType::all();
    
        return view('admin.utility.edit', compact('utility', 'utility_types', 'tinh', 'quan', 'phuong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tinh' => 'required|string',
            'quan' => 'required|string',
            'phuong' => 'required|string',
            // 'name' => 'required|max:100',
            'name' => 'required|max:100|unique:utilities,name,' . $id,
            'price' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'distance' => 'nullable|numeric|min:0',
            'time' => 'nullable|string',
            'description' => 'nullable|string',
            'utility_type_id' => 'nullable|exists:utility_types,id',
            'status' => 'nullable|string|max:100',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $utility = Utility::find($id);

        if (!$utility) {
            return redirect()->route('utilities.index')->with('error', 'Utility not found!');
        }
        // Tạo địa chỉ đầy đủ từ request
        $address = $request->phuong_text . ', ' . $request->quan_text . ', ' . $request->tinh_text;
        $fullAddress = trim("{$request->name}, {$address}");

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
        if ($utility->image && $request->hasFile('image1') && $utility->image !== 'default_hotel.jpg') {
            Storage::delete('public/utility_image/' . $utility->image);
        }
        
        $utility->address = $address;
        $utility->name = $request->name;
        $utility->price = $request->price;

        // Ưu tiên lấy tọa độ nhập tay, nếu không có thì lấy từ API
        $utility->latitude = $request->filled('latitude') ? $request->latitude : ($location['lat'] ?? null);
        $utility->longitude = $request->filled('longitude') ? $request->longitude : ($location['lng'] ?? null);

        $utility->distance = $request->distance;
        $utility->time = $request->time;
        $utility->description = $request->description;
        $utility->utility_type_id = $request->utility_type_id;
        $utility->status = $request->status;

        // Xử lý tải lên hình ảnh mới nếu có
        if ($request->hasFile('image1')) {
            $imageName = time() . '.' . $request->file('image1')->extension();
            $request->file('image1')->storeAs('public/utility_image', $imageName);
            $utility->image = $imageName;
        } elseif (!$utility->image) {
            $utility->image = 'default_hotel.jpg'; // Nếu chưa có ảnh thì gán mặc định
        }
        
        app(\App\Services\DistanceService::class)->calculateAndSaveDistances(
            $utility->latitude,
            $utility->longitude,
            'utility',
            $utility->id
        );

        $utility->save();

        return redirect()->route('utilities.index')->with('success', 'Utility updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tìm tiện ích theo ID
        $utility = Utility::find($id);

        if (!$utility) {
            return redirect()->route('utilities.index')->with('error', 'Utility not found!');
        }

        // Chỉ xóa file nếu không phải là ảnh mặc định
        if ($utility->image && $utility->image !== 'default_hotel.jpg') {
            Storage::delete('public/utility_image/' . $utility->image);
        }

        // Xóa tiện ích khỏi database
        $utility->delete();

        return redirect()->route('utilities.index')->with('success', 'Utility deleted successfully!');
    }

    public function show($id)
    {
        $utility = \App\Models\Utility::with('utility_types')->findOrFail($id);
        return view('admin.utility.show', compact('utility'));
    }
}
