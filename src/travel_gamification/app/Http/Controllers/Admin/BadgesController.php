<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Badge;
use Illuminate\Support\Facades\Storage;


class BadgesController extends Controller
{
    public function index()
    {
        $badges = Badge::all(); // Lấy tất cả các tỉnh
        return view('admin.badge.list', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.badge.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|max:100|unique:badges,name',
            'description' => 'required',
            'image1' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Vui lòng nhập tên huy hiệu.',
            'name.unique' => 'Tên huy hiệu đã tồn tại.',
            'image1.required' => 'Bạn chưa nhập hình.',
            'image1.image' => 'Tệp tải lên phải là hình ảnh.',
            'image1.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image1.max' => 'Hình ảnh phải nhỏ hơn 2MB.',
        ]);

        // Lưu file ảnh
        $filePath = null;
        if ($request->hasFile('image1')) {
            $file = $request->file('image1');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('badges', $fileName, 'public'); // Lưu vào storage/app/public/uploads/badges
        }

        // Lưu dữ liệu vào cơ sở dữ liệu
        $badge = new Badge();
        $badge->name = $request->name;
        $badge->description = $request->description;
        $badge->icon_url = $filePath ? '/storage/' . $filePath : null; // Lưu đường dẫn công khai
        $badge->status = 0; // Gán trạng thái mặc định
        $badge->save();

        return redirect()->route('badges.index')->with('success', 'Huy hiệu đã được thêm thành công!');
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
        $badge = Badge::find($id);
        return view('admin.badge.edit',compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm huy hiệu theo ID
        $badge = Badge::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'name' => 'required|max:100|unique:badges,name,' . $id,
            'description' => 'required',
            'image1' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Vui lòng nhập tên huy hiệu.',
            'name.unique' => 'Tên huy hiệu đã tồn tại.',
            'description.required' => 'Vui lòng nhập mô tả.',
            'image1.image' => 'Tệp tải lên phải là hình ảnh.',
            'image1.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'image1.max' => 'Hình ảnh phải nhỏ hơn 2MB.',
        ]);

        // Xử lý file ảnh mới (nếu có)
        if ($request->hasFile('image1')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($badge->icon_url) {
                $oldFilePath = str_replace('/storage/', 'public/', $badge->icon_url); // Chuyển đổi đường dẫn công khai thành đường dẫn lưu trữ
                Storage::delete($oldFilePath); // Xóa file từ storage
            }

            // Lưu ảnh mới
            $file = $request->file('image1');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('badges', $fileName, 'public'); // Lưu vào storage/app/public/badges
            $badge->icon_url = '/storage/' . $filePath; // Cập nhật đường dẫn công khai
        }

        // Cập nhật thông tin huy hiệu
        $badge->name = $request->name;
        $badge->description = $request->description;
        $badge->status = $request->status;
        $badge->save();

        // Chuyển hướng về danh sách huy hiệu với thông báo thành công
        return redirect()->route('badges.index')->with('success', 'Huy hiệu đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $badge = Badge::find($id);

        if ($badge) {
            // Xóa file ảnh nếu tồn tại
            if ($badge->icon_url) {
                $filePath = str_replace('/storage/', 'public/', $badge->icon_url); // Chuyển đổi đường dẫn công khai thành đường dẫn lưu trữ
                Storage::delete($filePath); // Xóa file từ storage
            }

            // Xóa bản ghi khỏi cơ sở dữ liệu
            $badge->delete();
        }

        return redirect()->route('badges.index')->with('success', 'Huy hiệu đã được xóa thành công!');
    }
}
