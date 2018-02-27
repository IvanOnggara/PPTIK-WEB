<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    protected $table = 'pengajar';
    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip', 'nama', 'status','mta','mos','scm','mtcna'
    ];
}
