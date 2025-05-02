<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Đăng nhập</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f7f7f7;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-wrapper {
      display: flex;
      background: white;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 850px;
      width: 100%;
    }

    .login-left {
      background: #ff5722;
      color: white;
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      padding: 40px 20px;
    }

    .login-left img {
      width: 300px;
      margin-bottom: 0px;
    }

    .login-right {
      flex: 1;
      padding: 40px 30px;
      box-sizing: border-box;
    }

    .login-right h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #ff5722;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-group input {
      width: 100%;
      padding: 12px 40px 12px 40px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      box-sizing: border-box;
    }

    .form-group i {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
    }

    .form-group i.fa-envelope,
    .form-group i.fa-lock {
      left: 12px;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #999;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .form-actions a {
      text-decoration: none;
      color: #ff5722;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background: #ff5722;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .login-btn:hover {
      background: #e64a19;
    }

    .login-google {
      margin-top: 15px;
      /* width: 100%; */
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      cursor: pointer;
    }

    .login-google:hover {
      background: #f1f1f1;
    }

    .login-google img {
      width: 20px;
    }

    .extra-links {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .extra-links a {
      color: #ff5722;
      text-decoration: none;
      font-weight: 500;
    }

    .error {
      color: red;
      font-size: 13px;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .login-wrapper {
        flex-direction: column;
      }

      .login-left {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="login-left">
      <img src="logo/logo_trang_full.png" alt="logo" />
    </div>
    <div class="login-right">
      <h2>Đăng nhập</h2>
      @include('user.components.alert')
      <form id="loginForm" action="{{route('login.store')}}" method="POST">
        @csrf
        @if(Session::has('flag'))
        <div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
        @endif

        <div class="form-group">
          <i class="fa fa-envelope"></i>
          <input type="email" id="email" name="email" placeholder="Email" required />
        </div>

        <div class="form-group">
          <i class="fa fa-lock"></i>
          <input type="password" id="password" name="password" placeholder="Mật khẩu" required />
          <i class="fa fa-eye toggle-password" toggle="#password"></i>
        </div>

        <div class="form-actions">
          <label>
            <input type="checkbox" id="remember" /> Ghi nhớ
          </label>
          <a href="#">Quên mật khẩu?</a>
        </div>
        <div id="loginError" class="error"></div>
        <button type="submit" class="login-btn">Đăng nhập</button>
      </form>

      <div class="login-google" onclick="alert('Đang tích hợp đăng nhập Google...')">
        <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google" />
        <span>Đăng nhập bằng Google</span>
      </div>

      <div class="extra-links">
        Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
      </div>
    </div>
  </div>

  <script>
    // Toggle hiện/ẩn mật khẩu
    document.querySelectorAll(".toggle-password").forEach(icon => {
      icon.addEventListener("click", () => {
        const input = document.querySelector(icon.getAttribute("toggle"));
        const type = input.getAttribute("type") === "password" ? "text" : "password";
        input.setAttribute("type", type);
        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
      });
    });

    // Xử lý đăng nhập đơn giản
    // document.getElementById("loginForm").addEventListener("submit", function (e) {
    //   e.preventDefault();

    //   const email = document.getElementById("email").value.trim();
    //   const password = document.getElementById("password").value.trim();
    //   const error = document.getElementById("loginError");

    //   if (!email || !password) {
    //     error.textContent = "Vui lòng nhập đầy đủ thông tin.";
    //     return;
    //   }

    //   if (email === "test@example.com" && password === "123456") {
    //     alert("Đăng nhập thành công!");
    //     error.textContent = "";

    //     // Xử lý "Ghi nhớ đăng nhập"
    //     if (document.getElementById("remember").checked) {
    //       localStorage.setItem("rememberedEmail", email);
    //     } else {
    //       localStorage.removeItem("rememberedEmail");
    //     }

    //     // window.location.href = "/trangchu.html";
    //   } else {
    //     error.textContent = "Email hoặc mật khẩu không đúng.";
    //   }
    // });

    // Tự động điền email nếu đã nhớ
    window.onload = () => {
      const remembered = localStorage.getItem("rememberedEmail");
      if (remembered) {
        document.getElementById("email").value = remembered;
        document.getElementById("remember").checked = true;
      }
    };
  </script>
</body>
</html>
