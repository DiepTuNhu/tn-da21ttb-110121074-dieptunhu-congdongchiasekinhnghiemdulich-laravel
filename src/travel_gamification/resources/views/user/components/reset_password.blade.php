@extends('user.master')
@section('content')
<style>
.reset-password-container {
    max-width: 400px;
    margin: 200px auto 100px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 32px 28px 24px 28px;
}
.reset-password-container h2 {
    text-align: center;
    margin-bottom: 24px;
    color: #2d3e50;
    font-weight: 700;
}
.reset-password-container form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.reset-password-container input[type="email"],
.reset-password-container input[type="password"] {
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
    transition: border 0.2s;
}
.reset-password-container input[type="email"]:focus,
.reset-password-container input[type="password"]:focus {
    border: 1.5px solid #007bff;
}
.reset-password-container button {
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 0;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.reset-password-container button:hover {
    background: #0056b3;
}
.reset-password-container .error {
    color: #e74c3c;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 8px;
    text-align: left;
}
</style>
<div class="reset-password-container">
    <h2>Đặt lại mật khẩu</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" value="{{ $email ?? old('email') }}" required placeholder="Email">
        <input type="password" name="password" placeholder="Mật khẩu mới" required>
        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror
        @error('password') <div class="error">{{ $message }}</div> @enderror
        <button type="submit">Đặt lại mật khẩu</button>
    </form>
</div>
@endsection