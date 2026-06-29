@extends('admin.layouts.app')

@section('content')

<style>
    .profile-card {
        max-width: 700px;
        margin: 0 auto;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
    }

    .profile-header {
        background: linear-gradient(135deg, #0b1f3a, #1c2b3a);
        padding: 30px 20px 25px;
        text-align: center;
    }

    .profile-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        border: 3px solid rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        color: white;
        font-size: 36px;
    }

    .profile-name {
        color: white;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .profile-role {
        color: rgba(255, 255, 255, 0.6);
        font-size: 13px;
    }

    .profile-role i {
        color: #0ea5e9;
        margin-right: 5px;
    }

    .profile-body {
        padding: 25px 30px;
        background: white;
    }

    .profile-item {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #f0f2f5;
    }

    .profile-item:last-child {
        border-bottom: none;
    }

    .profile-item-label {
        width: 120px;
        font-weight: 600;
        color: #6c757d;
        font-size: 13px;
        flex-shrink: 0;
    }

    .profile-item-label i {
        width: 20px;
        color: #0ea5e9;
        margin-right: 6px;
    }

    .profile-item-value {
        flex: 1;
        color: #1c2b3a;
        font-size: 13px;
        font-weight: 500;
    }

    .badge-admin {
        background: #0b1f3a;
        color: white;
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-admin i {
        margin-right: 4px;
        color: #0ea5e9;
    }

    @media (max-width: 576px) {
        .profile-body {
            padding: 18px;
        }
        .profile-item {
            flex-direction: column;
            gap: 4px;
        }
        .profile-item-label {
            width: 100%;
        }
    }
</style>

<div class="container py-4">

    <div class="profile-card">

        <!-- Header -->
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="profile-name">{{ auth()->user()->name }}</div>
            <div class="profile-role">
                <i class="fa-solid fa-shield-halved"></i>
                Administrator Sistem Akademik
            </div>
        </div>

        <!-- Body -->
        <div class="profile-body">

            <div class="profile-item">
                <div class="profile-item-label">
                    <i class="fa-solid fa-id-card"></i> ID Pengguna
                </div>
                <div class="profile-item-value">#{{ auth()->id() }}</div>
            </div>

            <div class="profile-item">
                <div class="profile-item-label">
                    <i class="fa-solid fa-user"></i> Nama
                </div>
                <div class="profile-item-value">{{ auth()->user()->name }}</div>
            </div>

            <div class="profile-item">
                <div class="profile-item-label">
                    <i class="fa-solid fa-envelope"></i> Email
                </div>
                <div class="profile-item-value">{{ auth()->user()->email }}</div>
            </div>

            <div class="profile-item">
                <div class="profile-item-label">
                    <i class="fa-solid fa-user-tag"></i> Role
                </div>
                <div class="profile-item-value">
                    <span class="badge-admin">
                        <i class="fa-solid fa-crown"></i> Admin
                    </span>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection