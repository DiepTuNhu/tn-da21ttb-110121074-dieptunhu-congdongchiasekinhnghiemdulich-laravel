<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
       
        return view('admin.slide.list',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slide.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // dd($request->hasFile('image1'));

    // Xác thực input
    $this->validate($request, [
        'image1' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
    ], [
        'image1.required' => 'Bạn chưa nhập hình.',
        'image1.image' => 'Tệp tải lên phải là hình ảnh.',
        'image1.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
        'image1.max' => 'Hình ảnh phải nhỏ hơn 2MB.',
    ]);

    // Xử lý ảnh
    if ($request->hasFile('image1')) {
        // Tạo tên file duy nhất
        $imageName = time() . '.' . $request->image1->extension();

        // Lưu ảnh vào thư mục public/slide_image
        $request->image1->storeAs('public/slide_image', $imageName);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $slide = new Slide();
        $slide->image = $imageName;
        $slide->status = 0; // Gán trạng thái mặc định
        $slide->save();
    }

    return redirect()->route('slides.index')->with('success', 'Ảnh đã được tải lên thành công!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.edit',compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slide = Slide::findOrFail($id);
        // Kiểm tra xem Slide có ảnh hiện tại hay không
        if ($slide->image && $request->hasFile('image1')) {
            // Xóa ảnh cũ nếu có
            Storage::delete('public/slide_image/' . $slide->image);
        }
        // Xử lý ảnh mới nếu có
        if ($request->hasFile('image1')) {
            // Đặt tên file dựa trên thời gian (timestamp) và phần mở rộng của ảnh
            $imageName = time() . '.' . $request->file('image1')->getClientOriginalExtension();
            
            // Lưu ảnh vào thư mục public/slide_image
            $request->file('image1')->storeAs('public/slide_image', $imageName);
            
            // Cập nhật tên ảnh vào cơ sở dữ liệu
            $slide->image = $imageName;
        }
    
        // Cập nhật các trường khác
        $slide->status = $request->status;
    
        $slide->save();
    
        return redirect()->route('slides.index')->with('success', 'Cập nhật slide thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $slide = Slide::find($id);

        // Kiểm tra nếu người dùng có ảnh
        if ($slide->image) {
            // Xóa ảnh khỏi thư mục lưu trữ
            Storage::delete('public/slide_image/' . $slide->image);
        }
        $slide->delete();
        return redirect()->route('slides.index');
    }
}
