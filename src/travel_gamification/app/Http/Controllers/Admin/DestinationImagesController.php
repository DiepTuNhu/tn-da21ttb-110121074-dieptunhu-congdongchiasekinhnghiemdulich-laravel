<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DestinationImage;
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;

class DestinationImagesController extends Controller
{
    public function index(Request $request)
    {
    // Lấy id từ query string
    $locationId = $request->input('id');

    // Kiểm tra và lọc dữ liệu
    if ($locationId) {
        // Lấy hình ảnh liên kết với địa điểm
        $photos = DestinationImage::where('id_location', $locationId)->get();
    } else {
        // Nếu không có id, lấy tất cả hình ảnh
        $photos = DestinationImage::all();
    }

    // Trả dữ liệu ra view
    return view('admin.photo.list', compact('photos'));
}

    public function create(Request $request)
{
    // Lấy id_location từ query string
    $locationId = $request->query('id_location');

    // Tìm địa điểm bằng id_location (nếu không tìm thấy sẽ trả về 404)
    $location = Destination::findOrFail($locationId);

    // Lấy danh sách các địa điểm và tỉnh (nếu cần)
    $locations = Destination::all();

    // Lấy tên địa điểm
    $locationName = $location->name;

    // Lấy ảnh chính nếu có
    $existingMainPhoto = DestinationImage::where('id_location', $locationId)->where('status', 2)->first();

    // Lấy số lượng ảnh phụ hiện tại
    $existingPhotosCount = DestinationImage::where('id_location', $locationId)->where('status', 0)->count();

    // Truyền tất cả dữ liệu vào view
    return view('admin.photo.add', compact('provinces', 'locations', 'locationId', 'locationName', 'existingMainPhoto', 'existingPhotosCount'));
}

   /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate dữ liệu
    $this->validate($request, [
        'caption' => 'required|max:255',
        'images' => 'nullable|array|max:4',
        'images.*' => 'mimes:webp,jpg,jpeg,png,gif|max:2048',
        'image1' => 'mimes:webp,jpg,jpeg,png,gif|max:2048',
        'id_location' => 'required|exists:locations,id', // Kiểm tra xem id_location có tồn tại trong bảng locations không
    ], [
        'caption.required' => 'Bạn chưa nhập chú thích',
        'images.max' => 'Bạn chỉ có thể tải lên tối đa 4 ảnh phụ',
        'images.*.mimes' => 'Chỉ chấp nhận định dạng jpg, jpeg, png, gif',
        'image1.mimes' => 'Ảnh chính phải có định dạng jpg, jpeg, png, gif',
        'image1.max' => 'Ảnh chính không được vượt quá 2MB'
    ]);
    // Lấy id_location từ request
    $locationId = $request->input('id_location');

// Lưu ảnh chính (image1)
if ($request->hasFile('image1')) {
    $image1 = $request->file('image1');
    $image1Name = time() . '-' . $image1->getClientOriginalName();
    $image1->storeAs('public/location_image', $image1Name);

    // Lưu thông tin ảnh chính vào DB
    DestinationImage::create([
        'name' => $image1Name,
        'caption' => $request->input('caption'),
        'url' => $request->input('url'),
        'status' => 2, // Ảnh chính
        'id_location' => $locationId,
    ]);
}

    $existingPhotosCount = DestinationImage::where('id_location', $locationId)->where('status', 0)->count();
    // dd($existingPhotosCount);

if ($request->hasFile('images')) {
    $images = $request->file('images');

    foreach ($images as $image) {
        // Kiểm tra nếu đã đạt giới hạn 5 ảnh
        if ($existingPhotosCount >= 4) {
            return redirect()->back()->withErrors(['error' => 'Địa điểm này đã có đủ 5 ảnh. Không thể thêm ảnh nữa.']);
        }

        // Lưu ảnh vào thư mục
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('public/location_image', $imageName);

        // Lưu vào cơ sở dữ liệu
        DestinationImage::create([
            'name' => $imageName,
            'caption' => $request->input('caption'),
            'url' => $request->input('url'),
            'status' => 0,
            'id_location' => $request->input('id_location'),
        ]);

        // Cập nhật lại số lượng ảnh sau khi thêm
        $existingPhotosCount++;
    }
}


return redirect()->route('locations.index')->with('success', 'Ảnh đã được lưu thành công');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $photo = DestinationImage::findOrFail($id); // Lấy ảnh theo ID
    $locations = Destination::all(); // Lấy danh sách địa điểm

    return view('admin.photo.edit', compact('photo', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {

        
    //     $photo = Photo::find($id);  // Lấy thông tin ảnh cần chỉnh sửa
    //     // Cập nhật thông tin ảnh chính nếu người dùng chọn ảnh mới
    //     if ($request->hasFile('image1')) {
    //         // Xóa ảnh cũ trước khi lưu ảnh mới
    //         Storage::delete('public/location_image/' . $photo->name);

    //         // Lưu ảnh mới
    //         $image1 = $request->file('image1');
    //         $image1Name = time() . '-' . $image1->getClientOriginalName();
    //         $image1->storeAs('public/location_image', $image1Name);

    //         // Cập nhật thông tin ảnh chính
    //         $photo->name = $image1Name;
    //     }

    //     // Cập nhật các trường khác
    //     $photo->caption = $request->input('caption');
    //     $photo->url = $request->input('url');
    //     $photo->status = $request->input('status');
    //     $photo->id_location = $request->input('id_location');
    //     $photo->save();

    //     return redirect()->route('photos.index')->with('success', 'Ảnh đã được cập nhật thành công');
    // }

    public function update(Request $request, string $id)
    {
        $photo = DestinationImage::find($id);  // Lấy thông tin ảnh cần chỉnh sửa
        
        // Kiểm tra nếu có ảnh mới được chọn và lưu ảnh mới
        if ($request->hasFile('image1')) {
            // Xóa ảnh cũ trước khi lưu ảnh mới
            Storage::delete('public/location_image/' . $photo->name);
    
            // Lưu ảnh mới
            $image1 = $request->file('image1');
            $image1Name = time() . '-' . $image1->getClientOriginalName();
            $image1->storeAs('public/location_image', $image1Name);
    
            // Cập nhật thông tin ảnh chính
            $photo->name = $image1Name;
        }
    
        // Cập nhật các trường khác
        $photo->caption = $request->input('caption');
        $photo->url = $request->input('url');
        $photo->id_location = $request->input('id_location');
    
        // Nếu có thay đổi trạng thái (status), cập nhật trạng thái
        if ($request->has('status')) {
            // Trường hợp ảnh chính (status = 2), kiểm tra nếu cần cập nhật ảnh chính mới
            if ($request->input('status') == 2) {
                // Chuyển ảnh chính cũ thành ảnh phụ nếu có ảnh chính
                $existingMainPhoto = DestinationImage::where('id_location', $photo->id_location)
                                            ->where('status', 2)
                                            ->first();
                if ($existingMainPhoto && $existingMainPhoto->id != $photo->id) {
                    $existingMainPhoto->update(['status' => 0]);
                }
            }
    
            $photo->status = $request->input('status');
        }
    
        // Lưu thông tin đã thay đổi
        $photo->save();
    
        // Chuyển hướng sau khi cập nhật
        return redirect()->route('photos.index')->with('success', 'Ảnh đã được cập nhật thành công');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo = DestinationImage::find($id);
        // Kiểm tra nếu người dùng có ảnh
        if ($photo->name) {
            // Xóa ảnh khỏi thư mục lưu trữ
            Storage::delete('public/location_image/' . $photo->name);
        }
        $photo->delete();
        return redirect()->route('photos.index');
    }
}
