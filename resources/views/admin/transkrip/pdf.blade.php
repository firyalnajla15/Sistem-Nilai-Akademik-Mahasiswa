<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .header p {
            margin: 3px 0;
            font-size: 12px;
        }

        .info {
            width: 100%;
            margin-bottom: 20px;
        }

        .info td {
            padding: 4px 0;
            border: none;
        }

        .info .label {
            width: 120px;
            font-weight: bold;
        }

        table.nilai {
            width: 100%;
            border-collapse: collapse;
        }

        table.nilai th {
            background: #1e3a8a;
            color: white;
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
        }

        table.nilai td {
            border: 1px solid #000;
            padding: 7px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 35px;
            width: 100%;
        }

        .signature {
            width: 250px;
            float: right;
            text-align: center;
        }

        .signature p {
            margin: 4px 0;
        }
    </style>

</head>

<body>

    <div class="header">
        <h2>TRANSKRIP NILAI MAHASASISWA</h2>
        <p>Sistem Nilai Akademik Mahasiswa</p>
        <hr>
    </div>

    @php
        $mhs = $data->first();
    @endphp

    @if($mhs)

    <table class="info">
        <tr>
            <td class="label">NIM</td>
            <td>: {{ $mhs->nim }}</td>
        </tr>
        <tr>
            <td class="label">Nama Mahasiswa</td>
            <td>: {{ $mhs->mahasiswa->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Program Studi</td>
            <td>: {{ $mhs->mahasiswa->prodi ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Angkatan</td>
            <td>: {{ $mhs->mahasiswa->angkatan ?? '-' }}</td>
        </tr>
    </table>

    @endif

    <table class="nilai">

        <thead>
            <tr>
                <th width="6%">No</th>
                <th>Mata Kuliah</th>
                <th width="12%">Semester</th>
                <th width="15%">Nilai Akhir</th>
                <th width="12%">Grade</th>
            </tr>
        </thead>

        <tbody>

            @forelse($data as $item)

            <tr>
                <td class="center">{{ $loop->iteration }}</td>

                <td>{{ $item->matkul->nama ?? '-' }}</td>

                <td class="center">{{ $item->matkul->semester ?? '-' }}</td>

                <td class="center">{{ number_format($item->nilai_akhir,2) }}</td>

                <td class="center">{{ $item->grade }}</td>
            </tr>

            @empty

            <tr>
                <td colspan="5" class="center">
                    Tidak ada data nilai.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

    <table style="margin-top:20px;border:none;">
        <tr>
            <td style="border:none;font-weight:bold;">
                Total Mata Kuliah
            </td>
            <td style="border:none;">
                : {{ $data->count() }}
            </td>
        </tr>
    </table>

    <div class="footer">

        <div class="signature">

            <p>______________, {{ date('d F Y') }}</p>

            <p>Mengetahui,</p>

            <br><br><br>

            <p><strong>Admin Akademik</strong></p>

        </div>

    </div>

</body>

</html>