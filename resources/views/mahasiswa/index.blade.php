@extends('layouts.app')

@section('content')

<style>
    .data-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        background: #ffffff;
        border: 1px solid #e2e8f0;
    }

    .data-card .card-body {
        padding: 1.8rem 2rem 2rem;
    }

    .page-title {
        color: #0f172a;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 0;
    }

    .page-title i {
        color: #38bdf8;
        margin-right: 10px;
    }

    .btn-tambah {
        background: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-tambah:hover {
        background: #1e293b;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-tambah i {
        margin-right: 6px;
    }

    .alert-custom {
        background: #f0f9ff;
        color: #0f172a;
        border: 1px solid #b3d4fc;
        border-radius: 10px;
        padding: 0.6rem 1rem;
    }

    .form-select {
        border-radius: 10px;
        padding: 0.5rem 1rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.9rem;
        transition: 0.2s;
        background: #fafbfc;
    }

    .form-select:focus {
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        border-color: #38bdf8;
    }

    .btn-filter {
        background: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: 0.2s;
        width: 100%;
    }

    .btn-filter:hover {
        background: #1e293b;
        color: #ffffff;
    }

    .btn-filter i {
        margin-right: 6px;
    }

    .btn-reset {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: 0.2s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        width: 100%;
    }

    .btn-reset:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .table-custom {
        border-color: #e5e7eb;
        margin-bottom: 0;
    }

    .table-custom thead {
        background: #0f172a;
        color: #ffffff;
    }

    .table-custom thead th {
        padding: 0.7rem 1rem;
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: none;
    }

    .table-custom tbody td {
        padding: 0.7rem 1rem;
        font-size: 0.9rem;
        vertical-align: middle;
        background: #ffffff;
    }

    .table-custom tbody tr {
        border-bottom: 1px solid #f0f2f5;
        transition: 0.2s;
    }

    .table-custom tbody tr:hover {
        background: #f8fafc;
    }

    .badge-angkatan {
        background: #f1f5f9;
        color: #0f172a;
        padding: 0.35rem 0.8rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .btn-edit {
        background: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.3rem 1.2rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-edit:hover {
        background: #1e293b;
        color: #ffffff;
    }

    .btn-hapus {
        background: #dc2626;
        color: #ffffff;
        border: none;
        padding: 0.3rem 1.2rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
        transition: 0.2s;
    }

    .btn-hapus:hover {
        background: #b91c1c;
        color: #ffffff;
    }

    .text-empty {
        color: #94a3b8;
        padding: 2rem 0;
    }
</style>

<div class="container py-4">

    <div class="data-card">
        <div class="card-body">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="page-title">
                    <i class="fa-solid fa-users"></i>
                    Data Mahasiswa
                </h4>

                <a href="{{ route('mahasiswa.create') }}" class="btn-tambah">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>

            <!-- Alert -->
            @if(session('success'))
                <div class="alert alert-custom mb-3">
                    <i class="fa-regular fa-circle-check me-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter -->
            <form method="GET" action="{{ route('mahasiswa.index') }}" class="row g-2 mb-3">

                <div class="col-md-4">
                    <select name="prodi" class="form-select">
                        <option value="">Semua Prodi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>
                                {{ $prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="angkatan" class="form-select">
                        <option value="">Semua Angkatan</option>
                        @foreach($angkatans as $angkatan)
                            <option value="{{ $angkatan }}" {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                                {{ $angkatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('mahasiswa.index') }}" class="btn-reset">
                        <i class="fa-solid fa-rotate-right"></i> Reset
                    </a>
                </div>

            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-custom">

                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td class="fw-semibold text-dark">{{ $item->nim }}</td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-muted">{{ $item->prodi }}</td>
                                <td>
                                    <span class="badge-angkatan">{{ $item->angkatan }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('mahasiswa.edit', $item->id) }}" class="btn-edit">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn-hapus"
                                                    onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="fa-regular fa-trash-can"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-empty">
                                    <i class="fa-regular fa-face-frown me-1"></i>
                                    Tidak ada data mahasiswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection