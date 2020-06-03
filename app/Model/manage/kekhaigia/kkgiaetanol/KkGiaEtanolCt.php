<?php

namespace App\Model\manage\kekhaigia\kkgiaetanol;

use Illuminate\Database\Eloquent\Model;

class KkGiaEtanolCt extends Model
{
    protected $table = 'kkgiaetanolct';
    protected $fillable = [
        'id',
        'mahs',
        'maxa',
        'tthhdv',
        'qccl',
        'dvt',
        'ghichu',
        'trangthai',
        'thuevat',

        'madv',
        'plhs',

        'tendvcu',
        'gialk',
        'giakk',
    ];
}
