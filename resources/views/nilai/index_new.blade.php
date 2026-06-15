@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3"
         style="background: #f8f9fb;">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-dark fw-semibold">📝 Data Nilai Mahasiswa</h3>

                <a href="{{ route('nilai.create') }}"
                   class="btn btn-sm px-3 rounded-pill"
                   style="background:#1f2a44; color:#fff;">
                    + Input Nilai
                </a>
            </div>

            @if(session('success'))
                <div class="alert py-2 border-0"
                     style="background:#e9edf5; color:#1f2a44;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('nilai.index') }}" class="mb-3" id="filterForm">
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
                            
                            @if(isset($semesters))
                                @foreach($semesters as $sem)
                                    <option value="{{ $sem }}" {{ (string) ($selectedSemester ?? '') === (string) $sem ? 'selected' : '' }}>
                                        Semester {{ $sem }}
                                    </option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle"
                       style="border-color:#e5e7eb;">

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
                    @forelse($data->groupBy(fn($item) => $item->matkul->semester) as $semester => $nilaiPerSemester)
                        <tr style="background:#e9edf5; cursor:pointer;" onclick="toggleSemester({{ $semester }})">
                            <td colspan="11" class="fw-bold text-dark">
                                <span id="arrow-{{ $semester }}" style="display:inline-block; margin-right:10px;">▼</span>
                                📚 Semester {{ $semester }}
                            </td>
                        </tr>
                        <tr id="matkul-{{ $semester }}" style="background:#f5f7fc;">
                            <td colspan="11" class="p-3">
                                <strong class="text-dark">Mata Kuliah:</strong>
                                <div class="mt-2">
                                    @php
                                        $matkulList = $nilaiPerSemester->pluck('matkul')->unique('id');
                                    @endphp
                                    @foreach($matkulList as $mk)
                                        <span class="badge me-2 mb-2" style="background:#1f2a44; color:#fff;">
                                            {{ $mk->nama }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        @forelse($nilaiPerSemester as $index => $n)
                            <tr class="text-center">
                                <td class="text-muted small">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $n->nim }}</td>
                                <td class="text-dark text-start">{{ $n->nama_mahasiswa }}</td>
                                
                                <td class="text-dark">
                                    {{ $n->matkul->nama ?? '-' }}
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

                                        <form action="{{ route('nilai.destroy', $n->id) }}"
                                              method="POST">
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
                                <td colspan="11" class="text-center text-muted py-3">
                                    Belum ada data nilai untuk semester ini
                                </td>
                            </tr>
                        @endforelse
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted py-4">
                                Belum ada data nilai mahasiswa
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
function toggleSemester(semester) {
    var matkulRow = document.getElementById('matkul-' + semester);
    var arrow = document.getElementById('arrow-' + semester);
    
    if (matkulRow.style.display === 'none') {
        matkulRow.style.display = 'table-row';
        arrow.textContent = '▼';
    } else {
        matkulRow.style.display = 'none';
        arrow.textContent = '▶';
    }
}
</script>

@endsection
