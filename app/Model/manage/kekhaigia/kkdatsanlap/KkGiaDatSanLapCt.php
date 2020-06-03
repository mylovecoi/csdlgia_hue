<?php

namespace App\Model\manage\kekhaigia\kkdatsanlap;

use Illuminate\Database\Eloquent\Model;

class KkGiaDatSanLapCt extends Model
{
    protected $table = 'kkgiadatsanlapct';
    protected $fillable = [
        'id',
        'mahs',
        'maxa',
        'madv',
        'tendvcu',
        'qccl',
        'dvt',
        'gialk',
        'giakk',
        'ghichu',
        'trangthai',
        'thuevat',
    ];
}
