<?php

namespace App\Model\manage\kekhaigia\kkhplx;

use Illuminate\Database\Eloquent\Model;

class KkGiaHpLxCt extends Model
{
    protected $table = 'kkgiahplxct';
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
