<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Nilai Akademik Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Arial, sans-serif;
            overflow-x: hidden;
        }

        /* ================= TOPBAR ================= */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 65px;
            background: linear-gradient(135deg, #0b1f3a 0%, #1c2b3a 100%);
            border-bottom: 2px solid rgba(14, 165, 233, 0.2);
            display: flex;
            align-items: center;
            padding: 0 24px;
            z-index: 1400;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Saat sidebar terbuka di desktop, topbar bergeser */
        .topbar.shifted {
            left: 275px;
        }

        .topbar-title {
            font-weight: 700;
            color: #ffffff;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        .topbar-title i {
            margin-right: 10px;
            color: #0ea5e9;
        }

        .toggle-btn {
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            color: white;
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-right: 14px;
            transition: all 0.3s ease;
            font-size: 18px;
            flex-shrink: 0;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: scale(1.05);
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 275px;
            height: 100vh;
            background: linear-gradient(180deg, #1c2b3a 0%, #0f1e2e 100%);
            color: white;
            padding: 80px 16px 20px 16px;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1300;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(14, 165, 233, 0.4);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(14, 165, 233, 0.6);
        }

        /* User Profile Card in Sidebar */
        .sidebar-user-card {
            background: rgba(14, 165, 233, 0.1);
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }

        .sidebar-user-card:hover {
            background: rgba(14, 165, 233, 0.18);
        }

        .sidebar-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
            font-weight: 600;
        }

        .sidebar-user-name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            line-height: 1.3;
        }

        .sidebar-user-email {
            font-size: 11px;
            opacity: 0.6;
            color: #93c5fd;
            line-height: 1.2;
        }

        /* Brand */
        .sidebar .brand {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 25px;
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 0 8px 12px 8px;
            border-bottom: 2px solid rgba(14, 165, 233, 0.2);
            letter-spacing: 0.5px;
        }

        .sidebar .brand i {
            color: #0ea5e9;
            margin-right: 8px;
        }

        /* Sidebar Sections */
        .sidebar-section {
            margin-bottom: 20px;
        }

        .sidebar-section-title {
            font-size: 10px;
            text-transform: uppercase;
            opacity: 0.5;
            margin-bottom: 8px;
            padding: 0 10px;
            letter-spacing: 1.2px;
            font-weight: 600;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 3px;
            font-size: 13px;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar a i {
            width: 20px;
            text-align: center;
            font-size: 15px;
            flex-shrink: 0;
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            transform: translateX(4px);
        }

        .sidebar a:hover i {
            color: #0ea5e9;
        }

        .sidebar a.active {
            background: rgba(14, 165, 233, 0.2);
            color: #ffffff;
            border-left: 3px solid #0ea5e9;
            padding-left: 11px;
        }

        .sidebar a.active i {
            color: #0ea5e9;
        }

        .sidebar a.logout-link {
            color: rgba(239, 68, 68, 0.7);
            margin-top: 5px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 14px;
        }

        .sidebar a.logout-link:hover {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }

        .sidebar a.logout-link i {
            color: rgba(239, 68, 68, 0.5);
        }

        .sidebar a.logout-link:hover i {
            color: #ef4444;
        }

        /* ================= CONTENT AREA ================= */
        .content-area {
            padding: 90px 30px 30px 30px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            margin-left: 0;
            width: 100%;
        }

        /* Saat sidebar terbuka di desktop, content bergeser */
        .content-area.shifted {
            margin-left: 275px;
            width: calc(100% - 275px);
        }

        /* ================= OVERLAY ================= */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1250;
            backdrop-filter: blur(4px);
            cursor: pointer;
        }

        .overlay.show {
            display: block;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .topbar {
                padding: 0 16px;
                height: 60px;
                left: 0 !important;
            }

            .topbar.shifted {
                left: 0 !important;
            }

            .topbar-title {
                font-size: 0.85rem;
            }

            .topbar-title span {
                display: none;
            }

            .topbar-title i {
                display: inline-block;
            }

            .content-area {
                padding: 80px 16px 20px 16px;
                margin-left: 0 !important;
                width: 100% !important;
            }

            .content-area.shifted {
                margin-left: 0 !important;
                width: 100% !important;
            }

            .sidebar {
                width: 280px;
                padding: 75px 14px 20px 14px;
            }
        }

        @media (max-width: 576px) {
            .topbar-title {
                font-size: 0.75rem;
            }

            .toggle-btn {
                width: 36px;
                height: 36px;
                font-size: 15px;
                margin-right: 10px;
            }
        }

        /* ================= ANIMATIONS ================= */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-area {
            animation: fadeInUp 0.4s ease;
        }

        .card-custom {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <!-- ============ OVERLAY ============ -->
    <div id="sidebarOverlay" class="overlay"></div>

    <!-- ============ TOPBAR ============ -->
    <div class="topbar" id="topbar">
        <button class="toggle-btn" type="button" id="toggleBtn">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="topbar-title">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Sistem Nilai Akademik Mahasiswa</span>
        </div>
    </div>

    <!-- ============ SIDEBAR ============ -->
    <aside id="sidebarMenu" class="sidebar">

        @auth
            <!-- User Card -->
            <div class="sidebar-user-card">
                <div class="sidebar-avatar">
                    {{ strtoupper(substr(optional(Auth::user())->name ?? 'G', 0, 1)) }}
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div class="sidebar-user-name">
                        {{ optional(Auth::user())->name ?? 'Guest' }}
                    </div>
                    <div class="sidebar-user-email">
                        {{ optional(Auth::user())->email ?? '' }}
                    </div>
                </div>
            </div>

            <!-- Brand -->
            <a href="/dashboard" class="brand">
                <i class="fa-solid fa-layer-group"></i>
                KELOLA AKADEMIK
            </a>

            <!-- Menu Utama -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">Menu Utama</div>
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </div>

            <!-- Kelola Data -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">Kelola Data</div>
                <a href="/mahasiswa" class="{{ request()->is('mahasiswa*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    Mahasiswa
                </a>
                <a href="/mata-kuliah" class="{{ request()->is('mata-kuliah*') ? 'active' : '' }}">
                    <i class="fa-solid fa-book-open"></i>
                    Mata Kuliah
                </a>
            </div>

            <!-- Manajemen Nilai -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">Manajemen Nilai</div>

                <a href="{{ route('nilai.create') }}" class="{{ request()->routeIs('nilai.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Input Nilai
                </a>

                <a href="{{ route('nilai.index') }}" class="{{ request()->routeIs('nilai.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-alt"></i>
                    Laporan Nilai
                </a>

                <a href="{{ route('transkrip.index') }}">
                    <i class="fa-solid fa-file-pdf"></i>
                    Transkrip Nilai
                </a>

                <a href="#">
                    <i class="fa-solid fa-bell"></i>
                    Kelola Notifikasi
                </a>
            </div>

            <!-- Akun -->
            <div class="sidebar-section">
                <div class="sidebar-section-title">Akun</div>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">
                    <i class="fa-solid fa-circle-user"></i>
                    Profil
                </a>
                <a href="/logout" class="logout-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </div>

        @endauth

        @guest
            <div class="sidebar-section">
                <div class="sidebar-section-title">Akses</div>
                <a href="/login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login
                </a>
            </div>
        @endguest

    </aside>

    <!-- ============ CONTENT ============ -->
    <main id="mainContent" class="content-area">
        @yield('content')
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const sidebar = document.getElementById('sidebarMenu');
            const toggleBtn = document.getElementById('toggleBtn');
            const mainContent = document.getElementById('mainContent');
            const topbar = document.getElementById('topbar');
            const overlay = document.getElementById('sidebarOverlay');

            // ===============================
            // Fungsi untuk update state sidebar
            // ===============================
            function updateSidebarState(isOpen) {
                const isDesktop = window.innerWidth > 768;

                if (isOpen) {
                    sidebar.classList.add('open');

                    if (isDesktop) {
                        mainContent.classList.add('shifted');
                        topbar.classList.add('shifted');
                        overlay.classList.remove('show');
                    } else {
                        overlay.classList.add('show');
                        mainContent.classList.remove('shifted');
                        topbar.classList.remove('shifted');
                    }
                } else {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('show');
                    mainContent.classList.remove('shifted');
                    topbar.classList.remove('shifted');
                }
            }

            // ===============================
            // Toggle Sidebar
            // ===============================
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = !sidebar.classList.contains('open');
                updateSidebarState(isOpen);
            });

            // ===============================
            // Klik Overlay (di luar sidebar di mobile)
            // ===============================
            overlay.addEventListener('click', function() {
                updateSidebarState(false);
            });

            // ===============================
            // Klik di luar Sidebar (sensitive click)
            // ===============================
            document.addEventListener('click', function(e) {
                if (
                    sidebar.classList.contains('open') &&
                    !sidebar.contains(e.target) &&
                    !toggleBtn.contains(e.target)
                ) {
                    updateSidebarState(false);
                }
            });

            // ===============================
            // Resize Browser
            // ===============================
            let resizeTimeout;

            function handleResize() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    const isDesktop = window.innerWidth > 768;

                    if (isDesktop) {
                        // Di desktop, sidebar selalu terbuka
                        updateSidebarState(true);
                    } else {
                        // Di mobile, sidebar tertutup
                        updateSidebarState(false);
                    }
                }, 150);
            }

            window.addEventListener('resize', handleResize);

            // ===============================
            // Inisialisasi pertama kali halaman dibuka
            // ===============================
            // Cek lebar layar pertama kali
            const isDesktop = window.innerWidth > 768;
            if (isDesktop) {
                updateSidebarState(true);
            } else {
                updateSidebarState(false);
            }

        });
    </script>

</body>

</html>