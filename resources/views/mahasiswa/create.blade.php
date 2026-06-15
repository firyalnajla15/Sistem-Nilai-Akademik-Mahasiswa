@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3 mx-auto"
         style="max-width: 700px; background:#f8f9fb;">

        <div class="card-body p-4">

            <h3 class="mb-4 fw-semibold text-dark">
                ➕ Tambah Mahasiswa
            </h3>

            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-muted">NIM</label>
                    <input type="text"
                           name="nim"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('nim') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Nama</label>
                    <input type="text"
                           name="nama"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('nama') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Prodi</label>
                    <input type="text"
                           name="prodi"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('prodi') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Angkatan</label>
                    <input type="number"
                           name="angkatan"
                           class="form-control border-0 shadow-sm"
                           style="background:#fff;"
                           value="{{ old('angkatan') }}">
                </div>

                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                            class="btn rounded-pill px-4"
                            style="background:#1f2a44; color:#fff;">
                        Simpan
                    </button>

                    <a href="{{ route('mahasiswa.index') }}"
                       class="btn btn-light rounded-pill px-4 shadow-sm">
                        Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection