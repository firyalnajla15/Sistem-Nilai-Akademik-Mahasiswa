@extends('layouts.app')

@section('content')

<div class="container py-3">

<div class="card shadow-sm mx-auto" style="max-width:700px;">
<div class="card-body">

<h3>Input Nilai Mahasiswa</h3>

<form action="{{ route('nilai.store') }}" method="POST">
@csrf

<div class="mb-2">
    <label>Mata Kuliah</label>
    <select name="matkul_id" class="form-control">
        @foreach($matkul as $m)
            <option value="{{ $m->id }}">{{ $m->nama }}</option>
        @endforeach
    </select>
</div>

<div class="mb-2">
    <label>NIM</label>
    <input type="text" name="nim" id="nimInput" class="form-control" list="mahasiswaList" autocomplete="off" required>
    <datalist id="mahasiswaList">
        @foreach($mahasiswa as $m)
            <option value="{{ $m->nim }}">{{ $m->nama }}</option>
        @endforeach
    </datalist>
    <small class="text-muted">Ketik NIM, lalu nama mahasiswa akan otomatis terisi.</small>
</div>

<div class="mb-2">
    <label>Nama Mahasiswa</label>
    <input type="text" name="nama_mahasiswa" id="namaInput" class="form-control" required>
</div>

<div class="mb-2">
    <label>Kehadiran</label>
    <input type="number" name="kehadiran" class="form-control">
</div>

<div class="mb-2">
    <label>Tugas</label>
    <input type="number" name="tugas" class="form-control">
</div>

<div class="mb-2">
    <label>UTS</label>
    <input type="number" name="uts" class="form-control">
</div>

<div class="mb-2">
    <label>UAS</label>
    <input type="number" name="uas" class="form-control">
</div>

<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Kembali</a>
    <button class="btn btn-primary">Simpan</button>
</div>

</form>

</div>
</div>

</div>

<script>
    const mahasiswaData = @json($mahasiswa->pluck('nama', 'nim'));

    document.addEventListener('DOMContentLoaded', function () {
        const nimInput = document.getElementById('nimInput');
        const namaInput = document.getElementById('namaInput');

        if (nimInput && namaInput) {
            const fillNama = function () {
                const value = nimInput.value.trim();
                namaInput.value = mahasiswaData[value] || '';
            };

            nimInput.addEventListener('input', fillNama);
            nimInput.addEventListener('change', fillNama);
        }
    });
</script>

@endsection