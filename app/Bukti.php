<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    protected $table = 'bukti';
    protected $fillable = [
        'nim', 'bukti','jenis_sertifikasi','pengambilan_ke','status'
    ];
}
