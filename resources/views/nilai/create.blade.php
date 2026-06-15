@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3 mx-auto" 
         style="max-width: 700px; background: #f8f9fb;">
         
        <div class="card-body p-4">

            <div class="mb-4">
                <h3 class="text-dark fw-semibold mb-1">📝 Input Nilai Mahasiswa</h3>
                <p class="text-muted small mb-0">Silakan masukkan data komponen nilai secara lengkap dan teliti.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm py-2 small mb-3 text-danger" style="background: #fcdede;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li><strong>Gagal:</strong> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label small text-muted fw-medium">Mata Kuliah</label>
                    <select name="matkul_id" 
                            class="form-select border-0 shadow-sm" 
                            style="background: #ffffff;" 
                            required>
                        <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                        @foreach($matkul as $m)
                            <option value="{{ $m->id }}" {{ old('matkul_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted fw-medium">NIM Mahasiswa</label>
                    <input type="text"
                           name="nim"
                           id="nimInput"
                           class="form-control border-0 shadow-sm"
                           style="background: #ffffff;"
                           list="listMahasiswa"
                           autocomplete="off"
                           value="{{ old('nim') }}"
                           placeholder="Ketik atau pilih NIM..."
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
                    <label class="form-label small text-muted fw-medium">Nama Mahasiswa</label>
                    <input type="text"
                           name="nama_mahasiswa"
                           id="namaInput"
                           class="form-control border-0 shadow-sm text-dark fw-medium"
                           style="background: #e9edf5;"
                           value="{{ old('nama_mahasiswa') }}"
                           placeholder="Nama akan terisi otomatis setelah NIM dipilih"
                           readonly
                           required>
                </div>

                <hr class="my-4" style="border-color: #e5e7eb;">

                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <label class="form-label small text-muted fw-medium">Kehadiran</label>
                        <input type="number"
                               name="kehadiran"
                               class="form-control border-0 shadow-sm text-center"
                               style="background: #ffffff;"
                               min="0"
                               max="100"
                               value="{{ old('kehadiran') }}"
                               placeholder="0-100"
                               required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label small text-muted fw-medium">Tugas</label>
                        <input type="number"
                               name="tugas"
                               class="form-control border-0 shadow-sm text-center"
                               style="background: #ffffff;"
                               min="0"
                               max="100"
                               value="{{ old('tugas') }}"
                               placeholder="0-100"
                               required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label small text-muted fw-medium">UTS</label>
                        <input type="number"
                               name="uts"
                               class="form-control border-0 shadow-sm text-center"
                               style="background: #ffffff;"
                               min="0"
                               max="100"
                               value="{{ old('uts') }}"
                               placeholder="0-100"
                               required>
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label small text-muted fw-medium">UAS</label>
                        <input type="number"
                               name="uas"
                               class="form-control border-0 shadow-sm text-center"
                               style="background: #ffffff;"
                               min="0"
                               max="100"
                               value="{{ old('uas') }}"
                               placeholder="0-100"
                               required>
                    </div>
                </div>

                <div class="d-flex justify-content-between pt-2">
                    <a href="{{ route('nilai.index') }}"
                       class="btn btn-sm btn-light px-4 rounded-pill border shadow-sm text-muted">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-sm px-4 rounded-pill fw-medium"
                            style="background: #1f2a44; color: #fff;">
                        Simpan Data
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

    function isiNamaOtomatis() {
        var nim = nimInput.value.trim();

        if (nim === "") {
            namaInput.value = "";
            return;
        }

        var opsiTerpilih = document.querySelector('#listMahasiswa option[value="' + nim + '"]');

        if (opsiTerpilih) {
            namaInput.value = opsiTerpilih.getAttribute('data-nama');
        } else {
            var options = document.querySelectorAll('#listMahasiswa option');
            var ketemu = false;

            for (var i = 0; i < options.length; i++) {
                if (options[i].value.trim() === nim) {
                    namaInput.value = options[i].getAttribute('data-nama');
                    ketemu = true;
                    break;
                }
            }

            if (!ketemu) {
                namaInput.value = "";
            }
        }
    }

    nimInput.addEventListener('input', isiNamaOtomatis);
    nimInput.addEventListener('change', isiNamaOtomatis);
    
    // Pemicu awal jika form memuat data lama (old value) pasca-error
    if(nimInput.value !== "") {
        isiNamaOtomatis();
    }

});
</script>

@endsection