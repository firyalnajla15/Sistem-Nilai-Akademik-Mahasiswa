@extends('mahasiswa.layouts.index')

@section('title', 'Dashboard Mahasiswa - Sistem Akademik')

@section('content')

<style>
    /* ===== WELCOME ===== */
    .welcome-box {
        background: linear-gradient(135deg, #1c2b3a 0%, #0f172a 100%);
        color: white;
        padding: 25px 30px;
        border-radius: 16px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        border: 1px solid rgba(255,255,255,0.05);
        position: relative;
        overflow: hidden;
    }

    .welcome-box::before {
        content: '';
        position: absolute;
        right: -50px;
        top: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(14, 165, 233, 0.05);
    }

    .welcome-box .greeting h5 {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 4px 0;
    }

    .welcome-box .greeting p {
        margin: 0;
        opacity: 0.7;
        font-size: 14px;
    }

    .badge-status {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
        padding: 6px 18px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid rgba(34, 197, 94, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* ===== STATS ===== */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px 22px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        transition: all 0.25s ease;
        border: 1px solid rgba(0,0,0,0.03);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border-color: rgba(14, 165, 233, 0.1);
    }

    .stat-left .stat-label {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .stat-left .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    .stat-left .stat-value.green { color: #22c55e; }
    .stat-left .stat-value.blue { color: #0ea5e9; }
    .stat-left .stat-value.orange { color: #f59e0b; }
    .stat-left .stat-value.purple { color: #8b5cf6; }

    .stat-right {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .stat-right.blue { background: #eff6ff; color: #0ea5e9; }
    .stat-right.green { background: #f0fdf4; color: #22c55e; }
    .stat-right.orange { background: #fffbeb; color: #f59e0b; }
    .stat-right.purple { background: #f5f3ff; color: #8b5cf6; }

    /* ===== CHART ===== */
    .chart-card {
        background: white;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .chart-card .card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        font-size: 16px;
        color: #0f172a;
    }

    .chart-card .card-header i {
        color: #0ea5e9;
        font-size: 18px;
    }

    .chart-card .card-body {
        padding: 24px;
    }

    .chart-wrapper {
        display: flex;
        justify-content: space-around;
        align-items: flex-end;
        height: 240px;
        padding: 0 10px;
        gap: 12px;
    }

    .chart-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        min-width: 0;
    }

    .chart-bar-wrapper {
        display: flex;
        align-items: flex-end;
        height: 190px;
        width: 100%;
        justify-content: center;
    }

    .chart-bar {
        width: 36px;
        border-radius: 6px 6px 0 0;
        transition: all 0.4s ease;
        min-height: 8px;
        position: relative;
        cursor: pointer;
    }

    .chart-bar:hover {
        opacity: 0.85;
        transform: scaleY(1.05);
        transform-origin: bottom;
    }

    .chart-bar .tooltip {
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
        background: #0f172a;
        color: white;
        padding: 2px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
        pointer-events: none;
    }

    .chart-bar:hover .tooltip {
        opacity: 1;
    }

    .chart-label {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 8px;
        font-weight: 500;
    }

    .chart-value {
        font-size: 12px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 3px;
    }

    .chart-legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
    }

    .chart-legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #64748b;
    }

    .chart-legend-item .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .chart-legend-item .dot.high { background: #0ea5e9; }
    .chart-legend-item .dot.normal { background: #93c5fd; }
    .chart-legend-item .dot.low { background: #fca5a5; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .welcome-box {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        .welcome-box .greeting h5 {
            font-size: 19px;
        }

        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .stat-card {
            padding: 16px 18px;
        }

        .stat-left .stat-value {
            font-size: 22px;
        }

        .stat-right {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .chart-wrapper {
            height: 190px;
            padding: 0 5px;
            gap: 6px;
        }

        .chart-bar-wrapper {
            height: 150px;
        }

        .chart-bar {
            width: 28px;
        }

        .chart-label {
            font-size: 10px;
        }

        .chart-value {
            font-size: 10px;
        }

        .chart-card .card-header {
            padding: 14px 18px;
            font-size: 14px;
        }

        .chart-card .card-body {
            padding: 16px;
        }
    }

    @media (max-width: 480px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat-card {
            padding: 14px 14px;
        }

        .stat-left .stat-value {
            font-size: 19px;
        }

        .stat-left .stat-label {
            font-size: 11px;
        }

        .stat-right {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .chart-bar {
            width: 20px;
        }

        .chart-wrapper {
            height: 160px;
            gap: 4px;
        }

        .chart-bar-wrapper {
            height: 120px;
        }

        .chart-legend {
            flex-wrap: wrap;
            gap: 12px;
        }
    }
</style>

<!-- ===== WELCOME ===== -->
<div class="welcome-box">
    <div class="greeting">
        <h5>
            <i class="fa-regular fa-hand-peace me-2"></i>
            Selamat Datang, {{ session('nama') ?: (Auth::check() ? Auth::user()->name : 'Mahasiswa') }}!
        </h5>
        <p>
            <i class="fa-regular fa-id-card me-1"></i>
            NIM: {{ session('nim') ?: '-' }} 
            <span class="mx-2">|</span>
            <i class="fa-regular fa-building me-1"></i>
            {{ session('jurusan') ?? 'Manajemen Informatika' }}
        </p>
    </div>
    <div>
        <span class="badge-status">
            <i class="fa-regular fa-circle-check"></i> Mahasiswa Aktif
        </span>
    </div>
</div>

<!-- ===== STATISTICS ===== -->
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

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-left">
            <div class="stat-label">IPK</div>
            <div class="stat-value blue">{{ $ipk }}</div>
        </div>
        <div class="stat-right blue">
            <i class="fa-solid fa-star"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-left">
            <div class="stat-label">Total SKS</div>
            <div class="stat-value green">{{ $totalSks }}</div>
        </div>
        <div class="stat-right green">
            <i class="fa-solid fa-book"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-left">
            <div class="stat-label">Mata Kuliah</div>
            <div class="stat-value orange">{{ $jumlahMatkul }}</div>
        </div>
        <div class="stat-right orange">
            <i class="fa-solid fa-list-check"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-left">
            <div class="stat-label">Status</div>
            <div class="stat-value green" style="font-size:20px;">Aktif</div>
        </div>
        <div class="stat-right purple">
            <i class="fa-solid fa-circle-check"></i>
        </div>
    </div>
</div>

<!-- ===== CHART ===== -->
<div class="chart-card">
    <div class="card-header">
        <i class="fa-solid fa-chart-line"></i>
        Grafik Perkembangan IPS (Semester 1-8)
    </div>
    <div class="card-body">

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
            $maxValue = max($ipsData);
        @endphp

        <div class="chart-wrapper">
            @foreach ($semesters as $sem)
                @php
                    $height = $ipsData[$sem] > 0 ? ($ipsData[$sem] / $maxIps) * 100 : 0;
                    $percentage = max($height, 5);
                    $isHighest = $ipsData[$sem] > 0 && $ipsData[$sem] == $maxValue;
                    $barColor = $isHighest ? '#0ea5e9' : ($ipsData[$sem] > 0 ? '#93c5fd' : '#e2e8f0');
                    $textColor = $ipsData[$sem] > 0 ? '#0f172a' : '#94a3b8';
                @endphp
                <div class="chart-item">
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar" style="height: {{ $percentage }}%; background: {{ $barColor }};">
                            @if($ipsData[$sem] > 0)
                                <span class="tooltip">{{ number_format($ipsData[$sem], 2) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="chart-label">Sem {{ $sem }}</div>
                    <div class="chart-value" style="color: {{ $textColor }};">
                        {{ number_format($ipsData[$sem], 2) }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Legend -->
        <div class="chart-legend">
            <span class="chart-legend-item">
                <span class="dot high"></span> Nilai Tertinggi
            </span>
            <span class="chart-legend-item">
                <span class="dot normal"></span> Nilai Normal
            </span>
            <span class="chart-legend-item">
                <span class="dot low"></span> Belum Ada Nilai
            </span>
        </div>

    </div>
</div>

@endsection