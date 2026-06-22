```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#e9edf5;
        }

        .card-login{
            border:none;
            border-radius:20px;
            background:#fff;
        }

        .btn-login{
            background:#1f2a44;
            color:white;
        }

        .btn-login:hover{
            background:#152038;
            color:white;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-md-5">

            <div class="card card-login shadow">

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h2>🎓</h2>
                        <h3>Login Mahasiswa</h3>
                        <p class="text-muted">
                            Sistem Nilai Akademik Mahasiswa
                        </p>
                    </div>

                    <form>

                        <div class="mb-3">
                            <label>NIM</label>
                            <input type="text"
                                   class="form-control"
                                   placeholder="Masukkan NIM">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password"
                                   class="form-control"
                                   placeholder="Masukkan Password">
                        </div>

                        <button type="submit"
                                class="btn btn-login w-100">
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Belum punya akun?

                        <a href="{{ route('mahasiswa.register') }}">
                            Daftar Disini
                        </a>
                    </div>

                    <div class="text-center mt-2">
                        <a href="/">← Kembali ke Beranda</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>
```
