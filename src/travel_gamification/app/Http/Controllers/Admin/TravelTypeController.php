<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelType;


class TravelTypeController extends Controller
{
    public function index()
    {
        $types = TravelType::all();
      
        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.travel_type.list', compact('types'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.travel_type.list', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.travel_type.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'typeName' => 'required|max:100|min:3|unique:travel_types,name' // Đổi 'types' thành 'travel_types'
        ],
        [
            'typeName.required' => 'Bạn chưa nhập tên loại hình',
            'typeName.unique' => 'Tên loại hình đã tồn tại',
            'typeName.max' => 'Nhập tối đa 100 ký tự',
            'typeName.min' => 'Nhập tối thiểu 3 ký tự'
        ]);

        $type = new TravelType;
       
        $type->name = $request->typeName;
        $type->status = 0;  // Gán status là 0
       
        $type->save();
        return redirect()->route('travel_types.index');
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
        $type = TravelType::find($id);
        return view('admin.travel_type.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = TravelType::find($id);
        $type->name = $request->typeName;
        $type->status = $request->status;
        $type->update();
        return redirect()->route('travel_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $type = TravelType::find($id);
        $type->delete();
        return redirect()->route('travel_types.index');
    }
}
