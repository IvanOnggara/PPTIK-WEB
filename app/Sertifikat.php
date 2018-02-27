<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'data_sertifikat';
    protected $fillable = [
        'id_sertifikat','nim', 'jenis_sertifikasi'
    ];
}
