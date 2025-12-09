<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CheckKhachHangAuth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Auth routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'handleLogin'])->name('admin.login.handle');

// Protected admin routes
Route::middleware(['admin'])->group(function () {

    //Logout
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    // Product management
    Route::get('/admin/products', [ProductController::class, 'adminList'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::post('/admin/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('admin.products.toggle');

    //Nhập sp
    Route::get('/admin/importproducts', [ProductController::class, 'importList'])->name('admin.importproducts.index');
    Route::put('/admin/importproducts', [ProductController::class, 'import'])->name('admin.importproducts.import');

    // customers
    Route::get('/admin/customers', [AuthController::class, 'customerList'])->name('customers');

    //Bill
    Route::get('/admin/billManager', [BillController::class, 'billListManager'])->name('admin.billManager');
    Route::get('/admin/billManager/detail/{MaHD}', [BillController::class, 'adminBillDetail'])->name('admin.detail');
    Route::post('/admin/billManager/{bill}/toggle-status', [BillController::class, 'toggleStatus'])->name('admin.bill.toggle');

    //Thống kê
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('admin.dashboard.chart-data');
    
});


Route::get('/about', function () {
    return view('aboutus');
});

Route::get('/location', function () {
    return view('location');
});

Route::get('/find', [ProductController::class, 'search'])->name('search');
Route::get('/category/{categoryName}', [ProductController::class, 'category'])->name('category');

Route::get('/login', [AuthController::class, 'showAuthForm'])->name('login');

// Xử lý đăng ký
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Xử lý đăng nhập
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware([CheckKhachHangAuth::class])->group(function () {

    // Đăng xuất
    Route::get('/logout', [AuthController::class, 'logoutus'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logoutus'])->name('logout.post');
    Route::get('/profile', function () {
    return view('users.profile');
    })->name('profile');

    // Thêm giỏ hàng

    Route::post('/cart/add', [ProductController::class, 'add'])->name('cart.add');
    Route::get('/cart', [ProductController::class, 'giohangview'])->name('cart.index');
    Route::delete('/cart/{maCTGH}', [ProductController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/{maCTGH}', [ProductController::class, 'update'])->name('cart.update');
    Route::get('/cart/count', [ProductController::class, 'count'])->name('cart.count');

    //Thanh toán
    Route::get('/payment', [BillController::class, 'paymentview'])->name('payment');
    Route::post('/payment/placeorder', [BillController::class, 'placeOrder'])->name('payment.placeOrder');

    //Hóa đơn
    Route::get('/bill', [BillController::class, 'billList'])->name('bill');
    Route::get('/bill/detail/{MaHD}', [BillController::class, 'billDetail'])->name('billDetail');

    //Đánh giá
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{maDG}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{maDG}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/product/{maSP}', [ReviewController::class, 'getByProduct'])->name('reviews.by-product');


});

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');
Route::put('/profile/update/{khachHang}', [AuthController::class, 'update'])->name('profile.update');