<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DvKcbCt extends Model
{
    protected $table = 'dvkcbct';
    protected $fillable = [
        'id',
        'mahs',
        'phanloai',
        'madichvu',
        'tenspdv',
        'dvt',
        'gc',
        'sapxep',
        'giadv',
        'giatoida',
        'giatoithieu',
        'ghichu',
    ];
}
