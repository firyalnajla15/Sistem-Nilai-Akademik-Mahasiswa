<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Nilai Akademik Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* ================= NAVY TOPBAR ================= */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;

            background: #0b1f3a;
            /* NAVY */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);

            display: flex;
            align-items: center;
            padding: 0 16px;
            z-index: 1400;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .topbar-title {
            font-weight: 700;
            color: #ffffff;
            font-size: 1rem;
        }

        .toggle-btn {
            border: none;
            border-radius: 8px;
            background: #142d52;
            color: white;
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-right: 12px;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #1c2b3a;
            color: white;

            padding: 80px 15px 20px 15px;

            position: fixed;
            left: 0;
            top: 0;

            overflow-y: auto;
            transform: translateX(-100%);
            transition: 0.25s ease;
            z-index: 1300;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar .brand {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 25px;
            display: block;
            color: #fff;
            text-decoration: none;
            padding-left: 6px;
        }

        .sidebar-section {
            margin-bottom: 18px;
        }

        .sidebar-section-title {
            font-size: 10px;
            text-transform: uppercase;
            opacity: 0.6;
            margin-bottom: 8px;
            padding-left: 8px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;

            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 5px;
            font-size: 13px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* ================= PUSH LAYOUT ================= */
        .content-area {
            padding: 90px 25px 25px 25px;
            transition: margin-left 0.25s ease;
        }

        body.sidebar-open .content-area {
            margin-left: 260px;
        }

        body.sidebar-open .topbar {
            margin-left: 260px;
            transition: 0.25s ease;
        }

        /* overlay */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            display: none;
            z-index: 1250;
        }

        .overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            body.sidebar-open .content-area {
                margin-left: 0;
            }

            body.sidebar-open .topbar {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <div id="sidebarOverlay" class="overlay" onclick="toggleSidebar()"></div>

    <div class="topbar">
        <button class="toggle-btn" type="button" onclick="toggleSidebar()">☰</button>
        <div class="topbar-title">Sistem Nilai Akademik Mahasiswa</div>
    </div>

    <aside id="sidebarMenu" class="sidebar">

        @auth
        <div style="
            background: rgba(255,255,255,0.08);
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        ">

            <div style="
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background: rgba(255,255,255,0.15);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                color: white;
            ">
                <i class="fa-solid fa-user"></i>
            </div>

            <div style="line-height: 1.2;">
                <div style="font-size: 13px; font-weight: 600; color: #fff;">
                    {{ optional(Auth::user())->name ?? 'Guest' }}
                </div>

                <div style="font-size: 11px; opacity: 0.7; color: #fff;">
                    {{ optional(Auth::user())->email ?? '' }}
                </div>
            </div>

        </div>
        @endauth
        
        <a href="/dashboard" class="brand">KELOLA AKADEMIK</a>

        <div class="sidebar-section">
            <div class="sidebar-section-title">Menu Utama</div>
            <a href="/dashboard" class="{{ request()->is('/') || request()->is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </div>

        @auth
        <div class="sidebar-section">
            <div class="sidebar-section-title">Kelola Data</div>
            <a href="/mahasiswa" class="{{ request()->is('mahasiswa') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                Mahasiswa
            </a>

            <a href="/mata-kuliah" class="{{ request()->is('mata-kuliah*') ? 'active' : '' }}">
                <i class="fa-solid fa-book"></i>
                Mata Kuliah
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-title">Manajemen Nilai</div>
            <a href="/nilai-mahasiswa">
                <i class="fa-solid fa-pen-to-square"></i>
                Input Nilai
            </a>

            <a href="#">
                <i class="fa-solid fa-file-lines"></i>
                Laporan Nilai
            </a>

            <a href="#">
                <i class="fa-solid fa-bell"></i>
                Kelola Notifikasi
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-title">Akun</div>
            <a href="#">
                <i class="fa-solid fa-circle-user"></i>
                Profil
            </a>

            <a href="/logout">
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

    <main id="mainContent" class="content-area">
        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarMenu');
            const overlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            if (sidebar && overlay) {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
                body.classList.toggle('sidebar-open');
            }
        }
    </script>

</body>

</html>