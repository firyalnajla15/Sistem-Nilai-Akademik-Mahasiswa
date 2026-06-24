<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'angkatan'
    ];

    public function nilai()
    {
        return $this->hasMany(NilaiMahasiswa::class, 'mahasiswa_id');
    }
}