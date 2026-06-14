<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama',
        'sks',
        'semester',
        'tahun_akademik',
        'dosen'
    ];
}