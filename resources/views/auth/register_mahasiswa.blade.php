<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #eef2f7; font-family: 'Segoe UI', sans-serif; color: #333; }
        .register-container { min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 1rem; }
        /* Ukuran kartu diperkecil agar tidak perlu scroll banyak */
        .register-card { background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); width: 100%; max-width: 400px; padding: 1.5rem; }
        .btn-custom-dark { background-color: #1e293b; color: #ffffff; border: none; padding: 0.6rem; border-radius: 50px; font-weight: 500; font-size: 0.95rem; }
        .btn-custom-dark:hover { background-color: #0f172a; color: #ffffff; }
        /* Margin antar form dirapatkan */
        .form-group-custom { margin-bottom: 0.75rem; }
        .form-control { border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.9rem; }
        .form-label { font-size: 0.8rem; margin-bottom: 0.25rem; }
    </style>
</head>
<body>

<div class="container register-container">
    <div class="register-card">
        
        <div class="text-center mb-3">
            <h4 class="fw-bold m-0" style="color: #1e293b;">Aktivasi Akun</h4>
            <p class="text-muted small m-0">Lengkapi data akun login Mahasiswa</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show p-2 small mb-3" role="alert">
                <ul class="mb-0 ps-3 text-start">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('/mahasiswa/register') }}" method="POST">
            @csrf

            <div class="form-group-custom">
                <label class="form-label text-secondary fw-semibold">NIM Resmi</label>
                <input type="text" name="nim" class="form-control" placeholder="Contoh: 2401092007" value="{{ old('nim') }}" required autocomplete="off">
            </div>

            <div class="form-group-custom">
                <label class="form-label text-secondary fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama') }}" required autocomplete="off">
            </div>

            <div class="form-group-custom">
                <label class="form-label text-secondary fw-semibold">Email Aktif</label>
                <input type="email" name="email" class="form-control" placeholder="nama@example.com" value="{{ old('email') }}" required autocomplete="off">
            </div>

            <div class="form-group-custom">
                <label class="form-label text-secondary fw-semibold">Buat Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>

            <div class="form-group-custom mb-4">
                <label class="form-label text-secondary fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>

            <div class="d-grid gap-2 mb-2">
                <button type="submit" class="btn btn-custom-dark">Aktivasi Akun Now</button>
            </div>
        </form>

        <div class="text-center small mt-3">
            <span class="text-muted">Sudah aktivasi?</span> 
            <a href="{{ route('mahasiswa.login') }}" class="text-decoration-none fw-semibold" style="color: #1e293b;">Login</a>
        </div>

    </div>
    <div class="text-center text-muted mt-3" style="font-size: 0.75rem;">
        &copy; 2026 Firyal Najla. Manajemen Informatika.
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>