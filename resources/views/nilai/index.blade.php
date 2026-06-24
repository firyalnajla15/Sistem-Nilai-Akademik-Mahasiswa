@extends('layouts.app')

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

    .btn-filter {
        background: #ffffff;
        color: #0f172a;
        border: 1px solid #e2e8f0;
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: 0.2s;
    }

    .btn-filter:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .btn-filter i {
        margin-right: 4px;
    }

    .btn-filter span {
        color: #0284c7;
    }

    .dropdown-menu-custom {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        min-width: 220px;
    }

    .dropdown-item-custom {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #334155;
        transition: 0.2s;
        text-decoration: none;
        display: block;
    }

    .dropdown-item-custom:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .dropdown-item-custom i {
        margin-right: 8px;
        color: #94a3b8;
    }

    .dropdown-divider-custom {
        border: none;
        border-top: 1px solid #f0f2f5;
        margin: 0.3rem 0;
    }

    .dropdown-header-custom {
        font-size: 0.75rem;
        font-weight: 600;
        color: #94a3b8;
        padding: 0.3rem 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu-sub {
        position: absolute;
        top: 0;
        left: 100%;
        margin-top: -2px;
        margin-left: 4px;
        display: none;
        min-width: 250px;
        max-width: 300px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #ffffff;
        padding: 0.4rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        z-index: 1050;
    }

    .dropdown-submenu:hover > .dropdown-menu-sub {
        display: block;
    }

    .dropdown-submenu > .dropdown-item-custom::after {
        content: "›";
        float: right;
        font-weight: 700;
        color: #94a3b8;
        font-size: 1.2rem;
        line-height: 1;
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

    .badge-grade-a {
        background: #dcfce7;
        color: #166534;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-grade-b {
        background: #dbeafe;
        color: #1e40af;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-grade-c {
        background: #fef3c7;
        color: #92400e;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-grade-d {
        background: #fde68a;
        color: #78350f;
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
        padding: 0.25rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.75rem;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-edit:hover {
        background: #1e293b;
        color: #ffffff;
    }

    .btn-hapus {
        background: #dc2626;
        color: #ffffff;
        border: none;
        padding: 0.25rem 1rem;
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
</style>

<div class="container py-4">

    <div class="data-card">
        <div class="card-body">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="page-title">
                    <i class="fa-solid fa-file-pen"></i>
                    Data Nilai Mahasiswa
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

            <!-- Filter Dropdown -->
            <div class="mb-4">
                <div class="dropdown d-inline-block">
                    <button class="btn-filter dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-filter"></i>
                        Filter:
                        <span>
                            @if(request('matkul_id'))
                                {{ \App\Models\MataKuliah::find(request('matkul_id'))->nama ?? 'Semua' }}
                            @elseif(request('semester'))
                                Semua Matkul Sem. {{ request('semester') }}
                            @else
                                Semua Data (Urut Semester)
                            @endif
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="filterDropdown">
                        <li>
                            <a class="dropdown-item-custom" href="{{ route('nilai.index') }}">
                                <i class="fa-solid fa-list"></i> Semua Nilai (Urut Semester)
                            </a>
                        </li>
                        <li><hr class="dropdown-divider-custom"></li>

                        @for($i = 1; $i <= 8; $i++)
                            <li class="dropdown-submenu">
                                <a class="dropdown-item-custom" href="{{ route('nilai.index', ['semester' => $i]) }}">
                                    <i class="fa-regular fa-calendar"></i> Semester {{ $i }}
                                </a>
                                <ul class="dropdown-menu-sub">
                                    <li class="dropdown-header-custom">Pilih Matkul Sem. {{ $i }}</li>
                                    @php
                                        $filteredMatkul = \App\Models\MataKuliah::where('semester', $i)->get();
                                    @endphp
                                    @forelse($filteredMatkul as $m)
                                        <li>
                                            <a class="dropdown-item-custom" href="{{ route('nilai.index', ['matkul_id' => $m->id]) }}">
                                                {{ $m->nama }}
                                            </a>
                                        </li>
                                    @empty
                                        <li><span class="dropdown-item-custom text-muted">Belum ada matkul</span></li>
                                    @endforelse
                                </ul>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>

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
                            if(request('matkul_id')) {
                                $filteredData = $data->where('matkul_id', request('matkul_id'));
                            } elseif(request('semester')) {
                                $filteredData = $data->filter(function($item) {
                                    return isset($item->matkul->semester) && $item->matkul->semester == request('semester');
                                });
                            }

                            // URUTKAN DATA BERDASARKAN SEMESTER (dari terkecil ke terbesar) dan NAMA MATA KULIAH
                            $filteredData = $filteredData->sortBy(function($item) {
                                return [
                                    $item->matkul->semester ?? 99,  // Urutkan berdasarkan semester
                                    $item->matkul->nama ?? ''      // Lalu berdasarkan nama matkul
                                ];
                            });

                            // Reset index untuk nomor urut
                            $filteredData = $filteredData->values();
                        @endphp

                        @forelse($filteredData as $index => $n)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $n->nim }}</td>
                                <td class="text-start-custom">{{ $n->nama_mahasiswa }}</td>
                                <td class="text-start-custom">{{ $n->matkul->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge-semester">Smt {{ $n->matkul->semester ?? '-' }}</span>
                                </td>
                                <td>{{ $n->kehadiran }}</td>
                                <td>{{ $n->tugas }}</td>
                                <td>{{ $n->uts }}</td>
                                <td>{{ $n->uas }}</td>
                                <td class="nilai-akhir">{{ number_format($n->nilai_akhir, 2) }}</td>
                                <td>
                                    @php
                                        $grade = $n->grade ?? 'E';
                                        $class = match($grade) {
                                            'A' => 'badge-grade-a',
                                            'B' => 'badge-grade-b',
                                            'C' => 'badge-grade-c',
                                            'D' => 'badge-grade-d',
                                            default => 'badge-grade-e'
                                        };
                                    @endphp
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
    // Submenu hover untuk desktop
    document.querySelectorAll('.dropdown-submenu').forEach(function(element) {
        element.addEventListener('mouseenter', function(e) {
            var submenu = this.querySelector('.dropdown-menu-sub');
            if (submenu) {
                submenu.style.display = 'block';
            }
        });
        element.addEventListener('mouseleave', function(e) {
            var submenu = this.querySelector('.dropdown-menu-sub');
            if (submenu) {
                submenu.style.display = 'none';
            }
        });
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        var dropdown = document.querySelector('.dropdown-menu-custom');
        var button = document.querySelector('.btn-filter');
        if (dropdown && button) {
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                var bsDropdown = bootstrap.Dropdown.getInstance(button);
                if (bsDropdown) {
                    bsDropdown.hide();
                }
            }
        }
    });
});
</script>

@endsection