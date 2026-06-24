<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        if ($request->prodi) {
            $query->where('prodi', $request->prodi);
        }

        if ($request->angkatan) {
            $query->where('angkatan', $request->angkatan);
        }

        $data = $query->get();

        $prodis = Mahasiswa::select('prodi')
            ->distinct()
            ->pluck('prodi');

        $angkatans = Mahasiswa::select('angkatan')
            ->distinct()
            ->orderBy('angkatan')
            ->pluck('angkatan');

        return view('mahasiswa.index', compact(
            'data',
            'prodis',
            'angkatans'
        ));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
        ]);

        return redirect('/mahasiswa')
            ->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
        ]);

        return redirect('/mahasiswa')
            ->with('success', 'Data mahasiswa berhasil diubah');
    }

    public function destroy($id)
    {
        Mahasiswa::destroy($id);

        return redirect('/mahasiswa')
            ->with('success', 'Data mahasiswa berhasil dihapus');
    }
    public function profil()
    {
        return view('mahasiswa.profil');
    }
    public function show($id)
    {
        //
    }
}
