<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAkademik;

class Mahasiswa extends Model
{
    public $timestamps = false;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'prodi',
        'angkatan'
    ];
    public function getSemesterAktifAttribute()
    {
        $tahunAktif = TahunAkademik::where('aktif', true)->first();

        if (!$tahunAktif) {
            return 1;
        }

        // Ambil tahun awal, contoh 2025 dari 2025/2026
        $tahunAwal = (int) substr($tahunAktif->tahun, 0, 4);

        $selisih = $tahunAwal - $this->angkatan;

        if ($tahunAktif->semester == 'Ganjil') {

            return ($selisih * 2) + 1;
        }

        return ($selisih * 2) + 2;
    }
}
