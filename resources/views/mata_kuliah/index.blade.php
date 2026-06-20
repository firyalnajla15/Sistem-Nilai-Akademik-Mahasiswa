@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3"
         style="background: #f8f9fb;">

        <div class="card-body">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-dark fw-semibold">📚 Data Mata Kuliah </h3>

                <a href="{{ route('mata-kuliah.create', ['semester' => $selectedSemester ?? 'all']) }}"
                   class="btn btn-sm px-3 rounded-pill"
                   style="background:#1f2a44; color:#fff;">
                    + Tambah
                </a>
            </div>

            <!-- Alert -->
            @if(session('success'))
                <div class="alert py-2 border-0"
                     style="background:#e9edf5; color:#1f2a44;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter -->
            <form method="GET" action="{{ route('mata-kuliah.index') }}" class="mb-3" id="filterForm">
                <div class="row g-2">
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Filter Semester</label>

                        <select name="semester"
                                class="form-select form-select-sm border-0 shadow-sm"
                                style="background:#ffffff;"
                                onchange="document.getElementById('filterForm').submit()">

                            <option value="all" {{ empty($selectedSemester) || $selectedSemester === 'all' ? 'selected' : '' }}>
                                Semua Semester
                            </option>

                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ (string) $selectedSemester === (string) $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor

                        </select>
                    </div>
                </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle"
                       style="border-color:#e5e7eb;">

                    <thead style="background:#1f2a44; color:#fff;">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Tahun</th>
                            <th>Dosen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody style="background:#ffffff;">
                    @forelse($data as $item)
                        <tr>
                            <td class="fw-semibold text-dark">{{ $item->kode }}</td>
                            <td class="text-dark">{{ $item->nama }}</td>

                            <td>
                                <span class="badge"
                                      style="background:#e9edf5; color:#1f2a44;">
                                    {{ $item->sks }} SKS
                                </span>
                            </td>

                            <td>
                                <span class="badge"
                                      style="background:#eef2f7; color:#1f2a44;">
                                    Semester {{ $item->semester }}
                                </span>
                            </td>

                            <td class="text-muted">{{ $item->tahun_akademik }}</td>
                            <td class="text-muted">{{ $item->dosen }}</td>

                            <td>
                                <div class="d-flex gap-2 justify-content-center">

                                    <a href="{{ route('mata-kuliah.edit', $item->id) }}"
                                       class="btn btn-sm rounded-pill px-3"
                                       style="background:#1f2a44; color:#fff;">
                                        Edit
                                    </a>

                                    <form action="{{ route('mata-kuliah.destroy', $item->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm rounded-pill px-3"
                                                style="background:#b23b3b; color:#fff;"
                                                onclick="return confirm('Hapus data ini?')">
                                            Hapus
                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Tidak ada data mata kuliah
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection