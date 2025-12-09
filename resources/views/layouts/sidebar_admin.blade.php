
<style>
    /* ==================== SIDEBAR ==================== */
.sidebar {
    /* Thiết lập vị trí cố định bên trái */
    position: fixed;
    left: 0;
    top: 0;
    width: 260px; /* Chiều rộng của sidebar */
    height: 100vh; /* Chiếm toàn bộ chiều cao màn hình */
    
    /* Màu nền */
    background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
    color: white;
    
    /* Xử lý nội dung tràn */
    overflow-y: auto;
    z-index: 1000;
}

/* Phần header và logo */
.sidebar-header {
    padding: 25px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    text-align: center;
}

.sidebar-logo {
    font-size: 1.8rem;
    font-weight: bold;
    color: #e74c3c; /* Màu đỏ nổi bật cho logo */
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

/* Menu chính */
.sidebar-menu {
    list-style: none;
    padding: 20px 0;
}

.menu-item {
    margin: 5px 0;
}

/* Liên kết menu */
.menu-link {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 25px;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent; /* Dải màu kích hoạt */
}

/* Hiệu ứng di chuột và trạng thái active */
.menu-link:hover,
.menu-link.active {
    background: rgba(231, 76, 60, 0.2); /* Nền mờ khi active/hover */
    border-left-color: #e74c3c; /* Dải màu đỏ khi active/hover */
    padding-left: 30px; /* Hiệu ứng dịch chuyển nhẹ */
}

/* Điều chỉnh nội dung chính để tránh bị Sidebar che khuất */
.main-content {
    margin-left: 260px; /* Bằng với width của sidebar */
    min-height: 100vh;
    padding: 30px;
}

/* Điều chỉnh khi màn hình nhỏ (responsive) */
@media (max-width: 768px) {
    .sidebar {
        width: 0; /* Ẩn sidebar trên di động */
        overflow: hidden;
    }

    .main-content {
        margin-left: 0;
    }
}
</style>

<aside class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <span>🏠</span>
            <span>ADMIN</span>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="{{ url('/admin/dashboard') }}" class="menu-link ">
                <span class="menu-icon">📊</span>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.products.index') }}" class="menu-link ">
                <span class="menu-icon">📦</span>
                <span>Quản Lý Sản Phẩm</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.billManager')}}" class="menu-link ">
                <span class="menu-icon">🛒</span>
                <span>Quản Lý Đơn Hàng</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.importproducts.index')}}" class="menu-link ">
                <span class="menu-icon">📂</span>
                <span>Nhập hàng</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('customers') }}" class="menu-link ">
                <span class="menu-icon">👥</span>
                <span>Khách Hàng</span>
            </a>
        </li>
    </ul>
</aside>