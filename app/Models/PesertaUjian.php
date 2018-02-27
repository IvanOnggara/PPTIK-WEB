<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $table = 'peserta_ujian';
    protected $fillable = [
        'nim', 'id_jadwal'
    ];
}
