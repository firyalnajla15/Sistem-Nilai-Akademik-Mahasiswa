<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Nilai Akademik Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            font-family: Arial, sans-serif;
        }

        .hero{
            min-height:100vh;
            background:
            linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
            url('https://images.unsplash.com/photo-1562774053-701939374585');
            background-size:cover;
            background-position:center;
            display:flex;
            align-items:center;
            color:white;
        }

        .info-bar{
            background:#1f2a44;
            color:white;
            padding:15px;
        }

        .feature-card{
            border:none;
            box-shadow:0 4px 15px rgba(0,0,0,.1);
            transition:.3s;
            height:100%;
        }

        .feature-card:hover{
            transform:translateY(-5px);
        }

        .navbar{
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

    <div class="container">

        <a class="navbar-brand fw-bold" href="/">
            🎓 Sistem Akademik
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#tentang">
                        Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#fitur">
                        Fitur
                    </a>
                </li>

                <!-- LOGIN DROPDOWN -->

                <li class="nav-item dropdown ms-2">

                    <a class="btn btn-primary dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        Login
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item"
                               href="/login">
                                👨‍🏫 Login Admin / Dosen
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                               href="/login-mahasiswa">
                                👨‍🎓 Login Mahasiswa
                            </a>
                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- HERO -->

<section class="hero">

    <div class="container text-center">

        <h1 class="display-4 fw-bold">
            Sistem Nilai Akademik Mahasiswa
        </h1>

        <p class="lead mt-3">
            Kelola data mahasiswa, mata kuliah,
            nilai dan transkrip akademik
            secara cepat dan mudah.
        </p>

        <div class="dropdown mt-4">

            <button class="btn btn-light btn-lg dropdown-toggle"
                    data-bs-toggle="dropdown">
                Login Sekarang
            </button>

            <ul class="dropdown-menu">

                <li>
                    <a class="dropdown-item"
                       href="/login">
                        👨‍🏫 Login Admin / Dosen
                    </a>
                </li>

                <li>
                    <a class="dropdown-item"
                       href="/login-mahasiswa">
                        👨‍🎓 Login Mahasiswa
                    </a>
                </li>

            </ul>

        </div>

    </div>

</section>

<!-- INFO KAMPUS -->

<div class="info-bar">

    <div class="container text-center">

        📍 Universitas Contoh Padang &nbsp; |
        &nbsp; ☎ (0751) 123456 &nbsp; |
        &nbsp; ✉ akademik@kampus.ac.id

    </div>

</div>

<!-- FITUR -->

<section id="fitur" class="py-5">

    <div class="container">

        <h2 class="text-center mb-5">
            Fitur Sistem
        </h2>

        <div class="row">

            <div class="col-md-4 mb-4">

                <div class="card feature-card p-4">

                    <h5>👨‍🎓 Data Mahasiswa</h5>

                    <p>
                        Mengelola data mahasiswa secara lengkap dan terstruktur.
                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card feature-card p-4">

                    <h5>📚 Mata Kuliah</h5>

                    <p>
                        Mengelola data mata kuliah dan semester akademik.
                    </p>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card feature-card p-4">

                    <h5>📝 Transkrip Nilai</h5>

                    <p>
                        Menampilkan dan mencetak transkrip nilai mahasiswa.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<footer class="bg-dark text-white text-center py-3">

    © {{ date('Y') }} Sistem Nilai Akademik Mahasiswa

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>