<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
       'id_jadwal','id_dosen','jenis_sertifikasi', 'id_kelas_1', 'id_kelas_2', 'id_kelas_3', 'tanggal_1','tanggal_2','tanggal_3','jam_awal_1','jam_akhir_1','jam_awal_2','jam_akhir_2','jam_awal_3','jam_akhir_3','periode','semester','status'
    ];
    public $incrementing = false;

}
