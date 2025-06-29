<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký tài khoản</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
      body {
        font-family: "Segoe UI", sans-serif;
        /* font-family: "Roboto", sans-serif; */
        background: #f7f7f7;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      .register-wrapper {
        display: flex;
        background: white;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
      }

      .register-left {
        background: #ff5722;
        color: white;
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 40px 20px;
      }

      .register-left img {
        width: 300px;
        margin-bottom: 0px;
      }

      .register-right {
        flex: 1;
        padding: 30px;
      }

      .register-right h2 {
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
        padding: 12px 50px 12px 40px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        box-sizing: border-box;
      }

      .form-group input:focus {
        outline: none;
        border-color: #ff5722;
      }

      .form-group i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
      }

      .form-group i.fa-user,
      .form-group i.fa-envelope,
      .form-group i.fa-lock {
        left: 12px;
      }

      .toggle-password {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
      }

      .register-btn {
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

      .register-btn:hover {
        background: #e64a19;
      }

      .error {
        color: red;
        font-size: 13px;
        margin-top: 5px;
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
      @media (max-width: 768px) {
        .register-wrapper {
          flex-direction: column;
        }

        .register-left {
          display: none;
        }
      }

      #password-requirements {
    font-size: 0.9rem;
    margin-top: 5px;
    padding-left: 15px;
}

#password-requirements li {
    margin-bottom: 5px;
}
    </style>
  </head>
  <body>
    <div class="register-wrapper">
      <div class="register-left">
        <img src="logo/logo_trang_full.png" alt="logo" />
      </div>
      <div class="register-right">
        <h2>Đăng ký tài khoản</h2>
        @include('user.components.alert')

        <form id="registerForm" action="{{route('postSignup')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @if(Session::has('flag'))
            <div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
          @endif

          <div class="form-group">
            <i class="fa fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Tên người dùng" required />
          </div>

          <div class="form-group">
            <i class="fa fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email" required />
          </div>

          <div class="form-group">
            <i class="fa fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required />
            <i class="fa fa-eye toggle-password" toggle="#password"></i>
          </div>

          <div class="form-group">
            <i class="fa fa-lock"></i>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Nhập lại mật khẩu" required />
            <i class="fa fa-eye toggle-password" toggle="#confirmPassword"></i>
            <div id="passwordError" class="error"></div>
          </div>

          {{-- Danh sách yêu cầu mật khẩu --}}
          <ul id="password-requirements" style="margin-top: 10px; list-style: none; padding: 0; display: none;">
              <li id="require-length" class="text-danger">Ít nhất 8 ký tự</li>
              <li id="require-lowercase" class="text-danger">Ít nhất một chữ cái viết thường</li>
              <li id="require-uppercase" class="text-danger">Ít nhất một chữ cái viết hoa</li>
              <li id="require-number" class="text-danger">Ít nhất một chữ số</li>
              <li id="require-special" class="text-danger">Ít nhất một ký tự đặc biệt (@, $, !, %, *, ?, &, #)</li>
          </ul>

          <button type="submit" class="register-btn">Tạo tài khoản</button>
        </form>
        <div class="extra-links">
          Chưa có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const passwordError = document.getElementById('passwordError');
    const passwordRequirements = document.getElementById('password-requirements');

    const lengthRequirement = document.getElementById('require-length');
    const lowercaseRequirement = document.getElementById('require-lowercase');
    const uppercaseRequirement = document.getElementById('require-uppercase');
    const numberRequirement = document.getElementById('require-number');
    const specialRequirement = document.getElementById('require-special');

    // Hiển thị danh sách yêu cầu khi người dùng bắt đầu nhập
    passwordInput.addEventListener('input', () => {
        const password = passwordInput.value;

        if (password.length > 0) {
            passwordRequirements.style.display = 'block';
        } else {
            passwordRequirements.style.display = 'none';
        }

        // Kiểm tra độ dài
        if (password.length >= 8) {
            lengthRequirement.style.display = 'none'; // Ẩn yêu cầu đã đạt
        } else {
            lengthRequirement.style.display = 'block';
        }

        // Kiểm tra chữ cái viết thường
        if (/[a-z]/.test(password)) {
            lowercaseRequirement.style.display = 'none'; // Ẩn yêu cầu đã đạt
        } else {
            lowercaseRequirement.style.display = 'block';
        }

        // Kiểm tra chữ cái viết hoa
        if (/[A-Z]/.test(password)) {
            uppercaseRequirement.style.display = 'none'; // Ẩn yêu cầu đã đạt
        } else {
            uppercaseRequirement.style.display = 'block';
        }

        // Kiểm tra số
        if (/[0-9]/.test(password)) {
            numberRequirement.style.display = 'none'; // Ẩn yêu cầu đã đạt
        } else {
            numberRequirement.style.display = 'block';
        }

        // Kiểm tra ký tự đặc biệt
        if (/[@$!%*?&#]/.test(password)) {
            specialRequirement.style.display = 'none'; // Ẩn yêu cầu đã đạt
        } else {
            specialRequirement.style.display = 'block';
        }
    });

    // Kiểm tra xác nhận mật khẩu
    confirmPasswordInput.addEventListener('input', () => {
        if (confirmPasswordInput.value !== passwordInput.value) {
            passwordError.textContent = 'Mật khẩu không khớp.';
        } else {
            passwordError.textContent = '';
        }
    });
});
      // Toggle mật khẩu
      document.querySelectorAll(".toggle-password").forEach((icon) => {
        icon.addEventListener("click", () => {
          const input = document.querySelector(icon.getAttribute("toggle"));
          const type = input.getAttribute("type") === "password" ? "text" : "password";
          input.setAttribute("type", type);
          icon.classList.toggle("fa-eye");
          icon.classList.toggle("fa-eye-slash");
        });
      });

      // Kiểm tra xác nhận mật khẩu
      const form = document.getElementById("registerForm");
      form.addEventListener("submit", function (e) {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const errorEl = document.getElementById("passwordError");

        if (password !== confirmPassword) {
          e.preventDefault();
          errorEl.textContent = "Mật khẩu không khớp.";
        } else {
          errorEl.textContent = "";
          // alert("Đăng ký thành công!");
          // Gửi form nếu cần
        }
      });
    </script>
  </body>
</html>
