<?php

namespace App\Model\manage\kekhaigia\kkgiakcbtn;

use Illuminate\Database\Eloquent\Model;

class KkGiaKcbTnCt extends Model
{
    protected $table = 'kkgiakcbtnct';
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
