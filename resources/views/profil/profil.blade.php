@extends('layouts.mahasiswa')

@section('title', 'Profil Mahasiswa')

@section('content')

@php
    // Ambil user yang login
    $user = Auth::user();
    
    // Cari mahasiswa berdasarkan email atau user_id
    $mahasiswa = \App\Models\Mahasiswa::where('email', $user->email)->first();
    
    // Jika tidak ditemukan, coba berdasarkan user_id
    if (!$mahasiswa) {
        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();
    }
    
    // Jika masih tidak ditemukan, coba berdasarkan nim dari session
    if (!$mahasiswa) {
        $mahasiswa = \App\Models\Mahasiswa::where('nim', session('nim'))->first();
    }
    
    // Debug: tampilkan info jika masih kosong
    $debug = [
        'user_email' => $user->email ?? 'tidak ada',
        'user_id' => $user->id ?? 'tidak ada',
        'session_nim' => session('nim') ?? 'tidak ada',
        'mahasiswa_ditemukan' => $mahasiswa ? 'ya' : 'tidak',
    ];
@endphp

<style>
    .profile-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
    }

    .profile-card-header {
        background: linear-gradient(135deg, #0b1f3a, #1c2b3a);
        color: white;
        padding: 18px 25px;
        border-bottom: 3px solid rgba(14, 165, 233, 0.3);
    }

    .profile-card-header h4 {
        font-weight: 600;
        font-size: 18px;
    }

    .profile-card-header h4 i {
        color: #0ea5e9;
        margin-right: 10px;
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0ea5e9, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: white;
        font-size: 44px;
        font-weight: bold;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.3);
    }

    .profile-name {
        font-size: 20px;
        font-weight: 600;
        color: #1c2b3a;
        margin-top: 14px;
        margin-bottom: 2px;
    }

    .profile-email {
        color: #6c757d;
        font-size: 14px;
    }

    .profile-email i {
        color: #0ea5e9;
        margin-right: 5px;
    }

    .profile-table {
        margin-bottom: 0;
    }

    .profile-table tr:hover {
        background: #f8fafc;
    }

    .profile-table th {
        width: 30%;
        background: #f8f9fb;
        color: #1c2b3a;
        font-weight: 600;
        font-size: 13px;
        padding: 12px 18px;
        border-color: #e9ecef;
    }

    .profile-table td {
        color: #2d3748;
        font-size: 13px;
        padding: 12px 18px;
        border-color: #e9ecef;
        font-weight: 500;
    }

    .profile-table th i {
        width: 20px;
        color: #0ea5e9;
        margin-right: 8px;
    }

    .badge-status {
        background: #22c55e;
        color: white;
        padding: 5px 18px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    .badge-status i {
        margin-right: 5px;
    }

    @media (max-width: 768px) {
        .profile-avatar {
            width: 90px;
            height: 90px;
            font-size: 36px;
        }

        .profile-name {
            font-size: 18px;
        }

        .profile-table th {
            width: 40%;
            font-size: 12px;
            padding: 10px 14px;
        }

        .profile-table td {
            font-size: 12px;
            padding: 10px 14px;
        }
    }

    .alert-debug {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        color: #78350f;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
</style>

<div class="container-fluid">

    <div class="card profile-card">

        <!-- Header -->
        <div class="profile-card-header">
            <h4 class="mb-0">
                <i class="fa-solid fa-user-graduate"></i>
                Profil Mahasiswa
            </h4>
        </div>

        <!-- Body -->
        <div class="card-body">

            <!-- Debug Info -->
            @if(!$mahasiswa)
                <div class="alert-debug">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    <strong>Data mahasiswa tidak ditemukan!</strong><br>
                    Email: <code>{{ $debug['user_email'] }}</code><br>
                    User ID: <code>{{ $debug['user_id'] }}</code><br>
                    Session NIM: <code>{{ $debug['session_nim'] }}</code><br>
                    <small class="text-muted">Pastikan tabel mahasiswa memiliki data dengan email yang sama.</small>
                </div>
            @endif

            <div class="row">

                <!-- Avatar Section -->
                <div class="col-md-3 text-center">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>

                    <h4 class="profile-name">
                        {{ Auth::user()->name ?? 'User' }}
                    </h4>

                    <p class="profile-email">
                        <i class="fa-regular fa-envelope"></i>
                        {{ Auth::user()->email ?? 'user@email.com' }}
                    </p>

                </div>

                <!-- Info Section -->
                <div class="col-md-9">

                    <table class="table table-bordered profile-table">

                        <tr>
                            <th><i class="fa-regular fa-user"></i> Nama Lengkap</th>
                            <td>{{ Auth::user()->name ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th><i class="fa-regular fa-envelope"></i> Email</th>
                            <td>{{ Auth::user()->email ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th><i class="fa-regular fa-id-card"></i> NIM</th>
                            <td>
                                @if($mahasiswa)
                                    {{ $mahasiswa->nim }}
                                @else
                                    {{ session('nim') ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th><i class="fa-regular fa-building-columns"></i> Program Studi</th>
                            <td>
                                @if($mahasiswa)
                                    {{ $mahasiswa->prodi }}
                                @else
                                    {{ session('jurusan') ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th><i class="fa-regular fa-building"></i> Fakultas</th>
                            <td>Teknologi Informasi</td>
                        </tr>

                        <tr>
                            <th><i class="fa-regular fa-calendar"></i> Angkatan</th>
                            <td>
                                @if($mahasiswa)
                                    {{ $mahasiswa->angkatan }}
                                @else
                                    {{ session('angkatan') ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th><i class="fa-regular fa-circle-check"></i> Status</th>
                            <td>
                                <span class="badge-status">
                                    <i class="fa-regular fa-circle-check"></i>
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