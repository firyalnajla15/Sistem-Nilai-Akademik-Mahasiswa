<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style>
        /* ===== GLOBAL ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Segoe UI', Arial, sans-serif;
            font-size: 12px;
            padding: 35px 45px;
            background: #ffffff;
            color: #1a1a2e;
            line-height: 1.6;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #0b1f3a;
        }

        .header .institution {
            font-size: 20px;
            font-weight: 800;
            color: #0b1f3a;
            letter-spacing: 1px;
        }

        .header .title {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 2px;
            margin-top: 4px;
        }

        .header .subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        .header .contact {
            font-size: 10px;
            color: #475569;
            margin-top: 4px;
            letter-spacing: 0.3px;
        }

        .header .contact span {
            margin: 0 8px;
            color: #d1d5db;
        }

        /* ===== INFO ===== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .info-table td {
            padding: 4px 8px;
            font-size: 12px;
            border: none;
        }

        .info-table .label {
            font-weight: 600;
            color: #475569;
            width: 120px;
        }

        .info-table .value {
            font-weight: 600;
            color: #0b1f3a;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        table thead th {
            background: #0b1f3a;
            color: #ffffff;
            padding: 8px 10px;
            text-align: center;
            font-weight: 700;
            font-size: 11px;
            border: 1px solid #0b1f3a;
        }

        table tbody td {
            padding: 7px 10px;
            border: 1px solid #d1d5db;
            text-align: center;
            vertical-align: middle;
        }

        table tbody td:nth-child(3) {
            text-align: left;
        }

        table tbody td:nth-child(4) {
            font-weight: 700;
        }

        /* ===== TOTAL ROW ===== */
        .total-row td {
            font-weight: 700;
            padding: 8px 10px;
            border: 1px solid #d1d5db;
            background: #f1f5f9;
        }

        .total-row .total-label {
            text-align: right;
        }

        .total-row .total-value {
            font-size: 13px;
            color: #0b1f3a;
            font-weight: 800;
        }

        /* ===== SIGNATURE ===== */
        .signature {
            margin-top: 50px;
            padding-top: 20px;
            width: 100%;
        }

        .signature table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .signature table td {
            border: none;
            text-align: center;
            vertical-align: bottom;
            padding: 0 20px;
            width: 33.33%;
        }

        .signature .sign-label {
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 35px;
        }

        .signature .sign-line {
            border-top: 1px solid #0b1f3a;
            width: 160px;
            margin: 0 auto 4px auto;
        }

        .signature .sign-name {
            font-weight: 700;
            color: #0b1f3a;
            font-size: 12px;
        }

        .signature .sign-role {
            font-size: 10px;
            color: #6b7280;
        }

        /* ===== FOOTER ===== */
        .page-footer {
            margin-top: 35px;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
            border-top: 1px solid #e2e8f0;
            padding-top: 12px;
        }

        /* ===== PRINT ===== */
        @media print {
            body {
                padding: 25px 35px;
            }

            table thead th {
                background: #0b1f3a !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .total-row td {
                background: #f1f5f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .signature .sign-line {
                border-top: 1px solid #0b1f3a;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
                font-size: 10px;
            }

            .header .institution {
                font-size: 16px;
            }
            .header .title {
                font-size: 13px;
            }
            .header .contact {
                font-size: 9px;
            }
            .header .contact span {
                margin: 0 4px;
            }

            .info-table td {
                font-size: 10px;
                padding: 3px 4px;
            }
            .info-table .label {
                width: 80px;
            }

            table {
                font-size: 9px;
            }
            table thead th {
                padding: 5px 6px;
                font-size: 9px;
            }
            table tbody td {
                padding: 5px 6px;
            }

            .signature table td {
                padding: 0 8px;
            }
            .signature .sign-line {
                width: 100px;
            }
            .signature .sign-label {
                font-size: 10px;
                margin-bottom: 25px;
            }
            .signature .sign-name {
                font-size: 10px;
            }
        }
    </style>

</head>

<body>

    <!-- ===== HEADER ===== -->
    <div class="header">
        <div class="institution">POLITEKNIK NEGERI PADANG</div>
        <div class="title">KARTU RENCANA STUDI (KRS)</div>
        <div class="subtitle">Semester {{ $semesterAktif }} — Tahun Akademik {{ date('Y') }}/{{ date('Y') + 1 }}</div>
        <div class="contact">
            Jl. Kampus PNP, Limau Manis, Kec. Pauh, Kota Padang, Sumatera Barat 25176
            <span>|</span> Telp. (0751) 72590
            <span>|</span> Email: info@pnp.ac.id
            <span>|</span> www.pnp.ac.id
        </div>
    </div>

    <!-- ===== INFO MAHASISWA ===== -->
    <table class="info-table">
        <tr>
            <td class="label">NIM</td>
            <td class="value">: {{ $mahasiswa->nim }}</td>
            <td class="label" style="width:100px;">Semester</td>
            <td class="value">: {{ $semesterAktif }}</td>
        </tr>
        <tr>
            <td class="label">Nama</td>
            <td class="value">: {{ $mahasiswa->nama }}</td>
            <td class="label">Program Studi</td>
            <td class="value">: {{ $mahasiswa->prodi }}</td>
        </tr>
    </table>

    <!-- ===== TABLE MATA KULIAH ===== -->
    <table>
        <thead>
            <tr>
                <th style="width:35px;">No</th>
                <th style="width:80px;">Kode</th>
                <th style="text-align:left;">Mata Kuliah</th>
                <th style="width:50px;">SKS</th>
                <th>Dosen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mataKuliah as $i => $mk)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $mk->kode }}</td>
                    <td>{{ $mk->nama }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->dosen }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="2"></td>
                <td class="total-label">Jumlah SKS</td>
                <td class="total-value">{{ $totalSks }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- ===== SIGNATURE ===== -->
    <div class="signature">
        <table>
            <tr>
                <td>
                    <div class="sign-label">Mahasiswa</div>
                    <div style="height:40px;"></div>
                    <div class="sign-line"></div>
                    <div class="sign-name">{{ $mahasiswa->nama }}</div>
                    <div class="sign-role">NIM. {{ $mahasiswa->nim }}</div>
                </td>
                <td>
                    <div class="sign-label">Dosen Pembimbing Akademik</div>
                    <div style="height:40px;"></div>
                    <div class="sign-line"></div>
                    <div class="sign-name">_________________________</div>
                    <div class="sign-role">NIP. ____________________</div>
                </td>
                <td>
                    <div class="sign-label">Ketua Program Studi</div>
                    <div style="height:40px;"></div>
                    <div class="sign-line"></div>
                    <div class="sign-name">_________________________</div>
                    <div class="sign-role">NIP. ____________________</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="page-footer">
        Dicetak: {{ date('d-m-Y H:i:s') }} &nbsp;|&nbsp; Dokumen sah &nbsp;|&nbsp; KRS {{ $semesterAktif }}
    </div>

</body>

</html>