<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMahasiswa extends Model
{
    protected $table = 'nilai_mahasiswa';

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
}