<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê tổng quan
        $tongSanPham = SanPham::count();
        $tongKhachHang = KhachHang::count();
        
        // Đơn hàng chờ duyệt (status = 'pending' hoặc 'cho_duyet')
        $donHangChoDuyet = HoaDon::where('TrangThai', 'Chờ xử lý')
                                  ->count();

        $doanhThu = HoaDon::sum('TongTien');
        
        // Doanh thu 7 ngày gần nhất
        $doanhThu7Ngay = $this->getRevenueLastDays(7);
        
        // Top 5 sản phẩm bán chạy
        $topSanPham = $this->getTopSellingProducts(5);
        
        // Thống kê đơn hàng theo trạng thái
        $donHangTheoTrangThai = $this->getOrdersByStatus();
        
        // Doanh thu theo tháng (12 tháng gần nhất)
        $doanhThuTheoThang = $this->getRevenueByMonth(12);

        return view('index.dashboard', compact(
            'tongSanPham',
            'tongKhachHang',
            'donHangChoDuyet',
            'doanhThu',
            'doanhThu7Ngay',
            'topSanPham',
            'donHangTheoTrangThai',
            'doanhThuTheoThang'
        ));
    }

    // Lấy doanh thu theo ngày (7 ngày gần nhất)
    private function getRevenueLastDays($days = 7)
    {
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $revenue = HoaDon::whereDate('NgayThanhToan', $date)->sum('TongTien');
            
            $data[] = [
                'date' => $date->format('d/m'),
                'revenue' => $revenue
            ];
        }
        return $data;
    }

    // Lấy top sản phẩm bán chạy
    private function getTopSellingProducts($limit = 5)
    {
        return DB::table('chi_tiet_hoa_don')
            ->join('sanpham', 'chi_tiet_hoa_don.MaSP', '=', 'sanpham.MaSP')
            ->select(
                'sanpham.MaSP',
                'sanpham.TenSP',
                'sanpham.HinhAnh',
                DB::raw('SUM(chi_tiet_hoa_don.SoLuong) as TongSoLuong'),
                DB::raw('SUM(chi_tiet_hoa_don.SoLuong * chi_tiet_hoa_don.DonGia) as TongDoanhThu')
            )
            ->groupBy('sanpham.MaSP', 'sanpham.TenSP', 'sanpham.HinhAnh')
            ->orderBy('TongSoLuong', 'desc')
            ->limit($limit)
            ->get();
    }

    // Thống kê đơn hàng theo trạng thái
    private function getOrdersByStatus()
    {
        return HoaDon::select('TrangThai', DB::raw('count(*) as total'))
            ->groupBy('TrangThai')
            ->get();
    }

    // Doanh thu theo tháng
    private function getRevenueByMonth($months = 12)
    {
        $data = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = HoaDon::whereYear('NgayThanhToan', $date->year)
                            ->whereMonth('NgayThanhToan', $date->month)
                            ->sum('TongTien');
            
            $data[] = [
                'month' => $date->format('m/Y'),
                'revenue' => $revenue
            ];
        }
        return $data;
    }

    // API để lấy dữ liệu biểu đồ (cho AJAX)
    public function getChartData(Request $request)
    {
        $type = $request->get('type', 'revenue_7days');
        
        switch ($type) {
            case 'revenue_7days':
                return response()->json($this->getRevenueLastDays(7));
            case 'revenue_30days':
                return response()->json($this->getRevenueLastDays(30));
            case 'revenue_monthly':
                return response()->json($this->getRevenueByMonth(12));
            default:
                return response()->json([]);
        }
    }
}