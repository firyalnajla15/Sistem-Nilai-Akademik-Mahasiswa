@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3 mx-auto"
         style="max-width: 700px; background: #f8f9fb;">

        <div class="card-body p-4">

            <h3 class="mb-1">📝 Input Nilai Mahasiswa</h3>
            <p class="text-muted small mb-3">Isi data nilai dengan benar</p>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0">
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
                    <label class="form-label small">Mata Kuliah</label>
                    <select name="matkul_id" class="form-select" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($matkul as $m)
                            <option value="{{ $m->id }}">{{ $m->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- ================= NIM AUTOCOMPLETE ================= --}}
                <div class="mb-3 position-relative">

                    <label class="form-label small">NIM Mahasiswa</label>

                    <input type="text"
                           name="nim"
                           id="nimInput"
                           class="form-control"
                           autocomplete="off"
                           placeholder="Ketik NIM (contoh: 22, 221, dst)"
                           required>

                    <div id="nimBox"
                         class="list-group position-absolute w-100"
                         style="z-index:999; display:none;"></div>

                </div>

                {{-- ================= NAMA ================= --}}
                <div class="mb-3">
                    <label class="form-label small">Nama Mahasiswa</label>
                    <input type="text"
                           name="nama_mahasiswa"
                           id="namaInput"
                           class="form-control bg-light"
                           readonly
                           required>
                </div>

                <hr>

                {{-- ================= NILAI ================= --}}
                <div class="row g-2 mb-3">

                    <div class="col-6 col-md-3">
                        <label class="small">Kehadiran</label>
                        <input type="number" name="kehadiran" class="form-control" min="0" max="100" required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="small">Tugas</label>
                        <input type="number" name="tugas" class="form-control" min="0" max="100" required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="small">UTS</label>
                        <input type="number" name="uts" class="form-control" min="0" max="100" required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="small">UAS</label>
                        <input type="number" name="uas" class="form-control" min="0" max="100" required>
                    </div>

                </div>

                {{-- ================= BUTTON ================= --}}
                <div class="d-flex justify-content-between">

                    <a href="{{ route('nilai.index') }}" class="btn btn-light">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-dark">
                        Simpan
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

// klik luar tutup dropdown
document.addEventListener('click', function (e) {
    if (!nimInput.contains(e.target)) {
        nimBox.style.display = 'none';
    }
});
</script>
<script>
const nimInput = document.querySelector('input[name="nim"]');
const matkulSelect = document.querySelector('select[name="matkul_id"]');

let warning = document.createElement('div');
warning.className = "alert alert-danger mt-2 d-none";
warning.innerHTML = "⚠️ Mahasiswa sudah pernah mengambil mata kuliah ini!";

document.querySelector('form').prepend(warning);

function cekData() {

    let nim = nimInput.value;
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

nimInput.addEventListener('change', cekData);
matkulSelect.addEventListener('change', cekData);
</script>

@endsection