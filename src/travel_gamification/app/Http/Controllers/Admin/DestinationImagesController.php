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
        $destinationId = $request->input('id');

        // Kiểm tra và lọc dữ liệu
        if ($destinationId) {
            // Lấy hình ảnh liên kết với địa điểm
            $destination_images = DestinationImage::where('destination_id', $destinationId)->get();
        } else {
            // Nếu không có id, lấy tất cả hình ảnh
            $destination_images = DestinationImage::all();
        }

        // Trả dữ liệu ra view
        return view('admin.destination_image.list', compact('destination_images'));
    }

    public function create(Request $request)
    {
        // Lấy destination_id từ query string
        $destinationId = $request->query('destination_id');

        // Tìm địa điểm bằng destination_id (nếu không tìm thấy sẽ trả về 404)
        $destination = Destination::findOrFail($destinationId);

        // Lấy tên địa điểm
        $destinationName = $destination->name;

        // Lấy ảnh chính nếu có
        $existingMainPhoto = DestinationImage::where('destination_id', $destinationId)->where('status', 2)->first();

        $step = 2;

        // Truyền dữ liệu vào view
        return view('admin.destination_image.add', compact('destinationId', 'destinationName', 'existingMainPhoto', 'step'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $this->validate($request, [
            'image1' => 'nullable|mimes:webp,jpg,jpeg,png,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'mimes:webp,jpg,jpeg,png,gif|max:2048',
            'destination_id' => 'required|exists:destinations,id',
        ], [
            'image1.mimes' => 'Ảnh chính phải có định dạng jpg, jpeg, png, gif',
            'image1.max' => 'Ảnh chính không được vượt quá 2MB',
            'images.*.mimes' => 'Chỉ chấp nhận định dạng jpg, jpeg, png, gif cho ảnh phụ',
            'images.*.max' => 'Ảnh phụ không được vượt quá 2MB',
        ]);

        $destinationId = $request->input('destination_id');

        // Lưu ảnh chính (image1)
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $image1Name = time() . '-' . $image1->getClientOriginalName();
            $image1Path = $image1->storeAs('public/destination_image', $image1Name);

            // Lưu thông tin ảnh chính vào DB
            DestinationImage::create([
                'name' => $image1Name,
                'image_url' => Storage::url($image1Path), // Lưu đường dẫn đầy đủ
                'status' => 2, // Ảnh chính
                'destination_id' => $destinationId,
            ]);
        }

        // Lưu ảnh phụ (images[])
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/destination_image', $imageName);

                // Lưu thông tin ảnh phụ vào DB
                DestinationImage::create([
                    'name' => $imageName,
                    'image_url' => Storage::url($imagePath), // Lưu đường dẫn đầy đủ
                    'status' => 0, // Ảnh phụ
                    'destination_id' => $destinationId,
                ]);
            }
        }

        // return redirect()->route('destination_images.index')->with('success', 'Ảnh đã được lưu thành công');
        $from = $request->input('from', 'image'); // mặc định là từ trang hình

        if ($from === 'create') {
            // Quay về trang chi tiết địa điểm
            return redirect()->route('destinations.index', ['id' => $destinationId])
                ->with('success', 'Thêm ảnh thành công!');
        } else {
            // Quay về trang danh sách hình ảnh
            return redirect()->route('destination_images.index', ['id' => $destinationId])
                ->with('success', 'Thêm ảnh thành công!');
        }
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
        $destination_image = DestinationImage::findOrFail($id); // Lấy ảnh theo ID
        $destinations = Destination::all(); // Lấy danh sách địa điểm

        return view('admin.destination_image.edit', compact('destination_image', 'destinations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $destination_image = DestinationImage::findOrFail($id); // Lấy thông tin ảnh cần chỉnh sửa

        // Validate dữ liệu
        $this->validate($request, [
            'image1' => 'nullable|mimes:webp,jpg,jpeg,png,gif|max:2048',
            'destination_id' => 'required|exists:destinations,id',
            'status' => 'required|in:0,1,2',
        ]);

        // Kiểm tra nếu có ảnh mới được chọn và lưu ảnh mới
        if ($request->hasFile('image1')) {
            // Xóa ảnh cũ trước khi lưu ảnh mới
            if ($destination_image->name) {
                Storage::delete('public/destination_image/' . $destination_image->name);
            }

            // Lưu ảnh mới
            $image1 = $request->file('image1');
            $image1Name = time() . '-' . $image1->getClientOriginalName();
            $image1Path = $image1->storeAs('public/destination_image', $image1Name);

            // Cập nhật thông tin ảnh
            $destination_image->name = $image1Name;
            $destination_image->image_url = Storage::url($image1Path); // Lưu đường dẫn đầy đủ
        }

        // Cập nhật các thông tin khác
        $destination_image->destination_id = $request->input('destination_id');

        // Nếu có thay đổi trạng thái (status), cập nhật trạng thái
        if ($request->has('status')) {
            // Trường hợp ảnh chính (status = 2), kiểm tra nếu cần cập nhật ảnh chính mới
            if ($request->input('status') == 2) {
                // Chuyển ảnh chính cũ thành ảnh phụ nếu có ảnh chính
                $existingMainPhoto = DestinationImage::where('destination_id', $destination_image->destination_id)
                    ->where('status', 2)
                    ->first();
                if ($existingMainPhoto && $existingMainPhoto->id != $destination_image->id) {
                    $existingMainPhoto->update(['status' => 0]);
                }
            }

            $destination_image->status = $request->input('status');
        }

        // Lưu thông tin đã thay đổi
        $destination_image->save();

        // Chuyển hướng về danh sách ảnh của địa điểm
        return redirect()->route('destination_images.index', ['id' => $destination_image->destination_id])
                         ->with('success', 'Ảnh đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination_image = DestinationImage::findOrFail($id);

        // Lấy `destination_id` trước khi xóa
        $destinationId = $destination_image->destination_id;

        // Kiểm tra nếu có ảnh và xóa ảnh khỏi thư mục lưu trữ
        if ($destination_image->name) {
            Storage::delete('public/destination_image/' . $destination_image->name);
        }

        // Xóa ảnh khỏi cơ sở dữ liệu
        $destination_image->delete();

        // Chuyển hướng về danh sách ảnh của địa điểm
        return redirect()->route('destination_images.index', ['id' => $destinationId])
                         ->with('success', 'Ảnh đã được xóa thành công');
    }
}
