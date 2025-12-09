<style>
        /* Biến CSS để quản lý màu sắc */
        :root {
            --footer-bg-color: #333333;
            --text-color: #ffffff;
            --link-color: #aaaaaa;
            --link-hover-color: #00bcd4; /* Màu xanh nổi bật khi hover */
        }

        /* Thiết lập cơ bản cho font nếu footer được dán vào */
        .footer {
            font-family: 'Inter', sans-serif; /* Đảm bảo font được sử dụng */
            background-color: var(--footer-bg-color);
            color: var(--text-color);
            padding: 30px 20px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
            width: 100%;
            box-sizing: border-box; /* Quan trọng để padding không làm tăng chiều rộng */
        }

        .footer-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap; 
            justify-content: space-between;
            gap: 20px; 
        }

        .footer-column {
            flex: 1 1 200px; 
            padding: 0 10px;
        }

        .footer-column h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-color);
            border-bottom: 2px solid var(--link-hover-color);
            padding-bottom: 5px;
            display: inline-block;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column a,
        .footer-info-text {
            color: var(--link-color);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            display: block;
        }

        .footer-column a:hover {
            color: var(--link-hover-color);
        }

        /* Vùng bản quyền */
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid #444444;
        }

        .footer-bottom p {
            font-size: 0.85rem;
            color: var(--link-color);
            margin: 0;
        }

        /* Media Queries cho thiết bị di động (Responsive) */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                align-items: center;
            }

            .footer-column {
                flex: 1 1 100%; 
                text-align: center;
                margin-bottom: 20px;
                padding: 0;
            }

            .footer-column h4 {
                margin-top: 10px;
            }
        }
    </style>
    <!-- Thêm liên kết font Inter nếu chưa có trong tài liệu chính -->
    <!-- Nếu tài liệu chính chưa có, bạn có thể thêm <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"> vào thẻ head của trang chính -->

    <!-- FOOTER START -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Cột 1: Liên kết nhanh -->
            <div class="footer-column">
                <h4>Điều hướng</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="{{ url('/about') }}">Về chúng tôi</a></li>
                    <li><a href="/location" class="nav-link">
                        <span>Vị trí</span>
                    </a></li>
                </ul>
            </div>

            <!-- Cột 2: Thông tin liên hệ -->
            <div class="footer-column" id="lh">
                <h4>Liên hệ</h4>
                <ul>
                    <li>
                        <span class="footer-info-text">Địa chỉ: 470 Trần Đại Nghĩa, Ngũ Hành Sơn, Đà Nẵng</span>
                    </li>
                    <li>
                        <a href="mailto:sarah@store.com">Email: sarah@store.com</a>
                    </li>
                    <li>
                        <a href="tel:+84123456789">SĐT: +84 123 456 789</a>
                    </li>
                </ul>
            </div>

            <!-- Cột 3: Mô tả ngắn -->
            <div class="footer-column">
                <h4>Về chúng tôi</h4>
                <p class="footer-info-text" style="text-align: left; margin-top: 10px;">
                    Chúng tôi là một công ty công nghệ chuyên cung cấp các giải pháp web hiện đại và tối ưu, cam kết mang lại giá trị tốt nhất cho khách hàng.
                </p>
            </div>
            
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Website Của Bạn. Mọi quyền được bảo lưu.</p>
        </div>
    </footer>
    <!-- FOOTER END -->