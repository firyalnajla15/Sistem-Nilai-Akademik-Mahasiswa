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
        return view('nilai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'semester' => 'required|integer|min:1|max:8',
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $matkul_id => $nilai) {
            // Cek duplikat
            $existing = NilaiMahasiswa::where('nim', $request->nim)
                ->where('matkul_id', $matkul_id)
                ->first();

            // Hitung nilai akhir dan grade
            $kehadiran = $nilai['kehadiran'] ?? 0;
            $tugas = $nilai['tugas'] ?? 0;
            $uts = $nilai['uts'] ?? 0;
            $uas = $nilai['uas'] ?? 0;
            
            $nilaiAkhir = ($kehadiran * 0.1) + ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);
            $grade = $this->getGrade($nilaiAkhir);

            $data = [
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'matkul_id' => $matkul_id,
                'kehadiran' => $kehadiran,
                'tugas' => $tugas,
                'uts' => $uts,
                'uas' => $uas,
                'grade' => $grade,
            ];

            if ($existing) {
                $existing->update($data);
            } else {
                NilaiMahasiswa::create($data);
            }
        }

        return redirect()->route('nilai.create')
            ->with('success', 'Nilai berhasil disimpan untuk semester ' . $request->semester);
    }

    public function index(Request $request)
    {
        $data = NilaiMahasiswa::with('matkul')->get();
        $matkuls = MataKuliah::all();
        
        return view('nilai.index', compact('data', 'matkuls'));
    }

    public function edit($id)
    {
        $nilai = NilaiMahasiswa::findOrFail($id);
        $matkul = MataKuliah::all();

        return view('nilai.edit', compact('nilai', 'matkul'));
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

        // Hitung ulang grade
        $na = $nilai->nilai_akhir;
        $grade = $this->getGrade($na);
        $nilai->update(['grade' => $grade]);

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

    // ========== API METHODS ==========
    public function searchMahasiswa(Request $request)
    {
        $q = $request->q;
        $data = Mahasiswa::where('nim', 'like', "%{$q}%")
            ->orWhere('nama', 'like', "%{$q}%")
            ->limit(10)
            ->get(['nim', 'nama']);
        
        return response()->json($data);
    }

    public function getMatkulBySemester(Request $request)
    {
        $semester = $request->semester;
        $data = MataKuliah::where('semester', $semester)->get(['id', 'nama', 'sks']);
        
        return response()->json($data);
    }

    public function checkNilai(Request $request)
    {
        $exists = NilaiMahasiswa::where('nim', $request->nim)
            ->where('matkul_id', $request->matkul_id)
            ->exists();
        
        return response()->json($exists);
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