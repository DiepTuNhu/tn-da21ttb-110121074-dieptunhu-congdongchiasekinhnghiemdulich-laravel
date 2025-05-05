<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utility;
use App\Models\UtilityType;
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class UtilitiesController extends Controller
{
    public function index()
    {
        
        $utilities = Utility::all();
        return view('admin.utility.list',compact('utilities'));
    }

    public function create()
    {
        $utility_types = UtilityType::all(); // Lấy danh sách các loại hình

        return view('admin.utility.add', compact('utility_types'));
    }

        public function store(Request $request)
        {
            // Validate dữ liệu từ form
            $request->validate([
                'name' => 'required|max:100',
                'id_typeofutility' => 'nullable|exists:utility_types,id',
                'tinh' => 'required|numeric',
                'quan' => 'required|numeric',
                'phuong' => 'required|numeric',
                'price' => 'nullable|string',
                'time' => 'nullable|string',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

            // Lấy tọa độ từ Google Maps API
            $apiKey = config('services.google_maps.api_key'); // Thay bằng API key của bạn
            // dd($apiKey, $fullAddress);
            $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
                'address' => $fullAddress,
                'key' => $apiKey,
            ]);
        
            // Ghi log toàn bộ kết quả trả về để kiểm tra nếu có lỗi
            logger()->info('📍 Địa chỉ gửi lên Google Maps: ' . $fullAddress);
            logger()->info('📦 Google Maps API response: ', $response->json());

            // Kiểm tra nếu không tìm thấy kết quả
            if (empty($response->json()['results'])) {
                logger()->error('❌ Không tìm thấy tọa độ cho địa chỉ: ' . $fullAddress);
            }

            $location = $response->json()['results'][0]['geometry']['location'] ?? null;

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

            // Xử lý upload hình ảnh nếu có
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs('public/utility_image', $imageName);
                $utility->image = $imageName;
            }

            // Lưu tiện ích vào cơ sở dữ liệu
            $utility->save();

            // Chuyển hướng về trang danh sách tiện ích với thông báo thành công
            return redirect()->route('utilities.index')->with('success', 'Tiện ích đã được thêm thành công!');
        }

    public function edit(string $id)
    {       
        $utility = Utility::find($id);
        $utility_type = UtilityType::all(); // Lấy danh sách các loại hình
        $locations = Destination::all(); // Lấy danh sách các tỉnh

        return view('admin.utility.edit', compact('utility','utility_types', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm location theo ID
        $utility = Utility::find($id);

        // Nếu không tìm thấy utility, trả về lỗi hoặc thông báo
        if (!$utility) {
            return redirect()->route('utilities.index')->with('error', 'Location not found!');
        }

        // Kiểm tra và xóa ảnh cũ nếu có
        if ($utility->image && $request->hasFile('image1') && $utility->image !== 'default.jpg') {
            // Xóa ảnh cũ nếu có và có ảnh mới được tải lên
            Storage::delete('public/utility_image/' . $utility->image);
        }

        // Cập nhật các trường thông tin từ request
        $utility->name = $request->name;
        $utility->price = $request->price;
        $utility->address = $request->address;
        $utility->phonenumber = $request->phone;
        $utility->time = $request->time;
        $utility->rank = $request->rank;
        $utility->distance = $request->distance;
        $utility->description = $request->description;
        $utility->id_typeofutility = $request->id_typeofutility;
        $utility->id_location = $request->id_location;
        $utility->status = $request->status; // Cập nhật trạng thái

        // Xử lý tải lên hình ảnh mới nếu có
        if ($request->hasFile('image1')) {
            $imageName = time() . '.' . $request->file('image1')->extension();  
            // Lưu ảnh vào thư mục public/images
            $request->file('image1')->storeAs('public/utility_image', $imageName);
            // Cập nhật tên ảnh trong cơ sở dữ liệu
            $utility->image = $imageName;
        }
        // Lưu lại các thay đổi
        $utility->save();

        // Chuyển hướng về trang danh sách locations với thông báo thành công
        return redirect()->route('utilities.index')->with('success', 'Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tìm người dùng theo ID
        $utility = Utility::find($id);

        // Kiểm tra nếu người dùng có ảnh
        if ($utility->image) {
            // Xóa ảnh khỏi thư mục lưu trữ
            Storage::delete('public/utility_image/' . $utility->image);
        }

        // Xóa người dùng
        $utility->delete();

        // Chuyển hướng về trang danh sách người dùng
        return redirect()->route('utilities.index');
    }
}
