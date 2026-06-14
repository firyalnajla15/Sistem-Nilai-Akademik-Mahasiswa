@extends('layouts.app')

@section('content')

@php
    $totalMahasiswa = \App\Models\Mahasiswa::count();
    $totalMataKuliah = \App\Models\MataKuliah::count();
    $totalNilai = \App\Models\NilaiMahasiswa::count();
@endphp

<h2 class="mb-4">
    Dashboard Sistem Nilai Akademik Mahasiswa
</h2>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Mahasiswa</h5>
                <h2>{{ $totalMahasiswa }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Mata Kuliah</h5>
                <h2>{{ $totalMataKuliah }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <h5>Total Nilai</h5>
                <h2>{{ $totalNilai }}</h2>
            </div>
        </div>
    </div>

</div>

@endsection