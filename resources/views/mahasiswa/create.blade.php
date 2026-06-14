@extends('layouts.app')

@section('content')

<div class="card shadow-sm mx-auto" style="max-width: 700px;">
    <div class="card-body">
        <h2 class="mb-4">Tambah Mahasiswa</h2>

        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ old('nim') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Prodi</label>
                <input type="text" name="prodi" class="form-control" value="{{ old('prodi') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Angkatan</label>
                <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan') }}">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
</div>

@endsection