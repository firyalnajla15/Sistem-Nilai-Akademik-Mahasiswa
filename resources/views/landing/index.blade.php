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
        /* Mengaktifkan efek scroll halus saat link navbar diklik */
        html {
            scroll-behavior: smooth;
        }

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

        .btn-login-nav:hover,
        .btn-login-nav:focus {
            background: #0369a1 !important;
            transform: translateY(-1px);
        }

        /* ================= HERO SECTION ================= */
        .hero {
            height: 91vh;
            background: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.20);
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-content {
            max-width: 500px;
            margin-left: 20px;
        }

        .hero-content h1 {
            color: white;
            font-size: 4rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 25px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, .3);
        }

        .hero-subtitle {
            color: #ffffff;
            font-size: 1.2rem;
            max-width: 600px;
            margin-top: 15px;
            line-height: 1.8;
            text-shadow: 0 2px 8px rgba(0, 0, 0, .4);
        }

        .search-box {
            width: 420px;
            background: white;
            display: flex;
            overflow: hidden;
            border-radius: 3px;
        }

        .search-box input {
            flex: 1;
            border: none;
            padding: 12px 15px;
            outline: none;
        }

        .search-box button {
            width: 55px;
            border: none;
            background: white;
            color: #666;
        }

        .search-box button:hover {
            background: #f8f9fa;
        }

        @media(max-width:768px) {

            .hero-content h1 {
                font-size: 2.7rem;
            }

            .search-box {
                width: 100%;
            }

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

        /* ================= TENTANG SECTION ================= */
        .about-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .about-icon {
            font-size: 2.5rem;
            color: #0284c7;
            margin-bottom: 15px;
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

        /* ================= TOMBOL BALIK KE ATAS (BACK TO TOP) ================= */
        .back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 99;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            background-color: #0284c7 !important;
            border: none !important;
            color: white !important;
        }

        .back-to-top:hover {
            background-color: #0369a1 !important;
            transform: translateY(-3px);
        }

        /* ================= FOOTER ================= */
        footer {
            background: #0f172a !important;
            color: #64748b !important;
            font-size: 0.9rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 10px 0 !important;
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
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <span style="font-size: 1.5rem;">🎓</span> Sistem Nilai Akademik Mahasiswa
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
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
                        <a class="btn btn-primary btn-login-nav dropdown-toggle" href="#" role="button"
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
        <div class="container">

            <div class="hero-content">

                <h1>
                    Welcome to <br>
                    Politeknik Negeri Padang
                </h1>

                <p class="hero-subtitle">
                    Kelola dan pantau perkembangan akademik Anda dalam satu platform terintegrasi.
                </p>

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

    <section id="tentang" class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="text-primary fw-bold text-uppercase tracking-wider" style="font-size: 0.85rem;">Profil
                        Sistem</span>
                    <h2 class="fw-bold text-dark display-6 mt-2 mb-4">Mengenai SIAKAD</h2>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Sistem Informasi Akademik (SIAKAD) merupakan platform tata kelola administrasi pendidikan yang
                        dirancang khusus untuk memfasilitasi kebutuhan seluruh sivitas akademika. Dengan mengedepankan
                        efisiensi, transparansi, dan kecepatan akses data guna mendukung kelancaran proses belajar
                        mengajar.
                    </p>
                    <div class="row g-4 mt-2">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-primary fs-4 mt-1"><i class="fa-solid fa-circle-check"></i></div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Akses 24/7</h6>
                                    <p class="text-muted small mb-0">Sistem dapat diakses kapan saja dan dari mana saja.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-primary fs-4 mt-1"><i class="fa-solid fa-shield-halved"></i></div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Keamanan Data</h6>
                                    <p class="text-muted small mb-0">Data nilai dan profil mahasiswa tersimpan aman
                                        dalam server.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 about-card">
                        <div class="row text-center g-4">
                            <div class="col-6">
                                <div class="about-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                                <h3 class="fw-bold text-dark mb-1">Aktif</h3>
                                <p class="text-muted small mb-0">Integrasi Data Mahasiswa</p>
                            </div>
                            <div class="col-6">
                                <div class="about-icon"><i class="fa-solid fa-book"></i></div>
                                <h3 class="fw-bold text-dark mb-1">Terstruktur</h3>
                                <p class="text-muted small mb-0">Kurikulum Program Studi</p>
                            </div>
                            <div class="col-6">
                                <div class="about-icon"><i class="fa-solid fa-chart-line"></i></div>
                                <h3 class="fw-bold text-dark mb-1">Otomatis</h3>
                                <p class="text-muted small mb-0">Kalkulasi IPK & Transkrip</p>
                            </div>
                            <div class="col-6">
                                <div class="about-icon"><i class="fa-solid fa-network-wired"></i></div>
                                <h3 class="fw-bold text-dark mb-1">Real-Time</h3>
                                <p class="text-muted small mb-0">Sinkronisasi Basis Data</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-5 bg-opacity-10 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title fs-1">Layanan Akademik</h2>
                <p class="text-muted">Modul aplikasi utama penunjang manajemen data dan aktivitas operasional akademik
                    perguruan tinggi</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card p-4">
                        <div class="feature-icon-wrapper">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h5>Biodata & Status Mahasiswa</h5>
                        <p>
                            Pusat penyimpanan informasi data induk mahasiswa, riwayat registrasi, serta pengelolaan
                            status keaktifan akademik.
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
                            Manajemen distribusi mata kuliah berdasar struktur kurikulum program studi, semester,
                            beserta bobot SKS terkait.
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
                            Kalkulasi nilai akhir semester otomatis, pencetakan KHS, pemantauan indeks prestasi (IPK),
                            hingga lembar transkrip resmi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a href="#" class="btn back-to-top" title="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </a>

    <footer class="text-center">
        <div class="container">
            © {{ date('Y') }} SIAKAD - Sistem Informasi Akademik. Seluruh Hak Cipta Dilindungi.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
