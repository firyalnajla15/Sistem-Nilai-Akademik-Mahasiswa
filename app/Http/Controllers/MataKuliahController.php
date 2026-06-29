<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = MataKuliah::query();

        $selectedSemester = $request->input('semester');

        if ($selectedSemester && $selectedSemester !== 'all') {
            $query->where('semester', $selectedSemester);
        }

        $data = $query->latest()->get();

        return view('admin.mata_kuliah.index', compact(
            'data',
            'selectedSemester'
        ));
    }

    public function create()
    {
        return view('admin.mata_kuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:mata_kuliah,kode',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:24',
            'semester' => 'required|integer|min:1|max:14',
            'tahun_akademik' => 'required|string|max:20',
            'dosen' => 'required|string|max:255',
        ]);

        MataKuliah::create($validated);

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(MataKuliah $mata_kuliah)
    {
        //
    }

    public function edit(MataKuliah $mata_kuliah)
    {
        return view('admin.mata_kuliah.edit', compact('mata_kuliah'));
    }

    public function update(Request $request, MataKuliah $mata_kuliah)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:mata_kuliah,kode,' . $mata_kuliah->id,
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:24',
            'semester' => 'required|integer|min:1|max:14',
            'tahun_akademik' => 'required|string|max:20',
            'dosen' => 'required|string|max:255',
        ]);

        $mata_kuliah->update($validated);

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mata_kuliah)
    {
        $mata_kuliah->delete();

        return redirect()
            ->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}