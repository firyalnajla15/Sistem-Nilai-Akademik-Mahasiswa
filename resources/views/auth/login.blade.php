<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9edf5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-card {
            background: #f8f9fb;
            border: none;
            border-radius: 16px;
        }

        .btn-custom-dark {
            background: #1f2a44;
            color: #ffffff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-custom-dark:hover {
            background: #131b2e;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .form-control:focus {
            border-color: #1f2a44;
            box-shadow: 0 0 0 0.25rem rgba(31, 42, 68, 0.15);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-11 col-sm-8 col-md-5 col-lg-4">

            <div class="card login-card shadow-sm p-3">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <span style="font-size: 2.5rem;">🔐</span>
                        <h4 class="text-dark fw-bold mt-2 mb-1">Login Admin</h4>
                        <p class="text-muted small">Sistem Nilai Akademik Mahasiswa</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger border-0 py-2 small text-center mb-3 text-danger" style="background: #fcdede;">
                            <strong>Gagal:</strong> {{ session('error') }}
                        </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small text-muted fw-medium">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control border-0 shadow-sm py-2 px-3 rounded-3" 
                                   style="background: #ffffff;"
                                   placeholder="Masukkan email Anda"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-muted fw-medium">Password</label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control border-0 shadow-sm py-2 px-3 rounded-3" 
                                   style="background: #ffffff;"
                                   placeholder="••••••••"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-custom-dark w-100 py-2 rounded-pill fw-medium shadow-sm">
                            Login
                        </button>
                    </form>

                </div>
            </div>

            <div class="text-center mt-3">
                <p class="text-muted" style="font-size: 0.75rem;">&copy; {{ date('Y') }} Firyal Najla 2010092007. Manajemen Informatika.</p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>