<?php

namespace App\Http\Controllers;

use App\Models\KRS;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KRSController extends Controller
{
    public function index(Request $request)
    {
        // Ambil mahasiswa yang sedang login
        $mahasiswa = Mahasiswa::where('nim', session('nim'))->firstOrFail();

        // Semester aktif mahasiswa
        $semesterAktif = $mahasiswa->semester_aktif;

        // Ambil semester dari dropdown, jika tidak ada gunakan semester aktif
        $semester = $request->get('semester', $semesterAktif);

        // Ambil mata kuliah berdasarkan semester yang dipilih
        $mataKuliah = MataKuliah::where('semester', $semester)
            ->orderBy('kode')
            ->get();

        // Cek apakah mahasiswa sudah mengambil KRS
        $sudahAmbil = KRS::where('mahasiswa_id', $mahasiswa->id)
            ->exists();

        return view('mahasiswa.krs.index', compact(
            'mahasiswa',
            'semesterAktif',
            'semester',
            'mataKuliah',
            'sudahAmbil'
        ));
    }

    public function pdf(Request $request)
    {
        // Mahasiswa yang login
        $mahasiswa = Mahasiswa::where('nim', session('nim'))->firstOrFail();

        // Semester aktif
        $semesterAktif = $mahasiswa->semester_aktif;

        // Semester yang dipilih
        $semester = $request->get('semester', $semesterAktif);

        // Mata kuliah sesuai semester
        $mataKuliah = MataKuliah::where('semester', $semester)
            ->orderBy('kode')
            ->get();

        // Total SKS
        $totalSks = $mataKuliah->sum('sks');

        $pdf = Pdf::loadView(
            'mahasiswa.krs.pdf',
            compact(
                'mahasiswa',
                'semesterAktif',
                'semester',
                'mataKuliah',
                'totalSks'
            )
        );

        return $pdf->stream('KRS-Semester-' . $semester . '-' . $mahasiswa->nim . '.pdf');
    }
}