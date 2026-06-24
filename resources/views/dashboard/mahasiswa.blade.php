@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa - Sistem Akademik')

@section('content')
<div class="welcome-box d-flex justify-content-between align-items-center">
    <div>
        <h5 class="fw-bold m-0">
            Selamat Datang, {{ session('nama') ?? Auth::user()->name }}!
        </h5>
        <p class="small m-0 text-white-50">
            NIM: {{ session('nim') ?? 'NIM tidak tersedia' }} | {{ session('jurusan') ?? 'Manajemen Informatika' }}
        </p>
    </div>
    <div>
        <span class="badge bg-success">Mahasiswa Aktif</span>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>IPK Kumulatif</small>
                    <h3>{{ $ipkTotal ?? '3.79' }}</h3>
                </div>
                <div class="card-icon bg-soft-primary">
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total SKS Kumulatif</small>
                    <h3>{{ $totalSks ?? '27' }} SKS</h3>
                </div>
                <div class="card-icon bg-soft-success">
                    <i class="fa-solid fa-book"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Semua Matkul</small>
                    <h3>{{ $jumlahMatkul ?? '9' }}</h3>
                </div>
                <div class="card-icon bg-soft-warning">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Status Portal</small>
                    <h3 style="font-size: 16px; color: #22c55e;">Mahasiswa Aktif</h3>
                </div>
                <div class="card-icon bg-soft-info">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Perkembangan IPK -->
<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h6 class="fw-bold m-0">
            <i class="fa-solid fa-chart-line me-2"></i>
            Grafik Perkembangan Indeks Prestasi (Seluruh Semester)
        </h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-end" style="height: 250px; padding: 0 10px;">
            @php
                $semesters = range(1, 8);
                $ipsData = [
                    1 => 3.50,
                    2 => 3.65,
                    3 => 3.70,
                    4 => 3.75,
                    5 => 3.78,
                    6 => 3.79,
                    7 => 3.80,
                    8 => 3.82
                ];
                $maxIps = 4.0;
            @endphp

            @foreach($semesters as $sem)
                @php
                    $height = ($ipsData[$sem] / $maxIps) * 200;
                @endphp
                <div class="text-center" style="flex: 1;">
                    <div class="bg-primary rounded" 
                         style="height: {{ $height }}px; width: 35px; margin: 0 auto; transition: height 0.5s; 
                                background: linear-gradient(to top, #0ea5e9, #3b82f6);">
                    </div>
                    <div style="margin-top: 8px; font-size: 11px; color: #6c757d;">
                        Sem {{ $sem }}
                    </div>
                    <div style="font-size: 11px; font-weight: 600; color: #1c2b3a;">
                        {{ number_format($ipsData[$sem], 2) }}
                    </div>
                </div>
            @endforeach
        </div>
        <p class="text-center text-muted small mt-3 mb-0">
            <i class="fa-solid fa-arrow-up text-success me-1"></i>
            Indeks Prestasi Semester (IPS)
        </p>
    </div>
</div>
@endsection