@extends('layouts.app')

@section('content')

<style>
    .form-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        background: #ffffff;
        border: 1px solid #e2e8f0;
    }

    .form-card .card-body {
        padding: 2rem;
    }

    .page-title {
        color: #0f172a;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 2px;
    }

    .page-title i {
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

    .table-nilai {
        border-color: #e2e8f0;
        margin-bottom: 0;
    }

    .table-nilai thead {
        background: #0f172a;
        color: #ffffff;
    }

    .table-nilai thead th {
        padding: 0.6rem 0.8rem;
        font-weight: 600;
        font-size: 0.8rem;
        text-align: center;
        border-bottom: none;
    }

    .table-nilai tbody td {
        padding: 0.5rem 0.8rem;
        font-size: 0.85rem;
        vertical-align: middle;
        background: #ffffff;
        text-align: center;
    }

    .table-nilai tbody tr {
        border-bottom: 1px solid #f0f2f5;
    }

    .table-nilai tbody tr:hover {
        background: #f8fafc;
    }

    .table-nilai tbody td input {
        width: 70px;
        text-align: center;
        border-radius: 8px;
        padding: 0.3rem 0.5rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.85rem;
        transition: 0.2s;
        background: #fafbfc;
    }

    .table-nilai tbody td input:focus {
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        border-color: #38bdf8;
        background: #ffffff;
        outline: none;
    }

    .matkul-name {
        font-weight: 500;
        color: #0f172a;
        text-align: left !important;
    }

    .alert-custom {
        background: #f0f9ff;
        color: #0f172a;
        border: 1px solid #b3d4fc;
        border-radius: 10px;
        padding: 0.6rem 1rem;
    }

    .list-group-item-action {
        cursor: pointer;
        transition: 0.2s;
    }

    .list-group-item-action:hover {
        background: #f0f9ff;
    }

    .suggest-box {
        z-index: 999;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #e2e8f0;
        border-radius: 0 0 10px 10px;
        background: white;
        display: none;
    }

    .suggest-box .list-group-item {
        border: none;
        border-bottom: 1px solid #f0f2f5;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .suggest-box .list-group-item:last-child {
        border-bottom: none;
    }
</style>

<div class="container py-4">

    <div class="form-card">
        <div class="card-body">

            <h4 class="page-title">
                <i class="fa-solid fa-pen-to-square"></i>
                Input Nilai Per Semester
            </h4>
            <p class="form-subtitle">Pilih mahasiswa dan semester, lalu input semua nilai mata kuliah</p>

            @if(session('success'))
                <div class="alert alert-custom mb-3">
                    <i class="fa-regular fa-circle-check me-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="background:#fef2f2; color:#991b1b; border:1px solid #fecaca; border-radius:10px; padding:0.6rem 1rem; font-size:0.85rem;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <!-- Pilih Mahasiswa -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6 position-relative">
                        <label class="form-label">Cari Mahasiswa</label>
                        <input type="text"
                               id="searchMahasiswa"
                               class="form-control"
                               placeholder="Ketik NIM atau Nama"
                               autocomplete="off">
                        <input type="hidden" name="nim" id="nimHidden">
                        <input type="hidden" name="nama_mahasiswa" id="namaHidden">
                        <div id="suggestMahasiswa" class="suggest-box"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pilih Semester</label>
                        <select name="semester" class="form-select" id="semesterSelect" required>
                            <option value="">-- Pilih Semester --</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Info Mahasiswa Terpilih -->
                <div id="infoMahasiswa" class="mb-3" style="display:none;">
                    <div class="p-3" style="background:#f8fafc; border-radius:10px; border:1px solid #e2e8f0;">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-muted small">NIM:</span>
                                <strong id="displayNim" class="ms-2"></strong>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted small">Nama:</span>
                                <strong id="displayNama" class="ms-2"></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Mata Kuliah -->
                <div id="tableMatkulWrapper" style="display:none;">
                    <div class="table-responsive mt-3">
                        <table class="table table-nilai">
                            <thead>
                                <tr>
                                    <th style="width:50px;">No</th>
                                    <th style="text-align:left;">Mata Kuliah</th>
                                    <th style="width:100px;">Kehadiran</th>
                                    <th style="width:100px;">Tugas</th>
                                    <th style="width:100px;">UTS</th>
                                    <th style="width:100px;">UAS</th>
                                </tr>
                            </thead>
                            <tbody id="matkulBody">
                                <!-- Data diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('nilai.index') }}" class="btn-kembali">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn-simpan" id="btnSimpan" disabled>
                            <i class="fa-regular fa-floppy-disk"></i> Simpan Semua Nilai
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchMahasiswa');
    const suggestBox = document.getElementById('suggestMahasiswa');
    const nimHidden = document.getElementById('nimHidden');
    const namaHidden = document.getElementById('namaHidden');
    const displayNim = document.getElementById('displayNim');
    const displayNama = document.getElementById('displayNama');
    const infoMahasiswa = document.getElementById('infoMahasiswa');
    const semesterSelect = document.getElementById('semesterSelect');
    const tableWrapper = document.getElementById('tableMatkulWrapper');
    const matkulBody = document.getElementById('matkulBody');
    const btnSimpan = document.getElementById('btnSimpan');

    let selectedNim = null;

    // Autocomplete Mahasiswa
    searchInput.addEventListener('input', function() {
        let value = this.value.trim();

        if (value.length < 1) {
            suggestBox.style.display = 'none';
            return;
        }

        fetch(`/api/search-mahasiswa?q=${value}`)
            .then(res => res.json())
            .then(data => {
                suggestBox.innerHTML = '';
                suggestBox.style.display = 'block';

                if (data.length === 0) {
                    suggestBox.innerHTML = `<div class="list-group-item text-muted">Tidak ditemukan</div>`;
                    return;
                }

                data.forEach(item => {
                    let div = document.createElement('div');
                    div.className = 'list-group-item list-group-item-action';
                    div.innerHTML = `<b>${item.nim}</b> - ${item.nama}`;
                    div.onclick = () => {
                        selectMahasiswa(item);
                    };
                    suggestBox.appendChild(div);
                });
            });
    });

    function selectMahasiswa(item) {
        searchInput.value = `${item.nim} - ${item.nama}`;
        nimHidden.value = item.nim;
        namaHidden.value = item.nama;
        displayNim.textContent = item.nim;
        displayNama.textContent = item.nama;
        infoMahasiswa.style.display = 'block';
        suggestBox.style.display = 'none';
        selectedNim = item.nim;
        loadMatkul();
    }

    // Load Mata Kuliah berdasarkan semester
    function loadMatkul() {
        const semester = semesterSelect.value;
        const nim = nimHidden.value;

        if (!semester || !nim) {
            tableWrapper.style.display = 'none';
            btnSimpan.disabled = true;
            return;
        }

        fetch(`/api/matkul-by-semester?semester=${semester}`)
            .then(res => res.json())
            .then(data => {
                matkulBody.innerHTML = '';
                tableWrapper.style.display = 'block';

                if (data.length === 0) {
                    matkulBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                Tidak ada mata kuliah untuk semester ini
                            </td>
                        </tr>
                    `;
                    btnSimpan.disabled = true;
                    return;
                }

                data.forEach((matkul, index) => {
                    let tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td class="matkul-name">${matkul.nama}</td>
                        <td><input type="number" name="nilai[${matkul.id}][kehadiran]" min="0" max="100" placeholder="0-100"></td>
                        <td><input type="number" name="nilai[${matkul.id}][tugas]" min="0" max="100" placeholder="0-100"></td>
                        <td><input type="number" name="nilai[${matkul.id}][uts]" min="0" max="100" placeholder="0-100"></td>
                        <td><input type="number" name="nilai[${matkul.id}][uas]" min="0" max="100" placeholder="0-100"></td>
                    `;
                    matkulBody.appendChild(tr);
                });

                btnSimpan.disabled = false;
            });
    }

    semesterSelect.addEventListener('change', function() {
        if (selectedNim && this.value) {
            loadMatkul();
        } else {
            tableWrapper.style.display = 'none';
            btnSimpan.disabled = true;
        }
    });

    // Click outside suggestion
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestBox.contains(e.target)) {
            suggestBox.style.display = 'none';
        }
    });
});
</script>

@endsection