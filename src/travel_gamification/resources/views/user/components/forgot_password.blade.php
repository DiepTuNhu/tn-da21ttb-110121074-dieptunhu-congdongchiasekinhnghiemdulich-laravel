@extends('user.master')
@section('content')
<style>
.forgot-password-container {
    max-width: 400px;
    margin: 200px auto 100px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 32px 28px 24px 28px;
}
.forgot-password-container h2 {
    text-align: center;
    margin-bottom: 24px;
    color: #2d3e50;
    font-weight: 700;
}
.forgot-password-container form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.forgot-password-container input[type="email"] {
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
    transition: border 0.2s;
}
.forgot-password-container input[type="email"]:focus {
    border: 1.5px solid #007bff;
}
.forgot-password-container button {
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
.forgot-password-container button:hover {
    background: #0056b3;
}
.forgot-password-container .alert {
    margin-bottom: 12px;
    padding: 10px;
    border-radius: 5px;
    background: #e6ffed;
    color: #1a7f37;
    border: 1px solid #b7eb8f;
    text-align: center;
}
.forgot-password-container .error {
    color: #e74c3c;
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 8px;
    text-align: left;
}
</style>
<div class="forgot-password-container">
    <h2>Quên mật khẩu</h2>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Nhập email" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror
        <button type="submit">Gửi liên kết đặt lại mật khẩu</button>
    </form>
</div>
@endsection