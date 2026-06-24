<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMahasiswa extends Model
{
    protected $table = 'nilai_mahasiswa';

    public $timestamps = false;

    protected $fillable = [
        'matkul_id',
        'nim',
        'nama_mahasiswa',
        'kehadiran',
        'tugas',
        'uts',
        'uas',
        'grade'
    ];

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'matkul_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function getNilaiAkhirAttribute()
    {
        $kehadiran = $this->kehadiran ?? 0;
        $tugas = $this->tugas ?? 0;
        $uts = $this->uts ?? 0;
        $uas = $this->uas ?? 0;

        // Bobot: Kehadiran 10%, Tugas 20%, UTS 30%, UAS 40%
        return ($kehadiran * 0.1) + ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);
    }
}