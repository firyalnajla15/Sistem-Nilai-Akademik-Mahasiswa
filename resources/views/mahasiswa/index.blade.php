@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3"
         style="background:#f8f9fb;">

        <div class="card-body">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 fw-semibold text-dark">👤 Data Mahasiswa</h3>

                <a href="{{ route('mahasiswa.create') }}"
                   class="btn btn-sm px-3 rounded-pill"
                   style="background:#1f2a44; color:#fff;">
                    + Tambah
                </a>
            </div>

            <!-- Alert -->
            @if(session('success'))
                <div class="alert py-2 border-0"
                     style="background:#e9edf5; color:#1f2a44;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('mahasiswa.index') }}" class="row mb-3">

    <div class="col-md-4">
        <select name="prodi" class="form-select">
            <option value="">Semua Prodi</option>

            @foreach($prodis as $prodi)
                <option value="{{ $prodi }}"
                    {{ request('prodi') == $prodi ? 'selected' : '' }}>
                    {{ $prodi }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="angkatan" class="form-select">
            <option value="">Semua Angkatan</option>

            @foreach($angkatans as $angkatan)
                <option value="{{ $angkatan }}"
                    {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                    {{ $angkatan }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <button type="submit"
                class="btn w-100"
                style="background:#1f2a44;color:white;">
            Filter
        </button>
    </div>

    <div class="col-md-2">
        <a href="{{ route('mahasiswa.index') }}"
           class="btn btn-secondary w-100">
            Reset
        </a>
    </div>

</form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle"
                       style="border-color:#e5e7eb;">

                    <thead style="background:#1f2a44; color:#fff;">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody style="background:#ffffff;">
                    @forelse($data as $item)
                        <tr>

                            <td class="fw-semibold text-dark">{{ $item->nim }}</td>
                            <td class="text-dark">{{ $item->nama }}</td>
                            <td class="text-muted">{{ $item->prodi }}</td>

                            <td>
                                <span class="badge"
                                      style="background:#eef2f7; color:#1f2a44;">
                                    {{ $item->angkatan }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex gap-2 justify-content-center">

                                    <a href="{{ route('mahasiswa.edit', $item->id) }}"
                                       class="btn btn-sm rounded-pill px-3"
                                       style="background:#1f2a44; color:#fff;">
                                        Edit
                                    </a>

                                    <form action="{{ route('mahasiswa.destroy', $item->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm rounded-pill px-3"
                                                style="background:#b23b3b; color:#fff;"
                                                onclick="return confirm('Hapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada data mahasiswa
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection