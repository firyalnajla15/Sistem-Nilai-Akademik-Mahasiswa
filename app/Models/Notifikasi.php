<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';

    protected $fillable = [

        'nim',

        'judul',

        'pesan',

        'jenis',

        'dibaca'

    ];

    protected $casts = [

        'dibaca' => 'boolean'

    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'nim','nim');
    }
}