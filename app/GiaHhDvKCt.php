<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaHhDvKCt extends Model
{
    protected $table = 'giahhdvkct';
    protected $fillable = [
        'id',
        'mahs',
        'mahhdv',
        'gialk',
        'gia',
        'loaigia',
        'nguontt',
        'ghichu',
    ];
}
