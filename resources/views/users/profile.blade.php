<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Khách Hàng - Laravel Ready</title>
    <style>
        /* --- CSS Thuần cho Giao Diện --- */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            background-color: #ffffff;
            margin: auto;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
            font-size: 24px;
        }

        /* Phần Hiển Thị Thông Tin */
        .profile-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            border: 3px solid #007bff;
        }

        .profile-detail-item {
            display: flex;
            margin-bottom: 15px;
            padding: 12px;
            background-color: #f9f9f9;
            border-radius: 6px;
            border-left: 5px solid #007bff50;
        }

        .profile-label {
            font-weight: bold;
            color: #555;
            width: 120px;
            flex-shrink: 0;
        }

        .profile-value {
            color: #333;
            flex-grow: 1;
        }

        /* Phần Form Chỉnh Sửa */
        .edit-form-group {
            margin-bottom: 20px;
        }

        .edit-form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .edit-form-group input, .edit-form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .edit-form-group input:focus, .edit-form-group textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        
        .disabled-input {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        /* Các Nút */
        .button-group {
            text-align: right;
            padding-top: 15px;
        }

        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
            margin-left: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #1e7e34;
            transform: translateY(-1px);
        }
        
        .hidden {
            display: none;
        }
        
        /* Responsive adjustments */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .avatar {
                margin-bottom: 15px;
            }
            .profile-detail-item {
                flex-direction: column;
                padding: 10px;
            }
            .profile-label {
                width: 100%;
                margin-bottom: 5px;
            }
            .button-group {
                text-align: center;
            }
            .btn {
                margin: 5px 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
        @include('index.header')
    <div class="container">
        <h1>THÔNG TIN KHÁCH HÀNG</h1>

        <div id="viewMode">
            
            <div class="profile-header">
                <img class="avatar" 
                     src="https://placehold.co/100x100/007bff/FFFFFF?text=AV" 
                     alt="Ảnh đại diện">
                <div>
           
                    <h2 id="nameDisplay" style="font-size: 22px; color: #333; margin: 0 0 5px 0;">{{ $khachHang->HoTen }}</h2>
                    <p id="emailDisplay" style="color: #007bff;">{{ $khachHang->Email }}</p>
                </div>
            </div>

            <div class="profile-details">
                     <div class="profile-detail-item">
                    <span class="profile-label">Họ và Tên:</span>
                    <span class="profile-value">{{ $khachHang->HoTen }}</span>
                </div>
             
                <div class="profile-detail-item">
                    <span class="profile-label">Điện Thoại:</span>
                    <span class="profile-value">{{ $khachHang->Sdt }}</span>
                </div>

                <div class="profile-detail-item">
                    <span class="profile-label">Địa Chỉ:</span>
                    <span class="profile-value">{{ $khachHang->DiaChi }}</span>
                </div>
            </div>
            <div style="text-align: center; color: red;">
                @if (session('error'))
                 {{ session('error') }}
        @endif
            </div>

            <div class="button-group" style="text-align: center;">
                <button onclick="toggleMode(true)"
                        class="btn btn-primary">
                    Sửa Thông Tin
                </button>
            </div>
        </div>

        <form id="editMode" class="hidden" method="POST" action="{{route('profile.update', $khachHang->MaKH) }}">
            @csrf
            @method('PUT')
        

            <h2 style="font-size: 20px; color: #333; border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px;">
                Chỉnh Sửa Hồ Sơ
            </h2>

         
            <div class="edit-form-group">
                <label for="nameInput">Họ và Tên</label>
                <input type="text" id="nameInput" name="HoTen" required value="{{$khachHang->HoTen}}">
            </div>

   
            <div class="edit-form-group">
                <label for="emailInput">Email (Không thể sửa)</label>
                <input type="email" id="emailInput" class="disabled-input" disabled value="{{$khachHang->Email}}">
            </div>

       
            <div class="edit-form-group">
                <label for="phoneInput">Số Điện Thoại</label>
                <input type="tel" id="phoneInput" name="Sdt" required value="{{$khachHang->Sdt}}">
            </div>

       
            <div class="edit-form-group">
                <label for="addressInput">Địa Chỉ</label>
                <textarea id="addressInput" rows="3" name="DiaChi" required>{{$khachHang->DiaChi}}</textarea>
            </div>
 
            <div class="button-group">
                <button type="button" onclick="toggleMode(false)"
                        class="btn btn-secondary">
                    Hủy Bỏ
                </button>
                <button type="submit"
                        class="btn btn-success">
                    Lưu Thay Đổi
                </button>
            </div>
        </form>
    </div>
    @include('index.footer')

    <script>

        function toggleMode(isEdit) {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');


            if (isEdit) {

                document.getElementById('nameInput').value = document.querySelector('.profile-value').textContent.trim();
                
                viewMode.classList.add('hidden');
                editMode.classList.remove('hidden');
            } else {

                editMode.classList.add('hidden');
                viewMode.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleMode(false);
        });
    </script>

</body>
</html>