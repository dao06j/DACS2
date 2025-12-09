<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Quản Lý Cửa Hàng')</title>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <style>

         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
        }

        .nav-item {
            margin: 5px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            padding-left: 25px;
        }

        .nav-link.active {
            background: rgba(52, 152, 219, 0.3);
            border-left: 4px solid #3498db;
        }

        .nav-icon {
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #2c3e50;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            opacity: 0.1;
        }

        .stat-card.blue::before { background: #3498db; }
        .stat-card.green::before { background: #2ecc71; }
        .stat-card.yellow::before { background: #f39c12; }
        .stat-card.red::before { background: #e74c3c; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-card.blue .stat-icon { background: rgba(52, 152, 219, 0.1); color: #3498db; }
        .stat-card.green .stat-icon { background: rgba(46, 204, 113, 0.1); color: #2ecc71; }
        .stat-card.yellow .stat-icon { background: rgba(243, 156, 18, 0.1); color: #f39c12; }
        .stat-card.red .stat-icon { background: rgba(231, 76, 60, 0.1); color: #e74c3c; }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-card.blue .stat-value { color: #3498db; }
        .stat-card.green .stat-value { color: #2ecc71; }
        .stat-card.yellow .stat-value { color: #f39c12; }
        .stat-card.red .stat-value { color: #e74c3c; }

        .stat-label {
            color: #7f8c8d;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .stat-link {
            color: #3498db;
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-filter {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            cursor: pointer;
        }

        /* Table */
        .table-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        .product-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .nav-link span {
                display: none;
            }

            .logo-text {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .main-content {
             margin-left: 260px;
              min-height: 100vh; 
              transition: all 0.3s ease;
             }
        .top-navbar { 
            background: white; 
            padding: 15px 30px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            position: sticky; 
            top: 0; 
            z-index: 100; 
        }
        .page-title { 
            font-size: 1.5rem; 
            color: #2c3e50; 
            font-weight: bold; 
        }
        .navbar-right { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
        }
        .notification-icon { 
            position: relative; 
            font-size: 1.5rem; 
            color: #7f8c8d; 
            cursor: pointer; 
            transition: color 0.3s; 
        }
        .notification-badge { 
            position: absolute; 
            top: -5px; 
            right: -5px; 
            background: #e74c3c; 
            color: white; 
            border-radius: 50%; 
            width: 18px; 
            height: 18px; 
            font-size: 0.7rem; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .admin-profile { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 8px 15px; 
            background: #f8f9fa; 
            border-radius: 25px; 
            cursor: pointer; 
            transition: all 0.3s; 
            position: relative; 
        }
        .admin-avatar { 
            width: 40px; 
            height: 40px; 
            border-radius: 50%; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 1.2rem; 
            font-weight: bold;
            color: white;
             }
        .admin-name { 
            font-weight: 600; 
            color: #2c3e50; 
            font-size: 0.95rem; 
        }
        .admin-role { 
            font-size: 0.8rem; 
            color: #7f8c8d; 
        }
        .profile-dropdown { 
            position: absolute; 
            top: 100%; 
            right: 0; 
            background: white; 
            border-radius: 10px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.15); 
            min-width: 200px; 
            margin-top: 10px; 
            opacity: 0; 
            visibility: hidden; 
            transform: translateY(-10px); transition: all 0.3s; z-index: 200; 
        }
        .admin-profile:hover .profile-dropdown { 
            opacity: 1; 
            visibility: visible; 
            transform: translateY(0); 
        }
        .dropdown-item { 

            padding: 12px 20px; 
            color: #333; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            transition: all 0.3s; 
        }
        .dropdown-item:hover { 
            background: #f8f9fa; 
            color: #e74c3c; 
        }
        .dropdown-item:last-child { border-top: 1px solid #eee; border-radius: 0 0 10px 10px; }

        @media (max-width: 768px) {
            .sidebar { width: 0; overflow: hidden; }
            .main-content { margin-left: 0; }
            .admin-info { display: none; }
        }

        
    </style>
</head>
<body>
    @include('layouts.sidebar_admin')

    <main class="main-content">
        <nav class="top-navbar" style="margin-bottom: 20px;">
            <div class="navbar-left">
                <h1 class="page-title">Dashboard</h1>
            </div>

            <div class="navbar-right">
                <div class="notification-icon">
                    🔔
                    <span class="notification-badge">5</span>
                </div>

                <div class="admin-profile" data-admin-name="{{ session('admin_name', 'Administrator') }}" data-admin-email="{{ session('admin_email', 'admin@example.com') }}">
                    <div class="admin-avatar">A</div>
                    <div class="admin-info">
                        <div class="admin-name">{{ session('admin_name', 'Administrator') }}</div>
                        <div class="admin-role">Administrator</div>
                    </div>
                    <span class="dropdown-arrow">▼</span>

                    <div class="profile-dropdown">
                        <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="background:none; border:none; padding:12px 20px; width:100%; text-align:left; cursor:pointer;">
                                <span><h3>Đăng Xuất</h3></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="dashboard-content">

    <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card blue">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ $donHangChoDuyet }}</div>
                            <div class="stat-label">Đơn hàng chờ duyệt</div>
                        </div>
                        <div class="stat-icon">🛒</div>
                    </div>
                </div>

                <div class="stat-card green">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ $tongSanPham }}</div>
                            <div class="stat-label">Tổng Sản phẩm</div>
                        </div>
                        <div class="stat-icon">📦</div>
                    </div>
                </div>

                <div class="stat-card yellow">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ number_format($doanhThu, 0, ',', '.') }}₫</div>
                            <div class="stat-label">Tổng Doanh thu</div>
                        </div>
                        <div class="stat-icon">💰</div>
                    </div>
                </div>

                <div class="stat-card red">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ $tongKhachHang }}</div>
                            <div class="stat-label">Tổng Khách hàng</div>
                        </div>
                        <div class="stat-icon">👥</div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="charts-grid">
                <!-- Revenue Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">
                            📊 Xu hướng Doanh thu 7 ngày gần nhất
                        </div>
                    </div>
                    <canvas id="revenueChart"></canvas>
                </div>

                <!-- Orders by Status -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">
                            📋 Đơn hàng theo trạng thái
                        </div>
                    </div>
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>

            <!-- Top Selling Products -->
            <div class="table-card">
                <div class="chart-header">
                    <div class="chart-title">🏆 Top 5 Sản phẩm bán chạy</div>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng bán</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topSanPham as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="/storage/{{ $product->HinhAnh }}" class="product-img" alt="{{ $product->TenSP }}">
                                </td>
                                <td>{{ $product->TenSP }}</td>
                                <td>{{ $product->TongSoLuong }}</td>
                                <td>{{ number_format($product->TongDoanhThu, 0, ',', '.') }}₫</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px;">Chưa có dữ liệu</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        const revenueData = @json($doanhThu7Ngay);
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.map(item => item.date),
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: revenueData.map(item => item.revenue),
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('vi-VN').format(value) + 'đ';
                            }
                        }
                    }
                }
            }
        });

        // Order Status Chart
        const orderStatusData = @json($donHangTheoTrangThai);
        const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
        
        const orderStatusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: orderStatusData.map(item => item.TrangThai),
                datasets: [{
                    data: orderStatusData.map(item => item.total),
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#f39c12',
                        '#e74c3c',
                        '#9b59b6'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        document.getElementById('revenueFilter').addEventListener('change', function() {
            console.log('Filter changed to:', this.value);
        });

    </script>
</body>
</html>