{{-- filepath: d:\laragon\www\travel_gamification\resources\views\user\layout\edit_profile.blade.php --}}
@extends('user.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success" style="margin-top: 100px">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h2 class="mb-4">Cập nhật thông tin cá nhân</h2>

    {{-- Tabs --}}
    <div class="tabs">
        <button class="tab-button active" data-tab="edit-info">Đổi thông tin</button>
        <button class="tab-button" data-tab="change-password">Đổi mật khẩu</button>
    </div>

    {{-- Tab Content --}}
    <div class="tab-content">
        {{-- Đổi thông tin --}}
        <div class="tab-pane active" id="edit-info">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Avatar --}}
                <div class="mb-3">
                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                    <div class="mb-3">
                        <img src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('storage/default.jpg') }}" alt="Avatar" class="rounded-circle" width="100" height="100">
                    </div>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label for="username" class="form-label">Tên người dùng</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" required>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>

        {{-- Đổi mật khẩu --}}
        <div class="tab-pane" id="change-password">
            <form id="change-password-form" action="{{ route('user.profile.change_password') }}" method="POST">
                @csrf

                {{-- Current Password --}}
                <div class="mb-3">
                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                    <small id="current-password-error" class="text-danger"></small>
                </div>

                {{-- New Password --}}
                <div class="mb-3">
                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <small id="new-password-error" class="text-danger"></small>
                </div>

                {{-- Confirm New Password --}}
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    <small id="confirm-password-error" class="text-danger"></small>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Container styling */
    .container {
        max-width: 600px; /* Giới hạn chiều ngang */
        margin: 100px auto 0; /* Căn giữa */
        padding-bottom: 20px;
        background-color: #fff;
        border-radius: 10px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        color: #343a40;
    }
    /* Tabs container */
    .tabs {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        justify-content: center;
    }

    /* Tab buttons */
    .tab-button {
        padding: 12px 25px;
        cursor: pointer;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .tab-button.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .tab-button:hover {
        background-color: #e9ecef;
        color: #007bff;
    }

    /* Tab content */
    .tab-content {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    /* Form styling */
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    /* Buttons */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        margin-top: 20px
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Avatar styling */
    .rounded-circle {
        border: 2px solid #007bff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentPasswordInput = document.getElementById('current_password');
        const newPasswordInput = document.getElementById('new_password');
        const confirmPasswordInput = document.getElementById('new_password_confirmation');

        const currentPasswordError = document.getElementById('current-password-error');
        const newPasswordError = document.getElementById('new-password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        // Kiểm tra mật khẩu hiện tại
        currentPasswordInput.addEventListener('input', () => {
            if (currentPasswordInput.value.length < 6) {
                currentPasswordError.textContent = 'Mật khẩu hiện tại phải có ít nhất 6 ký tự.';
            } else {
                currentPasswordError.textContent = '';
            }
        });

        // Kiểm tra mật khẩu mới
        newPasswordInput.addEventListener('input', () => {
            const password = newPasswordInput.value;
            const errors = [];

            if (password.length < 8) {
                errors.push('Mật khẩu phải có ít nhất 8 ký tự.');
            }
            if (!/[a-z]/.test(password)) {
                errors.push('Mật khẩu phải có ít nhất một chữ cái viết thường.');
            }
            if (!/[A-Z]/.test(password)) {
                errors.push('Mật khẩu phải có ít nhất một chữ cái viết hoa.');
            }
            if (!/[0-9]/.test(password)) {
                errors.push('Mật khẩu phải có ít nhất một chữ số.');
            }
            if (!/[@$!%*?&#]/.test(password)) {
                errors.push('Mật khẩu phải có ít nhất một ký tự đặc biệt (@, $, !, %, *, ?, &, #).');
            }

            if (errors.length > 0) {
                newPasswordError.innerHTML = errors.join('<br>');
            } else {
                newPasswordError.textContent = '';
            }
        });

        // Kiểm tra xác nhận mật khẩu mới
        confirmPasswordInput.addEventListener('input', () => {
            if (confirmPasswordInput.value !== newPasswordInput.value) {
                confirmPasswordError.textContent = 'Xác nhận mật khẩu không khớp.';
            } else {
                confirmPasswordError.textContent = '';
            }
        });

        // Kiểm tra mật khẩu hiện tại với server (AJAX)
        currentPasswordInput.addEventListener('blur', () => {
            fetch('/check-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ current_password: currentPasswordInput.value }),
            })
            .then(response => response.json())
            .then(data => {
                if (!data.valid) {
                    currentPasswordError.textContent = 'Mật khẩu hiện tại không đúng.';
                } else {
                    currentPasswordError.textContent = '';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons and panes
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            // Add active class to the clicked button and corresponding pane
            button.classList.add('active');
            document.getElementById(button.dataset.tab).classList.add('active');
        });
    });
</script>
@endsection