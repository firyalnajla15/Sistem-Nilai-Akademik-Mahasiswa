<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiMahasiswa;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class TranskripController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::all();

        $query = NilaiMahasiswa::with(['matkul', 'mahasiswa']);

        // SEARCH NIM / NAMA
        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nim', 'like', '%' . $search . '%')
                    ->orWhereHas('mahasiswa', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%' . $search . '%');
                    });

            });
        }

        // FILTER NIM
        if ($request->nim && $request->nim != 'all') {

            $query->where('nim', $request->nim);

        }

        // FILTER SEMESTER
        if ($request->semester && $request->semester != 'all') {

            $query->whereHas('matkul', function ($q) use ($request) {

                $q->where('semester', $request->semester);

            });

        }

        $data = $query->get();

        return view('admin.transkrip.index', compact(
            'data',
            'mahasiswa'
        ));
    }

    // ==========================
    // DOWNLOAD PDF
    // ==========================
    public function pdf(Request $request)
    {
        $query = NilaiMahasiswa::with(['matkul', 'mahasiswa']);

        // SEARCH
        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nim', 'like', '%' . $search . '%')
                    ->orWhereHas('mahasiswa', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%' . $search . '%');
                    });

            });
        }

        // FILTER NIM
        if ($request->nim && $request->nim != 'all') {

            $query->where('nim', $request->nim);

        }

        // FILTER SEMESTER
        if ($request->semester && $request->semester != 'all') {

            $query->whereHas('matkul', function ($q) use ($request) {

                $q->where('semester', $request->semester);

            });

        }

        $data = $query->get();

        $pdf = Pdf::loadView('admin.transkrip.pdf', compact('data'));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Transkrip_Nilai.pdf');
    }
}