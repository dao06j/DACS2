<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn của tôi</title>
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



    </style>
</head>
<body>
    <!-- SIDEBAR -->
    @include('index.header')
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <h1 class="page-title" style="text-align: center; margin-bottom: 20px;">Hóa đơn của tôi</h1>

        <div class="table-section">
            @if(isset($bills) && $bills->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Mã Hóa Đơn</th> 
                            <th>Tên Khách Hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th> 
                            <th>Ngày thanh toán</th>
                             <th>Trạng Thái</th>
                             <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{ $bill->MaHD }}</td> 
                                <td>{{ $bill->khachHang->HoTen }}</td>
                                <td>{{ $bill->khachHang->Sdt }}</td> 
                                <td>{{ $bill->khachHang->DiaChi }}</td> 
                                <td>{{ number_format($bill->TongTien, 0) . '₫' }}</td> 
                                <td>{{ $bill->NgayThanhToan }}</td>
                                 <td>{{$bill->TrangThai}}</td> 
                                 <td>
                                    <div class="action-btns">
                                        <a href="{{route('billDetail', $bill->MaHD)}}" class="btn-sm btn-edit"><b>Chi tiết</b></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <div style="padding: 40px; text-align: center; color: #7f8c8d;">
                    <p style="font-size: 1.1rem;">Không tìm thấy đơn hàng nào.</p>
                </div>
            @endif
        </div>
    </div>
    @include('index.footer')
</body>
</html>