<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - Sistem Nilai Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #eef2f7; font-family: 'Segoe UI', sans-serif; color: #333; }
        .login-container { min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .login-card { background: #ffffff; border-radius: 20px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); width: 100%; max-width: 440px; padding: 2.5rem; }
        .brand-icon { font-size: 3rem; margin-bottom: 0.5rem; }
        .btn-custom-dark { background-color: #1e293b; color: #ffffff; border: none; padding: 0.75rem; border-radius: 50px; font-weight: 500; transition: all 0.3s ease; }
        .btn-custom-dark:hover { background-color: #0f172a; color: #ffffff; }
        .form-control { border-radius: 10px; padding: 0.75rem 1rem; border: 1px solid #dee2e6; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(30, 41, 59, 0.15); border-color: #1e293b; }
        .footer-text { font-size: 0.85rem; color: #6c757d; margin-top: 1.5rem; text-align: center; }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="login-card">
        
        <div class="text-center mb-4">
            <div class="brand-icon">🎓</div>
            <h3 class="fw-bold m-0" style="color: #1e293b;">Login Mahasiswa</h3>
            <p class="text-muted small">Sistem Nilai Akademik Mahasiswa</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('/login-mahasiswa') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label text-secondary small fw-semibold">NIM</label>
                <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM Anda" required autocomplete="off" value="{{ old('nim') }}">
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary small fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-custom-dark">Login</button>
            </div>
        </form>

        <div class="text-center small mt-4">
            <span class="text-muted">Belum punya akun?</span> 
            <a href="{{ route('mahasiswa.register') }}" class="text-decoration-none fw-semibold" style="color: #1e293b;">Register</a>
        </div>

    </div>

    <div class="footer-text">
        &copy; 2026 Firyal Najla 2010092007. Manajemen Informatika.
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>