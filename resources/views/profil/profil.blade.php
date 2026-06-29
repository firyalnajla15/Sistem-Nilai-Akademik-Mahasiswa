@extends('layouts.mahasiswa')

@section('title','Profil')

@section('content')

<div class="card">
    <div class="card-body">
        <h1>PROFIL BERHASIL</h1>

        <p>Nama : {{ session('nama') }}</p>
        <p>NIM : {{ session('nim') }}</p>
    </div>
</div>

@endsection