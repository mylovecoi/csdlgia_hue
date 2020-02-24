<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaThueTsCongCt extends Model
{
    protected $table = 'giathuetscongct';
    protected $fillable = [
        'id',
        'mataisan',
        'tents',
        'dongiathue',
        'dvthue',
        'hdthue',
        'ththue',
        'sotienthuenam',
        'mahs',
    ];
}
