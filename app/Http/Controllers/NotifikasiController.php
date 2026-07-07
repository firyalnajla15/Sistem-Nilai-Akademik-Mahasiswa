<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $nim = session('nim');

        // Ambil semua notifikasi
        $notifikasi = Notifikasi::where('nim', $nim)
            ->latest()
            ->paginate(10);

        // Tandai semua sebagai sudah dibaca
        Notifikasi::where('nim', $nim)
            ->where('dibaca', false)
            ->update([
                'dibaca' => true
            ]);

        return view(
            'mahasiswa.notifikasi.index',
            compact('notifikasi')
        );
    }

    public function terbaru()
    {
        $nim = session('nim');

        $notifikasi = Notifikasi::where('nim', $nim)
            ->where('dibaca', false)
            ->latest()
            ->take(5)
            ->get();

        return response()->json($notifikasi);
    }

    public function bacaSemua()
    {
        $nim = session('nim');

        Notifikasi::where('nim', $nim)
            ->where('dibaca', false)
            ->update([
                'dibaca' => true
            ]);

        return redirect()->route('mahasiswa.notifikasi');
    }
}