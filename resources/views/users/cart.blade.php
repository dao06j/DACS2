<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <style>
        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #fbfbfbff 0%, #ffffffff 100%);
            min-height: 100vh;
            padding-bottom: 30px; 
            display: flex;
            flex-direction: column;
        }

        /* Container for content (max-width, centered) 
        .container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 0 20px;
        }
        
        /* Full-width Header styling */
        .header-section {
            padding: 30px 0; /* Padding applied here */
            margin-bottom: 20px;
            color: black;
        }

        .header {
            text-align: center;
            animation: slideDown 0.6s ease-out;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Main Cart Layout */
        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 25px;
        }

        .cart-items {
            animation: slideUp 0.6s ease-out;
        }

        .cart-item {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 25px;
            align-items: center;
            transition: all 0.3s;
            animation: fadeIn 0.6s ease-out;
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .item-image-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .item-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .cart-item:hover .item-image {
            transform: scale(1.1);
        }

        .item-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .item-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
            line-height: 1.4;
        }

        .item-desc {
            color: #718096;
            font-size: 0.95rem;
        }

        .item-price {
            color: #667eea;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: flex-end;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 12px;
            padding: 8px 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border: none;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            color: #667eea;
        }

        .quantity-btn:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: scale(1.1);
        }

        .quantity-btn:active {
            transform: scale(0.95);
        }

        .quantity {
            width: 45px;
            text-align: center;
            font-weight: 700;
            font-size: 1.1rem;
            color: #2d3748;
        }

        .remove-btn {
            background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
            border: none;
            color: white;
            cursor: pointer;
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(245, 101, 101, 0.3);
        }

        .remove-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(245, 101, 101, 0.4);
        }
        
        /* Summary styles (Summary remains sticky) */
        .cart-summary {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            height: fit-content;
            position: sticky;
            top: 30px;
            animation: slideLeft 0.6s ease-out;
        }

        .summary-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: #2d3748;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            color: #4a5568;
            font-size: 1.05rem;
            border-bottom: 1px dashed #e2e8f0;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row.total {
            margin-top: 15px;
            padding-top: 25px;
            border-top: 3px solid #667eea;
            border-bottom: none;
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
        }

        .promo-code {
            margin: 25px 0;
            padding: 20px;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 15px;
        }

        .promo-label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: #4a5568;
            font-size: 0.95rem;
        }

        .promo-input-wrapper {
            display: flex;
            gap: 10px;
        }

        .promo-input {
            flex: 1;
            padding: 14px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .promo-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .apply-btn {
            padding: 14px 24px;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(72, 187, 120, 0.3);
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(72, 187, 120, 0.4);
        }

        .checkout-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 25px;
            transition: all 0.3s;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.5);
        }

        .checkout-btn:active {
            transform: translateY(-1px);
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            grid-column: 1 / -1; /* Span full width in mobile view */
        }

        .empty-cart-icon {
            font-size: 5rem;
            margin-bottom: 25px;
            animation: bounce 2s infinite;
        }

        .empty-cart h3 {
            font-size: 1.8rem;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .empty-cart p {
            color: #718096;
            font-size: 1.1rem;
        }
        
        /* Message Box Custom UI (Replaces alert/confirm) */
        #status-message-box {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-50px);
            transition: all 0.4s ease-out;
            min-width: 250px;
            text-align: center;
        }

        #status-message-box.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        #status-message-box.success {
            background-color: #48bb78; /* Green */
        }

        #status-message-box.error {
            background-color: #f56565; /* Red */
        }

        #status-message-box.info {
            background-color: #667eea; /* Blue */
        }

        /* Animations */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to { opacity: 0; transform: translateX(-30px) scale(0.95); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .fade-out {
            animation: fadeOut 0.4s ease-out forwards;
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }

            .cart-item {
                grid-template-columns: 100px 1fr;
                gap: 20px;
                padding: 20px;
            }

            .item-image-wrapper {
                width: 100px;
                height: 100px;
            }

            .item-actions {
                grid-column: 1 / -1;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                margin-top: 15px;
                padding-top: 15px;
                border-top: 2px dashed #e2e8f0;
            }

            .header h1 {
                font-size: 2rem;
            }
            
            .header-section {
                padding: 20px 0;
            }
        }
    </style>
</head>
<body>
        
        @include('index.header')
    <div class="header-section">
        <div class="container">
            <div class="header">
                <h1>Giỏ Hàng Của Bạn</h1>
                <p>Bạn có <span id="item-count">{{$items->count() }}</span> sản phẩm trong giỏ hàng</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="cart-layout">
            <div class="cart-items" id="cart-items">
                @if($items->count() > 0)
                 @foreach($items as $item)

                <div class="cart-item" >
                        <div class="item-image-wrapper">
                            <img src="/storage/{{ $item->sanPham->HinhAnh }}" alt="Ảnh" class="item-image" onerror="this.onerror=null;this.src='https://placehold.co/300x300/000/fff?text=No+Image';">
                        </div>
                        <div class="item-details">
                            <div class="item-name">{{ $item->sanPham->TenSP }}</div>
                            <div class="item-price">{{ number_format($item->sanPham->DonGia, 0, ',', '.') }}₫</div>
                        </div>
                        <div class="item-actions">
                            <div class="quantity-control">
                                <span class="quantity" id="qty-${item.id}">{{ $item->SoLuong }}</span>
                            </div>
                            <form action="{{ route('cart.remove', $item->MaCTGH) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">Xóa</button>
                        </form>
                        </div>
                    </div>
                    @endforeach
    @else
        <p>Giỏ hàng trống.</p>
    @endif

            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Thông Tin Đơn Hàng</h2>
                <div class="summary-row total">
                    <span id="total">Tổng cộng: {{ number_format($total, 0, ',', '.') }}₫</span>
                </div>
                

                    <form action="{{route('payment', $khachHang->MaKH)}}" method="GET">
                            @csrf
                            @method('GET')
                            <button type="submit" class="checkout-btn">Mua Ngay</button>
                    </form>
            </div>
        </div>
    </div>

    <div id="status-message-box" class="message-box"></div>
        @include('index.footer')
    <script>
function updateCart(maCTGH, soLuong) {
    fetch(`/cart/${maCTGH}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ SoLuong: parseInt(soLuong) })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cập nhật thành tiền
            document.querySelector(`.thanh-tien-${maCTGH}`).textContent = data.thanh_tien + '₫';
            location.reload(); // Reload để cập nhật tổng
        } else {
            alert(data.message);
        }
    });
}
</script>
</body>
</html>