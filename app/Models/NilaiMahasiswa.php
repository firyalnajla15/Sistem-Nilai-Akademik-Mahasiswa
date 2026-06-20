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
}