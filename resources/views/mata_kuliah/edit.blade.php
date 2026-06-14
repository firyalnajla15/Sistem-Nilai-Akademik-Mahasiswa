@extends('layouts.app')

@section('content')

<div class="card shadow-sm mx-auto" style="max-width: 700px;">
    <div class="card-body">
        <h2 class="mb-4">Edit Mata Kuliah</h2>

        <form action="{{ route('mata-kuliah.update', $mata_kuliah->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode</label>
                <input type="text" name="kode" class="form-control" value="{{ old('kode', $mata_kuliah->kode) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $mata_kuliah->nama) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" class="form-control" value="{{ old('sks', $mata_kuliah->sks) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Semester</label>
                <input type="number" name="semester" class="form-control" value="{{ old('semester', $mata_kuliah->semester) }}" min="1" max="8">
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Akademik</label>
                <input type="text" name="tahun_akademik" class="form-control" value="{{ old('tahun_akademik', $mata_kuliah->tahun_akademik) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Dosen</label>
                <input type="text" name="dosen" class="form-control" value="{{ old('dosen', $mata_kuliah->dosen) }}">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection