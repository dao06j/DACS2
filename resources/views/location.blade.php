<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vị Trí Cửa Hàng & Liên Hệ</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }

        .header {
            background-color: #1a5f7a;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 2.2rem;
            font-weight: 700;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr; /* 2/3 cho Map, 1/3 cho Info */
            gap: 30px;
        }
        
        .map-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 500px; /* Chiều cao cố định cho map */
        }

        .map-frame {
            width: 100%;
            height: 100%;
            border: none;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 30px; /* Giữ sticky khi cuộn */
            height: fit-content;
        }

        .info-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a5f7a;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .contact-icon {
            color: #e74c3c;
            font-size: 1.5rem;
        }

        .info-text {
            color: #555;
        }
        
        .btn-direct {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-direct:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .map-section {
                height: 350px;
            }
            .info-card {
                position: static;
            }
        }
    </style>
</head>
<body>
        @include('index.header')
        <div style="margin-top: 20px; margin-bottom: 20px;">
        <h1 style="text-align: center; color: #1a5f7a;">Vị Trí Cửa Hàng</h1>
        </div>
    <div class="container">

        <section class="map-section">
            <iframe
                class="map-frame"
                id="google-map"
                src="https://maps.google.com/maps?q=470+Trần+Đại+Nghĩa,+Ngũ+Hành+Sơn,+Tp+Đà+Nẵng&z=16&output=embed"
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </section>

        <!-- Thông tin Liên hệ -->
        <aside class="info-card">
            <h2 class="info-title">Thông tin Cửa hàng</h2>

            <div class="contact-item">
                <span >Địa chỉ:</span>
                <p class="info-text">470 Trần Đại Nghĩa, Ngũ Hành Sơn, TP. Đà Nẵng, Việt Nam</p>
            </div>
            
            <div class="contact-item">
                <span >Số điện thoại:</span>
                <p class="info-text">(+84) 123 456 789</p>
            </div>

            <div class="contact-item">
                <span >Email:</span>
                <p class="info-text">sarah@store.com</p>
            </div>
            
            <div class="contact-item">
                <span >Thời gian: </span>
                <p class="info-text">Thứ 2 - Thứ 7: 8:00 - 20:00</p>
            </div>
        </aside>

    </div>

    @include('index.footer')
    
</body>
</html>