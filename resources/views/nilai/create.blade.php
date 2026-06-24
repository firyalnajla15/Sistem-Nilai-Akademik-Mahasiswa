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

    .form-control::placeholder {
        color: #a0aec0;
        font-size: 0.85rem;
    }

    .form-control[readonly] {
        background: #f1f5f9;
        cursor: not-allowed;
    }

    .btn-simpan {
        background: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.6rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-simpan:hover {
        background: #1e293b;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-simpan i {
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

    .alert-danger-custom {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.85rem;
    }

    .alert-danger-custom ul {
        margin-bottom: 0;
        padding-left: 1.2rem;
    }

    .alert-warning-custom {
        background: #fffbeb;
        color: #92400e;
        border: 1px solid #fde68a;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.85rem;
    }

    .divider {
        border: none;
        border-top: 2px solid #f0f2f5;
        margin: 1.2rem 0;
    }

    .list-group-item-action {
        cursor: pointer;
        transition: 0.2s;
    }

    .list-group-item-action:hover {
        background: #f0f9ff;
    }
</style>

<div class="container py-4">

    <div class="form-card">
        <div class="card-body">

            <h4 class="form-title">
                <i class="fa-solid fa-pen-to-square"></i>
                Input Nilai Mahasiswa
            </h4>
            <p class="form-subtitle">Isi data nilai dengan benar</p>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger-custom mb-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                {{-- ================= MATA KULIAH ================= --}}
                <div class="mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="matkul_id" class="form-select" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($matkul as $m)
                            <option value="{{ $m->id }}">{{ $m->kode }} - {{ $m->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- ================= NIM AUTOCOMPLETE ================= --}}
                <div class="mb-3 position-relative">
                    <label class="form-label">NIM Mahasiswa</label>
                    <input type="text"
                           name="nim"
                           id="nimInput"
                           class="form-control"
                           autocomplete="off"
                           placeholder="Ketik NIM (contoh: 2401092007)"
                           required>
                    <div id="nimBox"
                         class="list-group position-absolute w-100"
                         style="z-index:999; display:none; max-height:200px; overflow-y:auto; border:1px solid #e2e8f0; border-radius:0 0 10px 10px; background:white;">
                    </div>
                </div>

                {{-- ================= NAMA ================= --}}
                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text"
                           name="nama_mahasiswa"
                           id="namaInput"
                           class="form-control"
                           readonly
                           required
                           placeholder="Nama akan muncul otomatis">
                </div>

                <hr class="divider">

                {{-- ================= NILAI ================= --}}
                <div class="row g-2 mb-3">
                    <div class="col-6 col-md-3">
                        <label class="form-label">Kehadiran</label>
                        <input type="number" name="kehadiran" class="form-control" min="0" max="100" placeholder="0-100" required>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label">Tugas</label>
                        <input type="number" name="tugas" class="form-control" min="0" max="100" placeholder="0-100" required>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label">UTS</label>
                        <input type="number" name="uts" class="form-control" min="0" max="100" placeholder="0-100" required>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label">UAS</label>
                        <input type="number" name="uas" class="form-control" min="0" max="100" placeholder="0-100" required>
                    </div>
                </div>

                {{-- ================= BUTTON ================= --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('nilai.index') }}" class="btn-kembali">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn-simpan">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- ================= AUTOCOMPLETE SCRIPT ================= --}}
<script>
const nimInput = document.getElementById('nimInput');
const nimBox = document.getElementById('nimBox');
const namaInput = document.getElementById('namaInput');

nimInput.addEventListener('input', function () {
    let value = this.value.trim();

    if (value.length < 1) {
        nimBox.style.display = 'none';
        namaInput.value = '';
        return;
    }

    fetch(`/api/search-mahasiswa?q=${value}`)
        .then(res => res.json())
        .then(data => {
            nimBox.innerHTML = '';
            nimBox.style.display = 'block';

            if (data.length === 0) {
                nimBox.innerHTML = `<div class="list-group-item text-muted">Tidak ditemukan</div>`;
                return;
            }

            data.forEach(item => {
                let div = document.createElement('div');
                div.className = 'list-group-item list-group-item-action';
                div.innerHTML = `<b>${item.nim}</b> - ${item.nama}`;
                div.onclick = () => {
                    nimInput.value = item.nim;
                    namaInput.value = item.nama;
                    nimBox.style.display = 'none';
                };
                nimBox.appendChild(div);
            });
        });
});

document.addEventListener('click', function (e) {
    if (!nimInput.contains(e.target) && !nimBox.contains(e.target)) {
        nimBox.style.display = 'none';
    }
});
</script>

{{-- ================= CEK DUPLIKAT ================= --}}
<script>
const nimInputCek = document.querySelector('input[name="nim"]');
const matkulSelect = document.querySelector('select[name="matkul_id"]');

let warning = document.createElement('div');
warning.className = "alert alert-warning-custom mt-2 d-none";
warning.innerHTML = "<i class='fa-solid fa-triangle-exclamation me-1'></i> Mahasiswa sudah pernah mengambil mata kuliah ini!";

document.querySelector('form').prepend(warning);

function cekData() {
    let nim = nimInputCek.value;
    let matkul = matkulSelect.value;

    if (!nim || !matkul) return;

    fetch(`/api/check-nilai?nim=${nim}&matkul_id=${matkul}`)
        .then(res => res.json())
        .then(exists => {
            if (exists) {
                warning.classList.remove('d-none');
            } else {
                warning.classList.add('d-none');
            }
        });
}

nimInputCek.addEventListener('change', cekData);
nimInputCek.addEventListener('blur', cekData);
matkulSelect.addEventListener('change', cekData);
</script>

@endsection