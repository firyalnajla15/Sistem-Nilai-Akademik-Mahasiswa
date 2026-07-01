@extends('mahasiswa.layouts.index')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="welcome-box mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">
                    <i class="fas fa-bell me-2"></i>
                    Semua Notifikasi
                </h5>
                <p class="text-light opacity-75 mb-0" style="font-size: 14px;">
                    Kelola semua pemberitahuan akademik Anda
                </p>
            </div>
            <span class="badge bg-primary px-3 py-2" style="font-size: 14px;">
                <i class="fas fa-envelope me-1"></i>
                {{ $notifikasi->count() }} Notifikasi
            </span>
        </div>
    </div>

    <!-- Notifikasi Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            @forelse($notifikasi as $item)

                <div class="border-bottom p-4 notification-item-wrapper {{ !$item->dibaca ? 'bg-light' : '' }}" 
                     style="transition: all 0.3s ease;">

                    <div class="d-flex gap-3" style="flex: 1;">
                        <!-- Icon berdasarkan jenis -->
                        <div class="notification-icon-wrapper" style="flex-shrink: 0;">
                            @switch($item->jenis)
                                @case('nilai')
                                    <div class="card-icon bg-soft-success">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    @break
                                @case('krs')
                                    <div class="card-icon bg-soft-warning">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    @break
                                @default
                                    <div class="card-icon bg-soft-primary">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                            @endswitch
                        </div>

                        <!-- Konten -->
                        <div style="flex: 1;">
                            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                <h5 class="mb-0" style="font-weight: 600; color: #1c2b3a;">
                                    {{ $item->judul }}
                                </h5>
                                @if(!$item->dibaca)
                                    <span class="badge bg-danger px-2 py-1" style="font-size: 10px; animation: pulse-badge 2s infinite;">
                                        <i class="fas fa-circle me-1" style="font-size: 6px;"></i>
                                        Baru
                                    </span>
                                @else
                                    <span class="badge bg-success px-2 py-1" style="font-size: 10px;">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Dibaca
                                    </span>
                                @endif
                                <span class="badge px-2 py-1" style="font-size: 10px; 
                                    @switch($item->jenis)
                                        @case('nilai')
                                            background: #22c55e; color: white;
                                            @break
                                        @case('krs')
                                            background: #eab308; color: #1c2b3a;
                                            @break
                                        @default
                                            background: #0ea5e9; color: white;
                                    @endswitch
                                ">
                                    @switch($item->jenis)
                                        @case('nilai')
                                            <i class="fas fa-star me-1"></i>Nilai
                                            @break
                                        @case('krs')
                                            <i class="fas fa-book me-1"></i>KRS
                                            @break
                                        @default
                                            <i class="fas fa-info-circle me-1"></i>Informasi
                                    @endswitch
                                </span>
                            </div>

                            <p class="mb-2" style="color: #4a5568; font-size: 14px; line-height: 1.6;">
                                {{ $item->pesan }}
                            </p>

                            <div class="d-flex align-items-center gap-3">
                                <small class="text-muted" style="font-size: 12px;">
                                    <i class="far fa-clock me-1"></i>
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </small>
                                @if(!$item->dibaca)
                                    <small class="text-primary" style="font-size: 11px; font-weight: 500;">
                                        <i class="fas fa-circle me-1" style="font-size: 6px;"></i>
                                        Belum dibaca
                                    </small>
                                @else
                                    <small class="text-muted" style="font-size: 11px;">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Telah dibaca
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            @empty

                <div class="text-center py-5">
                    <div class="mb-4" style="font-size: 60px; color: #cbd5e1;">
                        <i class="fas fa-bell-slash"></i>
                    </div>
                    <h5 style="font-weight: 600; color: #1c2b3a;">
                        Belum Ada Notifikasi
                    </h5>
                    <p class="text-muted" style="font-size: 14px; max-width: 400px; margin: 0 auto;">
                        Semua pemberitahuan akademik seperti pengumuman nilai, KRS, dan informasi penting lainnya akan muncul di sini.
                    </p>
                    <div class="mt-3">
                        <i class="fas fa-arrow-right text-primary me-1"></i>
                        <small class="text-muted">Refresh halaman untuk notifikasi terbaru</small>
                    </div>
                </div>

            @endforelse

        </div>

        @if($notifikasi->hasPages())
            <div class="card-footer bg-transparent border-0 pt-0">
                <div class="d-flex justify-content-center">
                    {{ $notifikasi->links() }}
                </div>
            </div>
        @endif

    </div>

    <!-- Tombol Refresh -->
    @if($notifikasi->count() > 0)
    <div class="row mt-3">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-secondary btn-sm" 
                        style="border-radius: 8px; font-size: 13px;"
                        onclick="window.location.reload()">
                    <i class="fas fa-sync me-1"></i>
                    Refresh
                </button>
            </div>
        </div>
    </div>
    @endif

</div>

<!-- ====== Style Tambahan ====== -->
<style>
    .notification-item-wrapper {
        transition: all 0.3s ease;
        cursor: default !important;
    }
    
    .notification-item-wrapper:last-child {
        border-bottom: none !important;
    }

    .card-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .bg-soft-success {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
    }

    .bg-soft-warning {
        background: rgba(234, 179, 8, 0.1);
        color: #eab308;
    }

    .bg-soft-primary {
        background: rgba(14, 165, 233, 0.1);
        color: #0ea5e9;
    }

    .bg-soft-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    @keyframes pulse-badge {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    /* Responsive */
    @media (max-width: 576px) {
        .notification-item-wrapper {
            padding: 16px !important;
        }
        
        .notification-item-wrapper h5 {
            font-size: 14px;
        }
        
        .notification-item-wrapper p {
            font-size: 13px !important;
        }
        
        .card-icon {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }
    }
</style>

@endsection