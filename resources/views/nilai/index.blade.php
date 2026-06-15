@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Nilai Mahasiswa</h2>

        <a href="{{ route('nilai.create') }}" class="btn btn-primary">
            + Input Nilai
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Mata Kuliah</th>
                            <th>Kehadiran</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($data as $index => $n)

                        <tr>

                            <td>{{ $index + 1 }}</td>

                            <td>{{ $n->nim }}</td>

                            <td>{{ $n->nama_mahasiswa }}</td>

                            <td>
                                {{ $n->matkul->nama ?? '-' }}
                            </td>

                            <td>{{ $n->kehadiran }}</td>

                            <td>{{ $n->tugas }}</td>

                            <td>{{ $n->uts }}</td>

                            <td>{{ $n->uas }}</td>

                            <td>{{ $n->nilai_akhir }}</td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $n->grade }}
                                </span>
                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a href="{{ route('nilai.edit', $n->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('nilai.destroy', $n->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="11" class="text-center">
                                Belum ada data nilai
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