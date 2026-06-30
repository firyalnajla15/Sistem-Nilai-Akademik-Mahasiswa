<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;

class KHSController extends Controller
{
    public function index(Request $request)
    {
        $semester = $request->semester ?? 1;

        $nim = session('nim');

        $nilai = NilaiMahasiswa::with('matkul')
            ->where('nim', $nim)
            ->whereHas('matkul', function ($q) use ($semester) {
                $q->where('semester', $semester);
            })
            ->get();

        $totalSks = 0;
        $totalBobot = 0;

        foreach ($nilai as $item) {

            $sks = $item->matkul->sks;

            switch ($item->grade) {
                case 'A':
                    $bobot = 4;
                    break;
                case 'A-':
                    $bobot = 3.75;
                    break;
                case 'B+':
                    $bobot = 3.5;
                    break;
                case 'B':
                    $bobot = 3;
                    break;
                case 'C+':
                    $bobot = 2.5;
                    break;
                case 'C':
                    $bobot = 2;
                    break;
                case 'D':
                    $bobot = 1;
                    break;
                default:
                    $bobot = 0;
            }

            $totalSks += $sks;
            $totalBobot += ($sks * $bobot);
        }

        $ips = $totalSks > 0
            ? round($totalBobot / $totalSks, 2)
            : 0;

        return view('mahasiswa.khs.index', compact(
            'nilai',
            'semester',
            'ips',
            'totalSks'
        ));
    }
}