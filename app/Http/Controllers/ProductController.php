<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CTGioHang;
use App\Models\DanhGia;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function adminList(Request $request)
{
    $search = $request->get('search');
    $categoryFilter = $request->get('category', 'all');
    $statusFilter = $request->get('status', 'all');   
    
    $query = SanPham::query();

    if ($search) {
        $query->where('TenSP', 'like', '%' . $search . '%');
    }
    if ($categoryFilter && $categoryFilter !== 'all') {
        $query->where('LoaiSP', $categoryFilter);
    }
    if ($statusFilter && $statusFilter !== 'all') {
        $query->where('TrangThai', $statusFilter); 
    }
    $products = $query->latest()->paginate(10);
    return view('admin.products.SanPham', compact('products'))
        ->with([
            'search' => $search,
            'category' => $categoryFilter,
            'status' => $statusFilter,
        ]);
}

    public function edit(SanPham $product)
    {
        $categories = [
            'Tủ' => 'Tủ',
            'Giường' => 'Giường',
            'Bàn' => 'Bàn',
            'Ghế' => 'Ghế',
            'Trang Trí' => 'Trang Trí',
        ];
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, SanPham $product)
{

    $validatedData = $request->validate([
        'TenSP' => 'required|string|max:255', 
        'LoaiSP' => 'required|string|max:255',
        'DonGia' => 'required|numeric|min:0', 
        'MoTa' => 'nullable|string',    
        'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    if ($request->hasFile('HinhAnh') && $request->file('HinhAnh')->isValid()) {

        try {

            $file = $request->file('HinhAnh');
            $directory = storage_path('app/public/images');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            if ($product->HinhAnh) {
                $oldImagePath = storage_path('app/public/' . $product->HinhAnh);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

            }
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $fileName);
            $validatedData['HinhAnh'] = 'images/' . $fileName;
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi khi upload ảnh: ' . $e->getMessage());

        }
    }
    $product->update($validatedData);
    return redirect()->route('admin.products.index')
        ->with('success', 'Cập nhật sản phẩm thành công!');
}

    public function toggleStatus(SanPham $product)
{
    $currentStatus = $product->TrangThai;
    $newStatus = ($currentStatus === 'Hiện') ? 'Ẩn' : 'Hiện';
    $product->update(['TrangThai' => $newStatus]);
    return back()->with('success', 'Đã chuyển trạng thái sản phẩm ' . $product->TenSP . ' sang: ' . $newStatus);
}

    public function create()
    {
        return view('admin.products.create');
    }
 public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:100', 
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0', 
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    $imagePath = null;
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $file = $request->file('image');
        $directory = storage_path('app/public/images');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);
        $imagePath = 'images/' . $fileName;
    }
    $dataToCreate = [
        'TenSP' => $validated['name'],
        'LoaiSP' => $validated['category'], 
        'MoTa' => $validated['description'] ?? null,
        'DonGia' => $validated['price'],
        'HinhAnh' => $imagePath,
        'SLTonKho' => 0, 
        'SLDaBan' => 0,
        'TrangThai' => 'Hiện',
    ];
    SanPham::create($dataToCreate);

    return redirect()->route('admin.products.index')
        ->with('success', 'Thêm sản phẩm thành công!');
}
    public function index()
    {
        $products = SanPham::where('TrangThai', 'Hiện')->inRandomOrder()->limit(12)->get();
        $products1 = SanPham::where('TrangThai', 'Hiện')->orderBy('SLDaBan', 'desc')->limit(12)->get();
        $products2 = SanPham::where('TrangThai', 'Hiện')->latest()->limit(12)->get();
        return view('HomePage', compact('products', 'products1', 'products2'));
    }

     public function show($maSP)
    {

        $san_pham = SanPham::where('MaSP', $maSP)->first();
        $relatedProducts = SanPham::where('MaSP', '!=', $san_pham->MaSP)
                                  ->inRandomOrder()
                                  ->limit(4)
                                  ->get();

        $reviews = DanhGia::with('khachHang')
                          ->where('MaSP', $maSP)
                          ->orderBy('NgayDG', 'desc')
                          ->paginate(5);

        $totalReviews = DanhGia::where('MaSP', $maSP)->count();

        $hasReviewed = false;
        try {


            if (Session::has('khach_hang_id')) {
            $khachHangId = Session::get('khach_hang_id');
            $khachHang = KhachHang::find($khachHangId);
            $hasReviewed = DanhGia::where('MaKH', $khachHang->MaKH)
                                     ->where('MaSP', $maSP)
                                     ->exists();
            }

            return view('users.productdetail', [
            'san_pham' => $san_pham,
            'relatedProducts' => $relatedProducts, 
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'hasReviewed' => $hasReviewed 
        ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }

    }

    // Nhập sp

    public function importList(Request $request)
{
    $search = $request->get('search');
    $categoryFilter = $request->get('category', 'all');   
    
    $query = SanPham::query();

    if ($search) {
        $query->where('TenSP', 'like', '%' . $search . '%');
    }

    if ($categoryFilter && $categoryFilter !== 'all') {
        $query->where('LoaiSP', $categoryFilter);
    }

    $products = $query->latest()->paginate(10);

    return view('admin.products.importProduct', compact('products'))
        ->with([
            'search' => $search,
            'category' => $categoryFilter,
        ]);
}

    public function import(Request $request)
{
    $validatedData = $request->validate([
        'MaSP' => 'required|string|max:255',
        'SoLuongNhap' => 'required|integer|min:1',  
    ]);

           try {

            $product = SanPham::where('MaSP', $validatedData['MaSP'])->first();
            $importQty = $validatedData['SoLuongNhap'];
            $product->increment('SLTonKho', $importQty); 
            
            return redirect()->route('admin.importproducts.index') // Chuyển hướng đến trang quản lý chung
                ->with('success', 'Nhập hàng thành công! Đã thêm ' . $importQty . ' sản phẩm vào tồn kho.');
        
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi xử lý nhập hàng: ' . $e->getMessage());
        }

}

// Thêm vào giỏ hàng


    public function add(Request $request)
    {
        $validated = $request->validate([
            'MaSP' => 'required|string|exists:sanpham,MaSP', 
            'SoLuong' => 'required|integer|min:1',
        ]);

        try {
            if (!Session::has('khach_hang_id')) {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm vào giỏ hàng.');
            }

            $khachHangId = Session::get('khach_hang_id');
            $khachHang = KhachHang::find($khachHangId);

            if (!$khachHang) {
                 return back()->with('error', 'Thông tin khách hàng không tìm thấy.');
            }

            $sanPham = SanPham::findOrFail($validated['MaSP']);

            $chiTiet = CTGioHang::where('MaKH', $khachHang->MaKH)
                ->where('MaSP', $validated['MaSP'])
                ->first();

            if ($chiTiet) {
                $soLuongMoi = $chiTiet->SoLuong + $validated['SoLuong'];

                if ($sanPham->SLTonKho < $soLuongMoi) {
                    return back()->with('error', "Bạn đã có {$chiTiet->SoLuong} sản phẩm trong giỏ. Không thể thêm {$validated['SoLuong']} nữa.");
                }         

                $chiTiet->SoLuong = $soLuongMoi;
                $chiTiet->ThanhTien = $soLuongMoi * $sanPham->DonGia; 
                $chiTiet->save();
                
            } else {
                CTGioHang::create([
                    'MaKH' => $khachHang->MaKH,
                    'MaSP' => $validated['MaSP'],
                    'SoLuong' => $validated['SoLuong'],
                    'ThanhTien' => $validated['SoLuong'] * $sanPham->DonGia, 
                ]);
            }
            return redirect()->route('cart.index') 
                ->with('success', "Đã thêm {$validated['SoLuong']} sản phẩm vào giỏ hàng!");

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function giohangview()
    {
       if (!Session::has('khach_hang_id')) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
    }
    $khachHangId = Session::get('khach_hang_id');
    $khachHang = KhachHang::find($khachHangId);
        $items = CTGioHang::where('MaKH', $khachHang->MaKH)
            ->with('sanPham')
            ->get();
        $total = $items->sum('ThanhTien');

        return view('users.cart', compact('items', 'total'));
    }

    public function remove($maCTGH)
    {
        try {
            $chiTiet = CTGioHang::where('MaCTGH', $maCTGH)
                ->firstOrFail();
                
            $chiTiet->delete();

            return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra.');
        }
    }

    public function updateqty(Request $request, $maCTGH)
    {
        $validated = $request->validate([
            'SoLuong' => 'required|integer|min:1',
        ]);

        try {
            $chiTiet = CTGioHang::where('MaCTGH', $maCTGH)
                ->where('MaKH', Auth::user()->MaKH)
                ->firstOrFail();
                
            $sanPham = $chiTiet->sanPham;

            if ($sanPham->SLTonKho < $validated['SoLuong']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng vượt quá tồn kho.'
                ], 400);
            }

            $chiTiet->SoLuong = $validated['SoLuong'];
            $chiTiet->ThanhTien = $validated['SoLuong'] * $chiTiet->GiaLucMua;
            $chiTiet->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật số lượng.',
                'thanh_tien' => number_format($chiTiet->ThanhTien, 0, ',', '.')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra.'
            ], 500);
        }
    }

    public function count()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = CTGioHang::where('MaKH', Auth::user()->MaKH)->sum('SoLuong');
        
        return response()->json(['count' => $count]);
    }

    //Search
    public function search(Request $request)
{
    $search = $request->get('q'); 
    $query = SanPham::query();

    if ($search) {
        $query->where('TenSP', 'like', '%' . $search . '%');
    }
    $products = $query->latest()->get();
    return view('find', compact('products', 'search'))
        ->with([
            'search' => $search,
        ]);
}

public function category(string $categoryName)
{
    $products = SanPham::where('LoaiSP', $categoryName)->get();
    return view('category', compact('products', 'categoryName'));
}

}

