<?php

namespace App\Model\manage\kekhaigia\kkdaxaydung;

use Illuminate\Database\Eloquent\Model;

class KkGiaDaXayDungCt extends Model
{
    protected $table = 'kkgiadaxaydungct';
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
