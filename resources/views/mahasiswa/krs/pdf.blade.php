<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #eeeeee;
        }

        .info {
            margin-top: 20px;
        }

        .footer {
            margin-top: 60px;
        }
    </style>

</head>

<body>

    <h2>UNIVERSITAS</h2>

    <h3>KARTU RENCANA STUDI (KRS)</h3>

    <hr>

    <div class="info">

        <p><strong>NIM :</strong> {{ $mahasiswa->nim }}</p>

        <p><strong>Nama :</strong> {{ $mahasiswa->nama }}</p>

        <p><strong>Program Studi :</strong> {{ $mahasiswa->prodi }}</p>

        <p><strong>Semester :</strong> {{ $semesterAktif }}</p>

    </div>

    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>Kode</th>

                <th>Mata Kuliah</th>

                <th>SKS</th>

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

            <tr>

                <th colspan="3" style="text-align:right">

                    Total SKS

                </th>

                <th>{{ $totalSks }}</th>

                <th></th>

            </tr>

        </tfoot>

    </table>

    <div class="footer">

        <table style="border:none">

            <tr style="border:none">

                <td style="border:none;text-align:center">

                    Mahasiswa

                    <br><br><br><br>

                    ( {{ $mahasiswa->nama }} )

                </td>

                <td style="border:none;text-align:center">

                    Dosen Pembimbing Akademik

                    <br><br><br><br>

                    (.........................................)

                </td>

            </tr>

        </table>

    </div>

</body>

</html>
