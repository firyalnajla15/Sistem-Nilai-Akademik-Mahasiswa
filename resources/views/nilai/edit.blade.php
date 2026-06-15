@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3 mx-auto" 
         style="max-width: 700px; background: #f8f9fb;">
         
        <div class="card-body p-4">

            <div class="mb-4">
                <h3 class="text-dark fw-semibold mb-1">📝 Edit Nilai Mahasiswa</h3>
                <p class="text-muted small mb-0">Perbarui komponen nilai mahasiswa dengan teliti.</p>
            </div>

            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label small text-muted fw-medium">Mata Kuliah</label>
                    <select name="matkul_id" 
                            class="form-select border-0 shadow-sm" 
                            style="background: #ffffff;" 
                            required>
                        @foreach($matkul as $m)
                            <option value="{{ $m->id }}" {{ $nilai->matkul_id == $m->id ? 'selected' : '' }}>
                                {{ $m->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted fw-medium">NIM Mahasiswa</label>
                    <input type="text"
                           class="form-control border-0 shadow-sm text-dark fw-medium"
                           style="background: #e9edf5;"
                           value="{{ $nilai->nim }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted fw-medium">Nama Mahasiswa</label>
                    <input type="text" 
                           class="form-control border-0 shadow-sm text-dark fw-medium"
                           style="background: #e9edf5;"
                           value="{{ $nilai->nama_mahasiswa }}"
                           readonly>
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
                               value="{{ $nilai->kehadiran }}"
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
                               value="{{ $nilai->tugas }}"
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
                               value="{{ $nilai->uts }}"
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
                               value="{{ $nilai->uas }}"
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
                        Update Data
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection