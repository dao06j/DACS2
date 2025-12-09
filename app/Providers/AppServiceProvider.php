<?php

namespace App\Providers;

use Illuminate\Support\Facades\View; // Đảm bảo dòng này có
use Illuminate\Support\Facades\Session; // Đảm bảo dòng này có
use Illuminate\Support\Facades\Auth; // THÊM DÒNG NÀY CHO USER/ADMIN
use Illuminate\Support\ServiceProvider;

// BỔ SUNG: Import các Model cần thiết để truy vấn CSDL
use App\Models\KhachHang; 
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $khachHang = null;
            if (Session::has('khach_hang_id')) {
                $khachHangId = Session::get('khach_hang_id');
                $khachHang = KhachHang::find($khachHangId);
            }           
            $view->with('khachHang', $khachHang);
        });
    }
}