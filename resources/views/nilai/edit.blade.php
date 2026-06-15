@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card shadow-sm mx-auto" style="max-width:700px;">
        <div class="card-body">

            <h3>Edit Nilai Mahasiswa</h3>

            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Mata Kuliah</label>
                    <select name="matkul_id" class="form-control" required>

                        @foreach($matkul as $m)

                            <option value="{{ $m->id }}"
                                {{ $nilai->matkul_id == $m->id ? 'selected' : '' }}>
                                {{ $m->nama }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $nilai->nim }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Nama Mahasiswa</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $nilai->nama_mahasiswa }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Kehadiran</label>
                    <input type="number"
                           name="kehadiran"
                           class="form-control"
                           value="{{ $nilai->kehadiran }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Tugas</label>
                    <input type="number"
                           name="tugas"
                           class="form-control"
                           value="{{ $nilai->tugas }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>UTS</label>
                    <input type="number"
                           name="uts"
                           class="form-control"
                           value="{{ $nilai->uts }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>UAS</label>
                    <input type="number"
                           name="uas"
                           class="form-control"
                           value="{{ $nilai->uas }}"
                           required>
                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('nilai.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        Update
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection