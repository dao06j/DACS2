<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chi tiết Sản phẩm</title>
    <!-- Tải Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Biến CSS */
        :root {
            --primary-color: #ff6f61; /* Màu chủ đạo: Đỏ cam */
            --secondary-color: #343a40; /* Màu chữ chính */
            --background-color: #f8f9fa;
            --card-bg: #ffffff;
            --border-color: #e9ecef;
            --success-color: #28a745;
        }

        /* Thiết lập chung */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            line-height: 1.6;
        }

        /* Container chính */
        .product-container {
            max-width: 1200px;
            margin: 50px auto 40px auto; /* Thêm margin dưới để cách footer hoặc mục gợi ý */
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            display: flex;
            gap: 40px;
            flex-wrap: wrap; 
        }

        /* Cột hình ảnh */
        .product-image-col {
            flex: 1 1 400px; 
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* Cột chi tiết */
        .product-details-col {
            flex: 1 1 500px; 
            color: var(--secondary-color);
        }

        .product-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }

        .product-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        /* Mô tả */
        .description h3 {
            font-size: 1.2rem;
            margin-top: 25px;
            margin-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 5px;
        }

        .description p {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Khu vực Tương tác (Số lượng, Thêm/Mua) */
        .interaction-area {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        /* Điều chỉnh Số lượng */
        .quantity-control {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .quantity-control label {
            font-weight: 600;
            margin-right: 15px;
        }

        .quantity-input-group {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            overflow: hidden;
        }

        .qty-button {
            background-color: var(--background-color);
            border: none;
            padding: 8px 15px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .qty-button:hover {
            background-color: var(--border-color);
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: none;
            border-left: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            font-size: 1rem;
            font-weight: 600;
            padding: 8px 0;
        }
        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        /* Nhóm nút hành động */
        .action-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            border: 2px solid transparent;
        }

        .btn:active {
            transform: scale(0.98);
        }

        /* Nút Mua ngay (Primary) */
        .btn-buy {
            flex: 1; /* Chiếm nhiều hơn */
            background-color: var(--primary-color);
            color: var(--card-bg);
            border-color: var(--primary-color);
        }
        .btn-buy:hover {
            background-color: #d15c52;
        }

        /* Nút Thêm vào giỏ hàng (Secondary/Outline) */
        .btn-add-to-cart {
            flex: 1;
            background-color: var(--card-bg);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-add-to-cart:hover {
            background-color: var(--primary-color);
            color: var(--card-bg);
        }

        /* Thông báo */
        #message-box {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff3cd; /* Màu vàng nhạt */
            color: #856404; /* Màu chữ vàng đậm */
            border: 1px solid #ffeeba;
            border-radius: 6px;
            text-align: center;
            display: none;
        }
        
        /* --- SẢN PHẨM GỢI Ý (RELATED PRODUCTS) --- */

        .related-products {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 0;
        }

        .related-products h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--secondary-color);
            text-align: center;
            border-bottom: 3px solid var(--primary-color);
            display: inline-block;
            padding-bottom: 5px;
            width: 100%;
        }

        .product-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .product-card {
            flex: 0 0 calc(25% - 15px); /* 4 cột trên desktop, trừ đi gap */
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease;
            text-decoration: none; /* Bỏ gạch chân cho thẻ a */
            color: inherit;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 200px; /* Chiều cao cố định cho ảnh */
            object-fit: cover;
            border-bottom: 1px solid var(--border-color);
        }

        .card-info {
            padding: 15px;
        }

        .card-info h4 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 10px 0;
            height: 40px; /* Cố định chiều cao tên SP */
            overflow: hidden;
        }

        .card-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        /* === PHẦN ĐÁNH GIÁ === */
.product-reviews {
    max-width: 1200px;
    margin: 40px auto;
    padding: 30px;
    background-color: var(--card-bg);
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 3px solid var(--border-color);
}

.reviews-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--secondary-color);
    margin: 0;
}

.rating-summary .total-reviews {
    color: #6c757d;
    font-size: 1.1rem;
    font-weight: 600;
}

/* === FORM ĐÁNH GIÁ === */
.review-form-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 30px;
    border: 2px solid var(--border-color);
}

.review-form-container h3 {
    font-size: 1.3rem;
    margin-top: 0;
    margin-bottom: 20px;
    color: var(--secondary-color);
}

.review-form .form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--secondary-color);
    font-size: 1rem;
}

.required {
    color: #dc3545;
}

/* === TEXTAREA === */
.form-textarea {
    width: 100%;
    padding: 15px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    font-family: 'Inter', sans-serif;
    resize: vertical;
    transition: border-color 0.3s;
    line-height: 1.6;
}

.form-textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 111, 97, 0.1);
}

.char-count {
    text-align: right;
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 5px;
}

.error-message {
    display: block;
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 5px;
}

/* === SUBMIT BUTTON === */
.btn-submit-review {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 14px 32px;
    border-radius: 8px;
    font-size: 1.05rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-block;
}

.btn-submit-review:hover {
    background-color: #d15c52;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 111, 97, 0.3);
}

.btn-submit-review:disabled {
    background-color: #ccc;
    cursor: not-allowed;
    transform: none;
}

.btn-loading {
    display: none;
}

/* === ALERT === */
.review-alert {
    margin-top: 15px;
    padding: 14px 18px;
    border-radius: 8px;
    font-size: 0.95rem;
}

.review-alert.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.review-alert.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* === ALREADY REVIEWED / LOGIN REQUIRED === */
.already-reviewed,
.login-required {
    background: #fff3cd;
    padding: 18px 22px;
    border-radius: 8px;
    border-left: 4px solid #ffc107;
    margin-bottom: 30px;
}

.already-reviewed p,
.login-required p {
    margin: 0;
    font-size: 1rem;
}

.login-required a {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
}

.login-required a:hover {
    text-decoration: underline;
}

/* === DANH SÁCH ĐÁNH GIÁ === */
.reviews-list h3 {
    font-size: 1.3rem;
    margin-bottom: 20px;
    color: var(--secondary-color);
}

.review-item {
    padding: 20px;
    border-bottom: 1px solid var(--border-color);
    background: #fafafa;
    border-radius: 8px;
    margin-bottom: 15px;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.reviewer-info {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), #ff8f61);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.reviewer-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.reviewer-name {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--secondary-color);
}

.badge-owner {
    background-color: var(--primary-color);
    color: white;
    font-size: 0.7rem;
    padding: 3px 8px;
    border-radius: 4px;
    font-weight: 600;
    display: inline-block;
    width: fit-content;
}

.review-date {
    font-size: 0.85rem;
    color: #6c757d;
}

.review-content {
    font-size: 1rem;
    color: #495057;
    line-height: 1.7;
    margin-top: 10px;
    padding: 15px;
    background: white;
    border-radius: 6px;
    border-left: 3px solid var(--primary-color);
}

/* === REVIEW ACTIONS === */
.review-actions {
    display: flex;
    gap: 8px;
}

.btn-edit-review,
.btn-delete-review {
    background: white;
    border: 1px solid var(--border-color);
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-edit-review:hover {
    background-color: #17a2b8;
    color: white;
    border-color: #17a2b8;
}

.btn-delete-review:hover {
    background-color: #dc3545;
    color: white;
    border-color: #dc3545;
}

/* === EDIT FORM === */
.edit-form {
    margin-top: 15px;
    padding: 15px;
    background: white;
    border-radius: 8px;
    border: 2px solid var(--primary-color);
}

.edit-actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.btn-save-edit,
.btn-cancel-edit {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-save-edit {
    background-color: var(--success-color);
    color: white;
}

.btn-save-edit:hover {
    background-color: #218838;
}

.btn-cancel-edit {
    background-color: #6c757d;
    color: white;
}

.btn-cancel-edit:hover {
    background-color: #5a6268;
}

/* === NO REVIEWS === */
.no-reviews {
    text-align: center;
    padding: 50px 20px;
    color: #6c757d;
    font-size: 1.1rem;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .reviews-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .review-header {
        flex-direction: column;
        gap: 10px;
    }

    .review-actions {
        width: 100%;
    }

    .btn-edit-review,
    .btn-delete-review {
        flex: 1;
    }
}

        /* Responsive cho mobile */
        @media (max-width: 992px) {
            .product-container {
                flex-direction: column;
                padding: 20px;
                gap: 20px;
            }
            .product-image-col, .product-details-col {
                flex: 1 1 100%;
            }
            .product-title {
                font-size: 1.8rem;
            }
            .product-price {
                font-size: 1.7rem;
            }
            .action-buttons {
                flex-direction: column;
            }
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            /* Responsive cho Sản phẩm gợi ý */
            .product-card {
                flex: 0 0 calc(50% - 10px); /* 2 cột trên tablet/mobile */
            }
        }
        
        @media (max-width: 600px) {
            .product-card {
                flex: 0 0 100%; /* 1 cột trên mobile nhỏ */
                max-width: 300px;
            }
            .product-grid {
                 gap: 15px;
            }
            .product-reviews {
                padding: 20px;
            }
            .review-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .review-date {
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>

        @include('index.header')

    <div class="product-container">
        <!-- Cột 1: Hình ảnh Sản phẩm -->
        <div class="product-image-col">
            <img 
                src="/storage/{{ $san_pham->HinhAnh }}" 
                alt="Hình ảnh Sản phẩm" 
                class="main-image"
                onerror="this.onerror=null; this.src='https://placehold.co/500x500/ff6f61/ffffff?text=Lỗi+Ảnh';"
            >
        </div>

        <!-- Cột 2: Chi tiết Sản phẩm và Tương tác -->
        <div class="product-details-col">
            <h1 class="product-title">{{$san_pham->TenSP}}</h1>
            <div class="rating">⭐⭐⭐⭐⭐ ({{$totalReviews}} Đánh giá)</div>
            
            <div class="product-price">{{ number_format($san_pham->DonGia, 0, ',', '.')}}₫</div>
            
            <div class="description">
                <h3>Chi tiết sản phẩm</h3>
            <pre style="font-family: 'Inter', sans-serif; white-space: pre-wrap;">{{$san_pham->MoTa}}</pre>
            </div>
            
            <!-- Khu vực Tương tác -->
            <div class="interaction-area">
                 <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                <div class="quantity-control">
                    <label for="qty">Số lượng:</label>
                    <div class="quantity-input-group">
                        <button class="qty-button" type="button" onclick="updateQuantity(-1)">-</button>
                        <input type="number" id="qty" name="SoLuong" class="qty-input" value="1" min="1">
                        <button class="qty-button" type="button" onclick="updateQuantity(1)">+</button>
                    </div>

                </div>
                <div class="action-buttons">
                        <input type="hidden" name="MaSP" value="{{ $san_pham->MaSP }}">
                        <button type="submit" class="btn btn-add-to-cart">
                         Thêm vào Giỏ hàng
                        </button>
                    </form>
                </div>

                <!-- Hộp thông báo -->
                <div id="message-box"></div>
            </div>
        </div>
    </div>

    <!-- PHẦN ĐÁNH GIÁ CỦA KHÁCH HÀNG -->
<div class="product-reviews">
    <div class="reviews-header">
        <h2>Đánh giá của Khách hàng</h2>
        <div class="rating-summary">
            <span class="total-reviews">{{ $totalReviews }} đánh giá</span>
        </div>
    </div>

    <!-- FORM ĐÁNH GIÁ -->
   @if (Session::has('khach_hang_id'))
        @if(!$hasReviewed)
        <div class="review-form-container">
            <h3>✍️ Viết đánh giá của bạn</h3>
            <form id="reviewForm" class="review-form">
                @csrf
                <input type="hidden" name="MaSP" value="{{ $san_pham->MaSP }}">

                <!-- Nội dung đánh giá -->
                <div class="form-group">
                    <label for="review-content" class="form-label">
                        Chia sẻ trải nghiệm của bạn về sản phẩm này <span class="required">*</span>
                    </label>
                    <textarea 
                        id="review-content" 
                        name="NoiDung" 
                        class="form-textarea" 
                        rows="6" 
                        placeholder="Hãy chia sẻ cảm nhận của bạn về chất lượng, thiết kế, độ bền hay bất kỳ điều gì bạn thích về sản phẩm này... (tối thiểu 10 ký tự)"
                        required
                        minlength="10"
                        maxlength="1000"
                    ></textarea>
                    <div class="char-count">
                        <span id="char-counter">0</span>/1000 ký tự
                    </div>
                    <span class="error-message" id="error-content"></span>
                </div>

                <!-- Nút submit -->
                <button type="submit" class="btn-submit-review" id="submitReviewBtn">
                    <span class="btn-text">📝 Gửi đánh giá</span>
                    <span class="btn-loading" style="display: none;">⏳ Đang gửi...</span>
                </button>
            </form>
            
            <!-- Alert message -->
            <div id="review-alert" class="review-alert" style="display: none;"></div>
        </div>
        @else
        <div class="already-reviewed">
            <p>Bạn đã đánh giá sản phẩm này rồi. Cảm ơn bạn đã chia sẻ!</p>
        </div>
        @endif
    @else
        <div class="login-required">
            <p>🔒 Bạn cần <a href="{{ route('login') }}">đăng nhập</a> để đánh giá sản phẩm</p>
        </div>
    @endif

    <!-- DANH SÁCH ĐÁNH GIÁ -->
    <div class="reviews-list">
        <h3>📋 Tất cả đánh giá ({{ $totalReviews }})</h3>
        
        @forelse($reviews as $review)
        <div class="review-item" data-review-id="{{ $review->MaDG }}">
            <div class="review-header">
                <div class="reviewer-info">
                    <div class="avatar">{{ substr($review->khachHang->HoTen ?? 'K', 0, 1) }}</div>
                    <div class="reviewer-details">
                        <span class="reviewer-name">{{ $review->khachHang->HoTen }}</span>
                        @if (  (Session::has('khach_hang_id')) && ($khachHang->MaKH  == $review->MaKH))
                            <span class="badge-owner">Đánh giá của bạn</span>
                        @endif
                        <span class="review-date">📅 {{ $review->formatted_date }}</span>
                    </div>
                </div>
                
                @if (  (Session::has('khach_hang_id')) && ($khachHang->MaKH  == $review->MaKH))
                <div class="review-actions">
                    <button class="btn-edit-review" onclick="editReview('{{ $review->MaDG }}', `{{ $review->NoiDung }}`)">
                        Sửa
                    </button>
                    <button class="btn-delete-review" onclick="deleteReview('{{ $review->MaDG }}')">
                        Xóa
                    </button>
                </div>
                @endif
            </div>
            
            <p class="review-content" id="content-{{ $review->MaDG }}">{{ $review->NoiDung }}</p>
            
            <div class="edit-form" id="edit-form-{{ $review->MaDG }}" style="display: none;">
                <textarea class="form-textarea" id="edit-content-{{ $review->MaDG }}" rows="4">{{ $review->NoiDung }}</textarea>
                <div class="edit-actions">
                    <button class="btn-save-edit" onclick="saveEdit('{{ $review->MaDG }}')">Lưu</button>
                    <button class="btn-cancel-edit" onclick="cancelEdit('{{ $review->MaDG }}')">Hủy</button>
                </div>
            </div>
        </div>
        @empty
        <div class="no-reviews">
            <p>📝 Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá sản phẩm này!</p>
        </div>
        @endforelse
        
        <!-- Pagination -->
        @if($reviews->hasPages())
        <div class="pagination-container">
            {{ $reviews->links() }}
        </div>
        @endif
    </div>
</div>

    <div class="related-products">
        <h2>Sản phẩm có thể bạn yêu thích</h2>
        <div class="product-grid">
            
            @foreach ($relatedProducts as $product)    
            <a href="{{ route('products.show', $product->MaSP) }}" class="product-card">
                <img src="/storage/{{$product->HinhAnh}}" alt="Sản phẩm gợi ý 1">
                <div class="card-info">
                    <h4>{{$product->TenSP}}</h4>
                    <div class="card-price">{{number_format($product->DonGia, 0, ',' , '.') }}₫</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

     @include('index.footer')

    <script>
        // Hàm cập nhật số lượng
        function updateQuantity(change) {
            const qtyInput = document.getElementById('qty');
            let currentQty = parseInt(qtyInput.value);
            let newQty = currentQty + change;
            
            if (newQty < 1) {
                newQty = 1;
            }
            qtyInput.value = newQty;
        }

        // Hàm hiển thị thông báo
        function showMessage(message, type = 'success') {
            const msgBox = document.getElementById('message-box');
            msgBox.textContent = message;
            msgBox.style.display = 'block';
            msgBox.style.backgroundColor = type === 'success' ? '#d4edda' : '#f8d7da';
            msgBox.style.color = type === 'success' ? '#155724' : '#721c24';

            // Tự động ẩn sau 3 giây
            setTimeout(() => {
                msgBox.style.display = 'none';
            }, 3000);
        }
document.addEventListener('DOMContentLoaded', function() {
    const reviewForm = document.getElementById('reviewForm');
    const reviewContent = document.getElementById('review-content');
    const charCounter = document.getElementById('char-counter');
    const submitBtn = document.getElementById('submitReviewBtn');
    const reviewAlert = document.getElementById('review-alert');

    // Character counter
    if (reviewContent && charCounter) {
        reviewContent.addEventListener('input', function() {
            charCounter.textContent = this.value.length;
        });
    }

    // Submit review form
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            
            // Validate
            const content = reviewContent.value.trim();
            
            if (content.length < 10) {
                document.getElementById('error-content').textContent = 'Nội dung đánh giá phải có ít nhất 10 ký tự';
                return;
            }
            
            // Show loading
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-text').style.display = 'none';
            submitBtn.querySelector('.btn-loading').style.display = 'inline';
            
            // Prepare data
            const formData = new FormData(reviewForm);
            
            // Send AJAX request
            fetch('{{ route("reviews.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    
                    // Reset form
                    reviewForm.reset();
                    charCounter.textContent = '0';
                    
                    // Reload page after 2 seconds to show new review
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    showAlert(data.message, 'error');
                    
                    if (data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 2000);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Có lỗi xảy ra. Vui lòng thử lại.', 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.querySelector('.btn-text').style.display = 'inline';
                submitBtn.querySelector('.btn-loading').style.display = 'none';
            });
        });
    }
    
    function showAlert(message, type) {
        if (reviewAlert) {
            reviewAlert.textContent = message;
            reviewAlert.className = 'review-alert ' + type;
            reviewAlert.style.display = 'block';
            
            setTimeout(() => {
                reviewAlert.style.display = 'none';
            }, 5000);
        }
    }
});

// Edit review function
function editReview(maDG, currentContent) {
    document.getElementById('content-' + maDG).style.display = 'none';
    document.getElementById('edit-form-' + maDG).style.display = 'block';
}

// Cancel edit function
function cancelEdit(maDG) {
    document.getElementById('content-' + maDG).style.display = 'block';
    document.getElementById('edit-form-' + maDG).style.display = 'none';
}

// Save edit function
function saveEdit(maDG) {
    const newContent = document.getElementById('edit-content-' + maDG).value.trim();
    
    if (newContent.length < 10) {
        alert('Nội dung đánh giá phải có ít nhất 10 ký tự');
        return;
    }
    
    fetch(`/reviews/${maDG}`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            NoiDung: newContent
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại.');
    });
}

// Delete review function
function deleteReview(maDG) {
    if (!confirm('Bạn có chắc muốn xóa đánh giá này?')) return;
    
    fetch(`/reviews/${maDG}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại.');
    });
}
    </script>

</body>
</html>