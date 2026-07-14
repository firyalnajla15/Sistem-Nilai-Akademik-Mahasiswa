<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Notifikasi;

class NilaiMahasiswaController extends Controller
{
    public function create()
    {
        $matkul = MataKuliah::all();
        $mahasiswa = Mahasiswa::all();

        return view('admin.nilai.create', compact(
            'matkul',
            'mahasiswa'
        ));
    }

    public function store(Request $request)
{
    $request->validate([
        'nim' => 'required',
        'nama_mahasiswa' => 'required',
        'semester' => 'required|integer|min:1|max:8',
        'nilai' => 'required|array',
    ]);

    // Cek apakah semester ini sudah pernah diinput
    $cekSemester = NilaiMahasiswa::where('nim', $request->nim)
        ->whereHas('matkul', function ($q) use ($request) {
            $q->where('semester', $request->semester);
        })
        ->exists();

    if ($cekSemester) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Nilai mahasiswa untuk semester ' . $request->semester . ' sudah pernah diinput.');
    }

    foreach ($request->nilai as $matkul_id => $nilai) {

        $kehadiran = $nilai['kehadiran'] ?? 0;
        $tugas      = $nilai['tugas'] ?? 0;
        $uts        = $nilai['uts'] ?? 0;
        $uas        = $nilai['uas'] ?? 0;

        $nilaiAkhir = ($kehadiran * 0.10)
                    + ($tugas * 0.20)
                    + ($uts * 0.30)
                    + ($uas * 0.40);

        $grade = $this->getGrade($nilaiAkhir);

        NilaiMahasiswa::create([
            'nim'             => $request->nim,
            'nama_mahasiswa'  => $request->nama_mahasiswa,
            'matkul_id'       => $matkul_id,
            'kehadiran'       => $kehadiran,
            'tugas'           => $tugas,
            'uts'             => $uts,
            'uas'             => $uas,
            'nilai_akhir'     => $nilaiAkhir,
            'grade'           => $grade,
        ]);

        $matkul = MataKuliah::find($matkul_id);

        if ($matkul) {
            Notifikasi::create([
                'nim'     => $request->nim,
                'judul'   => 'Nilai Mata Kuliah',
                'pesan'   => 'Nilai mata kuliah ' . $matkul->nama . ' telah keluar.',
                'jenis'   => 'nilai',
                'dibaca'  => false,
            ]);
        }
    }

    return redirect()
        ->route('nilai.create')
        ->with('success', 'Nilai berhasil disimpan untuk semester ' . $request->semester);
}

    public function index(Request $request)
    {
        $data = NilaiMahasiswa::with('matkul')->get();

        $matkuls = MataKuliah::all();

        return view('admin.nilai.index', compact(
            'data',
            'matkuls'
        ));
    }

    public function edit($id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);

        $matkul = MataKuliah::all();

        return view('admin.nilai.edit', compact(
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

        $grade = $this->getGrade($na);

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

    // ================= API =================

    public function searchMahasiswa(Request $request)
    {
        $q = $request->q;

        $data = Mahasiswa::where('nim', 'like', "%{$q}%")
            ->orWhere('nama', 'like', "%{$q}%")
            ->limit(10)
            ->get([
                'nim',
                'nama'
            ]);

        return response()->json($data);
    }

    public function getMatkulBySemester(Request $request)
    {
        $semester = $request->semester;

        $data = MataKuliah::where('semester', $semester)
            ->get([
                'id',
                'nama',
                'sks'
            ]);

        return response()->json($data);
    }

    public function checkNilai(Request $request)
{
    $exists = NilaiMahasiswa::where('nim', $request->nim)
        ->whereHas('matkul', function ($q) use ($request) {
            $q->where('semester', $request->semester);
        })
        ->exists();

    return response()->json([
        'exists' => $exists
    ]);
}

    private function getGrade($na)
    {
        if ($na >= 95) return 'A+';
        elseif ($na >= 90) return 'A';
        elseif ($na >= 85) return 'A-';
        elseif ($na >= 80) return 'B+';
        elseif ($na >= 75) return 'B';
        elseif ($na >= 70) return 'B-';
        elseif ($na >= 65) return 'C+';
        elseif ($na >= 60) return 'C';
        elseif ($na >= 55) return 'C-';
        elseif ($na >= 50) return 'D';
        else return 'E';
    }
}
