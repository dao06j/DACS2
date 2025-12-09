<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khách Hàng</title>
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
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    @include('layouts.sidebar_admin')
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Quản Lý Khách Hàng</h1>
        </div>

        @if(session('error'))
            <div class="alert alert-error">✗ {{ session('error') }}</div>
        @endif

        <div class="filters">
            <form method="GET" action="{{ route('customers') }}" class="filter-form">
                
                <div class="search-box">
                    <input type="text" name="search" placeholder="" value="{{ request('search') }}">
                </div>

                <button type="submit" class="btn btn-filter">🔎 Lọc</button>
            </form>
        </div>

        <div class="table-section">
            @if(isset($customers) && $customers->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Mã KH</th> 
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th> 
                            <th>Địa chỉ</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->MaKH }}</td>
                                <td>{{ $customer->HoTen }}</td> 
                                <td>{{ $customer->Email }}</td> 
                                <td>{{ $customer->Sdt }}</td> 
                                <td>{{ $customer->DiaChi }}</td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <div style="padding: 40px; text-align: center; color: #7f8c8d;">
                    <p style="font-size: 1.1rem;">Không tìm thấy sản phẩm nào.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>