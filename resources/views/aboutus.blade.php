<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Chúng Tôi - Nội Thất DaoJ</title>
    
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        #about-us {
            padding: 60px 0;
            background-color: #ffffff;
        }

        /* --- Header Section --- */
        .about-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .about-header h1 {
            font-size: 2.8rem;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .slogan {
            font-size: 1.15rem;
            color: #e74c3c;
            font-style: italic;
        }

        /* --- Story Section --- */
        .story-section {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 60px;
        }

        .story-content {
            flex: 1;
            padding-right: 20px;
        }

        .story-content h2 {
            font-size: 2rem;
            color: #34495e;
            margin-bottom: 20px;
            border-left: 5px solid #e74c3c;
            padding-left: 15px;
        }

        .story-content p {
            line-height: 1.7;
            margin-bottom: 15px;
            color: #666;
            font-size: 1rem;
        }

        .story-image {
            flex: 1;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .story-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .story-image:hover img {
            transform: scale(1.05);
        }

        /* --- Value Cards Section --- */
        .values-section {
            text-align: center;
            margin-bottom: 60px;
        }

        .values-section h2 {
            font-size: 2.2rem;
            color: #2c3e50;
            margin-bottom: 40px;
        }

        .value-cards {
            display: flex;
            gap: 30px;
            justify-content: space-between;
        }

        .card {
            flex: 1;
            padding: 30px 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .card .icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 15px;
        }

        .card h3 {
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .card p {
            color: #777;
            font-size: 0.95rem;
        }

        /* --- Call to Action --- */
        .call-to-action {
            text-align: center;
            padding: 40px;
            background-color: #4a698a; 
            color: white;
            border-radius: 8px;
            margin-top: 40px;
        }

        .call-to-action h2 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .call-to-action p {
            font-size: 1.1rem;
            margin-bottom: 25px;
            color: rgba(255, 255, 255, 0.85);
        }

        .cta-button {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-size: 1rem;
            border: 2px solid transparent;
        }

        .cta-button {
            background-color: #e74c3c;
            color: white;
        }

        .cta-button:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }

        /* Secondary CTA */
        .cta-button.secondary {
            background-color: transparent;
            border-color: white;
            color: white;
        }

        .cta-button.secondary:hover {
            background-color: white;
            color: #4a698a;
        }

        @media (max-width: 900px) {
            .story-section {
                flex-direction: column;
                text-align: center;
            }

            .story-content {
                padding-right: 0;
                order: 2; 
            }
            
            .story-content h2 {
                border-left: none;
                padding-left: 0;
                margin-top: 20px;
            }

            .story-image {
                order: 1;
                width: 100%;
            }

            .value-cards {
                flex-direction: column;
            }
            
            .card {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 600px) {
            .about-header h1 {
                font-size: 2rem;
            }

            .values-section h2 {
                font-size: 1.8rem;
            }
            
            .call-to-action h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

        @include('index.header')

    <section id="about-us">
        <div class="container">
            <div class="about-header">
                <h1>Về Chúng Tôi: Kiến Tạo Không Gian Sống</h1>
                <p class="slogan">Nội Thất SARAH - Nơi Giao Thoa Giữa Nghệ Thuật Và Cuộc Sống Đương Đại.</p>
            </div>
            
            <div class="story-section">
                <div class="story-content">
                    <h2>Bắt Đầu Từ Một Giấc Mơ...</h2>
                    <p>
                        Nội Thất SARAH ra đời vào năm 2018 với một niềm đam mê duy nhất: **biến những ngôi nhà thành tổ ấm thực sự**. Chúng tôi tin rằng nội thất không chỉ là đồ vật, mà là ngôn ngữ thể hiện cá tính, phong cách và là bối cảnh cho những khoảnh khắc đáng nhớ nhất của cuộc đời.
                    </p>
                    <p>
                        Từ những sản phẩm đầu tiên được chế tác thủ công, đến nay, DaoJ đã phát triển thành một thương hiệu uy tín, tự hào mang đến các giải pháp thiết kế toàn diện, từ nội thất gia đình hiện đại đến các dự án thương mại cao cấp.
                    </p>
                    <a href="{{route('products.index')}}" class="cta-button">Khám Phá Bộ Sưu Tập</a>
                </div>
                <div class="story-image">
                    <img src="https://vkingdecor.com/wp-content/uploads/2024/09/thiet-ke-cua-hang-noi-that-tai-da-nang-8.jpg" alt="Hình ảnh nội thất cao cấp">
                </div>
            </div>  

            <div class="values-section">
                <h2>Tầm Nhìn & Giá Trị Cốt Lõi</h2>
                <div class="value-cards">
                    <div class="card">
                        <span class="icon">✨</span>
                        <h3>Sáng Tạo Bền Vững</h3>
                        <p>Luôn đổi mới trong thiết kế, kết hợp vật liệu thân thiện với môi trường, đảm bảo sản phẩm không chỉ đẹp mà còn bền vững theo thời gian.</p>
                    </div>
                    <div class="card">
                        <span class="icon">🤝</span>
                        <h3>Đồng Hành Cùng Khách Hàng</h3>
                        <p>Lấy khách hàng làm trung tâm, cung cấp dịch vụ tư vấn tận tâm để tìm ra giải pháp nội thất hoàn hảo, độc đáo cho từng không gian.</p>
                    </div>
                    <div class="card">
                        <span class="icon">💎</span>
                        <h3>Chất Lượng Tinh Hoa</h3>
                        <p>Mỗi sản phẩm đều được kiểm soát nghiêm ngặt, từ khâu lựa chọn nguyên liệu đến hoàn thiện chi tiết, cam kết chất lượng chuẩn quốc tế.</p>
                    </div>
                </div>
            </div>

            <div class="call-to-action">
                <h2>Hãy để SARAH Biến Ngôi Nhà Bạn Thành Tác Phẩm Nghệ Thuật</h2>
            </div>
        </div>
    </section>
     @include('index.footer')
</body>
</html>