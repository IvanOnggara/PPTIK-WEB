<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = [
        'id_jadwal','nim', 'nilai', 'jenis_sertifikasi','pengambilan_ke','status','id_sertifikat'
    ];
}
