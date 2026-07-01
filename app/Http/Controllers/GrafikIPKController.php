<?php

namespace App\Http\Controllers;

use App\Models\NilaiMahasiswa;

class GrafikIPKController extends Controller
{
    public function index()
    {
        $nim = session('nim');

        $nilai = NilaiMahasiswa::with('matkul')
            ->where('nim', $nim)
            ->get();

        $semesterData = [];

        foreach ($nilai as $item) {

            if (!$item->matkul) {
                continue;
            }

            $semester = $item->matkul->semester;
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

            if (!isset($semesterData[$semester])) {

                $semesterData[$semester] = [
                    'sks' => 0,
                    'bobot' => 0
                ];
            }

            $semesterData[$semester]['sks'] += $sks;
            $semesterData[$semester]['bobot'] += ($bobot * $sks);
        }

        ksort($semesterData);

        $labels = [];
        $ips = [];

        $totalSks = 0;
        $totalBobot = 0;

        foreach ($semesterData as $semester => $data) {

            $labels[] = "Semester ".$semester;

            $nilaiIps = round($data['bobot']/$data['sks'],2);

            $ips[] = $nilaiIps;

            $totalSks += $data['sks'];
            $totalBobot += $data['bobot'];
        }

        $ipk = $totalSks > 0
            ? round($totalBobot/$totalSks,2)
            : 0;

        return view(
            'mahasiswa.grafik.index',
            compact(
                'labels',
                'ips',
                'ipk'
            )
        );
    }
}