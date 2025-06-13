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
        $remember = $req->has('remember'); // Lấy giá trị checkbox

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            Session::put('userEmail', $user->email);
            Session::put('userID', $user->id);

            // Lấy intended_url từ localStorage (gửi qua form hoặc query string)
            $intended = $req->input('intended') ?? $req->session()->pull('url.intended');

            // Nếu dùng localStorage, bạn cần truyền intended qua form khi submit login
            // hoặc dùng JS sau khi đăng nhập thành công để redirect

            if ($intended) {
                return redirect($intended)->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
            }

            // Điều hướng tùy theo vai trò
            if (strtolower($user->role->name) == 'quản trị') {
                // Nếu là admin, chuyển đến trang quản trị
                return redirect()->route('admin.overview')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
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

    public function authenticated(Request $request, $user)
    {
        if ($request->has('intended')) {
            return redirect($request->input('intended'));
        }
        return redirect()->intended('/');
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
        $user = \App\Models\User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $role = \App\Models\Role::whereRaw('LOWER(name) = ?', [mb_strtolower('người dùng')])->first();
            if (!$role) {
                return redirect()->route('login')->with(['flag' => 'danger', 'message' => 'Không tìm thấy vai trò "người dùng"']);
            }
            $user = \App\Models\User::create([
                'username'    => $googleUser->getName(),
                'email'       => $googleUser->getEmail(),
                'avatar'      => $googleUser->getAvatar(),
                'password'    => bcrypt(Str::random(16)),
                'status'      => '0',
                'role_id'     => $role->id,
            ]);
        }
        Auth::login($user);
        Session::put('userEmail', $user->email);
        Session::put('userID', $user->id);

        // Lấy intended từ session hoặc query string
        $intended = session('url.intended') ?? request('intended');
        if ($intended) {
            session()->forget('url.intended');
            return redirect($intended)->with(['flag' => 'success', 'message' => 'Đăng nhập thành công bằng Google']);
        }

        // Điều hướng tùy theo vai trò
        if (str_contains(mb_strtolower($user->role->name), 'quản trị')) {
            return redirect()->route('admin.overview')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công bằng Google']);
        } else {
            return redirect()->route('page.index')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công bằng Google']);
        }
    }
}
