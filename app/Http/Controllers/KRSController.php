<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KRS; // WAJIB pakai model

class KRSController extends Controller
{
    public function index()
    {
        $krs = KRS::with('mataKuliah')
            ->where('mahasiswa_id', session('mahasiswa_id'))
            ->get();

        return view('krs.index', compact('krs'));
    }
}
