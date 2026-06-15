<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;

class NilaiMahasiswaController extends Controller
{
    public function create()
    {
        $matkul = MataKuliah::all();
        $mahasiswa = Mahasiswa::all();
        return view('nilai.create', compact('matkul', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matkul_id' => 'required',
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'kehadiran' => 'required',
            'tugas' => 'required',
            'uts' => 'required',
            'uas' => 'required',
        ]);

        $nilai = NilaiMahasiswa::create($request->all());

        // ambil nilai akhir dari DB (generated column)
        $na = $nilai->nilai_akhir;

        // hitung grade
        if ($na >= 85) $grade = 'A';
        elseif ($na >= 70) $grade = 'B';
        elseif ($na >= 60) $grade = 'C';
        elseif ($na >= 50) $grade = 'D';
        else $grade = 'E';

        $nilai->update(['grade' => $grade]);

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai berhasil ditambahkan');
    }

    public function index()
    {
        $data = NilaiMahasiswa::all();
        return view('nilai.index', compact('data'));
    }
}