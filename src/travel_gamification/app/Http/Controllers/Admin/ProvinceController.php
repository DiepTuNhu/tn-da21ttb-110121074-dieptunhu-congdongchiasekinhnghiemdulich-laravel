<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all(); // Lấy tất cả các tỉnh
        return view('admin.province.list', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.province.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'code' => 'required|max:5|unique:provinces,code',
            'name' => 'required|max:100',
            'region' => 'required|in:Miền Bắc,Miền Trung,Miền Nam',
        ], [
            'code.required' => 'Vui lòng nhập mã tỉnh.',
            'code.unique' => 'Mã tỉnh đã tồn tại.',
            'name.required' => 'Vui lòng nhập tên tỉnh.',
            'region.required' => 'Vui lòng chọn vùng miền.',
            'region.in' => 'Vùng miền không hợp lệ.',
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $province = new Province();
        $province->code = $request->code;
        $province->name = $request->name;
        $province->region = $request->region;
        $province->save();

        return redirect()->route('provinces.index')->with('success', 'Tỉnh đã được thêm thành công!');
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
        $province = Province::find($id);
        return view('admin.province.edit',compact('province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm tỉnh theo ID
        $province = Province::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'code' => 'required|max:5|unique:provinces,code,' . $id,
            'name' => 'required|max:100',
            'region' => 'required|in:Miền Bắc,Miền Trung,Miền Nam',
            // 'status' => 'required|in:0,1',
        ], [
            'code.required' => 'Vui lòng nhập mã tỉnh.',
            'code.unique' => 'Mã tỉnh đã tồn tại.',
            'name.required' => 'Vui lòng nhập tên tỉnh.',
            'region.required' => 'Vui lòng chọn vùng miền.',
            'region.in' => 'Vùng miền không hợp lệ.',
            // 'status.required' => 'Vui lòng chọn trạng thái.',
            // 'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        // Cập nhật thông tin tỉnh
        $province->code = $request->code;
        $province->name = $request->name;
        $province->region = $request->region;
        // $province->status = $request->status;
        $province->save();

        // Chuyển hướng về danh sách tỉnh
        return redirect()->route('provinces.index')->with('success', 'Cập nhật tỉnh thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $province = Province::find($id);
        $province->delete();
        return redirect()->route('provinces.index');
    }
}
