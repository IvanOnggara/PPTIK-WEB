<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = [
        'nim', 'nilai', 'jenis_sertifikasi','pengambilan_ke','status'
    ];
}
