<?php

namespace App\Model\manage\kekhaigia\kkdvhdtmck;

use Illuminate\Database\Eloquent\Model;

class KkGiaDvHdTmCt extends Model
{
    protected $table = 'kkgiadvhdtmct';
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
