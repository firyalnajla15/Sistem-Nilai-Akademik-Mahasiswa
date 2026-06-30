@extends('mahasiswa.layouts.index')

@section('title', 'KRS')

@section('content')

<div class="container mt-4">
    <div class="welcome-box">
        <h5><i class="fa-solid fa-book-open me-2"></i>Kartu Rencana Studi (KRS)</h5>
        <p class="mb-0 text-light opacity-75">Daftar mata kuliah yang Anda ambil pada semester ini</p>
    </div>

    <div class="card">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #0b1f3a, #1a365d);">
            <span><i class="fa-solid fa-list me-2"></i>Daftar Mata Kuliah</span>
            <span class="badge bg-light text-dark">{{ count($krs) }} Mata Kuliah</span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead style="background: #0b1f3a; color: white;">
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th width="80" class="text-center">SKS</th>
                            <th width="100" class="text-center">Semester</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($krs as $i => $item)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td><span class="badge" style="background: #0b1f3a;">{{ $item->mataKuliah->kode }}</span></td>
                            <td>{{ $item->mataKuliah->nama }}</td>
                            <td class="text-center"><span class="badge" style="background: #0ea5e9;">{{ $item->mataKuliah->sks }}</span></td>
                            <td class="text-center">{{ $item->semester }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox fa-2x d-block mb-2"></i>
                                Belum ada mata kuliah yang diambil
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                    @if(count($krs) > 0)
                    <tfoot style="background: #f0f4f8; font-weight: bold;">
                        <tr>
                            <td colspan="3" class="text-end">Total SKS</td>
                            <td class="text-center"><span class="badge" style="background: #0b1f3a; color: white;">{{ $krs->sum(fn($item) => $item->mataKuliah->sks) }}</span></td>
                            <td></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

@endsection