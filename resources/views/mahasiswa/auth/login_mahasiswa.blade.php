<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - Sistem Nilai Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f0f4f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #1a2a3a;
        }

        /* ===== NAVBAR ===== */
        .auth-navbar {
            background: #ffffff;
            padding: 0.7rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            border-bottom: 1px solid #e8edf3;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .auth-navbar .brand-text {
            color: #1a3a5c;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .auth-navbar .brand-text i {
            color: #1a3a5c;
            font-size: 1.2rem;
        }

        .nav-btn {
            border: 1px solid #e2e8f0;
            color: #4a6a84;
            border-radius: 50px;
            padding: 5px 18px;
            font-size: 0.8rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            background: #f8fafc;
        }

        .nav-btn:hover {
            background: #1a3a5c;
            color: #ffffff;
            border-color: #1a3a5c;
            transform: translateY(-1px);
        }

        .nav-btn-primary {
            background: #1a3a5c;
            border-color: #1a3a5c;
            color: #ffffff;
        }

        .nav-btn-primary:hover {
            background: #2a5a7a;
            border-color: #2a5a7a;
            color: #ffffff;
        }

        /* ===== LOGIN CONTAINER ===== */
        .login-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 100px 20px 40px;
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            animation: fadeUp 0.6s ease-out;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== LOGIN CARD ===== */
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem 2.2rem 2.2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            box-shadow: 0 8px 35px rgba(0, 0, 0, 0.07);
        }

        /* ===== BRAND ICON ===== */
        .brand-icon-wrap {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .brand-icon {
            width: 72px;
            height: 72px;
            background: #f0f6fb;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #1a3a5c;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .brand-icon:hover {
            transform: scale(1.05);
            background: #e8f0f8;
        }

        /* ===== TITLE ===== */
        .login-title {
            color: #1a3a5c;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 2px;
            letter-spacing: -0.3px;
        }

        .login-subtitle {
            color: #5a7a94;
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* ===== FORM ===== */
        .form-label {
            color: #3a5a7a;
            font-weight: 600;
            font-size: 0.8rem;
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }

        .form-control {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: #1a2a3a;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: #1a3a5c;
            box-shadow: 0 0 0 4px rgba(26, 58, 92, 0.06);
            color: #1a2a3a;
        }

        .form-control::placeholder {
            color: #a0b8cc;
            font-size: 0.85rem;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .form-control {
            padding-right: 2.8rem;
        }

        .input-group-custom .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0b8cc;
            font-size: 1rem;
            pointer-events: none;
            transition: color 0.3s ease;
        }

        .input-group-custom .form-control:focus~.input-icon {
            color: #1a3a5c;
        }

        /* ===== BUTTON ===== */
        .btn-login {
            background: #1a3a5c;
            border: none;
            color: #ffffff;
            padding: 0.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            background: #2a5a7a;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 58, 92, 0.15);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            margin-right: 8px;
        }

        /* ===== ALERT ===== */
        .alert-custom {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-custom-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-custom i {
            font-size: 1rem;
        }

        /* ===== DIVIDER ===== */
        .divider-text {
            color: #94a3b8;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .divider-text::before,
        .divider-text::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        /* ===== REGISTER LINK ===== */
        .register-link {
            color: #4a6a84;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .register-link:hover {
            color: #1a3a5c;
        }

        .register-link .link-highlight {
            color: #1a3a5c;
            font-weight: 600;
        }

        .register-link:hover .link-highlight {
            color: #2a5a7a;
        }

        /* ===== FOOTER ===== */
        .footer-text {
            color: #94a3b8;
            font-size: 0.75rem;
            margin-top: 1.5rem;
            text-align: center;
            letter-spacing: 0.3px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 576px) {
            .auth-navbar {
                padding: 0.6rem 1rem;
            }

            .auth-navbar .brand-text {
                font-size: 0.85rem;
            }

            .auth-navbar .brand-text i {
                font-size: 1rem;
            }

            .nav-btn {
                font-size: 0.7rem;
                padding: 4px 12px;
            }

            .login-card {
                padding: 1.8rem 1.2rem 1.5rem;
                border-radius: 16px;
            }

            .login-title {
                font-size: 1.3rem;
            }

            .brand-icon {
                width: 60px;
                height: 60px;
                font-size: 1.6rem;
            }

            .form-control {
                font-size: 0.85rem;
                padding: 0.65rem 0.9rem;
            }

            .btn-login {
                font-size: 0.85rem;
                padding: 0.7rem;
            }
        }

        @media (max-width: 400px) {
            .login-container {
                padding: 80px 10px 30px;
            }
            .login-card {
                padding: 1.2rem 0.8rem 1.2rem;
            }
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="auth-navbar d-flex justify-content-between align-items-center">
        <a href="{{ url('/') }}" class="brand-text">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Sistem Nilai Akademik</span>
        </a>
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ url('/') }}" class="nav-btn">
                <i class="fa-solid fa-house"></i> Landing
            </a>
            <a href="{{ route('login') }}" class="nav-btn nav-btn-primary">
                <i class="fa-solid fa-user-tie"></i> Admin/Dosen
            </a>
        </div>
    </nav>

    <!-- ================= LOGIN ================= -->
    <div class="login-container">
        <div class="login-wrapper">

            <div class="login-card">

                <!-- ===== BRAND ===== -->
                <div class="brand-icon-wrap">
                    <div class="brand-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <h4 class="login-title">Login Mahasiswa</h4>
                    <p class="login-subtitle">Silakan masuk ke portal nilai Anda</p>
                </div>

                <!-- ===== ALERT ===== -->
                @if (session('error'))
                    <div class="alert-custom mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert-custom alert-custom-success mb-3">
                        <i class="fa-regular fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-custom mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- ===== FORM ===== -->
                <form action="{{ route('mahasiswa.login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <div class="input-group-custom">
                            <input type="text"
                                   name="nim"
                                   class="form-control"
                                   placeholder="Masukkan NIM Anda"
                                   required
                                   autocomplete="off"
                                   value="{{ old('nim') }}">
                            <span class="input-icon"><i class="fa-regular fa-id-card"></i></span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group-custom">
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Masukkan password"
                                   required>
                            <span class="input-icon"><i class="fa-solid fa-lock"></i></span>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mb-2">
                        <button type="submit" class="btn-login">
                            <i class="fa-solid fa-right-to-bracket"></i> Login Sekarang
                        </button>
                    </div>
                </form>

                <!-- ===== DIVIDER ===== -->
                <div class="divider-text my-3">
                    <span>atau</span>
                </div>

                <!-- ===== REGISTER ===== -->
                <div class="text-center">
                    <span class="register-link">
                        Belum punya akun?
                        <a href="{{ route('mahasiswa.register') }}" class="register-link">
                            <span class="link-highlight">Aktivasi Akun</span>
                        </a>
                    </span>
                </div>

            </div>

            <!-- ===== FOOTER ===== -->
            <div class="footer-text">
                &copy; {{ date('Y') }} Sistem Nilai Akademik Mahasiswa
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>