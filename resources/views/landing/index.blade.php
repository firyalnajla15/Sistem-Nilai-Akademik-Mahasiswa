<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Nilai Akademik Mahasiswa</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #334155;
            background: #f8fafc;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: rgba(15, 23, 42, 0.92) !important;
            padding: 14px 0;
            border-bottom: 2px solid rgba(56, 189, 248, 0.15);
            backdrop-filter: blur(8px);
        }

        .navbar-brand {
            font-size: 1.05rem;
            font-weight: 700;
            color: white !important;
        }

        .navbar-brand i {
            color: #38bdf8;
            margin-right: 10px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .nav-link:hover {
            color: #38bdf8 !important;
        }

        .btn-login-nav {
            background: #0284c7;
            border: none;
            color: white !important;
            padding: 8px 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .btn-login-nav:hover {
            background: #0369a1 !important;
        }

        .dropdown-menu {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .dropdown-item {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
        }

        .dropdown-item i {
            width: 20px;
            color: #64748b;
        }

        /* ================= HERO ================= */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 41, 59, 0.75) 100%),
                        url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            padding: 80px 0 50px;
            position: relative;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            color: white;
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .hero h1 span {
            color: #38bdf8;
        }

        .hero p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.15rem;
            max-width: 500px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .btn-hero {
            background: white;
            color: #0f172a !important;
            font-weight: 600;
            padding: 13px 34px;
            border-radius: 10px;
            border: none;
            font-size: 1rem;
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            display: inline-block;
        }

        .btn-hero:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-hero i {
            margin-right: 8px;
        }

        .hero-image {
            background: rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            backdrop-filter: blur(4px);
        }

        .hero-image i {
            font-size: 4rem;
            color: #38bdf8;
            opacity: 0.7;
        }

        .hero-image p {
            color: rgba(255, 255, 255, 0.5);
            margin-top: 12px;
            font-size: 0.9rem;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .hero {
                min-height: 100vh;
                padding: 90px 0 40px;
                background-attachment: scroll;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
                max-width: 100%;
            }

            .hero-image {
                margin-top: 30px;
                padding: 25px;
            }
        }

        /* ================= INFO BAR ================= */
        .info-bar {
            background: #0f172a;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .info-bar .info-item {
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 400;
        }

        .info-bar .info-item i {
            color: #38bdf8;
            margin-right: 8px;
            width: 18px;
        }

        /* ================= SECTION ================= */
        .section-title {
            font-weight: 700;
            color: #0f172a;
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .section-subtitle {
            color: #64748b;
            font-size: 1.05rem;
        }

        /* ================= TENTANG ================= */
        #tentang {
            background: white;
            padding: 70px 0 50px;
        }

        .about-text {
            color: #475569;
            line-height: 1.8;
            font-size: 1rem;
        }

        .about-card {
            background: #f8fafc;
            border-radius: 14px;
            padding: 30px;
            border: 1px solid #e2e8f0;
        }

        .about-card .item {
            text-align: center;
            padding: 15px 10px;
        }

        .about-card .item i {
            font-size: 2rem;
            color: #0284c7;
            margin-bottom: 8px;
            display: block;
        }

        .about-card .item h6 {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .about-card .item small {
            color: #64748b;
        }

        .check-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .check-item i {
            color: #0284c7;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .check-item h6 {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .check-item p {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* ================= LAYANAN AKADEMIK (BARU) ================= */
        #layanan {
            background: #f8fafc;
            padding: 60px 0 70px;
        }

        .layanan-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 28px 24px;
            height: 100%;
            transition: 0.3s;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.02);
        }

        .layanan-card:hover {
            transform: translateY(-4px);
            border-color: #b3d4fc;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        .layanan-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
            background: #eff6ff;
            color: #0284c7;
        }

        .layanan-card:nth-child(2) .layanan-icon {
            background: #f0fdf4;
            color: #16a34a;
        }

        .layanan-card:nth-child(3) .layanan-icon {
            background: #faf5ff;
            color: #9333ea;
        }

        .layanan-card h5 {
            font-weight: 600;
            color: #0f172a;
            font-size: 1.05rem;
            margin-bottom: 8px;
        }

        .layanan-card p {
            color: #64748b;
            font-size: 0.92rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* ================= BACK TO TOP ================= */
        .back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 99;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            border: none;
            color: white;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            transition: 0.3s;
        }

        .back-to-top:hover {
            background: #0284c7;
            transform: translateY(-3px);
        }

        /* ================= FOOTER ================= */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 18px 0;
            text-align: center;
            font-size: 0.85rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-graduation-cap"></i>
                Sistem Nilai Akademik Mahasiswa
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item dropdown ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-login-nav dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/login">
                                    <i class="fa-solid fa-user-tie"></i> Portal Admin & Dosen
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/login-mahasiswa">
                                    <i class="fa-solid fa-graduation-cap"></i> Portal Mahasiswa
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ================= HERO ================= -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>Politeknik <span>Negeri</span> Padang</h1>
                    <p>Sistem Informasi Akademik untuk mengelola data nilai, mahasiswa, dan transkrip secara terintegrasi.</p>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="hero-image">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <p>SIAKAD - Terintegrasi & Real-Time</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= INFO BAR ================= -->
    <div class="info-bar">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-4 info-item">
                    <i class="fa-solid fa-location-dot"></i> Politeknik Negeri Padang
                </div>
                <div class="col-md-4 info-item">
                    <i class="fa-solid fa-phone"></i> (0751) 72590
                </div>
                <div class="col-md-4 info-item">
                    <i class="fa-solid fa-envelope"></i> www.pnp.ac.id
                </div>
            </div>
        </div>
    </div>

    <!-- ================= TENTANG ================= -->
    <section id="tentang">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <h2 class="section-title">Tentang SIAKAD</h2>
                    <p class="section-subtitle mb-3">Platform terpadu untuk administrasi akademik</p>
                    <p class="about-text">
                        Sistem Informasi Akademik (SIAKAD) dirancang untuk memudahkan pengelolaan data mahasiswa, 
                        mata kuliah, nilai, dan transkrip dalam satu platform yang terintegrasi.
                    </p>

                    <div class="mt-4">
                        <div class="check-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <h6>Akses 24/7</h6>
                                <p>Dapat diakses kapan saja dari perangkat apapun</p>
                            </div>
                        </div>
                        <div class="check-item">
                            <i class="fa-solid fa-shield-halved"></i>
                            <div>
                                <h6>Keamanan Data</h6>
                                <p>Data nilai dan profil mahasiswa terlindungi dengan baik</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-card">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="item">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <h6>Aktif</h6>
                                    <small>Data Mahasiswa</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item">
                                    <i class="fa-solid fa-book"></i>
                                    <h6>Terstruktur</h6>
                                    <small>Kurikulum</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <h6>Otomatis</h6>
                                    <small>Kalkulasi IPK</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item">
                                    <i class="fa-solid fa-database"></i>
                                    <h6>Real-Time</h6>
                                    <small>Sinkronisasi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= LAYANAN AKADEMIK ================= -->
    <section id="layanan">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Layanan Akademik</h2>
                <p class="section-subtitle">Modul utama untuk manajemen data akademik</p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="layanan-card">
                        <div class="layanan-icon"><i class="fa-solid fa-users"></i></div>
                        <h5>Data Mahasiswa</h5>
                        <p>Kelola biodata, status, dan riwayat registrasi mahasiswa dengan mudah.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="layanan-card">
                        <div class="layanan-icon"><i class="fa-solid fa-book-bookmark"></i></div>
                        <h5>Kurikulum & Matkul</h5>
                        <p>Manajemen mata kuliah, SKS, dan struktur kurikulum program studi.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="layanan-card">
                        <div class="layanan-icon"><i class="fa-solid fa-file-invoice"></i></div>
                        <h5>Nilai & Transkrip</h5>
                        <p>Input nilai, hitung IPK, dan cetak transkrip nilai secara otomatis.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= BACK TO TOP ================= -->
    <a href="#" class="back-to-top" title="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </a>

    <!-- ================= FOOTER ================= -->
    <footer>
        <div class="container">
            &copy; {{ date('Y') }} Sistem Nilai Akademik Mahasiswa. All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Back to top smooth
        document.querySelector('.back-to-top').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

</body>

</html>