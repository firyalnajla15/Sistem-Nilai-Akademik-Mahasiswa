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
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #1c2b3a;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            overflow-y: auto;
        }

        .brand {
            padding: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand i {
            margin-right: 8px;
        }

        .user-profile {
            margin: 15px 10px;
            padding: 12px;
            background: rgba(255, 255, 255, .08);
            border-radius: 12px;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #0ea5e9;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
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
        }

        .user-status {
            font-size: 11px;
            color: #93c5fd;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-header {
            padding: 15px 20px 5px;
            font-size: 11px;
            opacity: .6;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar .nav {
            padding: 0 10px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            margin: 2px 0;
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, .1);
            color: white;
        }

        .sidebar .nav-link.active {
            background: rgba(14, 165, 233, 0.2);
            color: #60a5fa;
        }

        .topbar {
            margin-left: 260px;
            height: 60px;
            background: #0b1f3a;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 25px;
            font-weight: 600;
            font-size: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar i {
            margin-right: 10px;
        }

        .content {
            margin-left: 260px;
            padding: 25px;
            min-height: calc(100vh - 60px);
        }

        .welcome-box {
            background: #1c2b3a;
            color: white;
            padding: 25px 30px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .welcome-box h5 {
            font-size: 20px;
        }

        .card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
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
            border-radius: 10px;
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

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar .brand span,
            .sidebar .user-info,
            .sidebar .menu-header,
            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .brand {
                font-size: 20px;
                padding: 15px;
            }

            .sidebar .user-profile {
                padding: 10px;
                justify-content: center;
            }

            .sidebar .nav-link {
                justify-content: center;
                padding: 12px;
            }

            .sidebar .nav-link i {
                font-size: 18px;
                margin: 0;
            }

            .topbar,
            .content {
                margin-left: 70px;
            }

            .content {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Portal Student</span>
        </div>

        <div class="user-profile">
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="user-name">
                    {{ Auth::user()->name ?? 'User' }}
                </div>
                <div class="user-status">
                    {{ Auth::user()->email ?? 'user@email.com' }}
                </div>
            </div>
        </div>

        <div class="menu-header">Dashboard</div>
        <ul class="nav flex-column">
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="menu-header">Akademik</div>
        <ul class="nav flex-column">
            <li>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-book"></i>
                    <span>KRS</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-star"></i>
                    <span>Nilai</span>
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
                <a href="{{ route('mahasiswa.profil') }}" class="nav-link {{ request()->routeIs('mahasiswa.profil') ? 'active' : '' }}">
                    <i class="fa-solid fa-user"></i>
                    <span>Profil</span>
                </a>
            </li>
            <li>
                <form action="{{ route('mahasiswa.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start" style="color: rgba(255,255,255,0.7);">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <div class="topbar">
        <i class="fa-solid fa-graduation-cap"></i>
        Portal Akademik Mahasiswa
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>