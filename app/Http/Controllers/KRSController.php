<?php

namespace App\Http\Controllers;

use App\Models\KRS;

class KRSController extends Controller
{
    public function index()
    {
        $krs = KRS::with('mataKuliah')
            ->where('mahasiswa_id', session('mahasiswa_id'))
            ->get();

        return view('mahasiswa.krs.index', compact('krs'));
    }
}