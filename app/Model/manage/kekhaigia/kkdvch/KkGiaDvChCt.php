<?php

namespace App\Model\manage\kekhaigia\kkdvch;

use Illuminate\Database\Eloquent\Model;

class KkGiaDvChCt extends Model
{
    protected $table = 'kkgiadvchct';
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
