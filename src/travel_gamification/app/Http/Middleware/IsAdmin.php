<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra user đã đăng nhập và có role là quản trị (không phân biệt hoa thường)
        if (!Auth::check() || strtolower(Auth::user()->role->name) !== 'quản trị') {
            abort(403, 'Bạn không có quyền truy cập!');
        }
        return $next($request);
    }
}
