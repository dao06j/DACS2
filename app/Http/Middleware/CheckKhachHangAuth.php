<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckKhachHangAuth
{

    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('khach_hang_id')) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để tiếp tục!');
        }
        return $next($request);
    }
}