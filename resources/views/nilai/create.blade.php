@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card shadow-sm mx-auto" style="max-width:700px;">
        <div class="card-body">

            <h3>Input Nilai Mahasiswa</h3>

            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Mata Kuliah</label>
                    <select name="matkul_id" class="form-control" required>
                        @foreach($matkul as $m)
                        <option value="{{ $m->id }}">
                            {{ $m->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>NIM Mahasiswa</label>

                    <input type="text"
                        name="nim"
                        id="nimInput"
                        class="form-control"
                        list="listMahasiswa"
                        autocomplete="off"
                        required>

                    <datalist id="listMahasiswa">
                        @foreach($mahasiswa as $m)
                            <option value="{{ $m->nim }}" data-nama="{{ $m->nama }}">
                            {{ $m->nama }}
                        </option>
                        @endforeach
                    </datalist>
                </div>

                <div class="mb-3">
                    <label>Nama Mahasiswa</label>

                    <input type="text"
                        name="nama_mahasiswa"
                        id="namaInput"
                        class="form-control"
                        readonly
                        required>
                </div>


                <div class="mb-3">
                    <label>Kehadiran</label>
                    <input type="number"
                        name="kehadiran"
                        class="form-control"
                        min="0"
                        max="100"
                        required>
                </div>

                <div class="mb-3">
                    <label>Tugas</label>
                    <input type="number"
                        name="tugas"
                        class="form-control"
                        min="0"
                        max="100"
                        required>
                </div>

                <div class="mb-3">
                    <label>UTS</label>
                    <input type="number"
                        name="uts"
                        class="form-control"
                        min="0"
                        max="100"
                        required>
                </div>

                <div class="mb-3">
                    <label>UAS</label>
                    <input type="number"
                        name="uas"
                        class="form-control"
                        min="0"
                        max="100"
                        required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('nilai.index') }}"
                        class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit"
                        class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var nimInput = document.getElementById('nimInput');
    var namaInput = document.getElementById('namaInput');

    function isiNama() {
        var nim = nimInput.value;
        var nama = '';

        @foreach($mahasiswa as $m)
            if (nim === "{{ $m->nim }}") {
                nama = "{{ $m->nama }}";
            }
        @endforeach

        namaInput.value = nama;
    }

    nimInput.addEventListener('input', isiNama);
    nimInput.addEventListener('change', isiNama);

});
</script>

@endsection