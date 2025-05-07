<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
       
        if (request()->ajax()) {
            // Nếu là request AJAX, chỉ trả phần nội dung @section('content')
            return view('admin.role.list',compact('roles'))->render();
        }

        // Nếu là request bình thường, trả toàn bộ layout
        return view('admin.role.list',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'roleName'=>'required|max:50|min:3|unique:roles,name'
        ],
        [
            'roleName.required'=>'Bạn chưa nhập tên phân quyền',
            'roleName.unique'=>'Tên phân quyền đã tồn tại',
            'roleName.max'=>'Nhập tối đa 50 ký tự',
            'roleName.min'=>'Nhập tối thiểu 3 ký tự'
        ]);

        $role = new Role;
       
        $role->name = $request->roleName;
       
        $role->save();
        return redirect()->route('roles.index');
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
        $role = Role::find($id);
        return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->name = $request->roleName;
        $role->update();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
