@extends('layouts.app')

@section('content')
    @php
        $totalMahasiswa = \App\Models\Mahasiswa::count();
        $totalMataKuliah = \App\Models\MataKuliah::count();
        $totalNilai = \App\Models\NilaiMahasiswa::count();
        $ratarata = \App\Models\NilaiMahasiswa::whereNotNull('nilai_akhir')->avg('nilai_akhir');
        $ratarata = $ratarata !== null ? number_format($ratarata, 2) : '0.00';
    @endphp

    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #1c2b3a 0%, #0b1f3a 100%);
            padding: 25px 30px;
            border-radius: 15px;
            color: white;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(14, 165, 233, 0.1);
            border-radius: 50%;
        }

        .dashboard-header h2 {
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .dashboard-header p {
            opacity: 0.8;
            margin-bottom: 0;
            position: relative;
            z-index: 1;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .stat-card .card-body {
            padding: 25px;
        }

        .stat-card .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-card .stat-icon.primary {
            background: rgba(14, 165, 233, 0.12);
            color: #0ea5e9;
        }

        .stat-card .stat-icon.success {
            background: rgba(34, 197, 94, 0.12);
            color: #22c55e;
        }

        .stat-card .stat-icon.warning {
            background: rgba(234, 179, 8, 0.12);
            color: #eab308;
        }

        .stat-card .stat-icon.info {
            background: rgba(6, 182, 212, 0.12);
            color: #06b6d4;
        }

        .stat-card h5 {
            font-size: 14px;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .stat-card h2 {
            font-weight: 700;
            color: #1c2b3a;
            margin-bottom: 5px;
        }

        .stat-card .stat-change {
            font-size: 12px;
            font-weight: 500;
            color: #22c55e;
            background: rgba(34, 197, 94, 0.1);
            padding: 2px 10px;
            border-radius: 20px;
            display: inline-block;
        }

        .stat-card .stat-label {
            font-size: 13px;
            color: #6c757d;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quick-actions {
            margin-top: 30px;
        }

        .quick-actions .card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .quick-actions .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .quick-actions .card .card-body {
            padding: 20px;
            text-align: center;
        }

        .quick-actions .card i {
            font-size: 32px;
            margin-bottom: 10px;
            display: block;
        }

        .quick-actions .card h6 {
            font-weight: 600;
            color: #1c2b3a;
            margin-bottom: 0;
            font-size: 14px;
        }

        .quick-actions .card p {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 0;
        }
    </style>

    <div class="dashboard-header">
        <h2>
            <i class="fa-solid fa-gauge-high me-2"></i>
            Dashboard Sistem Nilai Akademik Mahasiswa
        </h2>
        <p>
            <i class="fa-regular fa-calendar me-1"></i>
            {{ date('l, d F Y') }} | Total Data Akademik Terkini
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="stat-icon primary">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h5>TOTAL MAHASISWA</h5>
                    <h2>{{ number_format($totalMahasiswa) }}</h2>
                    <div class="stat-label">
                        <i class="fa-regular fa-user"></i>
                        Mahasiswa Terdaftar
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="stat-icon success">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <h5>TOTAL MATA KULIAH</h5>
                    <h2>{{ number_format($totalMataKuliah) }}</h2>
                    <div class="stat-label">
                        <i class="fa-regular fa-bookmark"></i>
                        Mata Kuliah Aktif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="stat-icon warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <h5>TOTAL NILAI TERINPUT</h5>
                    <h2>{{ number_format($totalNilai) }}</h2>
                    <div class="stat-label">
                        <i class="fa-regular fa-star"></i>
                        Nilai Tersimpan
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="stat-icon info">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                    <h5>RATA-RATA NILAI</h5>
                    <h2>{{ $ratarata }}</h2>
                    <div class="stat-label">
                        <i class="fa-regular fa-circle-check"></i>
                        Rata-rata Keseluruhan
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions / Shortcut -->
    <div class="quick-actions">
        <div class="row g-3">
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fa-solid fa-user-plus" style="color: #0ea5e9;"></i>
                            <h6>Tambah Mahasiswa</h6>
                            <p>Registrasi mahasiswa baru</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fa-solid fa-plus-circle" style="color: #22c55e;"></i>
                            <h6>Tambah Mata Kuliah</h6>
                            <p>Buat mata kuliah baru</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fa-solid fa-upload" style="color: #eab308;"></i>
                            <h6>Input Nilai</h6>
                            <p>Input nilai mahasiswa</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i>
                            <h6>Laporan Nilai</h6>
                            <p>Cetak laporan nilai</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


@endsection