@extends('mahasiswa.layouts.index')

@section('title', 'Profil Mahasiswa')

@section('content')

<style>
    .profile-header{
        background: linear-gradient(135deg,#1c2b3a,#0f172a);
        color:white;
        border-radius:15px;
        padding:30px;
        margin-bottom:25px;
    }

    .profile-avatar{
        width:100px;
        height:100px;
        border-radius:50%;
        background:#0ea5e9;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:42px;
        font-weight:bold;
        color:white;
        margin:auto;
    }

    .profile-card{
        border:none;
        border-radius:15px;
        box-shadow:0 4px 18px rgba(0,0,0,.08);
    }

    .profile-card .card-header{
        background:white;
        border-bottom:1px solid #eee;
        font-weight:600;
        font-size:18px;
    }

    .table-profile th{
        width:220px;
        color:#6c757d;
        font-weight:600;
    }

    .table-profile td{
        font-weight:500;
        color:#1c2b3a;
    }

    .badge-status{
        background:#22c55e;
        color:white;
        padding:6px 15px;
        border-radius:20px;
        font-size:13px;
    }

    .info-box{
        border-radius:12px;
        padding:20px;
        text-align:center;
        color:white;
    }

    .bg1{background:#0ea5e9;}
    .bg2{background:#22c55e;}
    .bg3{background:#f59e0b;}

    .info-box h3{
        margin:10px 0 0;
        font-size:26px;
        font-weight:700;
    }

    .info-box p{
        margin:0;
        opacity:.9;
    }
</style>

<div class="profile-header">
    <div class="row align-items-center">

        <div class="col-md-2 text-center">
            <div class="profile-avatar">
                {{ strtoupper(substr(session('nama'),0,1)) }}
            </div>
        </div>

        <div class="col-md-10">
            <h3 class="mb-1">{{ session('nama') }}</h3>

            <p class="mb-2">
                NIM : {{ session('nim') }}
            </p>

            <span class="badge-status">
                <i class="fa-solid fa-circle-check"></i>
                Mahasiswa Aktif
            </span>
        </div>

    </div>
</div>

<div class="row">

    <div class="col-lg-8">

        <div class="card profile-card">

            <div class="card-header">
                <i class="fa-solid fa-user me-2"></i>
                Informasi Mahasiswa
            </div>

            <div class="card-body">

                <table class="table table-borderless table-profile">

                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ session('nama') }}</td>
                    </tr>

                    <tr>
                        <th>NIM</th>
                        <td>{{ session('nim') }}</td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td>{{ session('jurusan') }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection