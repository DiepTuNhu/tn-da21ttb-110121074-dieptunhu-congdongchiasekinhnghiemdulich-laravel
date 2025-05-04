<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate ảnh
        ], [
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự.',
            'avatar.image' => 'Vui lòng chọn tệp hình ảnh hợp lệ.',
            'avatar.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif.',
            'avatar.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        // Tạo người dùng mới
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->status = 0;

        // Xử lý ảnh người dùng (nếu có)
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->storeAs('public/avatars', $avatarName);
            $user->avatar = $avatarName;
        } else {
            // Sao chép ảnh mặc định vào thư mục avatars
            $defaultAvatarPath = 'public/default.jpg'; // Đường dẫn ảnh mặc định
            $avatarName = 'default.jpg'; // Tên file mặc định
            if (!Storage::exists('public/avatars/' . $avatarName)) {
                Storage::copy($defaultAvatarPath, 'public/avatars/' . $avatarName);
        }
    $user->avatar = $avatarName; // Gán tên ảnh mặc định
}

        // Lưu người dùng vào cơ sở dữ liệu
        $user->save();

        return redirect()->route('users.index')->with('success', 'Người dùng đã được thêm thành công!');
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
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit',compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        // Kiểm tra nếu người dùng tồn tại
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        // Kiểm tra và xóa ảnh cũ nếu có
        if ($user->avatar && $request->hasFile('image1') && $user->avatar !== 'default.jpg') {
            // Xóa ảnh cũ nếu có và có ảnh mới được tải lên
            Storage::delete('public/avatars/' . $user->avatar);
        }

        // Cập nhật thông tin người dùng
        $user->username = $request->userName;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->role_id = $request->role_id;
        $user->status = $request->status;

        // Nếu có mật khẩu mới, mã hóa và cập nhật
        // if ($request->has('password') && !empty($request->password)) {
        //     $user->password = bcrypt($request->password);
        // }

        // Xử lý tải lên hình ảnh mới nếu có
        if ($request->hasFile('image1')) {
            $imageName = time() . '.' . $request->file('image1')->extension();  
            // Lưu ảnh vào thư mục public/images
            $request->file('image1')->storeAs('public/avatars/', $imageName);
            // Cập nhật tên ảnh trong cơ sở dữ liệu
            $user->avatar = $imageName;
        }

        // Lưu thông tin người dùng
        $user->save(); 

        // Quay lại trang danh sách người dùng với thông báo thành công
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        // Kiểm tra nếu người dùng có ảnh
        if ($user->avatar && $user->avatar !== 'default.jpg') {
            // Xóa ảnh khỏi thư mục lưu trữ
            Storage::delete('public/avatars/' . $user->avatar);
        }

        // Xóa người dùng
        $user->delete();

        // Chuyển hướng về trang danh sách người dùng
        return redirect()->route('users.index');
    }
}