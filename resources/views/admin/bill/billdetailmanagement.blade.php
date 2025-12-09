<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết hóa đơn</title>
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
            min-height: 100vh;
            padding: 30px;
        }

        .page-header {
            margin: auto;
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

                .product-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
        }

        .btn {
            padding: 12px 25px;
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

         .btn-secondary {
            background: #7f8c8d;
            color: white;
        }

        .btn-secondary:hover {
            background: #6c7a7f;
        }

    </style>
</head>
<body>
    @include('layouts.sidebar_admin')
    <div class="main-content">
        <h1 class="page-title" style="text-align: center; margin-bottom: 20px;">Chi tiết hóa đơn</h1>

        <div class="table-section">
            @if(isset($cthd) && $cthd->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Mã Hóa Đơn</th> 
                            <th>Tên Sản phẩm</th>
                            <th>Hình Ảnh</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th> 
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cthd as $ct)
                            <tr>
                                <td>{{ $ct->MaHD }}</td> 
                                <td>{{ $ct->sanPham->TenSP }}</td>
                                <td> @if($ct->sanPham->HinhAnh)
                                        <img src="{{ asset('storage/' . $ct->sanPham->HinhAnh) }}" alt="{{ $ct->sanPham->TenSP }}" class="product-img">
                                    @else
                                        <img src="https://via.placeholder.com/50/f5f5f5/888888?text=No+Img" alt="No Image" class="product-img">
                                    @endif</td>
                                <td>{{ $ct->SoLuong }}</td> 
                                <td>{{ $ct->DonGia }}</td> 
                                <td>{{ number_format($ct->ThanhTien, 0) . '₫' }}</td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
                          <div style="margin-top: 20px;">
                            <a href="{{route('admin.billManager')}}" class="btn btn-secondary">
                            <span>Quay Lại</span>
                            </a>
                          </div>
    </div>
</body>
</html>