<?php

namespace App\Model\manage\kekhaigia\kkgiathan;

use Illuminate\Database\Eloquent\Model;

class KkGiaThanCt extends Model
{
    protected $table = 'kkgiathanct';
    protected $fillable = [
        'id',
        'mahs',
        'maxa',
        'tthhdv',
        'qccl',
        'dvt',
        'ghichu',
        'thuevat',
        'trangthai',

        'madv',
        'plhs',

        'tendvcu',
        'gialk',
        'giakk',
    ];
}
