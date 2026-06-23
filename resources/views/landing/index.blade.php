<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Sistem Informasi Akademik</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #334155;
            overflow-x: hidden;
        }

        /* ================= MODERN NAVBAR ================= */
        .navbar {
            backdrop-filter: blur(12px);
            background-color: rgba(15, 23, 42, 0.95) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8) !important;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: #38bdf8 !important;
        }

        .btn-login-nav {
            background: #0284c7;
            border: none;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-login-nav:hover, .btn-login-nav:focus {
            background: #0369a1 !important;
            transform: translateY(-1px);
        }

        /* ================= HERO SECTION ================= */
        .hero {
            min-height: 100vh;
            background: 
                linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.85)),
                url('https://images.unsplash.com/photo-1562774053-701939374585');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            color: white;
            padding-top: 80px;
        }

        .hero h1 {
            letter-spacing: -1.5px;
            line-height: 1.2;
            text-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .hero p {
            color: #cbd5e1;
            max-width: 700px;
            margin: 0 auto;
        }

        .btn-hero-login {
            background: #ffffff;
            color: #0f172a !important;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-hero-login:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        /* ================= INFO BAR ================= */
        .info-bar {
            background: #0f172a;
            color: #94a3b8;
            font-size: 0.9rem;
            padding: 18px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .info-bar i {
            color: #38bdf8;
            margin-right: 6px;
        }

        /* ================= FEATURE CARDS ================= */
        .section-title {
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
            position: relative;
            margin-bottom: 16px;
        }

        .feature-card {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: #cbd5e1;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .feature-icon-wrapper {
            width: 50px;
            height: 50px;
            background: #f0fdf4;
            color: #16a34a;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .col-md-4:nth-child(2) .feature-icon-wrapper {
            background: #f0f9ff;
            color: #0284c7;
        }

        .col-md-4:nth-child(3) .feature-icon-wrapper {
            background: #faf5ff;
            color: #9333ea;
        }

        .feature-card h5 {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* ================= FOOTER ================= */
        footer {
            background: #0f172a !important;
            color: #64748b !important;
            font-size: 0.9rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 24px 0 !important;
        }

        /* Dropdown Styling Menu Customization */
        .dropdown-menu {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 8px;
        }

        .dropdown-item {
            padding: 10px 16px;
            border-radius: 8px;
            color: #334155;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
            color: #0f172a;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
            <span style="font-size: 1.5rem;">🎓</span> Sistem Nilai Akademik Mahasiswa
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="#fitur">Layanan</a>
                </li>

                <li class="nav-item dropdown ms-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-primary btn-login-nav dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        Masuk ke Sistem
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/login">
                                <i class="fa-solid fa-user-tie text-secondary"></i> Portal Admin & Dosen
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/login-mahasiswa">
                                <i class="fa-solid fa-graduation-cap text-secondary"></i> Portal Mahasiswa
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container text-center">
        <h1 class="display-4 fw-bold px-md-5">
            Sistem Informasi Akademik
        </h1>

        <p class="lead mt-3 fs-5 px-md-5">
            Integrasi layanan data akademik, administrasi perkuliahan, pemantauan nilai, dan transkrip mahasiswa secara real-time.
        </p>

        <div class="dropdown mt-4">
            <button class="btn btn-light btn-lg btn-hero-login dropdown-toggle" data-bs-toggle="dropdown">
                Login Aplikasi
            </button>
            <ul class="dropdown-menu dropdown-menu-center mt-2">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="/login">
                        <i class="fa-solid fa-user-tie text-secondary"></i> Portal Admin & Dosen
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="/login-mahasiswa">
                        <i class="fa-solid fa-graduation-cap text-secondary"></i> Portal Mahasiswa
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

<div class="info-bar">
    <div class="container d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 gap-md-4">
        <div><i class="fa-solid fa-location-dot"></i> Politeknik Negeri Padang</div>
        <div class="d-none d-md-block text-muted">|</div>
        <div><i class="fa-solid fa-phone"></i> (0751) 72590</div>
        <div class="d-none d-md-block text-muted">|</div>
        <div><i class="fa-solid fa-envelope"></i> www.pnp.ac.id</div>
    </div>
</div>

<section id="fitur" class="py-5 bg-opacity-10 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="section-title fs-1">Layanan Akademik</h2>
            <p class="text-muted">Modul aplikasi utama penunjang manajemen data dan aktivitas operasional akademik perguruan tinggi</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <div class="feature-icon-wrapper">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h5>Biodata & Status Mahasiswa</h5>
                    <p>
                        Pusat penyimpanan informasi data induk mahasiswa, riwayat registrasi, serta pengelolaan status keaktifan akademik.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <div class="feature-icon-wrapper">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <h5>Kurikulum & Mata Kuliah</h5>
                    <p>
                        Manajemen distribusi mata kuliah berdasar struktur kurikulum program studi, semester, beserta bobot SKS terkait.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <div class="feature-icon-wrapper">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <h5>Evaluasi & Transkrip Nilai</h5>
                    <p>
                        Kalkulasi nilai akhir semester otomatis, pencetakan KHS, pemantauan indeks prestasi (IPK), hingga lembar transkrip resmi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-center">
    <div class="container">
        © {{ date('Y') }} SIAKAD - Sistem Informasi Akademik. Seluruh Hak Cipta Dilindungi.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>