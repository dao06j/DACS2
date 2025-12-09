<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
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
            /* Đã xóa max-width để form full màn hình */
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
        .form-group textarea,
        .form-group select { 
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus { 
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .image-preview {
            max-width: 200px;
            border-radius: 8px;
            margin-top: 10px;
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
            background: #e74c3c;
            color: white;
        }

        .btn-primary:hover {
            background: #c0392b;
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

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
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
        }
    </style>
</head>
<body>
    @include('layouts/sidebar_admin')

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">✏️ Sửa Sản Phẩm: {{ $product->TenSP }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('admin.products.index') }}">Quản Lý Sản Phẩm</a> / 
                <span>Sửa Sản Phẩm</span>
            </div>
        </div>
        
        @if ($errors->any())
            <div style="padding: 15px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 8px; margin-bottom: 20px;">
                <strong>Có lỗi xảy ra:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('admin.products.update', $product->MaSP) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Mã Sản Phẩm</label>
                    <input type="text" value="{{ $product->MaSP }}" disabled style="background: #eee; cursor: not-allowed;">
                </div>

                <div class="form-group">
                    <label for="TenSP">Tên Sản Phẩm *</label>
                    <input 
                        type="text" 
                        id="TenSP" 
                        name="TenSP" 
                        value="{{ old('TenSP', $product->TenSP) }}"
                        placeholder="Nhập tên sản phẩm"
                        required
                    >
                    @error('TenSP')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="LoaiSP">Loại Sản Phẩm *</label>
                    <select id="LoaiSP" name="LoaiSP" required>
                        <option value="">-- Chọn loại sản phẩm --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('LoaiSP', $product->LoaiSP) === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('LoaiSP')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="DonGia">Đơn Giá (₫) *</label>
                    <input 
                        type="number" 
                        id="DonGia" 
                        name="DonGia" 
                        value="{{ old('DonGia', $product->DonGia) }}"
                        placeholder="Nhập giá sản phẩm"
                        step="1000"
                        min="0"
                        required
                    >
                    @error('DonGia')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="MoTa">Mô Tả</label>
                    <textarea 
                        id="MoTa" 
                        name="MoTa" 
                        placeholder="Nhập mô tả sản phẩm"
                    >{{ old('MoTa', $product->MoTa) }}</textarea>
                    @error('MoTa')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="HinhAnh">Hình Ảnh</label>
                    @if($product->HinhAnh)
                        <div style="margin-bottom: 15px;">
                            <img src="{{ asset('storage/' . $product->HinhAnh) }}" alt="{{ $product->TenSP }}" class="image-preview">
                            <input type="hidden" name="HinhAnh_old" value="{{ $product->HinhAnh }}">
                        </div>
                    @endif
                    <input 
                        type="file" 
                        id="HinhAnh" 
                        name="HinhAnh" 
                        accept="image/jpeg,image/png,image/jpg,image/gif"
                    >
                    <p style="color: #7f8c8d; font-size: 0.85rem; margin-top: 8px;">Để trống nếu không muốn đổi hình ảnh. Dung lượng tối đa: 2MB.</p>
                    @error('HinhAnh')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span>Lưu Thay Đổi</span>
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