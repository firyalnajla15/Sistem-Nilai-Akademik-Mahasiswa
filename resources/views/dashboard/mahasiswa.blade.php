@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Dashboard Mahasiswa</h2>

    <div class="card">
        <div class="card-body">

            <h4>Selamat Datang</h4>

            <p>
                Nama :
                <strong>{{ session('nama') }}</strong>
            </p>

            <p>
                NIM :
                <strong>{{ session('nim') }}</strong>
            </p>

            <a href="{{ route('mahasiswa.logout') }}"
               class="btn btn-danger">
                Logout
            </a>

        </div>
    </div>

</div>
@endsection