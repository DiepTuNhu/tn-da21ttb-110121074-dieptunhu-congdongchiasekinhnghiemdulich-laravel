<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;


class DistrictsController extends Controller
{
    public function index()
    {
        $districts = District::all(); // Lấy tất cả các tỉnh

        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.district.list', compact('districts'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.district.list', compact('districts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.district.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'code' => 'required|max:5|unique:districts,code',
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
        $district = new District();
        $district->code = $request->code;
        $district->name = $request->name;
        // $district->region = $request->region;
        $district->save();

        return redirect()->route('districts.index')->with('success', 'Huyện đã được thêm thành công!');
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
        $district = District::find($id);
        return view('admin.district.edit',compact('district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm tỉnh theo ID
        $district = District::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'code' => 'required|max:5|unique:districts,code,' . $id,
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
        $district->code = $request->code;
        $district->name = $request->name;
        // $district->region = $request->region;
        // $province->status = $request->status;
        $district->save();

        // Chuyển hướng về danh sách tỉnh
        return redirect()->route('districts.index')->with('success', 'Cập nhật huyện thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $district = District::find($id);
        $district->delete();
        return redirect()->route('districts.index');
    }
}
