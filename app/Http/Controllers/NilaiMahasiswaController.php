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

        return view('nilai.create', compact(
            'matkul',
            'mahasiswa'
        ));
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

        $nilai->refresh();

        $na = $nilai->nilai_akhir;

        if ($na >= 95) {
            $grade = 'A+';
        } elseif ($na >= 90) {
            $grade = 'A';
        } elseif ($na >= 85) {
            $grade = 'A-';
        } elseif ($na >= 80) {
            $grade = 'B+';
        } elseif ($na >= 75) {
            $grade = 'B';
        } elseif ($na >= 70) {
            $grade = 'B-';
        } elseif ($na >= 65) {
            $grade = 'C+';
        } elseif ($na >= 60) {
            $grade = 'C';
        } elseif ($na >= 55) {
            $grade = 'C-';
        } elseif ($na >= 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        $nilai->update([
            'grade' => $grade
        ]);

        return redirect()
            ->route('nilai.index')
            ->with('success', 'Nilai berhasil ditambahkan');
    }

    public function index()
    {
        $data = NilaiMahasiswa::with('matkul')->get();

        return view('nilai.index', compact('data'));
    }

    public function edit($id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);
        $matkul = MataKuliah::all();

        return view('nilai.edit', compact(
            'nilai',
            'matkul'
        ));
    }

    public function update(Request $request, $id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);

        $nilai->update([
            'matkul_id' => $request->matkul_id,
            'kehadiran' => $request->kehadiran,
            'tugas' => $request->tugas,
            'uts' => $request->uts,
            'uas' => $request->uas,
        ]);

        $nilai->refresh();

        $na = $nilai->nilai_akhir;

        if ($na >= 95) {
            $grade = 'A+';
        } elseif ($na >= 90) {
            $grade = 'A';
        } elseif ($na >= 85) {
            $grade = 'A-';
        } elseif ($na >= 80) {
            $grade = 'B+';
        } elseif ($na >= 75) {
            $grade = 'B';
        } elseif ($na >= 70) {
            $grade = 'B-';
        } elseif ($na >= 65) {
            $grade = 'C+';
        } elseif ($na >= 60) {
            $grade = 'C';
        } elseif ($na >= 55) {
            $grade = 'C-';
        } elseif ($na >= 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        $nilai->update([
            'grade' => $grade
        ]);

        return redirect()
            ->route('nilai.index')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);

        $nilai->delete();

        return redirect()
            ->route('nilai.index')
            ->with('success', 'Data berhasil dihapus');
    }
}