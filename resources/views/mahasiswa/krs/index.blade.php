@extends('mahasiswa.layouts.index')

@section('title', 'KRS')

@section('content')

<div class="container mt-4">

    <div class="welcome-box">
        <h5>
            <i class="fa-solid fa-book-open me-2"></i>
            Kartu Rencana Studi (KRS)
        </h5>

        <p class="mb-0 text-light opacity-75">
            Paket Mata Kuliah Semester {{ $semesterAktif }}
        </p>
    </div>

    <div class="card shadow">

        <div class="card-header text-white d-flex justify-content-between align-items-center"
    style="background: linear-gradient(135deg,#0b1f3a,#1a365d);">

    <span>
        <i class="fa-solid fa-list me-2"></i>
        Daftar Mata Kuliah
    </span>

    <div>
        <a href="{{ route('mahasiswa.krs.pdf') }}"
            class="btn btn-danger btn-sm"
            target="_blank">

            <i class="fa-solid fa-file-pdf me-1"></i>
            Cetak KRS
        </a>

        <span class="badge bg-light text-dark ms-2">
    {{ $mataKuliah->count() }} Mata Kuliah
</span>
    </div>

</div>

        <div class="card-body">

            <div class="mb-3">

                <strong>Nama :</strong> {{ $mahasiswa->nama }}

                <br>

                <strong>NIM :</strong> {{ $mahasiswa->nim }}

                <br>

                <strong>Program Studi :</strong> {{ $mahasiswa->prodi }}

            </div>

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Mata Kuliah</th>

                        <th>SKS</th>

                    </tr>

                </thead>

                <tbody>

                    @php $total = 0; @endphp

                    @foreach($mataKuliah as $i => $mk)

                        @php $total += $mk->sks; @endphp

                        <tr>

                            <td>{{ $i+1 }}</td>

                            <td>{{ $mk->kode }}</td>

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

                        <th>{{ $total }}</th>

                    </tr>

                </tfoot>

            </table>

            <div class="text-end mt-4">

                @if($sudahAmbil)

                    <button class="btn btn-success" disabled>

                        <i class="fa-solid fa-check"></i>

                        KRS Sudah Diambil

                    </button>

                @else

                    <form action="{{ route('krs.store') }}" method="POST">

                        @csrf

                        <button class="btn btn-primary">

                            <i class="fa-solid fa-book"></i>

                            Ambil KRS

                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection