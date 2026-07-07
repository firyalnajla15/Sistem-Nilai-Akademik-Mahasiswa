<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Nilai Akademik Mahasiswa</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== ROOT VARIABLES ===== */
        :root {
            --bg-body: #f5f8fc;
            --bg-white: #ffffff;
            --bg-card: #f8fafc;
            --bg-navbar: rgba(255, 255, 255, 0.92);
            --bg-dropdown: #ffffff;
            --text-primary: #1a2a3a;
            --text-secondary: #4a6a84;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --shadow-color: rgba(0, 0, 0, 0.04);
            --shadow-hover: rgba(0, 0, 0, 0.06);
            --hero-overlay: rgba(15, 23, 42, 0.85);
            --hero-overlay2: rgba(26, 58, 92, 0.75);
            --info-bar-bg: #0f172a;
            --footer-bg: #0f172a;
            --btn-login-bg: #1a3a5c;
            --btn-login-hover: #2a5a7a;
            --icon-bg: #eff6ff;
            --icon-color: #1a3a5c;
            --transition: 0.3s ease;
        }

        /* ===== DARK THEME ===== */
        [data-theme="dark"] {
            --bg-body: #0f172a;
            --bg-white: #1a2332;
            --bg-card: #1e2a3d;
            --bg-navbar: rgba(15, 23, 42, 0.92);
            --bg-dropdown: #1a2332;
            --text-primary: #e8edf3;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --border-color: #2a3a55;
            --shadow-color: rgba(0, 0, 0, 0.2);
            --shadow-hover: rgba(0, 0, 0, 0.3);
            --hero-overlay: rgba(15, 23, 42, 0.92);
            --hero-overlay2: rgba(26, 58, 92, 0.85);
            --info-bar-bg: #0a0f1a;
            --footer-bg: #0a0f1a;
            --btn-login-bg: #2a5a7a;
            --btn-login-hover: #3a7a9a;
            --icon-bg: #1a2a3a;
            --icon-color: #38bdf8;
        }

        /* ===== GLOBAL ===== */
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
            color: var(--text-primary);
            background: var(--bg-body);
            transition: background var(--transition), color var(--transition);
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: var(--bg-navbar) !important;
            padding: 12px 0;
            box-shadow: 0 1px 3px var(--shadow-color);
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(12px);
            transition: background var(--transition), border-color var(--transition);
        }

        .navbar-brand {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary) !important;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color var(--transition);
        }

        .navbar-brand i {
            color: var(--text-primary);
            font-size: 1.2rem;
            transition: color var(--transition);
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            font-size: 0.9rem;
            transition: 0.2s;
            padding: 6px 16px !important;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: var(--text-primary) !important;
            background: rgba(26, 58, 92, 0.06);
        }

        [data-theme="dark"] .nav-link:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .btn-login-nav {
            background: var(--btn-login-bg);
            border: none;
            color: white !important;
            padding: 8px 22px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login-nav:hover {
            background: var(--btn-login-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(26, 58, 92, 0.15);
            color: white !important;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 6px;
            box-shadow: 0 8px 30px var(--shadow-color);
            background: var(--bg-dropdown);
            transition: background var(--transition), border-color var(--transition);
        }

        .dropdown-item {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-primary);
            transition: background 0.2s, color 0.2s;
        }

        .dropdown-item:hover {
            background: var(--bg-card);
            color: var(--text-primary);
        }

        .dropdown-item i {
            width: 20px;
            color: var(--text-secondary);
        }

        /* ===== THEME TOGGLE ===== */
        .theme-toggle {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all var(--transition);
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .theme-toggle:hover {
            border-color: var(--text-secondary);
        }

        .theme-toggle i {
            font-size: 0.9rem;
        }

        .theme-toggle .toggle-track {
            width: 36px;
            height: 20px;
            background: var(--border-color);
            border-radius: 50px;
            position: relative;
            transition: background var(--transition);
        }

        .theme-toggle .toggle-track .toggle-thumb {
            width: 16px;
            height: 16px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform var(--transition), background var(--transition);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
        }

        [data-theme="dark"] .theme-toggle .toggle-track {
            background: #38bdf8;
        }

        [data-theme="dark"] .theme-toggle .toggle-track .toggle-thumb {
            transform: translateX(16px);
            background: #0f172a;
        }

        /* ================= HERO ================= */
        .hero {
            min-height: 100vh;
            background:
                linear-gradient(135deg, var(--hero-overlay) 0%, var(--hero-overlay2) 100%),
                url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            padding: 100px 0 60px;
            position: relative;
            transition: background var(--transition);
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            color: white;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .hero h1 span {
            color: #38bdf8;
        }

        .hero p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1.1rem;
            max-width: 500px;
            line-height: 1.8;
            margin-bottom: 28px;
        }

        .btn-hero {
            background: white;
            color: #1a3a5c !important;
            font-weight: 600;
            padding: 14px 34px;
            border-radius: 50px;
            border: none;
            font-size: 1rem;
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            color: #1a3a5c !important;
        }

        .btn-hero i {
            color: #1a3a5c;
        }

        .hero-image {
            background: rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            backdrop-filter: blur(4px);
            transition: background var(--transition), border-color var(--transition);
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
                padding: 110px 0 50px;
                background-attachment: scroll;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 0.95rem;
                max-width: 100%;
            }

            .hero-image {
                margin-top: 30px;
                padding: 25px;
            }
        }

        /* ================= INFO BAR ================= */
        .info-bar {
            background: var(--info-bar-bg);
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background var(--transition);
        }

        .info-bar .info-item {
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 400;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .info-bar .info-item i {
            color: #38bdf8;
            width: 18px;
        }

        @media (max-width: 768px) {
            .info-bar .info-item {
                font-size: 0.75rem;
                justify-content: center;
                padding: 2px 0;
            }
        }

        /* ================= SECTION ================= */
        .section-title {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 2rem;
            margin-bottom: 6px;
            transition: color var(--transition);
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.05rem;
            transition: color var(--transition);
        }

        /* ================= TENTANG ================= */
        #tentang {
            background: var(--bg-white);
            padding: 70px 0 60px;
            transition: background var(--transition);
        }

        .about-text {
            color: var(--text-secondary);
            line-height: 1.8;
            font-size: 1rem;
            transition: color var(--transition);
        }

        .about-card {
            background: var(--bg-card);
            border-radius: 14px;
            padding: 30px;
            border: 1px solid var(--border-color);
            transition: background var(--transition), border-color var(--transition);
        }

        .about-card .item {
            text-align: center;
            padding: 12px 8px;
        }

        .about-card .item i {
            font-size: 2rem;
            color: var(--icon-color);
            margin-bottom: 8px;
            display: block;
            transition: color var(--transition);
        }

        .about-card .item h6 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
            transition: color var(--transition);
        }

        .about-card .item small {
            color: var(--text-muted);
            transition: color var(--transition);
        }

        .check-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .check-item i {
            color: var(--icon-color);
            font-size: 1.2rem;
            margin-top: 2px;
            transition: color var(--transition);
        }

        .check-item h6 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
            transition: color var(--transition);
        }

        .check-item p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 0;
            transition: color var(--transition);
        }

        /* ================= LAYANAN AKADEMIK ================= */
        #layanan {
            background: var(--bg-body);
            padding: 60px 0 70px;
            transition: background var(--transition);
        }

        .layanan-card {
            background: var(--bg-white);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 28px 24px;
            height: 100%;
            transition: all var(--transition);
            box-shadow: 0 1px 4px var(--shadow-color);
        }

        .layanan-card:hover {
            transform: translateY(-4px);
            border-color: #b3d4fc;
            box-shadow: 0 8px 30px var(--shadow-hover);
        }

        [data-theme="dark"] .layanan-card:hover {
            border-color: #2a5a7a;
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
            background: var(--icon-bg);
            color: var(--icon-color);
            transition: background var(--transition), color var(--transition);
        }

        .layanan-card:nth-child(2) .layanan-icon {
            background: #f0fdf4;
            color: #16a34a;
        }

        [data-theme="dark"] .layanan-card:nth-child(2) .layanan-icon {
            background: #1a2a3a;
            color: #22c55e;
        }

        .layanan-card:nth-child(3) .layanan-icon {
            background: #faf5ff;
            color: #9333ea;
        }

        [data-theme="dark"] .layanan-card:nth-child(3) .layanan-icon {
            background: #1a2a3a;
            color: #a855f7;
        }

        .layanan-card h5 {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1.05rem;
            margin-bottom: 8px;
            transition: color var(--transition);
        }

        .layanan-card p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 0;
            transition: color var(--transition);
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
            background: var(--btn-login-bg);
            border: none;
            color: white;
            box-shadow: 0 2px 12px var(--shadow-color);
            transition: all var(--transition);
            text-decoration: none;
        }

        .back-to-top:hover {
            background: var(--btn-login-hover);
            transform: translateY(-3px);
            color: white;
        }

        /* ================= FOOTER ================= */
        footer {
            background: var(--footer-bg);
            color: #94a3b8;
            padding: 18px 0;
            text-align: center;
            font-size: 0.85rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            transition: background var(--transition);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .theme-toggle {
                margin: 8px 0;
            }
        }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
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
                    <li class="nav-item ms-2">
                        <div class="theme-toggle" id="themeToggle" title="Toggle tema">
                            <i class="fa-regular fa-sun" id="themeIcon"></i>
                            <div class="toggle-track">
                                <div class="toggle-thumb"></div>
                            </div>
                        </div>
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
        // ===== THEME TOGGLE =====
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        updateIcon(savedTheme);

        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'fa-regular fa-moon';
            } else {
                themeIcon.className = 'fa-regular fa-sun';
            }
        }

        // ===== BACK TO TOP =====
        document.querySelector('.back-to-top').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // ===== NAVBAR SCROLL EFFECT =====
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 20) {
                navbar.style.boxShadow = '0 4px 20px var(--shadow-color)';
            } else {
                navbar.style.boxShadow = '0 1px 3px var(--shadow-color)';
            }
        });
    </script>

</body>

</html>