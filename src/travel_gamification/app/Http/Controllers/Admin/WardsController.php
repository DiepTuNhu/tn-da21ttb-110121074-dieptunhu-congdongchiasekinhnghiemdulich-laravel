<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ward;


class WardsController extends Controller
{
    public function index()
    {
        $wards = Ward::all(); // Lấy tất cả các tỉnh
        return view('admin.ward.list', compact('wards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ward.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'code' => 'required|max:5|unique:wards,code',
            'name' => 'required|max:100',
            // 'region' => 'required|in:Miền Bắc,Miền Trung,Miền Nam',
        ], [
            'code.required' => 'Vui lòng nhập mã tỉnh.',
            'code.unique' => 'Mã tỉnh đã tồn tại.',
            'name.required' => 'Vui lòng nhập tên tỉnh.',
            // 'region.required' => 'Vui lòng chọn vùng miền.',
            // 'region.in' => 'Vùng miền không hợp lệ.',
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $ward = new Ward();
        $ward->code = $request->code;
        $ward->name = $request->name;
        // $district->region = $request->region;
        $ward->save();

        return redirect()->route('wards.index')->with('success', 'Huyện đã được thêm thành công!');
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
        $ward = Ward::find($id);
        return view('admin.ward.edit',compact('ward'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm tỉnh theo ID
        $ward = Ward::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'code' => 'required|max:5|unique:wards,code,' . $id,
            'name' => 'required|max:100',
            // 'region' => 'required|in:Miền Bắc,Miền Trung,Miền Nam',
            // 'status' => 'required|in:0,1',
        ], [
            'code.required' => 'Vui lòng nhập mã tỉnh.',
            'code.unique' => 'Mã tỉnh đã tồn tại.',
            'name.required' => 'Vui lòng nhập tên tỉnh.',
            // 'region.required' => 'Vui lòng chọn vùng miền.',
            // 'region.in' => 'Vùng miền không hợp lệ.',
            // 'status.required' => 'Vui lòng chọn trạng thái.',
            // 'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        // Cập nhật thông tin tỉnh
        $ward->code = $request->code;
        $ward->name = $request->name;
        // $district->region = $request->region;
        // $province->status = $request->status;
        $ward->save();

        // Chuyển hướng về danh sách tỉnh
        return redirect()->route('wards.index')->with('success', 'Cập nhật huyện thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $ward = Ward::find($id);
        $ward->delete();
        return redirect()->route('wards.index');
    }
}
