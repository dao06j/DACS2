<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use App\Models\KhachHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        if (!Session::has('khach_hang_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để đánh giá sản phẩm',
                'redirect' => route('login')
            ]);
        }

        $request->validate([
            'MaSP' => 'required|exists:sanpham,MaSP',
            'NoiDung' => 'required|string|min:10|max:1000'
        ], [
            'MaSP.required' => 'Không tìm thấy sản phẩm',
            'MaSP.exists' => 'Sản phẩm không tồn tại',
            'NoiDung.required' => 'Vui lòng nhập nội dung đánh giá',
            'NoiDung.min' => 'Nội dung đánh giá phải có ít nhất 10 ký tự',
            'NoiDung.max' => 'Nội dung đánh giá không được quá 1000 ký tự'
        ]);

        $khachHangId = Session::get('khach_hang_id');
        $khachHang = KhachHang::find($khachHangId);
        $existingReview = DanhGia::where('MaKH', $khachHang->MaKH)
                                 ->where('MaSP', $request->MaSP)
                                 ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã đánh giá sản phẩm này rồi. Bạn có thể sửa đánh giá hiện tại.'
            ]);
        }

        // Tạo đánh giá mới (MaDG sẽ tự động tạo trong boot())
        $danhGia = DanhGia::create([
            'MaKH' => $khachHang->MaKH,
            'MaSP' => $request->MaSP,
            'NoiDung' => $request->NoiDung,
            'NgayDG' => Carbon::now()->toDateString()
        ]);

        // Load relationship để trả về dữ liệu đầy đủ
        $danhGia->load('khachHang');

        return response()->json([
            'success' => true,
            'message' => 'Cảm ơn bạn đã đánh giá sản phẩm!',
            'review' => [
                'MaDG' => $danhGia->MaDG,
                'TenKH' => $danhGia->khachHang->TenKH ?? 'Khách hàng',
                'NoiDung' => $danhGia->NoiDung,
                'NgayDG' => $danhGia->formatted_date
            ]
        ]);
    }

    // Cập nhật đánh giá
    public function update(Request $request, $maDG)
    {
        if (!Session::has('khach_hang_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập'
            ]);
        }

        $khachHangId = Session::get('khach_hang_id');
        $khachHang = KhachHang::find($khachHangId);
        $danhGia = DanhGia::findOrFail($maDG);

        // Kiểm tra quyền sở hữu
        if ($danhGia->MaKH !== $khachHang->MaKH) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền chỉnh sửa đánh giá này'
            ]);
        }

        $request->validate([
            'NoiDung' => 'required|string|min:10|max:1000'
        ]);

        $danhGia->update([
            'NoiDung' => $request->NoiDung,
            'NgayDG' => Carbon::now()->toDateString()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật đánh giá thành công!',
            'review' => [
                'NoiDung' => $danhGia->NoiDung,
                'NgayDG' => $danhGia->formatted_date
            ]
        ]);
    }

    // Xóa đánh giá
    public function destroy($maDG)
    {
        if (!Session::has('khach_hang_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập'
            ]);
        }
        $khachHangId = Session::get('khach_hang_id');
        $khachHang = KhachHang::find($khachHangId);
        $danhGia = DanhGia::findOrFail($maDG);

        // Kiểm tra quyền sở hữu
        if ($danhGia->MaKH !== $khachHang->MaKH) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền xóa đánh giá này'
            ]);
        }

        $danhGia->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa đánh giá thành công!'
        ]);
    }

    // Lấy danh sách đánh giá của sản phẩm
    public function getByProduct($maSP)
    {
        $reviews = DanhGia::with('khachHang')
                          ->bySanPham($maSP)
                          ->paginate(10);

        return response()->json([
            'success' => true,
            'reviews' => $reviews
        ]);
    }
}