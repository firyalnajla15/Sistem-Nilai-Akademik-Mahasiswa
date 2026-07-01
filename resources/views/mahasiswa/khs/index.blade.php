@extends('mahasiswa.layouts.index')

@section('title', 'KHS')

@section('content')

<div class="container mt-4">
    <div class="welcome-box">
        <h5><i class="fa-solid fa-star me-2"></i>Kartu Hasil Studi (KHS)</h5>
        <p class="mb-0 text-light opacity-75">Lihat nilai akademik Anda per semester</p>
    </div>

    <div class="card">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #0b1f3a, #1a365d);">
            <span><i class="fa-solid fa-filter me-2"></i>Filter Semester</span>
            <span class="badge bg-light text-dark">Semester {{ $semester }}</span>
        </div>

        <div class="card-body">
            <form method="GET">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <label class="form-label fw-semibold">Pilih Semester</label>
                        <select name="semester" class="form-select" onchange="this.form.submit()">
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ $semester == $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #0b1f3a, #1a365d);">
            <span><i class="fa-solid fa-list me-2"></i>Daftar Nilai</span>
            <span class="badge bg-light text-dark">{{ count($nilai) }} Mata Kuliah</span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead style="background: #0b1f3a; color: white;">
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>Mata Kuliah</th>
                            <th width="80" class="text-center">SKS</th>
                            <th width="120" class="text-center">Nilai Akhir</th>
                            <th width="80" class="text-center">Grade</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($nilai as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->matkul->nama }}</td>
                            <td class="text-center"><span class="badge" style="background: #0b1f3a;">{{ $item->matkul->sks }}</span></td>
                            <td class="text-center fw-semibold">{{ number_format($item->nilai_akhir, 2) }}</td>
                            <td class="text-center">
                                @php
                                    $gradeClass = match($item->grade) {
                                        'A' => 'success',
                                        'B' => 'primary',
                                        'C' => 'warning',
                                        'D' => 'danger',
                                        'E' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $gradeClass }} fs-6">{{ $item->grade }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox fa-2x d-block mb-2"></i>
                                Belum ada nilai pada semester ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: #f0f4f8;">
                        <span class="fw-semibold">Total SKS</span>
                        <span class="badge fs-5" style="background: #0b1f3a; color: white;">{{ $totalSks }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: #f0f4f8;">
                        <span class="fw-semibold">IPS Semester {{ $semester }}</span>
                        <span class="badge fs-5" style="background: #0ea5e9; color: white;">{{ $ips }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection