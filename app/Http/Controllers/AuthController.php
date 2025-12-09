<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('index.login');
    }
    public function handleLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự'
        ]);
        $adminEmail = 'admin123@gmail.com';
        $adminPassword = '123456';

        if ($validated['email'] === $adminEmail && $validated['password'] === $adminPassword) {
            $request->session()->regenerate();

            $request->session()->put('admin_name', 'Tran Nhan Dao');
            $request->session()->put('admin_email', $validated['email']);
            $request->session()->put('is_admin', true);

            $request->session()->flash('success', 'Đăng nhập thành công');

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_name');
        $request->session()->forget('admin_email');
        $request->session()->forget('is_admin');
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Đã đăng xuất');
    }

    public function showAuthForm()
    {
        return view('index.loginuser'); 
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:khach_hang,Email',
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $khachHang = KhachHang::create([
                'Email' => $request->email,
                'MatKhau' => $request->password, 
                'HoTen' => $request->name,
            ]);

            Session::put('khach_hang_id', $khachHang->MaKH);
            Session::put('khach_hang_name', $khachHang->HoTen);
            Session::put('khach_hang_email', $khachHang->Email);

            return redirect()->route('home')
                ->with('success', 'Đăng ký thành công! Chào mừng bạn đến với Nội Thất SARAH ');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string',
    ], [
        'email.required' => 'Vui lòng nhập email',
        'email.email' => 'Email không hợp lệ',
        'password.required' => 'Vui lòng nhập mật khẩu',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    try {
        $khachHang = KhachHang::where('Email', $request->email)->first();

        if (!$khachHang) {
            return redirect()->back()
                ->with('error', 'Email không tồn tại trong hệ thống')
                ->withInput();
        }

        $passwordCheck = Hash::check($request->password, $khachHang->MatKhau);
        
        if (!$passwordCheck) {
            return redirect()->back()
                ->with('error', 'Mật khẩu không chính xác. Vui lòng thử lại!')
                ->withInput();
        }

        Session::put('khach_hang_id', $khachHang->MaKH);
        Session::put('khach_hang_name', $khachHang->HoTen);
        Session::put('khach_hang_email', $khachHang->Email);

        if ($request->has('remember')) {
            cookie()->queue('remember_token', $khachHang->MaKH, 43200);
        }

        return  redirect('/')
            ->with('success', 'Đăng nhập thành công! Chào mừng trở lại ' . $khachHang->HoTen . ' 👋');

    } catch (\Exception $e) {
        Log::error('Login exception: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
            ->withInput();
    }
}
public function update(Request $request, KhachHang $khachHang)
    {
        $validatedData = $request->validate([
            'HoTen' => 'required|string|max:255',
            'Sdt' => 'required|string|max:20',
            'DiaChi' => 'nullable|string|max:500',
        ], [
            'HoTen.required' => 'Họ và Tên không được để trống.',
            'HoTen.max' => 'Họ và Tên không được quá 255 ký tự.',
            'Sdt.required' => 'Số Điện Thoại không được để trống.',
            'Sdt.max' => 'Số Điện Thoại không được quá 20 ký tự.',
            'DiaChi.max' => 'Địa Chỉ không được quá 500 ký tự.',
        ]);

        try {
            $khachHang->update($validatedData);
            return redirect()->route('profile')
                ->with('success', 'Cập nhật thông tin thành công!');

        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật profile', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->with('error', 'Có lỗi: ' . $e->getMessage())
                ->withInput();
        }

    }

    public function logoutus()
    {
        Session::forget('khach_hang_id');
        Session::forget('khach_hang_name');
        Session::forget('khach_hang_email');
        cookie()->queue(cookie()->forget('remember_token'));

        return redirect()->route('login')
            ->with('success', 'Đã đăng xuất thành công!');
    }
    public function customerList(Request $request)
{

    $search = $request->get('search');
    
    $query = KhachHang::query();
    if ($search) {
        $query->where('HoTen', 'like', '%' . $search . '%');
    }
    $customers = $query->latest()->paginate(10);
    return view('admin.customers.customer', compact('customers'))
        ->with([
            'search' => $search,
        ]);
}

}