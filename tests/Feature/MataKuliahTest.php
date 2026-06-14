<?php

use App\Models\MataKuliah;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can update mata kuliah data', function () {
    $mataKuliah = MataKuliah::create([
        'kode' => 'MK001',
        'nama' => 'Dasar Pemrograman',
        'sks' => 3,
        'semester' => 1,
        'tahun_akademik' => '2025/2026',
        'dosen' => 'Budi',
    ]);

    $response = $this->put(route('mata-kuliah.update', $mataKuliah), [
        'kode' => 'MK001',
        'nama' => 'Pemrograman Web',
        'sks' => 4,
        'semester' => 2,
        'tahun_akademik' => '2026/2027',
        'dosen' => 'Ani',
    ]);

    $response->assertRedirect(route('mata-kuliah.index'));
    $this->assertDatabaseHas('mata_kuliah', [
        'id' => $mataKuliah->id,
        'nama' => 'Pemrograman Web',
    ]);
});
