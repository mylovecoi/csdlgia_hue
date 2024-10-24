<?php

namespace App\Model\manage\kekhaigia\kkdvlt;

use Illuminate\Database\Eloquent\Model;

class KkGiaDvLtCt extends Model
{
    protected $table = 'kkgiadvltct';
    protected $fillable = [
        'id',
        'mahs',
        'macskd',
        'tenhhdv',
        'tendvcu',
        'qccl',
        'dvt',
        'mucgialk',
        'gialk',
        'mucgiakk',
        'giakk',
        'trangthai',
        'ghichu',
    ];
}
