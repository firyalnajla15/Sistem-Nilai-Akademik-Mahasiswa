<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Nilai Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: #334155;
            padding-top: 4rem;
        }

        /* ================= NAVBAR ================= */
        .auth-navbar {
            background: #0f172a !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1.5rem;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1000;
            border-bottom: 2px solid rgba(56, 189, 248, 0.15);
        }

        .auth-navbar .brand-text {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.05rem;
            text-decoration: none;
        }

        .auth-navbar .brand-text i {
            color: #38bdf8;
            margin-right: 10px;
        }

        .btn-outline-light-custom {
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            padding: 5px 16px;
            font-size: 0.85rem;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-outline-light-custom:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .btn-info-custom {
            background: #0284c7;
            color: white !important;
            border-radius: 20px;
            padding: 5px 16px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: 0.2s;
            border: none;
        }

        .btn-info-custom:hover {
            background: #0369a1;
        }

        /* ================= CARD ================= */
        .login-container {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
            padding: 2rem 2rem 2.2rem;
            border: 1px solid #e2e8f0;
        }

        .brand-icon {
            font-size: 2.8rem;
            margin-bottom: 0.3rem;
            color: #0f172a;
        }

        .brand-icon i {
            color: #38bdf8;
        }

        .login-title {
            color: #0f172a;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 2px;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* ================= FORM ================= */
        .form-label {
            color: #475569;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 4px;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.65rem 1rem;
            border: 1.5px solid #e2e8f0;
            font-size: 0.95rem;
            transition: 0.2s;
            background: #ffffff;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
            border-color: #38bdf8;
        }

        .form-control::placeholder {
            color: #a0aec0;
            font-size: 0.9rem;
        }

        .btn-custom-dark {
            background: #0f172a;
            color: #ffffff;
            border: none;
            padding: 0.7rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-custom-dark:hover {
            background: #1e293b;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-custom-dark i {
            margin-right: 8px;
        }

        /* ================= FOOTER ================= */
        .footer-text {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 1.5rem;
            text-align: center;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .login-card {
                padding: 1.5rem;
                margin: 0 15px;
            }

            .auth-navbar {
                padding: 0.6rem 1rem;
            }

            .auth-navbar .brand-text {
                font-size: 0.9rem;
            }

            .btn-outline-light-custom,
            .btn-info-custom {
                font-size: 0.75rem;
                padding: 4px 12px;
            }
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="auth-navbar d-flex justify-content-between align-items-center">
        <a href="{{ url('/') }}" class="brand-text">
            <i class="fa-solid fa-graduation-cap"></i>Sistem Nilai Akademik Mahasiswa
        </a>
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ url('/') }}" class="btn-outline-light-custom">
                <i class="fa-solid fa-house me-1"></i> Landing
            </a>
            <a href="{{ route('mahasiswa.login') }}" class="btn-info-custom">
                <i class="fa-solid fa-user-graduate me-1"></i> Mahasiswa
            </a>
        </div>
    </nav>

    <!-- ================= LOGIN CARD ================= -->
    <div class="container login-container">
        <div class="login-card">

            <div class="text-center mb-4">
                <div class="brand-icon">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <h4 class="login-title">Login Admin</h4>
                <p class="login-subtitle">Sistem Nilai Akademik Mahasiswa</p>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show small p-2" role="alert">
                    <strong>Gagal:</strong> {{ session('error') }}
                    <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-custom-dark w-100">
                    <i class="fa-solid fa-right-to-bracket"></i> Login Sekarang
                </button>
            </form>

        </div>

        <div class="footer-text">
            &copy; {{ date('Y') }} Sistem Nilai Akademik Mahasiswa
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>