@extends('layouts.app')

@section('content')

<div class="container py-3">

    <h3 class="mb-3">📄 Transkrip Nilai Mahasiswa</h3>

    {{-- ================= FILTER ================= --}}
    <form method="GET" class="mb-3">

        <div class="row g-2">

            {{-- SEARCH AUTOCOMPLETE --}}
            <div class="col-md-6 position-relative">

    <input type="text"
           id="searchInput"
           name="search"
           class="form-control form-control-sm"
           placeholder="Ketik NIM (contoh: 22, 221, dst)">

    <div id="suggestBox"
         class="list-group position-absolute w-100"
         style="z-index:999; display:none;"></div>

</div>

            {{-- SEMESTER --}}
            <div class="col-md-6">
                <select name="semester"
                        class="form-select form-select-sm"
                        onchange="this.form.submit()">

                    <option value="all">Semua Semester</option>

                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}"
                            {{ request('semester') == $i ? 'selected' : '' }}>
                            Semester {{ $i }}
                        </option>
                    @endfor

                </select>
            </div>

        </div>
    </form>

    {{-- ================= BUTTON PDF ================= --}}
    @if(request('search') || request('semester'))
        <div class="mb-3">
            <a href="{{ route('transkrip.pdf', request()->all()) }}"
               class="btn btn-dark btn-sm">
                🖨 Cetak / Download PDF
            </a>
        </div>
    @endif

    {{-- ================= TABLE ================= --}}
    <div class="table-responsive">

        <table class="table table-bordered table-hover text-center">

            <thead class="table-dark">
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                </tr>
            </thead>

            <tbody>

                @forelse($data as $n)
                <tr>
                    <td>{{ $n->nim }}</td>
                    <td>{{ $n->nama_mahasiswa }}</td>
                    <td>{{ $n->matkul->nama }}</td>
                    <td>{{ $n->matkul->semester }}</td>
                    <td>{{ $n->nilai_akhir }}</td>
                    <td>
                        <span class="badge bg-primary">
                            {{ $n->grade }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted">
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

    // minimal 1 karakter (BIAR LANGSUNG MUNCUL)
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

// klik luar → tutup
document.addEventListener('click', function (e) {
    if (!input.contains(e.target)) {
        box.style.display = 'none';
    }
});
</script>

@endsection