<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaThueTsCongCtDf extends Model
{
    protected $table = 'giathuetscongctdf';
    protected $fillable = [
        'id',
        'mataisan',
        'tents',
        'dvt',
        'dongiathue',
        'dvthue',
        'hdthue',
        'ththue',
        'sotienthuenam',
        'mahs',
    ];
}
