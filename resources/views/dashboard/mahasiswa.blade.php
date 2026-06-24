<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #334155;
            margin: 0;
            transition: 0.25s ease;
        }

        /* ================= WELCOME BOX ================= */
        .welcome-box {
            background-color: #1c2b3a; 
            color: #ffffff;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .welcome-box h5 {
            color: #ffffff !important;
        }

        /* ================= SIDEBAR LAYOUT ================= */
        .sidebar {
            background-color: #1c2b3a;
            height: 100vh;
            color: #ecf0f1;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1300;
            padding-top: 30px; /* Dikurangi sedikit agar muat dengan profil */
            overflow-y: auto;
            transform: translateX(-100%);
            transition: 0.25s ease;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #fff;
            text-decoration: none;
        }

        /* ----- KOMPONEN PROFIL MINI SIDEBAR ----- */
        .sidebar-profile {
            padding: 15px;
            margin: 0 15px 15px 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-avatar {
            width: 45px;
            height: 45px;
            background-color: #142d52;
            border: 2px solid #38bdf8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .sidebar-profile-info {
            overflow: hidden;
        }

        .sidebar-profile-name {
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
            margin: 0;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .sidebar-profile-status {
            font-size: 11px;
            color: #38bdf8;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background-color: #4ade80;
            border-radius: 50%;
            display: inline-block;
        }

        /* ---------------------------------------- */

        .menu-header {
            font-size: 10px;
            text-transform: uppercase;
            color: #ffffff;
            opacity: 0.6;
            font-weight: bold;
            padding-left: 1.5rem;
            margin-top: 1.2rem;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            padding: 12px 15px;
            border-radius: 10px;
            margin: 0.2rem 0.75rem;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-weight: 600;
        }

        /* ================= TOP NAVBAR & PUSH LAYOUT ================= */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: #0b1f3a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            padding: 0 16px;
            z-index: 1400;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            transition: 0.25s ease;
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

        .content-area {
            padding: 90px 25px 25px 25px;
            transition: margin-left 0.25s ease;
        }

        body.sidebar-open .content-area {
            margin-left: 260px;
        }

        body.sidebar-open .topbar {
            margin-left: 260px;
        }

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

        .card-stat {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
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

    <div class="topbar justify-content-between">
        <div class="d-flex align-items-center">
            <button class="toggle-btn" type="button" onclick="toggleSidebar()">☰</button>
            <div class="topbar-title">Dashboard Mahasiswa</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
                <i class="fa-solid fa-user-tie me-1"></i> Login Admin
            </a>
        </div>
    </div>

    <aside id="sidebarMenu" class="sidebar d-flex flex-column">
        <div class="brand">
            <i class="fa-solid fa-graduation-cap text-info"></i> Portal Student
        </div>
        
        <div class="sidebar-profile">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(session('nama', 'M'), 0, 1)) }}
            </div>
            <div class="sidebar-profile-info">
                <p class="sidebar-profile-name">{{ session('nama') }}</p>
                <p class="sidebar-profile-status"><span class="status-dot"></span> Online</p>
            </div>
        </div>

      <div class="menu-header">Menu Utama</div>

<ul class="nav nav-pills flex-column mb-auto" style="padding-left:0;">

    <li class="nav-item">
        <a href="#" class="nav-link active">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
        </a>
    </li>

    <li>
        <a href="#" class="nav-link">
            <i class="fa-solid fa-book"></i>
            KRS
        </a>
    </li>

    <li>
        <a href="#" class="nav-link">
            <i class="fa-solid fa-file-pen"></i>
            Nilai
        </a>
    </li>

    <li>
        <a href="#" class="nav-link">
            <i class="fa-solid fa-file-lines"></i>
            Transkrip
        </a>
    </li>

    <li>
        <a href="#" class="nav-link">
            <i class="fa-solid fa-chart-line"></i>
            Grafik IPK
        </a>
    </li>

    <li>
        <a href="#" class="nav-link">
            <i class="fa-solid fa-bell"></i>
            Notifikasi
        </a>
    </li>

</ul>

<div class="menu-header">Akun</div>

<ul class="nav nav-pills flex-column mb-3" style="padding-left:0;">

    <li>
        <a href="#" class="nav-link">
            <i class="fa-solid fa-user"></i>
            Profil
        </a>
    </li>

    <li>
        <form action="{{ route('mahasiswa.logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="btn btn-link nav-link w-100 text-start text-danger border-0 m-0"
                style="padding-left:15px;gap:12px;">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </li>

</ul>
    </aside>

    <main id="mainContent" class="content-area">

        <div class="welcome-box d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold m-0">Selamat Datang, {{ session('nama') }}!</h5>
                <p class="small m-0 text-white-50">NIM: {{ session('nim') }} | Manajemen Informatika</p>
            </div>
            <span class="badge bg-danger p-2"><i class="fa-solid fa-bell me-1"></i> Informasi Portal Aktif</span>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card card-stat p-3 bg-white d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">IPK Kumulatif</span>
                        <h4 class="fw-bold text-primary m-0 mt-1">{{ $ipkTotal }}</h4>
                    </div>
                    <div class="text-primary bg-primary bg-opacity-10 p-2 rounded"><i
                            class="fa-solid fa-chart-line fa-lg"></i></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-stat p-3 bg-white d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">
                            {{ $semesterDipilih ? 'SKS Semester ' . $semesterDipilih : 'Total SKS Kumulatif' }}
                        </span>
                        <h4 class="fw-bold text-success m-0 mt-1">{{ $totalSks ?? 0 }} <span class="text-muted"
                                style="font-size: 0.8rem;">SKS</span></h4>
                    </div>
                    <div class="text-success bg-success bg-opacity-10 p-2 rounded"><i
                            class="fa-solid fa-check-double fa-lg"></i></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-stat p-3 bg-white d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">
                            {{ $semesterDipilih ? 'Matkul Semester ' . $semesterDipilih : 'Total Semua Matkul' }}
                        </span>
                        <h4 class="fw-bold text-info m-0 mt-1">{{ $jumlahMatkul ?? 0 }}</h4>
                    </div>
                    <div class="text-info bg-info bg-opacity-10 p-2 rounded"><i
                            class="fa-solid fa-user-check fa-lg"></i></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-stat p-3 bg-white d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Status Portal</span>
                        <h4 class="fw-bold text-warning m-0 mt-1" style="font-size: 1.1rem;">Mahasiswa Aktif</h4>
                    </div>
                    <div class="text-warning bg-warning bg-opacity-10 p-2 rounded"><i
                            class="fa-solid fa-calendar-check fa-lg"></i></div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-stat p-4 bg-white">
                    <h6 class="fw-bold mb-3 text-secondary"><i class="fa-solid fa-chart-area me-2"></i>Grafik
                        Perkembangan Indeks Prestasi (Seluruh Semester)</h6>
                    <div class="chart-container">
                        <canvas id="chartIpk"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-stat p-4 bg-white">

                    <div class="row align-items-center g-2 mb-4">
                        <div class="col-12 col-sm-6">
                            <h6 class="fw-bold m-0 text-secondary"><i class="fa-solid fa-table-list me-2"></i>Daftar
                                Komponen Penilaian Nilai Matakuliah</h6>
                        </div>
                        <div class="col-12 col-sm-6">
                            <form action="{{ route('mahasiswa.dashboard') }}" method="GET" id="formFilterSemester"
                                class="d-flex justify-content-sm-end align-items-center gap-2">
                                <label class="small fw-semibold text-muted text-nowrap m-0">Cari Berdasarkan
                                    Semester:</label>
                                <select name="semester" class="form-select form-select-sm rounded-3"
                                    style="width: 170px;"
                                    onchange="document.getElementById('formFilterSemester').submit();">
                                    <option value="">-- Semua Semester --</option>
                                    @php
                                        $listSemesterAvailable = \DB::table('nilai_mahasiswa')
                                            ->join('mata_kuliah', 'nilai_mahasiswa.matkul_id', '=', 'mata_kuliah.id')
                                            ->where('nilai_mahasiswa.nim', session('nim'))
                                            ->distinct()
                                            ->orderBy('mata_kuliah.semester', 'asc')
                                            ->pluck('mata_kuliah.semester');
                                    @endphp
                                    @foreach ($listSemesterAvailable as $sem)
                                        <option value="{{ $sem }}"
                                            {{ $semesterDipilih == $sem ? 'selected' : '' }}>Semester
                                            {{ $sem }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped m-0 compact-table align-middle text-center">
                            <thead style="background-color: #1c2b3a; color: #ffffff;">
                                <tr>
                                    <th class="text-start" style="width: 35%;">Mata Kuliah</th>
                                    <th>Semester</th>
                                    <th>Absen</th>
                                    <th>Tugas</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
                                    <th>Nilai Akhir</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($daftarNilai as $nilai)
                                    <tr>
                                        <td class="text-start fw-semibold text-dark">{{ $nilai->nama_matakuliah }}
                                        </td>
                                        <td><span class="badge bg-secondary">Semester {{ $nilai->semester }}</span>
                                        </td>
                                        <td>{{ $nilai->kehadiran }}</td>
                                        <td>{{ $nilai->tugas }}</td>
                                        <td>{{ $nilai->uts }}</td>
                                        <td>{{ $nilai->uas }}</td>
                                        <td class="fw-bold text-primary">{{ number_format($nilai->nilai_akhir, 2) }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ in_array($nilai->grade, ['A', 'A-', 'B+', 'B']) ? 'bg-success' : 'bg-warning text-dark' }}">
                                                {{ $nilai->grade ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-muted py-4">Belum ada data nilai kuliah untuk
                                            kriteria pencarian semester ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartIpk').getContext('2d');
        const rawIpkData = {!! json_encode($grafikIpk) !!};
        const filterActive = "{!! $semesterDipilih !!}";

        let chartLabels = [];
        let chartData = [];

        if (filterActive !== "") {
            chartLabels = ['Semester ' + filterActive];
            chartData = [rawIpkData[parseInt(filterActive) - 1] || 0];
        } else {
            chartLabels = rawIpkData.map((_, index) => 'Sem ' + (index + 1));
            chartData = rawIpkData;
        }

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Indeks Prestasi Semester (IPS)',
                    data: chartData,
                    borderColor: '#1c2b3a',
                    backgroundColor: 'rgba(28, 43, 58, 0.08)',
                    borderWidth: 3,
                    pointBackgroundColor: '#1c2b3a',
                    pointRadius: 5,
                    fill: true,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 4,
                        ticks: {
                            stepSize: 1 
                        }
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>