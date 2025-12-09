<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 2rem;
            color: #2c3e50;
            font-weight: bold;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #e74c3c;
            color: white;
        }

        .btn-primary:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .filters {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        /* THAY ĐỔI: Sử dụng flexbox để căn chỉnh tổng thể */
        display: flex;
        flex-direction: column; /* Đặt form bên trong xuống dòng nếu cần */
        gap: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .filter-form {
        /* THAY ĐỔI: Đảm bảo form căn chỉnh tốt */
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
        width: 100%; /* Đảm bảo form chiếm đủ không gian */
    }

    .search-box {
        flex: 1; /* Cho phép search-box mở rộng tối đa */
        min-width: 250px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.95rem;
    }
    
    /* Đảm bảo các nhóm select không bị kéo dãn quá mức */
    .filter-group {
        display: flex;
        gap: 10px;
        align-items: center;
        /* THAY ĐỔI: Đặt min-width để các select không bị ép */
        min-width: 150px; 
    }

    .filter-group label {
        font-weight: 600;
        color: #2c3e50;
        white-space: nowrap; /* Ngăn nhãn xuống dòng */
    }

    .filter-group select {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: white;
        cursor: pointer;
        min-width: 100px; /* Đảm bảo select có kích thước tối thiểu */
    }

    .btn-filter {
        /* THAY ĐỔI: Đảm bảo nút lọc có kích thước chuẩn */
        padding: 10px 20px; 
        background: #667eea;
        color: white;
        /* Ngăn nút bị co lại khi không đủ chỗ */
        flex-shrink: 0; 
    }
    
    /* ... (Giữ nguyên các style khác) ... */
    
    /* Responsive (Đảm bảo trên mobile, chúng vẫn xuống dòng) */
    @media (max-width: 768px) {
        /* ... (Các responsive style khác) ... */
        .filter-form {
            flex-direction: column;
            align-items: stretch; /* Đảm bảo các mục kéo dãn toàn bộ chiều rộng */
        }
        .search-box {
            min-width: unset; /* Loại bỏ min-width cứng trên mobile */
        }
        .filter-group {
            width: 100%; /* Kéo dãn các nhóm lọc */
            justify-content: space-between; /* Căn đều nhãn và select */
        }
        .filter-group select {
             flex: 1; /* Cho select mở rộng tối đa */
        }
    }

        .btn-filter {
            background: #667eea;
            color: white;
        }

        .btn-filter:hover {
            background: #5568d3;
        }

        .table-section {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: #f8f9fa;
        }

        .data-table th {
            padding: 15px;
            text-align: left;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
        }

        .data-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            color: #555;
        }

        .data-table tbody tr:hover {
            background: #f8f9fa;
        }

        .product-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-visible {
            background: #d4edda;
            color: #155724;
        }

        .status-hidden {
            background: #f8d7da;
            color: #721c24;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-edit:hover {
            background: #2980b9;
        }

        .btn-toggle {
            background: #f39c12;
            color: white;
        }

        .btn-toggle:hover {
            background: #d68910;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filters {
                flex-direction: column;
            }

            .data-table {
                font-size: 0.9rem;
            }

            .data-table th,
            .data-table td {
                padding: 10px;
            }

            .action-btns {
                flex-direction: column;
            }
        }

        /* ========== PAGINATION STYLES - THÊM VÀO ĐÂY ========== */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 20px;
            background: white;
            border-top: 1px solid #e9ecef;
            gap: 20px;
            flex-wrap: wrap;
        }

        .pagination {
            display: flex;
            list-style: none;
            gap: 8px;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a,
        .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .pagination .active span {
            background: #e74c3c;
            color: white;
            border-color: #e74c3c;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
        }

        .pagination .disabled span {
            color: #adb5bd;
            cursor: not-allowed;
            background: #f8f9fa;
            border-color: #e9ecef;
        }

        .pagination .page-prev,
        .pagination .page-next {
            font-weight: 600;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.95rem;
            text-align: center;
            min-width: 200px;
        }

        @media (max-width: 768px) {
            .pagination-wrapper {
                flex-direction: column;
                gap: 15px;
            }

            .pagination a,
            .pagination span {
                min-width: 35px;
                height: 35px;
                font-size: 0.9rem;
                padding: 0 10px;
            }

            .pagination-info {
                font-size: 0.85rem;
            }
        }
        /* ========== KẾT THÚC PAGINATION STYLES ========== */

        /* ========== MODAL/POPUP STYLES ========== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: slideIn 0.3s;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 1.5rem;
            margin: 0;
        }

        .modal-close {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .modal-close:hover {
            background: rgba(255,255,255,0.3);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px 25px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-control:disabled {
            background: #e9ecef;
            cursor: not-allowed;
        }

        .info-display {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
        }

        .info-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .modal-footer {
            padding: 20px 25px;
            background: #f8f9fa;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-modal {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .btn-cancel {
            background: #e9ecef;
            color: #6c757d;
        }

        .btn-cancel:hover {
            background: #dee2e6;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                margin: 20px;
            }

            .modal-body {
                padding: 20px 15px;
            }

            .modal-footer {
                flex-direction: column;
            }

            .btn-modal {
                width: 100%;
            }
        }

    </style>
</head>
<body>
    <!-- SIDEBAR -->
    @include('layouts.sidebar_admin')
    <!-- MAIN CONTENT -->
    <div class="main-content">

        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">✗ {{ session('error') }}</div>
        @endif

        <div class="filters">
            <form method="GET" action="{{ route('admin.importproducts.index') }}" class="filter-form">
                
                <div class="search-box">
                    <input type="text" name="search" placeholder="🔍 Tìm kiếm sản phẩm..." value="{{ request('search') }}">
                </div>

                <div class="filter-group">
                    <label for="category">Loại:</label>
                    <select name="category" id="category">
                        <option value="all" {{ request('category') === 'all' || !request('category') ? 'selected' : '' }}>Tất Cả Loại</option>
                        
                        @php
                            $categories = [
                                'Tủ' => 'Tủ',
                                'Giường' => 'Giường',
                                'Bàn' => 'Bàn',
                                'Ghế' => 'Ghế',
                                'Trang Trí' => 'Trang Trí'
                            ];
                        @endphp

                        @foreach($categories as $value => $label)
                            <option value="{{ $value }}" {{ request('category') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-filter">🔎 Lọc</button>
            </form>
        </div>

        <div class="table-section">
            @if(isset($products) && $products->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Mã SP</th> 
                            <th>Hình Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Loại SP</th> 
                            <th>Đơn Giá</th> 
                            <th>SL Tồn</th> 
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->MaSP }}</td> 
                                <td>
                                    @if($product->HinhAnh)
                                        <img src="{{ asset('storage/' . $product->HinhAnh) }}" alt="{{ $product->TenSP }}" class="product-img">
                                    @else
                                        <img src="https://via.placeholder.com/50/f5f5f5/888888?text=No+Img" alt="No Image" class="product-img">
                                    @endif
                                </td>
                                <td>{{ $product->TenSP }}</td> 
                                <td>{{ $product->LoaiSP }}</td> 
                                <td>{{ number_format($product->DonGia, 0) . '₫' }}</td> 
                                <td>{{ number_format($product->SLTonKho) }}</td> 
                                <td>
                                    <div class="action-btns">
                                        <button type="button" onclick="openImportModal('{{ $product->MaSP }}', '{{ $product->TenSP }}', {{ $product->SLTonKho }})" class="btn-sm btn-edit"><b>Nhập hàng</b></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- ========== THÊM PHÂN TRANG VÀO ĐÂY ========== -->
                @if($products->hasPages())
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Hiển thị {{ $products->firstItem() }} - {{ $products->lastItem() }} 
                            trong tổng số {{ $products->total() }} sản phẩm
                        </div>

                        <ul class="pagination">
                            {{-- Previous Page --}}
                            @if ($products->onFirstPage())
                                <li class="disabled">
                                    <span>← Trước</span>
                                </li>
                            @else
                                <li class="page-prev">
                                    <a href="{{ $products->previousPageUrl() }}" rel="prev">← Trước</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li class="active">
                                        <span>{{ $page }}</span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page --}}
                            @if ($products->hasMorePages())
                                <li class="page-next">
                                    <a href="{{ $products->nextPageUrl() }}" rel="next">Sau →</a>
                                </li>
                            @else
                                <li class="disabled">
                                    <span>Sau →</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
                <!-- ========== KẾT THÚC PHÂN TRANG ========== -->

            @else
                <div style="padding: 40px; text-align: center; color: #7f8c8d;">
                    <p style="font-size: 1.1rem;">Không tìm thấy sản phẩm nào.</p>
                </div>
            @endif
        </div>
    </div>

      <!-- ========== MODAL NHẬP HÀNG ========== -->
    <div id="importModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="text-align: center;">Nhập Hàng</h3>
                <button class="modal-close" onclick="closeImportModal()">×</button>
            </div>

            <form id="importForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="product_id" name="MaSP">

                <div class="modal-body">
                    <!-- Thông tin sản phẩm -->
                    <div class="info-display">
                        <div class="info-item">
                            <span class="info-label">Tên sản phẩm:</span>
                            <span class="info-value" id="product_name">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Số lượng tồn hiện tại:</span>
                            <span class="info-value" id="current_stock">0</span>
                        </div>
                    </div>

                    <!-- Input số lượng nhập -->
                    <div class="form-group" style="margin-top: 25px;">
                        <label for="import_quantity" class="form-label">
                            Số lượng nhập thêm <span style="color: red;">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="import_quantity" 
                            name="SoLuongNhap" 
                            class="form-control" 
                            placeholder="Nhập số lượng..."
                            min="1"
                            required>
                    </div>

                    <!-- Hiển thị tổng sau khi nhập -->
                    <div class="info-display" style="background: #e7f3ff; border-left-color: #667eea;">
                        <div class="info-item">
                            <span class="info-label">Tổng sau khi nhập:</span>
                            <span class="info-value" style="color: #667eea; font-size: 1.2rem;" id="total_after">0</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-modal btn-cancel" onclick="closeImportModal()">
                        Hủy
                    </button>
                    <button type="submit" class="btn-modal btn-confirm">
                        ✓ Xác Nhận Nhập
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStock = 0;

        // Mở modal nhập hàng
        function openImportModal(productId, productName, stock) {
            currentStock = stock;
            
            document.getElementById('product_id').value = productId;
            document.getElementById('product_name').textContent = productName;
            document.getElementById('current_stock').textContent = stock.toLocaleString();
            document.getElementById('import_quantity').value = '';
            document.getElementById('total_after').textContent = stock.toLocaleString();

            const form = document.getElementById('importForm');
            form.action = `/admin/importproducts`;
            
            document.getElementById('importModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeImportModal() {
            document.getElementById('importModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('import_quantity').addEventListener('input', function() {
            const importQty = parseInt(this.value) || 0;
            const total = currentStock + importQty;
            document.getElementById('total_after').textContent = total.toLocaleString();
        });

        document.getElementById('importModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImportModal();
            }
        });
    </script>

</body>
</html>