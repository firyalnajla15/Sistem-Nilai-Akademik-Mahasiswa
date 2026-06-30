<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 7px;
        }

        th {
            background: #eeeeee;
        }

        .center {
            text-align: center;
        }
    </style>

</head>

<body>

    <h2>TRANSKRIP NILAI MAHASASISWA</h2>

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Mata Kuliah</th>
                <th>Semester</th>
                <th>Nilai</th>
                <th>Grade</th>
            </tr>

        </thead>

        <tbody>

            @forelse($data as $item)
                <tr>

                    <td class="center">{{ $loop->iteration }}</td>

                    <td>{{ $item->nim }}</td>

                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>

                    <td>{{ $item->matkul->nama ?? '-' }}</td>

                    <td class="center">{{ $item->matkul->semester ?? '-' }}</td>

                    <td class="center">{{ number_format($item->nilai_akhir, 2) }}</td>

                    <td class="center">{{ $item->grade }}</td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="center">
                        Tidak ada data
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</body>

</html>
