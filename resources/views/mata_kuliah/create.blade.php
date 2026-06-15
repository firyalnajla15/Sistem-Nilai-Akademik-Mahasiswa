@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3 mx-auto"
         style="max-width: 700px; background:#f8f9fb;">

        <div class="card-body p-4">

            <h3 class="mb-4 fw-semibold text-dark">
                ➕ Tambah Mata Kuliah
            </h3>

            <form action="{{ route('mata-kuliah.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-muted">Kode</label>
                    <input type="text"
                           name="kode"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('kode') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Nama Mata Kuliah</label>
                    <input type="text"
                           name="nama"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('nama') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">SKS</label>
                    <input type="number"
                           name="sks"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('sks') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Semester</label>
                    <input type="number"
                           name="semester"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           min="1"
                           max="8"
                           value="{{ old('semester', request('semester') != 'all' ? request('semester') : '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Tahun Akademik</label>
                    <input type="text"
                           name="tahun_akademik"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('tahun_akademik') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Dosen</label>
                    <input type="text"
                           name="dosen"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('dosen') }}">
                </div>

                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                            class="btn rounded-pill px-4"
                            style="background:#1f2a44; color:#fff;">
                        Simpan
                    </button>

                    <a href="{{ route('mata-kuliah.index') }}"
                       class="btn btn-light rounded-pill px-4 shadow-sm">
                        Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection