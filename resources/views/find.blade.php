<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Section */
        .section {
            padding-bottom: 80px;
        }

        /* ==================== CAROUSEL / SLIDER STYLES ==================== */
        .carousel-container {
            position: relative;
            max-width: 100%;
            height: 500px; /* Chiều cao cố định cho banner */
            overflow: hidden;
            margin-bottom: 60px;
        }

        .carousel-slide {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 0.8s ease-in-out;
        }

        .slide-item {
            min-width: 100%;
            height: 100%;
            position: relative;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        /* Overlay mờ để chữ dễ đọc hơn */
        .slide-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.2); 
        }

        .slide-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            padding: 20px;
        }

        .slide-content h2 {
            font-size: 3.5rem;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .slide-content p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            font-weight: 300;
        }

        /* Carousel Navigation Buttons */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
            z-index: 20;
            font-size: 1.5rem;
            transition: background 0.3s;
        }

        .carousel-btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .prev {
            left: 0;
            border-radius: 0 5px 5px 0;
        }

        .next {
            right: 0;
            border-radius: 5px 0 0 5px;
        }

        /* Dot Indicators */
        .carousel-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
        }

        .dot {
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dot.active {
            background-color: #ff9a8b; /* Màu nổi bật */
            transform: scale(1.2);
        }
        /* ==================== END CAROUSEL STYLES ==================== */


        /* ==================== STYLES CÒN LẠI (GIỮ NGUYÊN) ==================== */
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #ffa07a 0%, #ff9a8b 100%); 
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(255, 154, 139, 0.3);
        }

        .cta-button:hover {
            background: linear-gradient(135deg, #ff9a8b 0%, #ff8a7a 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 154, 139, 0.4);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 50px;
            color: #2d3748;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #ffa07a 0%, #ff9a8b 100%);
            border-radius: 2px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .product-image-wrapper {
            position: relative;
            width: 100%;
            height: 280px;
            overflow: hidden;
            cursor: pointer;
        }

        .product-image {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            transition: transform 0.3s ease;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 12px;
            min-height: 50px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-sold {
            color: #718096;
            margin-bottom: 12px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-price {
            font-size: 1.6rem;
            color: #ff2200ff;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .features {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            padding: 60px 20px;
            margin: 80px 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-item {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2d3748;
        }

        .feature-description {
            color: #718096;
        }

        .fixed-call-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1.8rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 50;
            text-decoration: none;
        }

        .fixed-call-btn:hover {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(72, 187, 120, 0.5);
        }

        .fixed-call-btn:active {
            transform: scale(0.95);
        }

        
        /* Responsive */
        @media (max-width: 1200px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .carousel-container {
                height: 350px;
            }
            .slide-content h2 {
                font-size: 2.5rem;
            }
            .slide-content p {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .product-name {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
        @include('index.header')

    <section id="featured-products" class="container section">
        <div style="margin-top: 20px;">
            <h2 class="section-title">Kết quả tìm kiếm cho: {{$search}}</h2>
        </div>
        <div class="products-grid">

            @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('products.show', $product->MaSP) }}">
            <div class="product-image-wrapper"  >
                <div class="product-image"><img src="/storage/{{ $product->HinhAnh }}" alt="Ảnh sp"></div>
            </div >
            </a>         
            <div class="product-info">
                <div class="product-name">{{ $product->TenSP }}</div>
                <div class="product-sold"> Đã bán: {{ number_format($product->SLDaBan) }}</div>
                <div class="product-price">{{ number_format($product->DonGia) }}₫</div>      
            </div>
        </div>

    @endforeach

        </div>
    </section>

    @include('index.footer')

    <a href="tel:+84123456789" class="fixed-call-btn" title="Gọi cho chúng tôi">
        📞
    </a>

    <script>
        // CAROUSEL LOGIC
        const carouselSlide = document.querySelector('.carousel-slide');
        const slides = document.querySelectorAll('.slide-item');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        const dotsContainer = document.querySelector('.carousel-dots');
        
        let currentIndex = 0;
        const slideWidth = 100; 

        slides.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (index === 0) {
                dot.classList.add('active');
            }
            dot.addEventListener('click', () => {
                goToSlide(index);
            });
            dotsContainer.appendChild(dot);
        });
        const dots = document.querySelectorAll('.dot');


        function updateCarousel() {
            // Cập nhật vị trí trượt
            carouselSlide.style.transform = `translateX(-${currentIndex * slideWidth}%)`;

            // Cập nhật trạng thái chấm chỉ báo
            dots.forEach((dot, index) => {
                dot.classList.remove('active');
                if (index === currentIndex) {
                    dot.classList.add('active');
                }
            });
        }

        function goToSlide(index) {
            currentIndex = index;
            updateCarousel();
        }
        
        function nextSlide() {
            currentIndex = (currentIndex === slides.length - 1) ? 0 : currentIndex + 1;
            updateCarousel();
        }

        function prevSlide() {
            currentIndex = (currentIndex === 0) ? slides.length - 1 : currentIndex - 1;
            updateCarousel();
        }

        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);

        setInterval(nextSlide, 5000); 

    </script>
</body>
</html>