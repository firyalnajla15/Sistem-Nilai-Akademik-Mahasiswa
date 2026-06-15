@extends('layouts.app')

@section('content')

<div class="container">

<h3>Data Nilai Mahasiswa</h3>

<a href="{{ route('nilai.create') }}" class="btn btn-success mb-3">
    + Input Nilai
</a>

<table class="table table-bordered">
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Nilai Akhir</th>
        <th>Grade</th>
    </tr>

    @foreach($data as $n)
    <tr>
        <td>{{ $n->nim }}</td>
        <td>{{ $n->nama_mahasiswa }}</td>
        <td>{{ $n->nilai_akhir }}</td>
        <td>{{ $n->grade }}</td>
    </tr>
    @endforeach

</table>

</div>

@endsection