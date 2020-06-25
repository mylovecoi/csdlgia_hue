<?php

namespace App\Model\manage\kekhaigia\kkgiaotonksx;

use Illuminate\Database\Eloquent\Model;

class GiaOtoNkSxCt extends Model
{
    protected $table = 'giaotonksxct';
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
