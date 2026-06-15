@extends('layouts.app')

@section('content')

<style>
    .dropdown-submenu {
        position: relative;
    }

    /* Mengatur posisi sub-menu agar muncul tepat di sebelah kanan menu utama */
    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
        margin-left: 2px;
        display: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 1px solid #e5e7eb;
        background-color: #ffffff;
        z-index: 1050;
    }

    /* Tampilkan sub-menu saat di-hover di desktop */
    .dropdown-submenu:hover > .dropdown-menu,
    .dropdown-submenu .dropdown-menu.show {
        display: block;
    }

    /* Indikator panah ke kanan seperti WinRAR */
    .dropdown-submenu > .dropdown-item::after {
        content: " ›";
        float: right;
        font-weight: bold;
        color: #9ca3af;
        font-size: 1.1rem;
        line-height: 1;
    }
    
    .dropdown-item:hover {
        background-color: #e9edf5 !important;
        color: #1f2a44 !important;
    }
</style>

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3" style="background: #f8f9fb;">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-dark fw-semibold">📝 Data Nilai Mahasiswa</h3>

                <a href="{{ route('nilai.create') }}"
                   class="btn btn-sm px-3 rounded-pill"
                   style="background:#1f2a44; color:#fff; border: none;">
                    + Input Nilai
                </a>
            </div>

            @if(session('success'))
                <div class="alert py-2 border-0" style="background:#e9edf5; color:#1f2a44;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                
                <div class="dropdown d-inline-block" id="utamaDropdownContainer">
                    <button class="btn btn-sm btn-white border shadow-sm rounded-pill px-3 dropdown-toggle text-dark" 
                            type="button" 
                            id="filterDropdown" 
                            style="background: #ffffff;">
                         Filter Halaman: 
                        <span class="fw-semibold text-primary">
                            @if(request('matkul_id'))
                                Matkul: {{ \App\Models\MataKuliah::find(request('matkul_id'))->nama ?? 'Semua' }}
                            @elseif(request('semester'))
                                Semua Matkul Sem. {{ request('semester') }}
                            @else
                                Semua Data
                            @endif
                        </span>
                    </button>
                    
                    <ul class="dropdown-menu border-0 shadow py-2" id="menuUtama" style="min-width: 200px;">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('nilai.index') }}">
                                 Tampilkan Semua Nilai
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        
                        @for($i = 1; $i <= 8; $i++)
                            <li class="dropdown-submenu">
                                <a class="dropdown-item py-2 tombol-semester" 
                                   href="{{ route('nilai.index', ['semester' => $i]) }}">
                                     Semester {{ $i }}
                                </a>
                                
                                <ul class="dropdown-menu rounded-3 p-2">
                                    <li class="dropdown-header small text-muted fw-bold border-bottom mb-1">
                                        Pilih Spesifik Matkul Sem. {{ $i }}
                                    </li>
                                    
                                    @php
                                        $filteredMatkul = \App\Models\MataKuliah::where('semester', $i)->get();
                                    @endphp
                                    
                                    @forelse($filteredMatkul as $m)
                                        <li>
                                            <a class="dropdown-item rounded-2 py-1 small text-wrap" 
                                               href="{{ route('nilai.index', ['matkul_id' => $m->id]) }}"
                                               style="min-width: 240px; max-width: 300px;">
                                                 {{ $m->nama }}
                                            </a>
                                        </li>
                                    @empty
                                        <li>
                                            <span class="dropdown-item-text small text-muted italic py-1">
                                                Belum ada mata kuliah
                                            </span>
                                        </li>
                                    @endforelse
                                </ul>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" style="border-color:#e5e7eb;">

                    <thead style="background:#1f2a44; color:#fff;">
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Mata Kuliah</th>
                            <th>Kehadiran</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody style="background:#ffffff;">
                    @php
                        // LOGIKA PENYARINGAN DATA LANGSUNG DI BLADE TANPA UP-DATE CONTROLLER
                        $filteredData = $data;
                        
                        if(request('matkul_id')) {
                            // Jika matkul dipilih, saring spesifik matkul itu saja
                            $filteredData = $data->where('matkul_id', request('matkul_id'));
                        } elseif(request('semester')) {
                            // Jika semester yang diklik, saring semua data yang matkul-nya di semester tersebut
                            $filteredData = $data->filter(function($item) {
                                return isset($item->matkul->semester) && $item->matkul->semester == request('semester');
                            });
                        }
                    @endphp

                    @forelse($filteredData as $index => $n)
                        <tr class="text-center">
                            <td class="text-muted small">{{ $loop->iteration }}</td>
                            <td class="fw-semibold text-dark">{{ $n->nim }}</td>
                            <td class="text-dark text-start">{{ $n->nama_mahasiswa }}</td>
                            
                            <td class="text-dark text-start">
                                {{ $n->matkul->nama ?? '-' }}
                                <span class="badge bg-light text-muted small border">Smstr {{ $n->matkul->semester ?? '-' }}</span>
                            </td>

                            <td>{{ $n->kehadiran }}</td>
                            <td>{{ $n->tugas }}</td>
                            <td>{{ $n->uts }}</td>
                            <td>{{ $n->uas }}</td>
                            
                            <td class="fw-bold text-dark">{{ $n->nilai_akhir }}</td>

                            <td>
                                <span class="badge px-3 rounded-pill"
                                      style="background: {{ $n->grade == 'A' || $n->grade == 'B' ? '#e2f0d9; color:#385723;' : '#fce4d6; color:#c65911;' }}">
                                    {{ $n->grade }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('nilai.edit', $n->id) }}"
                                       class="btn btn-sm rounded-pill px-3"
                                       style="background:#1f2a44; color:#fff;">
                                        Edit
                                    </a>

                                    <form action="{{ route('nilai.destroy', $n->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm rounded-pill px-3"
                                                style="background:#b23b3b; color:#fff;"
                                                onclick="return confirm('Yakin hapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">
                                Tidak ada data nilai mahasiswa yang cocok dengan filter ini.
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
document.addEventListener('DOMContentLoaded', function () {
    var tombolUtama = document.getElementById('filterDropdown');
    var menuUtama = document.getElementById('menuUtama');
    var subMenus = document.querySelectorAll('.dropdown-submenu');

    // 1. Klik tombol utama untuk toggle menu utama (daftar semester)
    tombolUtama.addEventListener('click', function (e) {
        e.stopPropagation();
        var isShow = menuUtama.style.display === 'block';
        tutupSubMenuSaja();
        menuUtama.style.display = isShow ? 'none' : 'block';
    });

    // 2. Kontrol hover di desktop dan touch-click di mobile untuk sub-menu
    subMenus.forEach(function (li) {
        li.addEventListener('mouseenter', function() {
            tutupSubMenuSaja();
            var targetSub = this.querySelector('.dropdown-menu');
            if(targetSub) targetSub.style.display = 'block';
        });
    });

    // 3. Klik di luar area untuk menutup menu otomatis
    document.addEventListener('click', function () {
        menuUtama.style.display = 'none';
        tutupSubMenuSaja();
    });

    function tutupSubMenuSaja() {
        subMenus.forEach(function (sm) {
            sm.querySelector('.dropdown-menu').style.display = 'none';
        });
    }
});
</script>

@endsection