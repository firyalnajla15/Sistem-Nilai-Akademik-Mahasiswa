<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KRSController extends Controller
{
    public function index()
    {
        // Ambil mahasiswa yang sedang login
        $mahasiswa = Mahasiswa::where('nim', session('nim'))->firstOrFail();

        // Semester aktif (sementara dihitung otomatis)
        $semesterAktif = $mahasiswa->semester_aktif;

        // Mata kuliah paket semester tersebut
        $mataKuliah = MataKuliah::where('semester', $semesterAktif)->get();

        // Cek apakah mahasiswa sudah mengambil KRS
        $sudahAmbil = KRS::where('mahasiswa_id', $mahasiswa->id)
            ->exists();

        return view('mahasiswa.krs.index', compact(
            'mahasiswa',
            'semesterAktif',
            'mataKuliah',
            'sudahAmbil'
        ));
    }
    public function pdf()
{
    // Mahasiswa yang login
    $mahasiswa = Mahasiswa::where('nim', session('nim'))->firstOrFail();

    // Semester aktif
    $semesterAktif = $mahasiswa->semester_aktif;

    // Paket mata kuliah semester aktif
    $mataKuliah = MataKuliah::where('semester', $semesterAktif)->get();

    // Total SKS
    $totalSks = $mataKuliah->sum('sks');

    $pdf = Pdf::loadView(
        'mahasiswa.krs.pdf',
        compact(
            'mahasiswa',
            'semesterAktif',
            'mataKuliah',
            'totalSks'
        )
    );

    return $pdf->stream('KRS-' . $mahasiswa->nim . '.pdf');
}
}