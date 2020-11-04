<?php

namespace App\Model\manage\kekhaigia\kkgiadvcang;

use Illuminate\Database\Eloquent\Model;

class GiaDvCangCt extends Model
{
    protected $table = 'giadvcangct';
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
