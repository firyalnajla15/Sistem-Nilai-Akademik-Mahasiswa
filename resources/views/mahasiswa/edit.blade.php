@extends('layouts.app')

@section('content')

<div class="card shadow-sm mx-auto" style="max-width: 700px;">
    <div class="card-body">
        <h2 class="mb-4">Edit Mahasiswa</h2>

        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ old('nim', $mahasiswa->nim) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $mahasiswa->nama) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Prodi</label>
                <input type="text" name="prodi" class="form-control" value="{{ old('prodi', $mahasiswa->prodi) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Angkatan</label>
                <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan', $mahasiswa->angkatan) }}">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
</div>

@endsection