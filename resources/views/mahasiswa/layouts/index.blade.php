<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            background: #f4f6f9;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #0b1f3a 0%, #1c2b3a 100%);
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.04);
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1300;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(14, 165, 233, 0.3);
            border-radius: 10px;
        }

        /* ========== OVERLAY ========== */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1200;
            display: none;
            backdrop-filter: blur(4px);
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* Brand */
        .brand {
            padding: 20px 18px 16px;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            border-bottom: 2px solid rgba(14, 165, 233, 0.15);
            letter-spacing: 0.5px;
        }

        .brand i {
            margin-right: 10px;
            color: #0ea5e9;
        }

        /* User Profile */
        .user-profile {
            margin: 16px 12px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 14px;
            display: flex;
            gap: 12px;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 17px;
            flex-shrink: 0;
            box-shadow: 0 2px 12px rgba(14, 165, 233, 0.25);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #fff;
        }

        .user-status {
            font-size: 11px;
            color: #93c5fd;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Menu Header */
        .menu-header {
            padding: 16px 20px 6px;
            font-size: 10px;
            opacity: 0.5;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        /* Navigation */
        .sidebar .nav {
            padding: 0 10px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            margin: 1px 0;
            border-radius: 10px;
            padding: 10px 16px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 13px;
            font-weight: 500;
            position: relative;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 15px;
            color: rgba(255, 255, 255, 0.4);
            transition: all 0.25s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            transform: translateX(4px);
        }

        .sidebar .nav-link:hover i {
            color: #0ea5e9;
        }

        .sidebar .nav-link.active {
            background: rgba(14, 165, 233, 0.15);
            color: #ffffff;
            border-left: 3px solid #0ea5e9;
            padding-left: 13px;
        }

        .sidebar .nav-link.active i {
            color: #0ea5e9;
        }

        /* Logout Button */
        .sidebar .btn-logout {
            color: rgba(239, 68, 68, 0.6);
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.25s ease;
            margin: 1px 0;
            cursor: pointer;
        }

        .sidebar .btn-logout i {
            width: 20px;
            text-align: center;
            font-size: 15px;
            color: rgba(239, 68, 68, 0.4);
            transition: all 0.25s ease;
        }

        .sidebar .btn-logout:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            transform: translateX(4px);
        }

        .sidebar .btn-logout:hover i {
            color: #ef4444;
        }

        /* ========== HAMBURGER BUTTON ========== */
        .hamburger-btn {
            display: none;
            position: fixed;
            top: 12px;
            left: 12px;
            z-index: 1400;
            background: #0b1f3a;
            border: none;
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .hamburger-btn:hover {
            background: #1c2b3a;
            transform: scale(1.05);
        }

        /* ========== TOPBAR ========== */
        .topbar {
            margin-left: 260px;
            height: 60px;
            background: linear-gradient(135deg, #0b1f3a, #1a365d);
            color: white;
            display: flex;
            align-items: center;
            padding: 0 25px;
            font-weight: 600;
            font-size: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 2px solid rgba(14, 165, 233, 0.15);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        }

        .topbar i {
            margin-right: 10px;
            color: #0ea5e9;
        }

        /* ========== CONTENT ========== */
        .content {
            margin-left: 260px;
            padding: 25px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .welcome-box {
            background: linear-gradient(135deg, #1c2b3a, #0b1f3a);
            color: white;
            padding: 25px 30px;
            border-radius: 14px;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .welcome-box h5 {
            font-size: 20px;
            font-weight: 700;
        }

        /* ========== CARDS ========== */
        .card {
            border: none;
            border-radius: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .card small {
            color: #6c757d;
            font-size: 13px;
            font-weight: 500;
        }

        .card h3 {
            font-weight: 700;
            color: #1c2b3a;
            margin-top: 5px;
        }

        .card .card-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .bg-soft-primary {
            background: rgba(14, 165, 233, 0.1);
            color: #0ea5e9;
        }

        .bg-soft-success {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .bg-soft-warning {
            background: rgba(234, 179, 8, 0.1);
            color: #eab308;
        }

        .bg-soft-info {
            background: rgba(6, 182, 212, 0.1);
            color: #06b6d4;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .hamburger-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .topbar {
                margin-left: 0;
                padding-left: 70px;
                font-size: 14px;
            }

            .topbar i {
                display: none;
            }

            .content {
                margin-left: 0;
                padding: 80px 15px 15px 15px;
            }

            .sidebar {
                width: 280px;
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar .brand span,
            .sidebar .user-info,
            .sidebar .menu-header,
            .sidebar .nav-link span,
            .sidebar .btn-logout span {
                display: inline;
            }

            .sidebar .nav-link {
                justify-content: flex-start;
                padding: 10px 16px;
            }

            .sidebar .nav-link i {
                font-size: 15px;
                margin: 0;
            }

            .sidebar .nav-link.active {
                border-left: 3px solid #0ea5e9;
                padding-left: 13px;
            }

            .sidebar .btn-logout {
                justify-content: flex-start;
                padding: 10px 16px;
            }

            .sidebar .btn-logout i {
                font-size: 15px;
                margin: 0;
            }
        }

        @media (min-width: 769px) {
            .hamburger-btn {
                display: none !important;
            }

            .sidebar {
                transform: translateX(0) !important;
            }
        }
    </style>
</head>

<body>

    <!-- ========== OVERLAY ========== -->
    <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

    <!-- ========== HAMBURGER BUTTON (Mobile) ========== -->
    <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- ========== SIDEBAR ========== -->
    <aside class="sidebar" id="sidebarMenu">
        <div class="brand">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Portal Student</span>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ strtoupper(substr(session('nama', 'M'), 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="user-name">
                    {{ session('nama') }}
                </div>
                <div class="user-status">
                    NIM : {{ session('nim') }}
                </div>
            </div>
        </div>

        <div class="menu-header">Dashboard</div>
        <ul class="nav flex-column">
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="menu-header">Akademik</div>
        <ul class="nav flex-column">
            <li>
                <a href="{{ route('mahasiswa.krs') }}"
                    class="nav-link {{ request()->routeIs('mahasiswa.krs') ? 'active' : '' }}">
                    <i class="fa-solid fa-book"></i>
                    <span>KRS</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-star"></i>
                    <span>KHS</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Transkrip</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Grafik IPK</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-bell"></i>
                    <span>Notifikasi</span>
                </a>
            </li>
        </ul>

        <div class="menu-header">Akun</div>
        <ul class="nav flex-column">
            <li>
                <a href="{{ route('mahasiswa.profil') }}"
                    class="nav-link {{ request()->routeIs('mahasiswa.profil') ? 'active' : '' }}">
                    <i class="fa-solid fa-user"></i>
                    <span>Profil</span>
                </a>
            </li>
            <li>
                <form action="{{ route('mahasiswa.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- ========== TOPBAR ========== -->
    <div class="topbar">
        <i class="fa-solid fa-graduation-cap"></i>
        Portal Akademik Mahasiswa
    </div>

    <!-- ========== CONTENT ========== -->
    <div class="content" id="mainContent">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('sidebarOverlay');
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mainContent = document.getElementById('mainContent');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        }

        // ====== KLIK DI LUAR SIDEBAR UNTUK MENUTUP ======
        // 1. Klik di overlay
        overlay.addEventListener('click', closeSidebar);

        // 2. Klik di content (area utama)
        mainContent.addEventListener('click', function() {
            if (window.innerWidth <= 768 && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });

        // 3. Klik di tombol hamburger
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });

        // 4. Klik di link sidebar (tutup otomatis di mobile)
        document.querySelectorAll('.sidebar .nav-link, .sidebar .btn-logout').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });

        // 5. Tutup dengan tombol ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });

        // 6. Resize: jika layar membesar, tutup sidebar mobile
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
    </script>

</body>

</html>