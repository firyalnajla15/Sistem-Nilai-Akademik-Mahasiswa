@extends('layouts.mahasiswa')

@section('title', 'Profil Mahasiswa')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-header" style="background: #1c2b3a; color: white;">
            <h4 class="mb-0">
                <i class="fa-solid fa-user-graduate"></i>
                Profil Mahasiswa
            </h4>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 text-center">

                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                        style="width:120px;height:120px;font-size:48px;font-weight:bold;">

                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}

                    </div>

                    <h4 class="mt-3">
                        {{ Auth::user()->name ?? 'User' }}
                    </h4>

                    <p class="text-muted">
                        {{ Auth::user()->email ?? 'user@email.com' }}
                    </p>

                </div>

                <div class="col-md-9">

                    <table class="table table-bordered">

                        <tr>
                            <th width="30%">Nama Lengkap</th>
                            <td>{{ Auth::user()->name ?? 'Firyal Najla' }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email ?? 'najla@gmail.com' }}</td>
                        </tr>

                        <tr>
                            <th>NIM</th>
                            <td>{{ session('nim') ?? '2401092007' }}</td>
                        </tr>

                        <tr>
                            <th>Program Studi</th>
                            <td>{{ session('jurusan') ?? 'Manajemen Informatika' }}</td>
                        </tr>

                        <tr>
                            <th>Fakultas</th>
                            <td>Teknologi Informasi</td>
                        </tr>

                        <tr>
                            <th>Angkatan</th>
                            <td>2024</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-success">
                                    Mahasiswa Aktif
                                </span>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection