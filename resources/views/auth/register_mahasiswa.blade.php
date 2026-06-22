```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#e9edf5;
        }

        .card-register{
            border:none;
            border-radius:20px;
        }

        .btn-daftar{
            background:#1f2a44;
            color:white;
        }

        .btn-daftar:hover{
            background:#152038;
            color:white;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-md-6">

            <div class="card card-register shadow">

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h2>📝</h2>
                        <h3>Registrasi Mahasiswa</h3>
                    </div>

                    <form>

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>NIM</label>
                            <input type="text"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Prodi</label>
                            <input type="text"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Angkatan</label>
                            <input type="number"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password"
                                   class="form-control">
                        </div>

                        <button type="submit"
                                class="btn btn-daftar w-100">
                            Daftar
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('mahasiswa.login') }}">
                            Sudah punya akun? Login
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>
```
