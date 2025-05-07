<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UtilityType;

class UtilityTypeController extends Controller
{
    public function index()
    {
        $utility_types = UtilityType::all();
       
        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.utility_type.list',compact('utility_types'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.utility_type.list',compact('utility_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.utility_type.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'utility_typeName'=>'required|max:100|min:3|unique:utility_types,name'
        ],
        [
            'utility_typeName.required'=>'Bạn chưa nhập tên tiện ích',
            'utility_typeName.unique'=>'Tên loại hình đã tồn tại',
            'utility_typeName.max'=>'Nhập tối đa 100 ký tự',
            'utility_typeName.min'=>'Nhập tối thiểu 3 ký tự'
        ]);

        $utility_type = new UtilityType;
       
        $utility_type->name = $request->utility_typeName;
        $utility_type->status = 0;  // Gán status là 0
       
        $utility_type->save();
        return redirect()->route('utility_types.index');
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
        $utility_type = UtilityType::find($id);
        return view('admin.utility_type.edit',compact('utility_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $utility_type = UtilityType::find($id);
        $utility_type->name = $request->utility_typeName;
        $utility_type->status = $request->status;
        $utility_type->update();
        return redirect()->route('utility_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $utility_type = UtilityType::find($id);
        $utility_type->delete();
        return redirect()->route('utility_types.index');
    }
}
