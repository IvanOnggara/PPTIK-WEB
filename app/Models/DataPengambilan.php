<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPengambilan extends Model
{
    protected $table = 'data_pengambilan';
    protected $fillable = [
        'nim', 'mta', 'mos', 'mtcna', 'scm'
    ];
}
