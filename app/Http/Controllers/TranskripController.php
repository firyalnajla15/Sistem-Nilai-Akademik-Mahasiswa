<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;
use App\Models\Mahasiswa;

class TranskripController extends Controller
{
   public function index(Request $request)
{
    $mahasiswa = \App\Models\Mahasiswa::all();

    $query = \App\Models\NilaiMahasiswa::with(['matkul', 'mahasiswa']);

    // ======================
    // SEARCH (NIM / NAMA via RELASI)
    // ======================
    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nim', 'like', '%' . $search . '%')
              ->orWhereHas('mahasiswa', function ($q2) use ($search) {
                  $q2->where('nama', 'like', '%' . $search . '%');
              });
        });
    }

    // ======================
    // FILTER MAHASISWA
    // ======================
    if ($request->nim && $request->nim != 'all') {
        $query->where('nim', $request->nim);
    }

    // ======================
    // FILTER SEMESTER
    // ======================
    if ($request->semester && $request->semester != 'all') {
        $query->whereHas('matkul', function ($q) use ($request) {
            $q->where('semester', $request->semester);
        });
    }

    $data = $query->get();

    return view('transkrip.index', compact('data', 'mahasiswa'));
}
}