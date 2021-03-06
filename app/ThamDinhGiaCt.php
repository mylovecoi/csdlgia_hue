<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThamDinhGiaCt extends Model
{
    protected $table = 'thamdinhgiact';
    protected $fillable = [
        'id',
        'manhom',
        'mats',
        'tents',
        'dacdiempl',
        'thongsokt',
        'nguongoc',
        'dvt',
        'sl',
        'nguyengiadenghi',
        'giadenghi',
        'nguyengiathamdinh',
        'giaththamdinh',
        'giakththamdinh',
        'giatritstd',
        'gc',
        'mahs'
    ];
}
