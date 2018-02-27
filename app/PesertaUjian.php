<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $table = 'peserta_ujian';
    protected $primaryKey = 'nim';
    protected $fillable = [
        'nim', 'id_jadwal'
    ];
}
