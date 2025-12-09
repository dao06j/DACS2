<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập / Đăng Ký</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            position: relative;
            min-height: 550px;
        }

        /* Left Side - Form */
        .form-side {
            flex: 1;
            padding: 50px 40px;
            position: relative;
            z-index: 2;
            background: white;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #7f8c8d;
            font-size: 0.95rem;
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .tab {
            padding: 10px 30px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            color: #7f8c8d;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .form-content {
            display: none;
        }

        .form-content.active {
            display: block;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-size: 1.2rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-group label {
            color: #555;
            font-size: 0.9rem;
            cursor: pointer;
            margin: 0;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .forgot-password a:hover {
            color: #5568d3;
            text-decoration: underline;
        }

        /* Right Side - Info */
        .info-side {
            flex: 1;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .info-side .icon {
            font-size: 5rem;
            margin-bottom: 30px;
        }

        .info-side h3 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .info-side p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            font-size: 1rem;
        }

        .features {
            margin-top: 30px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .feature-item .icon {
            font-size: 1.5rem;
        }

        /* Alert */
        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                max-width: 450px;
            }

            .info-side {
                display: none;
            }

            .form-side {
                padding: 40px 30px;
            }

            .form-header h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Form Side -->
        <div class="form-side">
            <div class="form-header">
                <h2>Chào Mừng!</h2>
                <p>Đăng nhập hoặc tạo tài khoản mới</p>
            </div>
            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active" onclick="switchTab('login')">Đăng Nhập</button>
                <button class="tab" onclick="switchTab('register')">Đăng Ký</button>
            </div>

            <!-- Login Form -->
            <div id="login-form" class="form-content active">
                <form action="{{ route('login.post')}}" method="POST">
                    @csrf
                    <!-- Email -->
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <div class="input-group">
                            <span class="input-icon">📧</span>
                            <input 
                                type="email" 
                                id="login-email"
                                name="email" 
                                class="form-control" 
                                placeholder="example@email.com"
                                required
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="login-password">Mật Khẩu</label>
                        <div class="input-group">
                            <span class="input-icon">🔒</span>
                            <input 
                                type="password" 
                                id="login-password"
                                name="password" 
                                class="form-control" 
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ghi nhớ đăng nhập</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-submit">Đăng Nhập</button>
                </form>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="form-content">
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div class="form-group">
                        <label for="register-name">Họ và Tên</label>
                        <div class="input-group">
                            <span class="input-icon">👤</span>
                            <input 
                                type="text" 
                                id="register-name"
                                name="name" 
                                class="form-control" 
                                placeholder="Nguyễn Văn A"
                                required
                            >
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <div class="input-group">
                            <span class="input-icon">📧</span>
                            <input 
                                type="email" 
                                id="register-email"
                                name="email" 
                                class="form-control" 
                                placeholder="example@email.com"
                                required
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="register-password">Mật Khẩu</label>
                        <div class="input-group">
                            <span class="input-icon">🔒</span>
                            <input 
                                type="password" 
                                id="register-password"
                                name="password" 
                                class="form-control" 
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-submit">Đăng Ký</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        function switchTab(tab) {
            // Switch tab buttons
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');

            // Switch form content
            const forms = document.querySelectorAll('.form-content');
            forms.forEach(f => f.classList.remove('active'));

            if (tab === 'login') {
                document.getElementById('login-form').classList.add('active');
            } else {
                document.getElementById('register-form').classList.add('active');
            }
        }

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const btn = this.querySelector('.btn-submit');
                btn.textContent = 'Đang xử lý...';
                btn.disabled = true;
            });
        });
    </script>
</body>
</html>