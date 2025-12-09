<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
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
            margin: 30px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 600px;
            gap: 30px;
        }

        .section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #1a1a1a;
        }


        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #666;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #1a5f7a;
        }

        .phone-input-wrapper {
            position: relative;
        }

        .flag-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 16px;
        }

        .phone-input-wrapper .form-input {
            padding-left: 50px;
        }

        .cart-section {
            position: sticky;
            min-width: 550px;
            top: 20px;
        }
        .cart-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 40px;
            height: 40px;
            background: #f5f5f5;
            border-radius: 8px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-image img {
            max-width: 100%;
            max-height: 100%;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
            color: #1a1a1a;
        }

        .item-variant {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
        }

        .item-price {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 13px;
        }

        .current-price {
            color: #d32f2f;
            font-weight: 600;
            font-size: 16px;
        }

        .discount-badge {
            font-size: 12px;
            color: #d32f2f;
            background: #ffebee;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }

        .qty-btn {
            width: 28px;
            height: 28px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: #f5f5f5;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 18px;
        }

        .remove-btn:hover {
            color: #d32f2f;
        }

        .promo-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .promo-input-wrapper {
            display: flex;
            gap: 10px;
        }

        .promo-input {
            flex: 1;
        }

        .cart-item {
            background: white;
            border-radius: 20px;
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 10px;
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
            width: 80px;
            height: 80px;
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



        .apply-btn {
            background: #1a1a1a;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .apply-btn:hover {
            background: #333;
        }

        .submit-btn {
            width: 100%;
            background: #1a5f7a;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 30px;
        }

        .submit-btn:hover {
            background: #154a5f;
        }

        @media (max-width: 968px) {
            .container {
                grid-template-columns: 1fr;
            }

            .cart-section {
                position: static;
            }
        }
    </style>
</head>
<body>
    @include('index.header')

    <div class="container">
        <div class="left-section">
            <div class="section">

                <h2 class="section-title">Thông tin giao hàng</h2>
                
                <form id="checkoutForm" >
                    <div class="form-group">
                        <input type="text" class="form-input" value="{{$khachHang->HoTen}}" disabled name="HoTen" required>
                    </div>

                    <div class="form-group">
                            <input type="tel" class="form-input" value="{{$khachHang->Sdt}}" disabled name="Sdt" required>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-input" value="{{$khachHang->Email}}" disabled name="Email" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-input" value="{{$khachHang->DiaChi}}" disabled name="DiaChi" required>
                    </div>

                    <h2 class="section-title" style="margin-top: 40px;">Phương thức thanh toán</h2>
                    
                    <div class="form-group">
                        <input type="text" class="form-input" value="Thanh Toán Khi Nhận Hàng" disabled>
                    </div>
                </form>
            </div>
        </div>

        <div class="cart-section">
            <div class="section">
                <h2 class="section-title">Giỏ hàng</h2>
                
                <div class="cart-items" id="cart-items">
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
                </div>

                <div class="cart-summary">
                <h2 class="summary-title">Tóm Tắt Đơn Hàng</h2>
                <div class="summary-row total">
                    <span id="total">Tổng cộng: {{ number_format($total, 0, ',', '.') }}₫</span>
                </div>
                @if (session('error'))
                 {{ session('error') }}
        @endif
                     <form action="{{route('payment.placeOrder')}}" method="POST">
                            @csrf
                            <button type="submit" class="checkout-btn">ĐẶT HÀNG</button>
                    </form>
            </div>
            </div>
        </div>
    </div>
    @include('index.footer')

    <script>
        function updateQty(itemId, change) {
            const item = document.querySelector(`.cart-item[data-id="${itemId}"]`);
            const input = item.querySelector('.qty-input');
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            input.value = value;
            updateTotal();
        }

        function removeItem(itemId) {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
                const item = document.querySelector(`.cart-item[data-id="${itemId}"]`);
                item.remove();
                updateTotal();
            }
        }

        function updateTotal() {
            // Logic tính tổng tiền
            console.log('Cập nhật tổng tiền');
        }

        function applyPromo() {
            const promoCode = document.getElementById('promoCode').value;
            if (promoCode) {
                alert('Áp dụng mã: ' + promoCode);
                // Gọi API kiểm tra mã giảm giá
            }
        }


        function handleSubmit(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData);
            
            // Lấy thông tin giỏ hàng
            const cartItems = [];
            document.querySelectorAll('.cart-item').forEach(item => {
                const qty = item.querySelector('.qty-input').value;
                const name = item.querySelector('.item-name').textContent;
                const price = item.querySelector('.current-price').textContent;
                cartItems.push({ name, qty, price });
            });
            
            data.cart = cartItems;
            
            console.log('Dữ liệu đơn hàng:', data);
            
            // Gửi dữ liệu đến server PHP
            fetch('process_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Đặt hàng thành công!');
                    window.location.href = 'thank-you.php';
                } else {
                    alert('Có lỗi xảy ra: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi xử lý đơn hàng');
            });
        }
    </script>
</body>
</html>