<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in as admin
        if (!$request->session()->has('is_admin')) {
            return redirect('/admin/login')->with('error', 'Vui lòng đăng nhập');
        }
        return $next($request);
    }
}
