@extends('mahasiswa.layouts.index')

@section('title', 'Dashboard Mahasiswa - Sistem Akademik')

@section('content')

    <style>
        .welcome-box {
            background: #1c2b3a;
            color: white;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .welcome-box h5 {
            font-size: 20px;
            font-weight: 700;
        }

        .badge-status {
            background: #22c55e;
            padding: 5px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .stat-card .card-body {
            padding: 20px;
        }

        .stat-card .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-card .stat-label {
            font-size: 13px;
            color: #6c757d;
            font-weight: 500;
        }

        .stat-card .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #1c2b3a;
            margin: 0;
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

        .chart-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-top: 25px;
        }

        .chart-card .card-header {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }

        .chart-card .card-header i {
            color: #0ea5e9;
            margin-right: 8px;
        }

        .chart-card .card-body {
            padding: 20px;
        }

        .chart-bar {
            border-radius: 4px 4px 0 0;
            transition: 0.3s;
            min-height: 10px;
        }

        .chart-bar:hover {
            opacity: 0.8;
        }

        .chart-label {
            font-size: 11px;
            color: #6c757d;
            margin-top: 6px;
        }

        .chart-value {
            font-size: 11px;
            font-weight: 600;
            color: #1c2b3a;
        }

        @media (max-width: 768px) {
            .welcome-box {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .stat-card .stat-value {
                font-size: 20px;
            }
        }
    </style>

    <!-- Welcome Box -->
    <div class="welcome-box d-flex justify-content-between align-items-center">
        <div>
            <h5 class="m-0">
                Selamat Datang,
                {{ session('nama') ?: (Auth::check() ? Auth::user()->name : 'Mahasiswa') }}!
            </h5>
            <p class="small m-0 text-white-50">
               NIM: {{ session('nim') ?: '-' }} | {{ session('jurusan') ?? 'Manajemen Informatika' }}
            </p>
        </div>
        <div>
            <span class="badge-status text-white">
                <i class="fa-regular fa-circle-check"></i> Mahasiswa Aktif
            </span>
        </div>
    </div>

    <div class="row g-3">

        @php
            $jumlahMatkul = \App\Models\NilaiMahasiswa::where('nim', session('nim'))->count();

            $ipk = \App\Models\NilaiMahasiswa::where('nim', session('nim'))
                ->get()
                ->avg(function ($item) {
                    return $item->nilai_akhir;
                });

            $ipk = $ipk ? number_format($ipk / 25, 2) : '0.00';

            $totalSks = \App\Models\NilaiMahasiswa::where('nim', session('nim'))
                ->with('matkul')
                ->get()
                ->sum(function ($item) {
                    return optional($item->matkul)->sks ?? 0;
                });
        @endphp

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">IPK</div>
                        <div class="stat-value">{{ $ipk }}</div>
                    </div>

                    <div class="stat-icon bg-soft-primary">
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total SKS</div>
                        <div class="stat-value">{{ $totalSks }}</div>
                    </div>

                    <div class="stat-icon bg-soft-success">
                        <i class="fa-solid fa-book"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Mata Kuliah</div>
                        <div class="stat-value">{{ $jumlahMatkul }}</div>
                    </div>

                    <div class="stat-icon bg-soft-warning">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Status</div>
                        <div class="stat-value" style="font-size:18px;color:#22c55e;">
                            Aktif
                        </div>
                    </div>

                    <div class="stat-icon bg-soft-info">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Grafik -->
    <div class="card chart-card">
        <div class="card-header">
            <i class="fa-solid fa-chart-line"></i>
            Grafik Perkembangan IPS (Semester 1-8)
        </div>
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-end" style="height: 200px; padding: 0 5px;">

                @php

                    $semesters = range(1, 8);

                    $ipsData = [];

                    for ($i = 1; $i <= 8; $i++) {
                        $nilai = \App\Models\NilaiMahasiswa::where('nim', session('nim'))
                            ->whereHas('matkul', function ($q) use ($i) {
                                $q->where('semester', $i);
                            })
                            ->get()
                            ->avg(function ($item) {
                                return $item->nilai_akhir;
                            });

                        $ipsData[$i] = $nilai ? round($nilai / 25, 2) : 0;
                    }

                    $maxIps = 4;

                @endphp

                @foreach ($semesters as $sem)
                    @php
                        $height = ($ipsData[$sem] / $maxIps) * 170;
                    @endphp
                    <div class="text-center" style="flex: 1;">
                        <div class="chart-bar"
                            style="height: {{ max($height, 15) }}px; 
                                width: 30px; 
                                margin: 0 auto;
                               background: {{ ($ipsData[$sem] > 0 && $ipsData[$sem] == max($ipsData)) ? '#0ea5e9' : '#93c5fd' }};
                        </div>
                        <div class="chart-label">Sem {{ $sem }}</div>
                        <div class="chart-value">{{ number_format($ipsData[$sem], 2) }}</div>
                    </div>
                @endforeach

            </div>

            <p class="text-center text-muted small mt-3 mb-0">
                <i class="fa-regular fa-calendar me-1"></i>
                Indeks Prestasi Semester (IPS)
            </p>

        </div>
    </div>

@endsection
