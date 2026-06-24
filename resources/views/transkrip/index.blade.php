@extends('layouts.app')

@section('content')

<style>
    .page-title {
        color: #0f172a;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
    }

    .page-title i {
        color: #38bdf8;
        margin-right: 10px;
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

    .form-control-sm-custom::placeholder {
        color: #a0aec0;
        font-size: 0.85rem;
    }

    .btn-pdf {
        background: #0f172a;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-pdf:hover {
        background: #1e293b;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .table-transkrip {
        border-color: #e2e8f0;
        margin-bottom: 0;
    }

    .table-transkrip thead {
        background: #0f172a;
        color: #ffffff;
    }

    .table-transkrip thead th {
        padding: 0.7rem 1rem;
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: none;
        text-align: center;
    }

    .table-transkrip tbody td {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        vertical-align: middle;
        background: #ffffff;
        text-align: center;
    }

    .table-transkrip tbody tr {
        border-bottom: 1px solid #f0f2f5;
        transition: 0.2s;
    }

    .table-transkrip tbody tr:hover {
        background: #f8fafc;
    }

    .badge-grade-transkrip {
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-grade-a { background: #dcfce7; color: #166534; }
    .badge-grade-b { background: #dbeafe; color: #1e40af; }
    .badge-grade-c { background: #fef3c7; color: #92400e; }
    .badge-grade-d { background: #fde68a; color: #78350f; }
    .badge-grade-e { background: #fecaca; color: #991b1b; }

    .text-empty {
        color: #94a3b8;
        padding: 2rem 0;
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

    <h4 class="page-title">
        <i class="fa-solid fa-file-lines"></i>
        Transkrip Nilai Mahasiswa
    </h4>

    {{-- ================= FILTER ================= --}}
    <form method="GET" class="mb-3">

        <div class="row g-3">

            {{-- SEARCH AUTOCOMPLETE --}}
            <div class="col-md-6 position-relative">
                <label class="form-label-filter">Cari NIM</label>
                <input type="text"
                       id="searchInput"
                       name="search"
                       class="form-control form-control-sm-custom"
                       placeholder="Ketik NIM (contoh: 2401092007)"
                       value="{{ request('search') }}">
                <div id="suggestBox" class="suggest-box"></div>
            </div>

            {{-- SEMESTER --}}
            <div class="col-md-3">
                <label class="form-label-filter">Filter Semester</label>
                <select name="semester"
                        class="form-select form-select-sm-custom"
                        onchange="this.form.submit()">
                    <option value="all">Semua Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                            Semester {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- BUTTON FILTER --}}
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn-pdf" style="background: #0f172a; color: white; border: none; padding: 0.5rem 2rem; border-radius: 50px; font-weight: 600;">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
            </div>

        </div>
    </form>

    {{-- ================= BUTTON PDF ================= --}}
    @if(request('search') || request('semester'))
        <div class="mb-3">
            <a href="{{ route('transkrip.pdf', request()->all()) }}" class="btn-pdf">
                <i class="fa-solid fa-file-pdf"></i> Cetak / Download PDF
            </a>
        </div>
    @endif

    {{-- ================= TABLE ================= --}}
    <div class="table-responsive">

        <table class="table table-transkrip">

            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $n)
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
                    <tr>
                        <td class="fw-semibold text-dark">{{ $n->nim }}</td>
                        <td>{{ $n->nama_mahasiswa }}</td>
                        <td class="text-start">{{ $n->matkul->nama ?? '-' }}</td>
                        <td>
                            <span class="badge" style="background:#f1f5f9; color:#64748b; padding:0.3rem 0.8rem; border-radius:12px;">
                                {{ $n->matkul->semester ?? '-' }}
                            </span>
                        </td>
                        <td class="fw-bold" style="color:#0f172a;">{{ number_format($n->nilai_akhir, 2) }}</td>
                        <td>
                            <span class="badge-grade-transkrip {{ $class }}">
                                {{ $grade }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-empty">
                            <i class="fa-regular fa-face-frown me-1"></i>
                            Tidak ada data transkrip
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

<script>
const input = document.getElementById('searchInput');
const box = document.getElementById('suggestBox');

input.addEventListener('input', function () {
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

document.addEventListener('click', function (e) {
    if (!input.contains(e.target) && !box.contains(e.target)) {
        box.style.display = 'none';
    }
});
</script>

@endsection