@extends('mahasiswa.layouts.index')

@section('title','KRS')

@section('content')

<div class="container mt-4">

    <h3>Kartu Rencana Studi (KRS)</h3>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            Daftar Mata Kuliah yang Diambil
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($krs as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item->mataKuliah->kode }}</td>
                        <td>{{ $item->mataKuliah->nama }}</td>
                        <td>{{ $item->mataKuliah->sks }}</td>
                        <td>{{ $item->semester }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada KRS</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection