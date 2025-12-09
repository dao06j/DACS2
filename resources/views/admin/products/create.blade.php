<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 2rem;
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .breadcrumb {
            color: #7f8c8d;
            font-size: 0.95rem;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #27ae60;
            color: white;
        }

        .btn-primary:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #7f8c8d;
            color: white;
        }

        .btn-secondary:hover {
            background: #6c7a7f;
        }

        .error-message {
            color: #721c24;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .success-message {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }


        /* Cập nhật CSS cho Tiêu đề: Thêm flex để căn giữa nội dung */
        .page-header {
            margin-bottom: 30px;
            /* CÁC THAY ĐỔI ĐỂ CĂN GIỮA */
            display: flex; 
            flex-direction: column;
            align-items: center;
            text-align: center;
            /* END THAY ĐỔI */
        }
        
        /* CSS CHUYÊN DỤNG CHO FORM */
        .form-container { 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
            /* Tăng độ rộng tối đa để form rộng hơn */
            max-width: 1000px; /* Đã thay đổi từ 800px */
            /* Căn giữa form trong main-content */
            margin: 0 auto;
        }
        
        /* Sửa lại grid để chỉ còn 2 cột chính */
        .form-grid {
            display: grid;
            /* Chia thành 2 cột đều nhau */
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .form-container {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    
        @include('layouts.sidebar_admin')

    <!-- MAIN CONTENT -->
  <div class="main-content">
        <div class="page-header">
            <h1 class="page-title"> Thêm Sản Phẩm Mới</h1>
            <div class="breadcrumb">
                <a href="{{ route('admin.products.index') }}">Quản Lý Sản Phẩm</a> / 
                <span>Thêm Mới</span>
            </div>
        </div>

        @if (session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Tên Sản Phẩm *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        placeholder="Nhập tên sản phẩm"
                        required
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="category">Loại Sản Phẩm *</label>
                        <select id="category" name="category" required style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                            <option value="">-- Chọn Loại Sản Phẩm --</option>
                            <option value="Tủ" {{ old('category') == 'Tủ' ? 'selected' : '' }}>Tủ</option>
                            <option value="Giường" {{ old('category') == 'Giường' ? 'selected' : '' }}>Giường</option>
                            <option value="Bàn" {{ old('category') == 'Bàn' ? 'selected' : '' }}>Bàn</option>
                            <option value="Ghế" {{ old('category') == 'Ghế' ? 'selected' : '' }}>Ghế</option>
                            <option value="Trang Trí" {{ old('category') == 'Trang Trí' ? 'selected' : '' }}>Trang Trí</option>
                        </select>
                        @error('category')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Giá (₫) *</label>
                        <input 
                            type="number" 
                            id="price" 
                            name="price" 
                            value="{{ old('price') }}"
                            placeholder="Nhập giá sản phẩm"
                            step="1000"
                            min="0"
                            required
                        >
                        @error('price')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <input type="hidden" name="status" value="Hiện">
                </div>
                
                <div class="form-group">
                    <label for="description">Mô Tả</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        placeholder="Nhập mô tả chi tiết sản phẩm"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Hình Ảnh *</label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        accept="image/jpeg,image/png,image/jpg,image/gif"
                        required
                    >
                    @error('image')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span>Thêm Sản Phẩm</span>
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <span>Quay Lại</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>