<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function index()
    {
        return view('user.components.login');
    }

    public function store(Request $req)
    {
        // Xác thực dữ liệu đầu vào
        $this->validate($req,
        [
             'email'=>'required|email',
            //  'password'=>'required|min:3|max:20'
             'password'=>'required|max:20'
        ],
        [
             'email.required'=>'Vui lòng nhập email',
             'email.email'=>'Không đúng định dạng email',
             'password.required'=>'Vui lòng nhập mật khẩu',
        ]);

        // Kiểm tra thông tin người dùng với email và mật khẩu
        $credentials = ['email' => $req->email, 'password' => $req->password];
        // Thực hiện xác thực người dùng
        // if (Auth::check()) {
        //     // Đã đăng nhập
        //     $user = Auth::user(); // Lấy thông tin người dùng
        //     dd('Đã đăng nhập với email: ' . $user->email);
        // } else {
        //     // Chưa đăng nhập
        //     dd('Chưa đăng nhập');
        // }
        if (Auth::attempt($credentials)) {
            // Kiểm tra vai trò của người dùng sau khi xác thực
            $user = Auth::user();
            Session::put('userEmail', $user->email);
            Session::put('userID', $user->id);
            
            // dd(session()->all());

            // Điều hướng tùy theo vai trò
            // if ($user->role_id == 1) {
            //     // Nếu là admin, chuyển đến trang quản trị
            //     return redirect()->route('travel_types.index')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
            // } elseif ($user->role_id == 2) {
            //     // Nếu là người dùng thường, chuyển đến trang người dùng
            //     return redirect()->route('page.index')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
            // } else {
            //     // Nếu không có vai trò hợp lệ
            //     return redirect()->route('login')->with(['flag' => 'danger', 'message' => 'Vai trò không hợp lệ']);
            // }

            // Điều hướng tùy theo vai trò
            if (strtolower($user->role->name) == 'quản trị') {
                // Nếu là admin, chuyển đến trang quản trị
                return redirect()->route('travel_types.index')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
            } elseif (strtolower($user->role->name) == 'người dùng') {
                // Nếu là người dùng thường, chuyển đến trang người dùng
                return redirect()->route('page.index')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
            } else {
                // Nếu không có vai trò hợp lệ
                return redirect()->route('login')->with(['flag' => 'danger', 'message' => 'Vai trò không hợp lệ']);
            }
        } else {
            // Nếu đăng nhập thất bại
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập thất bại']);
        }
    }

    public function logout(Request $request)
    {
        // Đăng xuất khỏi ứng dụng
        Auth::logout();
    
        // Làm mất hiệu lực phiên hiện tại
        $request->session()->invalidate();
    
        // Tạo lại token CSRF cho phiên mới
        $request->session()->regenerateToken();
    
        // Xóa thông tin email người dùng khỏi session
        Session::forget('userEmail');
        Session::forget('userID');
        
        // Chuyển hướng đến trang chủ sau khi đăng xuất
        return redirect()->route('page.index');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Tìm user theo email
        $user = \App\Models\User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Lấy role_id của "người dùng"
            $role = \App\Models\Role::whereRaw('LOWER(name) = ?', ['người dùng'])->first();

            // Tạo user mới
            $user = \App\Models\User::create([
                'username'    => $googleUser->getName(),
                'email'       => $googleUser->getEmail(),
                'avatar'      => $googleUser->getAvatar(),
                'password'    => bcrypt(Str::random(16)),
                'status'      => 0,
                'role_id'     => $role ? $role->id : null,
            ]);
        }

        // Đăng nhập user
        Auth::login($user);

        // Lưu session
        Session::put('userEmail', $user->email);
        Session::put('userID', $user->id);

        // Điều hướng về trang người dùng
        return redirect()->route('user.index')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công bằng Google']);
    }
}
