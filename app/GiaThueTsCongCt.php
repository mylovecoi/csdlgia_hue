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
        'dvt',
        'dongiathue',
        'dvthue',
        'hdthue',
        'ththue',
        'sotienthuenam',
        'mahs',

        'diachi',
        'soqdpd',
        'thoigianpd',
        'soqddg',
        'thoigiandg',
        'thuetungay',
        'thuedenngay',
    ];
}
