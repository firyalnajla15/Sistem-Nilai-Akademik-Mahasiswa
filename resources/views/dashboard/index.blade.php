@extends('layouts.app')

@section('content')

@php
    $totalMahasiswa = \App\Models\Mahasiswa::count();
    $totalMataKuliah = \App\Models\MataKuliah::count();
    $totalNilai = \App\Models\NilaiMahasiswa::count();
    $ratarata = \App\Models\NilaiMahasiswa::whereNotNull('nilai_akhir')->avg('nilai_akhir');
    $ratarata = $ratarata !== null ? number_format($ratarata, 2) : '0.00';
@endphp

<h2 class="mb-4">
    Dashboard Sistem Nilai Akademik Mahasiswa
</h2>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Mahasiswa</h5>
                <h2>{{ $totalMahasiswa }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Mata Kuliah</h5>
                <h2>{{ $totalMataKuliah }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Nilai Terinput</h5>
                <h2>{{ $totalNilai }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5>Rata-rata Nilai</h5>
                <h2>{{ $ratarata }}</h2>
            </div>
        </div>
    </div>

</div>

@endsection