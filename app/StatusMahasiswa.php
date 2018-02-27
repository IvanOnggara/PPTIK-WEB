<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusMahasiswa extends Model
{
    protected $table = 'status_mahasiswa';
    protected $primaryKey = 'nim';
    protected $fillable = [
        'nim', 'status_mta', 'status_mos', 'status_mtcna', 'status_scm'
    ];
}
