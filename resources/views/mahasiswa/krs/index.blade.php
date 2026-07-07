@extends('mahasiswa.layouts.index')

@section('title', 'KRS')

@section('content')

<style>
    .krs-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .welcome-box {
        background: linear-gradient(135deg, #0b1f3a, #1a365d);
        border-radius: 16px;
        padding: 24px 30px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(11, 31, 58, 0.15);
    }

    .welcome-box::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(56, 189, 248, 0.05);
        border-radius: 50%;
    }

    .welcome-box::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: 10%;
        width: 200px;
        height: 200px;
        background: rgba(139, 92, 246, 0.04);
        border-radius: 50%;
    }

    .welcome-box h5 {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 4px;
        position: relative;
        z-index: 1;
    }

    .welcome-box p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        position: relative;
        z-index: 1;
    }

    .card-krs {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-krs .card-header {
        background: linear-gradient(135deg, #0b1f3a, #1a365d);
        padding: 16px 24px;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .card-krs .card-header .header-title {
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-krs .card-header .header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-pdf {
        background: #dc2626;
        color: white;
        border: none;
        padding: 6px 18px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-pdf:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        color: white;
    }

    .badge-count {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .card-krs .card-body {
        padding: 24px;
        background: #ffffff;
    }

    .info-mahasiswa {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
        display: flex;
        flex-wrap: wrap;
        gap: 20px 40px;
    }

    .info-mahasiswa .info-item {
        display: flex;
        align-items: baseline;
        gap: 6px;
    }

    .info-mahasiswa .info-item .label {
        color: #64748b;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .info-mahasiswa .info-item .value {
        color: #1a2a3a;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .info-mahasiswa .info-item .value .badge-prodi {
        background: #eaf1f8;
        color: #1a3a5c;
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .table-krs {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .table-krs thead th {
        background: #f1f5f9;
        color: #1a2a3a;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        border-bottom: 2px solid #e2e8f0;
        text-align: center;
    }

    .table-krs tbody td {
        padding: 10px 16px;
        vertical-align: middle;
        text-align: center;
        border-bottom: 1px solid #f1f5f9;
        color: #1a2a3a;
        font-size: 0.9rem;
    }

    .table-krs tbody tr:hover td {
        background: #f8fafc;
    }

    .table-krs tbody td:nth-child(3) {
        text-align: left;
        font-weight: 500;
    }

    .table-krs tbody td:nth-child(4) {
        font-weight: 700;
        color: #1a3a5c;
    }

    .kode-mk {
        background: #eaf1f8;
        padding: 2px 10px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #1a3a5c;
        display: inline-block;
    }

    .table-krs tfoot th {
        background: #f8fafc;
        padding: 12px 16px;
        font-weight: 700;
        color: #1a3a5c;
        font-size: 0.95rem;
        border-top: 2px solid #e2e8f0;
    }

    .table-krs tfoot th.total-value {
        color: #1a3a5c;
        font-size: 1.1rem;
        background: #eaf1f8;
        border-radius: 30px;
        padding: 2px 16px;
        display: inline-block;
        line-height: 1.8;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 12px;
    }

    .empty-state h6 {
        color: #64748b;
        font-weight: 600;
    }

    .empty-state p {
        color: #94a3b8;
        font-size: 0.9rem;
    }

    .footer-krs {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .footer-krs .info-cetak {
        color: #94a3b8;
        font-size: 0.8rem;
    }

    .footer-krs .info-cetak i {
        color: #64748b;
    }

    @media (max-width: 768px) {
        .welcome-box {
            padding: 18px 20px;
        }

        .welcome-box h5 {
            font-size: 1.1rem;
        }

        .card-krs .card-header {
            padding: 14px 18px;
            flex-direction: column;
            align-items: flex-start;
        }

        .card-krs .card-body {
            padding: 16px;
        }

        .info-mahasiswa {
            flex-direction: column;
            gap: 6px;
            padding: 14px 16px;
        }

        .table-krs {
            font-size: 0.8rem;
        }

        .table-krs thead th,
        .table-krs tbody td {
            padding: 8px 10px;
        }

        .btn-pdf {
            font-size: 0.75rem;
            padding: 5px 14px;
        }

        .footer-krs {
            flex-direction: column;
            text-align: center;
        }
    }

    @media print {
        .welcome-box {
            background: #0b1f3a !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .card-krs .card-header {
            background: #0b1f3a !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .btn-pdf,
        .btn-print {
            display: none !important;
        }

        .table-krs thead th {
            background: #f1f5f9 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .card-krs {
            box-shadow: none !important;
            border: 1px solid #e2e8f0;
        }

        .info-mahasiswa {
            background: #f8fafc !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<div class="container mt-4 krs-container">

    <!-- ===== WELCOME BOX ===== -->
    <div class="welcome-box">
        <h5>
            <i class="fa-solid fa-book-open me-2"></i>
            Kartu Rencana Studi (KRS)
        </h5>
        <p class="mb-0 text-light opacity-75">
            Paket Mata Kuliah Semester {{ $semesterAktif }}
        </p>
    </div>

    <!-- ===== CARD KRS ===== -->
    <div class="card card-krs shadow">

        <!-- ===== HEADER ===== -->
        <div class="card-header">
            <div class="header-title">
                <i class="fa-solid fa-list me-2"></i>
                Daftar Mata Kuliah
            </div>
            <div class="header-actions">
                <a href="{{ route('mahasiswa.krs.pdf') }}"
                   class="btn-pdf"
                   target="_blank">
                    <i class="fa-solid fa-file-pdf me-1"></i>
                    Cetak KRS
                </a>
                <span class="badge-count">
                    {{ $mataKuliah->count() }} Mata Kuliah
                </span>
            </div>
        </div>

        <!-- ===== BODY ===== -->
        <div class="card-body">

            <!-- ===== INFO MAHASISWA ===== -->
            <div class="info-mahasiswa">
                <div class="info-item">
                    <span class="label">Nama</span>
                    <span class="value">{{ $mahasiswa->nama }}</span>
                </div>
                <div class="info-item">
                    <span class="label">NIM</span>
                    <span class="value">{{ $mahasiswa->nim }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Program Studi</span>
                    <span class="value">
                        <span class="badge-prodi">{{ $mahasiswa->prodi }}</span>
                    </span>
                </div>
                <div class="info-item">
                    <span class="label">Semester</span>
                    <span class="value">{{ $semesterAktif }}</span>
                </div>
            </div>

            <!-- ===== TABLE ===== -->
            @if($mataKuliah->count() > 0)
                <div class="table-responsive">
                    <table class="table table-krs">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th style="width:100px;">Kode</th>
                                <th style="text-align:left;">Mata Kuliah</th>
                                <th style="width:70px;">SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($mataKuliah as $i => $mk)
                                @php $total += $mk->sks; @endphp
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td><span class="kode-mk">{{ $mk->kode }}</span></td>
                                    <td>{{ $mk->nama }}</td>
                                    <td>{{ $mk->sks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">
                                    Total SKS
                                </th>
                                <th>
                                    <span class="total-value">{{ $total }}</span>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-regular fa-folder-open"></i>
                    <h6>Belum Ada Mata Kuliah</h6>
                    <p>Belum ada mata kuliah yang ditambahkan untuk semester ini.</p>
                </div>
            @endif

            <!-- ===== FOOTER ===== -->
            <div class="footer-krs">
                <div class="info-cetak">
                    <i class="fa-regular fa-calendar-check me-1"></i>
                    Dicetak: {{ date('d-m-Y H:i:s') }}
                </div>
                <div class="info-cetak">
                    <i class="fa-regular fa-file-lines me-1"></i>
                    Dokumen sah KRS {{ $semesterAktif }}
                </div>
            </div>

        </div>
    </div>

</div>

@endsection