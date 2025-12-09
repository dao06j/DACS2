<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\CTGioHang;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BillController extends Controller
{
    public function paymentview()
    {
       if (!Session::has('khach_hang_id')) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
    }
    $khachHangId = Session::get('khach_hang_id');
    $khachHang = KhachHang::find($khachHangId);
    if (empty($khachHang->Sdt) || empty($khachHang->DiaChi)) {
        return redirect()->route('profile')->with('error', 'Vui lòng thêm đầy đủ thông tin.');
    }
        $items = CTGioHang::where('MaKH', $khachHang->MaKH)
            ->with('sanPham')
            ->get();
        $total = $items->sum('ThanhTien');

        return view('users.payment', compact('items', 'khachHang', 'total'));
    }

    /**
     * Xử lý đặt hàng: Chuyển giỏ hàng thành hóa đơn
     */
    public function placeOrder(Request $request)
    {
        // 1. Kiểm tra Auth và lấy Khách hàng (Đảm bảo an toàn)
        $khachHangId = Session::get('khach_hang_id');
        $khachHang = KhachHang::find($khachHangId);

        if (!$khachHang) {
            return redirect()->route('login')->with('error', 'Phiên đăng nhập hết hạn.');
        }

        // 2. Lấy danh sách sản phẩm trong giỏ hàng
        $cartItems = CTGioHang::where('MaKH', $khachHang->MaKH)->with('sanPham')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống, không thể đặt hàng.');
        }
        
        // Bắt đầu Transaction
        DB::beginTransaction();

        try {
            $tongTien = $cartItems->sum(function ($item) {
                return $item->sanPham->DonGia * $item->SoLuong;
            });

            // 3. Tạo HÓA ĐƠN CHÍNH (HoaDon Header)
            $hoaDon = HoaDon::create([
                'MaKH' => $khachHang->MaKH,
                'TongTien' => $tongTien,
                'TrangThai' => 'Chờ xử lý',
                'NgayThanhToan' => Carbon::now(),
            ]);
            
            // 4. Tạo CHI TIẾT HÓA ĐƠN và Cập nhật Tồn kho
            foreach ($cartItems as $item) {
                // Kiểm tra tồn kho lần cuối
                $sanPham = SanPham::find($item->MaSP);
                if (!$sanPham || $sanPham->SLTonKho < $item->SoLuong) {
                    DB::rollBack();
                    return back()->with('error', 'Lỗi: Sản phẩm ' . $sanPham->TenSP . ' không đủ tồn kho (' . $sanPham->SLTonKho . ').');
                }

                // Tạo Chi Tiết Hóa Đơn
                ChiTietHoaDon::create([
                    'MaHD' => $hoaDon->MaHD, 
                    'MaSP' => $item->MaSP,
                    'SoLuong' => $item->SoLuong,
                    'DonGia' => $item->sanPham->DonGia,
                    'ThanhTien' => $item->sanPham->DonGia * $item->SoLuong,
                ]);

                $sanPham->decrement('SLTonKho', $item->SoLuong);
                $sanPham->increment('SLDaBan', $item->SoLuong);
            }

            CTGioHang::where('MaKH', $khachHang->MaKH)->delete();

            DB::commit(); 

            return redirect()->route('bill') 
                ->with('success', 'Đặt hàng thành công! Mã đơn hàng: ' . $hoaDon->MaHD);

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->with('error', 'Lỗi hệ thống: Không thể xử lý đơn hàng. Vui lòng thử lại. (' . $e->getMessage() . ')');
        }
    }

    public function billList(Request $request)
{
    if (!Session::has('khach_hang_id')) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
    }
    $khachHangId = Session::get('khach_hang_id');
    $khachHang = KhachHang::find($khachHangId);
        $bills = HoaDon::where('MaKH', $khachHang->MaKH)
            ->with('khachHang')
            ->get();

        return view('users.bill', compact('bills'));
}

public function billDetail($maHD)
    {

        $cthd = ChiTietHoaDon::where('MaHD', $maHD)->with('sanPham')
            ->get();

            return view('users.billdetail', [
            'cthd' => $cthd,
        ]);

    }

    public function adminBillDetail($maHD)
    {

        $cthd = ChiTietHoaDon::where('MaHD', $maHD)->with('sanPham')
            ->get();

            return view('admin.bill.billdetailmanagement', [
            'cthd' => $cthd,
        ]);

    }

    public function billListManager(Request $request)
{
     $search = $request->get('search'); 
    
    $query = HoaDon::with('khachHang'); 

     if ($search) {
        $query->whereHas('khachHang', function($q) use ($search) {
            $q->where('HoTen', 'like', '%' . $search . '%');
        });
    }

    $bills = $query->latest()->paginate(10);

    return view('admin.bill.billmanagement', compact('bills'))
        ->with([
            'search' => $search
        ]);
}

    public function toggleStatus(HoaDon $bill)
{
    $currentStatus = $bill->TrangThai;
    $newStatus = 'Đã giao';
    $bill->update(['TrangThai' => $newStatus]);
    return back()->with('success', 'Đã chuyển trạng thái sản phẩm sang: ' . $newStatus);
}

}
