@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="mb-3">📚 Data Mata Kuliah</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('mata-kuliah.create', ['semester' => $selectedSemester ?? 'all']) }}" class="btn btn-success mb-3">
            + Tambah Mata Kuliah
        </a>

        <form method="GET" action="{{ route('mata-kuliah.index') }}" class="row g-2 mb-3" id="filterForm">
            <div class="col-md-4">
                <label for="semester" class="form-label">Pilih Semester</label>
                <select name="semester" id="semester" class="form-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="all" {{ empty($selectedSemester) || $selectedSemester === 'all' ? 'selected' : '' }}>Semua Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ (string) $selectedSemester === (string) $i ? 'selected' : '' }}>
                            Semester {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Tahun Akademik</th>
                        <th>Dosen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->sks }}</td>
                        <td>{{ $item->semester }}</td>
                        <td>{{ $item->tahun_akademik }}</td>
                        <td>{{ $item->dosen }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('mata-kuliah.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('mata-kuliah.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection