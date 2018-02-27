<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'id_kelas', 'id_dosen','jenis_sertifikasi','deskripsi_tanggal_waktu','tanggal_awal','tanggal_akhir'
    ];
}
