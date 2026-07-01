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
            text-decoration: none;
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

        /* Notification badge on nav link */
        .sidebar .nav-link .nav-badge {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: #ef4444;
            color: white;
            font-size: 9px;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        .sidebar .nav-link .nav-badge.empty {
            display: none;
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
            justify-content: space-between;
            padding: 0 25px;
            font-weight: 600;
            font-size: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 2px solid rgba(14, 165, 233, 0.15);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-left i {
            color: #0ea5e9;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* ========== NOTIFICATION BELL IN TOPBAR ========== */
        .notification-bell {
            position: relative;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            padding: 8px 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .notification-bell:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.12);
            transform: scale(1.02);
        }

        .notification-bell i {
            font-size: 20px;
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: white;
            font-size: 9px;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.5);
            animation: pulse-badge 2s infinite;
            border: 2px solid #1a365d;
        }

        .notification-badge.empty {
            display: none;
        }

        @keyframes pulse-badge {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        /* ========== DROPDOWN NOTIFICATION ========== */
        .notification-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: white;
            border-radius: 14px;
            min-width: 420px;
            max-width: 480px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.25);
            display: none;
            z-index: 1500;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .notification-dropdown.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .notification-dropdown-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
        }

        .notification-dropdown-header h6 {
            font-weight: 700;
            color: #1c2b3a;
            margin: 0;
            font-size: 15px;
        }

        .notification-dropdown-header h6 i {
            color: #0ea5e9;
        }

        .notification-dropdown-header .mark-all-read {
            font-size: 12px;
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            padding: 4px 12px;
            border-radius: 6px;
            background: rgba(14, 165, 233, 0.08);
            transition: all 0.2s ease;
        }

        .notification-dropdown-header .mark-all-read:hover {
            background: rgba(14, 165, 233, 0.15);
            text-decoration: none;
        }

        .notification-list {
            max-height: 400px;
            overflow-y: auto;
            padding: 4px 0;
        }

        .notification-list::-webkit-scrollbar {
            width: 5px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .notification-list::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        .notification-item {
            padding: 14px 20px;
            border-bottom: 1px solid #f3f4f6;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .notification-item:hover {
            background: #f9fafb;
        }

        .notification-item.unread {
            background: #eff6ff;
            border-left: 4px solid #0ea5e9;
        }

        .notification-item.unread:hover {
            background: #dbeafe;
        }

        .notification-item-title {
            font-weight: 600;
            color: #1c2b3a;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .notification-item-message {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .notification-item-time {
            color: #9ca3af;
            font-size: 11px;
        }

        .notification-item .badge-jenis {
            font-size: 10px;
            padding: 2px 10px;
            border-radius: 10px;
        }

        .notification-dropdown-footer {
            padding: 12px 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            background: #f8fafc;
        }

        .notification-dropdown-footer a {
            color: #0ea5e9;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .notification-dropdown-footer a:hover {
            text-decoration: none;
            color: #0284c7;
            transform: translateX(4px);
        }

        .notification-empty {
            padding: 50px 20px;
            text-align: center;
        }

        .notification-empty i {
            font-size: 48px;
            color: #d1d5db;
            margin-bottom: 12px;
        }

        .notification-empty p {
            color: #9ca3af;
            font-size: 14px;
            margin: 0;
        }

        /* ========== TOPBAR TITLE ========== */
        .topbar-title {
            font-size: 16px;
            font-weight: 600;
        }

        .topbar-title i {
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
                padding: 0 16px;
                font-size: 14px;
            }

            .topbar-title {
                font-size: 14px;
            }

            .topbar-title i {
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

            .notification-dropdown {
                min-width: 320px;
                max-width: 340px;
                right: -60px;
            }
        }

        @media (max-width: 480px) {
            .notification-dropdown {
                min-width: 290px;
                max-width: 300px;
                right: -80px;
            }

            .notification-item {
                padding: 12px 16px;
            }

            .notification-item-title {
                font-size: 13px;
            }

            .notification-item-message {
                font-size: 12px;
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
                <a href="{{ route('mahasiswa.khs') }}"
                    class="nav-link {{ request()->routeIs('mahasiswa.khs') ? 'active' : '' }}">
                    <i class="fa-solid fa-star"></i>
                    <span>KHS</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.grafik-ipk') }}"
                    class="nav-link {{ request()->routeIs('mahasiswa.grafik-ipk') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Grafik IPK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.notifikasi') }}"
                    class="nav-link {{ request()->routeIs('mahasiswa.notifikasi') ? 'active' : '' }}">
                    <i class="fas fa-bell"></i>
                    <span>Notifikasi</span>
                    <span class="nav-badge {{ $jumlahNotifikasi > 0 ? '' : 'empty' }}">
                        {{ $jumlahNotifikasi > 0 ? $jumlahNotifikasi : '' }}
                    </span>
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
        <div class="topbar-left">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="topbar-title">Portal Akademik Mahasiswa</span>
        </div>
        <div class="topbar-right">
            <!-- Notification Bell -->
            <div class="notification-bell" id="notificationBell" onclick="toggleNotificationDropdown(event)">
                <i class="fas fa-bell"></i>
                <span class="notification-badge {{ $jumlahNotifikasi > 0 ? '' : 'empty' }}" id="notificationBadge">
                    {{ $jumlahNotifikasi > 0 ? $jumlahNotifikasi : '' }}
                </span>

                <!-- Dropdown -->
                <div class="notification-dropdown" id="notificationDropdown">
                    <div class="notification-dropdown-header">
                        <h6>
                            <i class="fas fa-bell me-1"></i>
                            Notifikasi
                        </h6>
                        @if($notifikasiTerbaru->count() > 0)
                            <span class="mark-all-read" onclick="markAllNotificationsRead(event)">
                                <i class="fas fa-check-double me-1"></i>
                                Tandai semua dibaca
                            </span>
                        @endif
                    </div>

                    <div class="notification-list">
                        @forelse($notifikasiTerbaru as $item)
                            <div class="notification-item {{ !$item->dibaca ? 'unread' : '' }}" 
                                 onclick="markNotificationRead({{ $item->id }}, event)">
                                <div>
                                    <div class="notification-item-title">
                                        {{ $item->judul }}
                                        @if(!$item->dibaca)
                                            <span class="badge bg-danger badge-jenis ms-1">Baru</span>
                                        @endif
                                    </div>
                                    <div class="notification-item-message">
                                        {{ $item->pesan }}
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="notification-item-time">
                                            <i class="far fa-clock me-1"></i>
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                        <span class="badge badge-jenis 
                                            @switch($item->jenis)
                                                @case('nilai')
                                                    bg-success
                                                    @break
                                                @case('krs')
                                                    bg-warning text-dark
                                                    @break
                                                @default
                                                    bg-info
                                            @endswitch
                                        ">
                                            @switch($item->jenis)
                                                @case('nilai')
                                                    <i class="fas fa-star me-1"></i>Nilai
                                                    @break
                                                @case('krs')
                                                    <i class="fas fa-book me-1"></i>KRS
                                                    @break
                                                @default
                                                    <i class="fas fa-info-circle me-1"></i>Info
                                            @endswitch
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="notification-empty">
                                <i class="fas fa-bell-slash"></i>
                                <p>Tidak ada notifikasi baru</p>
                            </div>
                        @endforelse
                    </div>

                    @if($notifikasiTerbaru->count() > 0)
                        <div class="notification-dropdown-footer">
                            <a href="{{ route('mahasiswa.notifikasi') }}">
                                Lihat semua notifikasi
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
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
        overlay.addEventListener('click', closeSidebar);

        mainContent.addEventListener('click', function() {
            if (window.innerWidth <= 768 && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });

        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });

        document.querySelectorAll('.sidebar .nav-link, .sidebar .btn-logout').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });

        // ====== NOTIFICATION FUNCTIONS ======
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        function toggleNotificationDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const bell = document.getElementById('notificationBell');
            const dropdown = document.getElementById('notificationDropdown');
            if (!bell.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        function markNotificationRead(id, event) {
            if (event) {
                event.stopPropagation();
            }

            fetch(`/mahasiswa/notifikasi/${id}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI
                    const item = document.querySelector(`[onclick*="markNotificationRead(${id}"]`)?.closest('.notification-item');
                    if (item) {
                        item.classList.remove('unread');
                        const badge = item.querySelector('.badge-danger');
                        if (badge) badge.remove();
                    }
                    
                    // Update badge count
                    updateNotificationCount();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function markAllNotificationsRead(event) {
            if (event) {
                event.stopPropagation();
            }

            if (!confirm('Tandai semua notifikasi sebagai dibaca?')) {
                return;
            }

            fetch('/mahasiswa/notifikasi/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI - remove unread class from all items
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                        const badge = item.querySelector('.badge-danger');
                        if (badge) badge.remove();
                    });
                    
                    // Update badge count
                    updateNotificationCount();
                    
                    // Close dropdown
                    document.getElementById('notificationDropdown').classList.remove('show');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function updateNotificationCount() {
            fetch('/mahasiswa/notifikasi/unread-count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('notificationBadge');
                    const navBadge = document.querySelector('.nav-badge');
                    const count = data.count || 0;
                    
                    if (count > 0) {
                        badge.textContent = count;
                        badge.classList.remove('empty');
                        if (navBadge) {
                            navBadge.textContent = count;
                            navBadge.classList.remove('empty');
                        }
                    } else {
                        badge.textContent = '';
                        badge.classList.add('empty');
                        if (navBadge) {
                            navBadge.textContent = '';
                            navBadge.classList.add('empty');
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Auto refresh notification count every 30 seconds
        setInterval(updateNotificationCount, 30000);

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Close dropdown on ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.getElementById('notificationDropdown').classList.remove('show');
                }
            });
        });
    </script>

</body>

</html>