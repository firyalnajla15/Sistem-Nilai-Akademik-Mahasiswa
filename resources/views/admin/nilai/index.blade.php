@extends('admin.layouts.app')

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

    .form-label-filter {
        color: #475569;
        font-weight: 600;
        font-size: 0.8rem;
        margin-bottom: 4px;
    }

    .form-control-sm-custom, .form-select-sm-custom {
        border-radius: 10px;
        padding: 0.5rem 1rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.9rem;
        transition: 0.2s;
        background: #fafbfc;
    }

    .form-control-sm-custom:focus, .form-select-sm-custom:focus {
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        border-color: #38bdf8;
        background: #ffffff;
    }

    .btn-cari {
        background: #0f172a;
        color: white;
        border: none;
        padding: 0.5rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        width: 100%;
    }

    .btn-cari:hover {
        background: #1e293b;
        color: white;
        transform: translateY(-1px);
    }

    .btn-cari i {
        margin-right: 6px;
    }

    .btn-reset {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.85rem;
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
        padding: 0.6rem 0.6rem;
        font-weight: 600;
        font-size: 0.78rem;
        border-bottom: none;
        text-align: center;
        white-space: nowrap;
    }

    .table-custom tbody td {
        padding: 0.6rem 0.6rem;
        font-size: 0.85rem;
        vertical-align: middle;
        background: #ffffff;
        text-align: center;
    }

    .table-custom tbody tr {
        border-bottom: 1px solid #f0f2f5;
        transition: 0.2s;
    }

    .table-custom tbody tr:hover {
        background: #f8fafc;
    }

    .badge-semester {
        background: #f1f5f9;
        color: #64748b;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 500;
        border: 1px solid #e2e8f0;
    }

    .badge-grade-a-plus {
        background: #dcfce7;
        color: #166534;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-a {
        background: #dbeafe;
        color: #1e40af;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-a-minus {
        background: #dbeafe;
        color: #1e40af;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-b-plus {
        background: #fef3c7;
        color: #92400e;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-b {
        background: #fef3c7;
        color: #92400e;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-b-minus {
        background: #fef3c7;
        color: #92400e;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-c-plus {
        background: #fde68a;
        color: #78350f;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-c {
        background: #fde68a;
        color: #78350f;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-c-minus {
        background: #fde68a;
        color: #78350f;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-d {
        background: #fecaca;
        color: #991b1b;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .badge-grade-e {
        background: #fecaca;
        color: #991b1b;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .nilai-akhir {
        font-weight: 700;
        color: #0f172a;
    }

    .btn-edit {
        background: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.25rem 0.8rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.75rem;
        transition: 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit:hover {
        background: #1e293b;
        color: #ffffff;
    }

    .btn-hapus {
        background: #dc2626;
        color: #ffffff;
        border: none;
        padding: 0.25rem 0.8rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.75rem;
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

    .text-start-custom {
        text-align: left !important;
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

    <div class="data-card">
        <div class="card-body">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="page-title">
                    <i class="fa-solid fa-file-lines"></i>
                    Laporan Nilai Mahasiswa
                </h4>

                <a href="{{ route('nilai.create') }}" class="btn-tambah">
                    <i class="fa-solid fa-plus"></i> Input Nilai
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
            <form method="GET" action="{{ route('nilai.index') }}" class="mb-3">
                <div class="row g-3">

                    <div class="col-md-3 position-relative">
                        <label class="form-label-filter">Cari Mahasiswa</label>
                        <input type="text"
                               id="searchNama"
                               name="search"
                               class="form-control form-control-sm-custom"
                               placeholder="Ketik NIM atau Nama"
                               value="{{ request('search') }}">
                        <div id="suggestBox" class="suggest-box"></div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label-filter">Semester</label>
                        <select name="semester" class="form-select form-select-sm-custom">
                            <option value="all">Semua</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label-filter">Mata Kuliah</label>
                        <select name="matkul_id" class="form-select form-select-sm-custom">
                            <option value="all">Semua Matkul</option>
                            @foreach($matkuls as $m)
                                <option value="{{ $m->id }}" {{ request('matkul_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn-cari">
                            <i class="fa-solid fa-magnifying-glass"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('nilai.index') }}" class="btn-reset">
                            <i class="fa-solid fa-rotate-right"></i> Reset
                        </a>
                    </div>

                </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-custom">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Mata Kuliah</th>
                            <th>Semester</th>
                            <th>Kehadiran</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            // Filter data berdasarkan request
                            $filteredData = $data;
                            
                            if(request('search')) {
                                $search = request('search');
                                $filteredData = $filteredData->filter(function($item) use ($search) {
                                    return stripos($item->nim, $search) !== false || 
                                           stripos($item->nama_mahasiswa, $search) !== false;
                                });
                            }
                            
                            if(request('semester') && request('semester') != 'all') {
                                $filteredData = $filteredData->filter(function($item) {
                                    return isset($item->matkul->semester) && $item->matkul->semester == request('semester');
                                });
                            }
                            
                            if(request('matkul_id') && request('matkul_id') != 'all') {
                                $filteredData = $filteredData->where('matkul_id', request('matkul_id'));
                            }

                            // URUTKAN DATA BERDASARKAN SEMESTER
                            $filteredData = $filteredData->sortBy(function($item) {
                                return $item->matkul->semester ?? 99;
                            });

                            $filteredData = $filteredData->values();
                        @endphp

                        @forelse($filteredData as $index => $n)
                            @php
                                $grade = $n->grade ?? 'E';
                                $class = match($grade) {
                                    'A+' => 'badge-grade-a-plus',
                                    'A' => 'badge-grade-a',
                                    'A-' => 'badge-grade-a-minus',
                                    'B+' => 'badge-grade-b-plus',
                                    'B' => 'badge-grade-b',
                                    'B-' => 'badge-grade-b-minus',
                                    'C+' => 'badge-grade-c-plus',
                                    'C' => 'badge-grade-c',
                                    'C-' => 'badge-grade-c-minus',
                                    'D' => 'badge-grade-d',
                                    default => 'badge-grade-e'
                                };
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $n->nim }}</td>
                                <td class="text-start-custom">{{ $n->nama_mahasiswa }}</td>
                                <td class="text-start-custom">{{ $n->matkul->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge-semester">Smt {{ $n->matkul->semester ?? '-' }}</span>
                                </td>
                                <td>{{ number_format($n->kehadiran, 2) }}</td>
                                <td>{{ number_format($n->tugas, 2) }}</td>
                                <td>{{ number_format($n->uts, 2) }}</td>
                                <td>{{ number_format($n->uas, 2) }}</td>
                                <td class="nilai-akhir">{{ number_format($n->nilai_akhir, 2) }}</td>
                                <td>
                                    <span class="{{ $class }}">{{ $grade }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('nilai.edit', $n->id) }}" class="btn-edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('nilai.destroy', $n->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn-hapus"
                                                    onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-empty">
                                    <i class="fa-regular fa-face-frown me-1"></i>
                                    Tidak ada data nilai yang cocok
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('searchNama');
    const box = document.getElementById('suggestBox');

    if (input) {
        input.addEventListener('input', function() {
            let value = this.value.trim();

            if (value.length < 1) {
                box.style.display = 'none';
                return;
            }

            fetch(`/api/search-mahasiswa?q=${value}`)
                .then(res => res.json())
                .then(data => {
                    box.innerHTML = '';
                    box.style.display = 'block';

                    if (data.length === 0) {
                        box.innerHTML = `<div class="list-group-item text-muted">Tidak ditemukan</div>`;
                        return;
                    }

                    data.forEach(item => {
                        let div = document.createElement('div');
                        div.className = 'list-group-item list-group-item-action';
                        div.innerHTML = `<b>${item.nim}</b> - ${item.nama}`;
                        div.onclick = () => {
                            input.value = item.nim;
                            box.style.display = 'none';
                            input.form.submit();
                        };
                        box.appendChild(div);
                    });
                });
        });

        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !box.contains(e.target)) {
                box.style.display = 'none';
            }
        });
    }
});
</script>

@endsection