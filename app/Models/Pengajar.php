<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    protected $table = 'pengajar';
    protected $fillable = [
        'nip', 'nama', 'status'
    ];
}
