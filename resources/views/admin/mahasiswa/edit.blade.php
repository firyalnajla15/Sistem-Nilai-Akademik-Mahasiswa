@extends('admin.layouts.app')

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
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f0f2f5;
    }

    .form-title i {
        color: #38bdf8;
        margin-right: 10px;
    }

    .form-label {
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 4px;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.6rem 1rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.9rem;
        transition: 0.2s;
        background: #fafbfc;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        border-color: #38bdf8;
        background: #ffffff;
    }

    .form-control::placeholder {
        color: #a0aec0;
        font-size: 0.85rem;
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
                Edit Mahasiswa
            </h4>

            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text"
                           name="nim"
                           class="form-control"
                           placeholder="Masukkan NIM"
                           value="{{ old('nim', $mahasiswa->nim) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           placeholder="Masukkan nama lengkap"
                           value="{{ old('nama', $mahasiswa->nama) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Program Studi</label>
                    <input type="text"
                           name="prodi"
                           class="form-control"
                           placeholder="Masukkan program studi"
                           value="{{ old('prodi', $mahasiswa->prodi) }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Angkatan</label>
                    <input type="number"
                           name="angkatan"
                           class="form-control"
                           placeholder="Masukkan tahun angkatan"
                           value="{{ old('angkatan', $mahasiswa->angkatan) }}"
                           required>
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn-update">
                        <i class="fa-regular fa-floppy-disk"></i> Update
                    </button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn-kembali">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection