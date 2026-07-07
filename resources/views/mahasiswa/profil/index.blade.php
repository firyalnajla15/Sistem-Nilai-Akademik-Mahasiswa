@extends('mahasiswa.layouts.index')

@section('title', 'Profil Mahasiswa')

@section('content')

<style>
    .profile-header {
        background: linear-gradient(135deg, #1c2b3a, #0f172a);
        color: white;
        border-radius: 12px;
        padding: 25px 30px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 25px;
        flex-wrap: wrap;
    }

    .profile-avatar {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        background: #0ea5e9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        font-weight: bold;
        color: white;
        flex-shrink: 0;
    }

    .profile-info h3 {
        margin: 0 0 5px 0;
        font-size: 22px;
        font-weight: 600;
    }

    .profile-info p {
        margin: 0 0 8px 0;
        opacity: 0.8;
        font-size: 14px;
    }

    .badge-status {
        background: #22c55e;
        color: white;
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 13px;
        display: inline-block;
    }

    .card-profile {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        background: white;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-profile:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .card-profile .card-header {
        background: white;
        border-bottom: 1px solid #f1f5f9;
        font-weight: 600;
        padding: 16px 20px;
        border-radius: 12px 12px 0 0;
        font-size: 16px;
    }

    .card-profile .card-header i {
        color: #0ea5e9;
        margin-right: 8px;
    }

    .card-profile .card-body {
        padding: 20px;
    }

    .table-profile {
        margin: 0;
        width: 100%;
    }

    .table-profile tr {
        border-bottom: 1px solid #f1f5f9;
    }

    .table-profile tr:last-child {
        border-bottom: none;
    }

    .table-profile th {
        padding: 12px 8px 12px 0;
        font-weight: 600;
        color: #64748b;
        font-size: 14px;
        width: 150px;
    }

    .table-profile td {
        padding: 12px 8px;
        color: #1e293b;
        font-size: 14px;
    }

    .badge-aktif {
        background: #22c55e;
        color: white;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        .profile-avatar {
            width: 70px;
            height: 70px;
            font-size: 28px;
        }

        .profile-info h3 {
            font-size: 20px;
        }

        .table-profile th {
            width: 120px;
            font-size: 13px;
        }

        .table-profile td {
            font-size: 13px;
        }
    }

    @media (max-width: 576px) {
        .profile-header {
            padding: 16px;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            font-size: 22px;
        }

        .profile-info h3 {
            font-size: 18px;
        }

        .table-profile th {
            width: 100px;
            font-size: 12px;
            padding: 8px 6px 8px 0;
        }

        .table-profile td {
            font-size: 12px;
            padding: 8px 6px;
        }

        .card-profile .card-header {
            font-size: 14px;
            padding: 12px 16px;
        }

        .card-profile .card-body {
            padding: 14px 16px;
        }
    }
</style>

<!-- Header Profil -->
<div class="profile-header">
    <div class="profile-avatar">
        {{ strtoupper(substr(session('nama'), 0, 1)) }}
    </div>
    <div class="profile-info">
        <h3>{{ session('nama') }}</h3>
        <p><i class="fa-regular fa-id-card me-1"></i> NIM : {{ session('nim') }}</p>
        <span class="badge-status">
            <i class="fa-solid fa-circle-check me-1"></i> Mahasiswa Aktif
        </span>
    </div>
</div>

<!-- Card Profil -->
<div class="row">
    <div class="col-lg-8 mx-auto">

        <div class="card-profile">

            <div class="card-header">
                <i class="fa-regular fa-user"></i> Informasi Mahasiswa
            </div>

            <div class="card-body">

                <table class="table-profile">

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
                            <span class="badge-aktif">
                                <i class="fa-solid fa-circle-check me-1"></i> Aktif
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