@extends('layouts.app')

@section('content')

<style>
    .form-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        background: #ffffff;
        max-width: 700px;
        margin: 0 auto;
        border: 1px solid #e2e8f0;
    }

    .form-card .card-body {
        padding: 2rem 2rem 2.2rem;
    }

    .form-title {
        color: #0f172a;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 2px;
    }

    .form-title i {
        color: #38bdf8;
        margin-right: 10px;
    }

    .form-subtitle {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: #475569;
        font-weight: 600;
        font-size: 0.82rem;
        margin-bottom: 4px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.6rem 1rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.9rem;
        transition: 0.2s;
        background: #fafbfc;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        border-color: #38bdf8;
        background: #ffffff;
    }

    .form-control[readonly] {
        background: #f1f5f9;
        cursor: not-allowed;
        color: #0f172a;
        font-weight: 500;
    }

    .form-control.text-center {
        text-align: center;
    }

    .divider {
        border: none;
        border-top: 2px solid #f0f2f5;
        margin: 1.2rem 0;
    }

    .btn-update {
        background: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.6rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-update:hover {
        background: #1e293b;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-update i {
        margin-right: 8px;
    }

    .btn-kembali {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        padding: 0.6rem 2rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        text-decoration: none;
    }

    .btn-kembali:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .btn-kembali i {
        margin-right: 6px;
    }
</style>

<div class="container py-4">

    <div class="form-card">
        <div class="card-body">

            <h4 class="form-title">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Nilai Mahasiswa
            </h4>
            <p class="form-subtitle">Perbarui komponen nilai mahasiswa dengan teliti</p>

            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ================= MATA KULIAH ================= --}}
                <div class="mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="matkul_id" class="form-select" required>
                        @foreach($matkul as $m)
                            <option value="{{ $m->id }}" {{ $nilai->matkul_id == $m->id ? 'selected' : '' }}>
                                {{ $m->kode }} - {{ $m->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ================= NIM ================= --}}
                <div class="mb-3">
                    <label class="form-label">NIM Mahasiswa</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $nilai->nim }}"
                           readonly>
                </div>

                {{-- ================= NAMA ================= --}}
                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $nilai->nama_mahasiswa }}"
                           readonly>
                </div>

                <hr class="divider">

                {{-- ================= NILAI ================= --}}
                <div class="row g-2 mb-3">
                    <div class="col-6 col-md-3">
                        <label class="form-label">Kehadiran</label>
                        <input type="number"
                               name="kehadiran"
                               class="form-control text-center"
                               min="0"
                               max="100"
                               value="{{ $nilai->kehadiran }}"
                               required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">Tugas</label>
                        <input type="number"
                               name="tugas"
                               class="form-control text-center"
                               min="0"
                               max="100"
                               value="{{ $nilai->tugas }}"
                               required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">UTS</label>
                        <input type="number"
                               name="uts"
                               class="form-control text-center"
                               min="0"
                               max="100"
                               value="{{ $nilai->uts }}"
                               required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label">UAS</label>
                        <input type="number"
                               name="uas"
                               class="form-control text-center"
                               min="0"
                               max="100"
                               value="{{ $nilai->uas }}"
                               required>
                    </div>
                </div>

                {{-- ================= BUTTON ================= --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('nilai.index') }}" class="btn-kembali">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn-update">
                        <i class="fa-regular fa-floppy-disk"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection