<style>
    /* ==================== GLOBAL RESET ==================== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        /* Giữ lại body style để đảm bảo header hiển thị đúng màu nền */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5; 
    }

    /* ==================== HEADER (Màu Nhạt Đã Chỉnh Sửa) ==================== */
    header {
        /* Màu xanh xám nhạt hơn */
        background: white;
        color: white;
        padding: 0;
        box-shadow: 0 4px 15px rgba(252, 211, 211, 0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* Top Header - Logo & Search */
    .header-top {
        padding: 15px 0;
        border-bottom: 1px solid rgba(177, 170, 170, 0.2); 
    }

    .header-top-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .logo {
        font-size: 1.8rem;
        font-weight: bold;
        text-decoration: none;
        color: white;
        display: flex;
        align-items: center;
        gap: 10px;
        white-space: nowrap;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .logo-icon {
        font-size: 2rem;
    }

    .logo span {
        color: #ed5c0dff;
    }

    /* Search Bar */
    .search-container {
        flex: 1;
        max-width: 800px;
        min-width: 200px;
        margin-right: 100px;
    }

    .search-form {
        display: flex;
        gap: 0;
        border-radius: 25px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .search-form input {
        flex: 1;
        border: none;
        padding: 12px 20px;
        font-size: 0.95rem;
        outline: none;
        color: #333;
    }

    .search-form input::placeholder {
        color: #999;
    }

    .search-form button {
        background-color: #ffffffff;
        border: none;
        padding: 12px 20px;
        color: white;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
        font-size: 1rem;
    }

    .search-form button:hover {
        background-color: #008df3ff;
    }

    .icon {
        font-size: 1.3rem;
    }

    .cart-count {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: #e74c3c;
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: bold;
    }

    /* Bottom Header - Navigation */
    .header-bottom {
        padding: 0;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .header-bottom-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    nav {
        display: flex;
        gap: 0;
    }

    nav .nav-item {
        position: relative;
        display: flex;
        align-items: center;
    }

    nav .nav-link {
        padding: 16px 20px;
        color: black;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    nav .nav-link:hover {
        background-color: #e74c3c;
        color: white;
    }

    /* Dropdown Menu */
    .dropdown {
        position: relative;
    }

    .dropdown-toggle::after {
        content: '';
        width: 6px;
        height: 6px;
        border-right: 2px solid currentColor;
        border-bottom: 2px solid currentColor;
        transform: rotate(45deg);
        margin-left: 5px;
        transition: transform 0.3s ease;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        min-width: 250px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 100;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 0;
    }

    .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown:hover .dropdown-toggle::after {
        transform: rotate(225deg);
    }

    .dropdown-item {
        padding: 12px 20px;
        color: #333;
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .dropdown-item:hover {
        background-color: #f5f5f5;
        border-left-color: #e74c3c;
        padding-left: 25px;
        color: #e74c3c;
    }

    /* Login Button */
    .login-btn {
        background-color: #c42412ff;
        color: white;
        padding: 10px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-left: auto;
        margin-right: 20px;
    }

    .login-btn:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
    }

    /* Mobile Menu Toggle - Hamburger Menu */
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        color: blue;
        cursor: pointer;
        padding: 10px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        width: 40px;
        height: 40px;
        transition: all 0.3s ease;
    }

    .mobile-menu-toggle span {
        width: 25px;
        height: 3px;
        background-color: blue;
        border-radius: 2px;
        transition: all 0.3s ease;
        display: block;
    }

    .mobile-menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    .mobile-menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    .mobile-menu-toggle:hover {
        background-color: rgba(148, 8, 255, 0.3);
        border-radius: 5px;
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 1024px) {
        .header-top-container {
            gap: 20px;
        }

        .search-container {
            max-width: 300px;
        }

        nav .nav-link {
            padding: 16px 15px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 768px) {
        .header-top-container {
            flex-wrap: wrap;
            gap: 10px;
        }

        .logo {
            font-size: 1.4rem;
            order: 1;
        }

        .search-container {
            flex: 1;
            min-width: 200px;
            max-width: none;
            order: 3;
            width: 100%;
            margin-top: 10px;
        }


        .search-form input {
            padding: 10px 15px;
            font-size: 0.9rem;
        }

        .search-form button {
            padding: 10px 15px;
        }

        .mobile-menu-toggle {
            display: flex;
            order: 4;
        }

        .header-bottom {
            display: none;
            max-height: 0;
            overflow: hidden;
        }

        .header-bottom.active {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #4a698a; 
            border-top: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            max-height: 500px;
            overflow-y: auto;
            animation: slideDownMenu 0.3s ease-out;
        }

        @keyframes slideDownMenu {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        nav {
            flex-direction: column;
            width: 100%;
            gap: 0;
        }

        nav .nav-item {
            border-bottom: 1px solid rgba(192, 80, 80, 0.1);
        }

        nav .nav-link {
            padding: 15px 20px;
            border-bottom: none;
        }

        .dropdown-menu {
            position: static;
            opacity: 1;
            visibility: visible;
            transform: none;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: none;
            min-width: 100%;
            display: none;
            border-radius: 0;
        }

        .dropdown.active .dropdown-menu {
            display: block;
            animation: slideDownMenu 0.2s ease-out;
        }

        .dropdown-item {
            padding-left: 40px;
        }

        .login-btn {
            display: none;
        }

        .eader-icon-item{
            display: none;
        }
    }

    @media (max-width: 480px) {
        .header-top-container {
            gap: 8px;
        }

        .logo {
            font-size: 1.1rem;
        }

        .logo-icon {
            font-size: 1.5rem;
        }

        .search-container {
            min-width: 150px;
        }

        .search-form input {
            padding: 8px 12px;
            font-size: 0.85rem;
        }

        .search-form button {
            padding: 8px 12px;
        }

        .icon {
            font-size: 1.1rem;
        }
    }

/* Dropdown Container */
.user-dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Button */
.user-dropdown-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.user-dropdown-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.user-dropdown-btn .icon {
    font-size: 1.2rem;
}

.user-dropdown-btn .arrow {
    font-size: 0.7rem;
    transition: transform 0.3s ease;
}

.user-dropdown.active .user-dropdown-btn .arrow {
    transform: rotate(180deg);
}

/* Dropdown Menu */
.user-dropdown-menu {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    background: white;
    min-width: 220px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    overflow: hidden;
}

.user-dropdown.active .user-dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* User Info Section */
.user-dropdown-header {
    padding: 15px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.user-dropdown-header .user-name {
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 3px;
}

.user-dropdown-header .user-email {
    font-size: 0.85rem;
    opacity: 0.9;
}

/* Menu Items */
.user-dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: #2c3e50;
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.user-dropdown-item:hover {
    background: #f5f5f5;
    border-left-color: #667eea;
    padding-left: 25px;
}

.user-dropdown-item .icon {
    font-size: 1.2rem;
    width: 20px;
    text-align: center;
}

.user-dropdown-item.logout {
    border-top: 1px solid #e0e0e0;
    color: #e74c3c;
}

.user-dropdown-item.logout:hover {
    background: #ffebee;
    border-left-color: #e74c3c;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .user-dropdown-menu {
        right: -10px;
        min-width: 200px;
    }
}

</style>

<header>
    <div class="header-top">
        <div class="header-top-container">
            <a href="/" class="logo">
                <span>NỘI THẤT SARAH</span>
            </a>

            <div class="search-container">
                <form class="search-form" action="{{route('search', )}}" method="GET">
                    <input type="text" name="q" placeholder="Tìm kiếm sản phẩm..." required>
                    <button type="submit">🔍</button>
                </form>
            </div>

            <button class="mobile-menu-toggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="header-bottom">
        <div class="header-bottom-container">
            <nav>
                <div class="nav-item">
                    <a href="/" class="nav-link">
                        <span>Trang Chủ</span>
                    </a>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle">
                        <span>Danh Mục</span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="/category/Ghế" class="dropdown-item">Ghế</a>
                        <a href="/category/Giường" class="dropdown-item">Giường Ngủ</a>
                        <a href="/category/Bàn" class="dropdown-item">Bàn</a>
                        <a href="/category/Tủ" class="dropdown-item">Tủ</a>
                        <a href="/category/Trang Trí" class="dropdown-item">Trang Trí</a>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="/location" class="nav-link">
                        <span>Vị trí</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="/about" class="nav-link">
                        <span>Về Chúng Tôi</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="#lh" class="nav-link">
                        <span>Liên Hệ</span>
                    </a>
                </div>
            </nav>

@if($khachHang)

    <div class="user-dropdown">
        <button class="user-dropdown-btn" onclick="toggleUserDropdown()">
            <span>{{ $khachHang['HoTen'] }}</span>
            <span class="arrow">▼</span>
        </button>

        <div class="user-dropdown-menu">
            <!-- User Info -->
            <div class="user-dropdown-header">
                <div class="user-name">{{ $khachHang['HoTen'] }}</div>
                <div class="user-email">{{ $khachHang['Email'] }}</div>
            </div>

            <!-- Menu Items -->
            <a href="{{ route('profile') }}" class="user-dropdown-item">
                <span>Trang cá nhân</span>
            </a>

            <a href="{{ route('cart.index') }}" class="user-dropdown-item">
                <span>Giỏ hàng</span>
            </a>

            <a href="{{ route('bill') }}" class="user-dropdown-item">
                <span>Đơn hàng</span>
            </a>
            <a href="{{ route('logout') }}" class="user-dropdown-item logout">
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
@else
    <a href="{{ route('login') }}" class="login-btn">
        <span>Đăng Nhập</span>
    </a>
@endif
        </div>
    </div>
</header>

<script>
    // Mobile menu toggle with hamburger animation
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    const headerBottom = document.querySelector('.header-bottom');
    const dropdowns = document.querySelectorAll('.dropdown');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            headerBottom.classList.toggle('active');
            toggleBtn.classList.toggle('active');
        });
    }

    // Mobile dropdown toggle
    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        if (toggle) {
            toggle.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                }
            });
        }
    });

    // Close mobile menu when clicking a link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768 && !link.classList.contains('dropdown-toggle')) {
                headerBottom.classList.remove('active');
                toggleBtn.classList.remove('active');
            }
        });
    });

    // Update cart count (example)
    function updateCartCount(count) {
        const cartCount = document.querySelector('.cart-count');
        if (cartCount) {
            cartCount.textContent = count;
        }
    }
    // Example: Set initial cart count
    updateCartCount(0);


// Toggle Dropdown
function toggleUserDropdown() {
    const dropdown = document.querySelector('.user-dropdown');
    dropdown.classList.toggle('active');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.user-dropdown');
    if (dropdown && !dropdown.contains(event.target)) {
        dropdown.classList.remove('active');
    }
});

// Close dropdown when clicking on menu item
document.querySelectorAll('.user-dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelector('.user-dropdown').classList.remove('active');
    });
});
</script>