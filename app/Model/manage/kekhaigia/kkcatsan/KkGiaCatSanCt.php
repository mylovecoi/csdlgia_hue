<?php

namespace App\Model\manage\kekhaigia\kkcatsan;

use Illuminate\Database\Eloquent\Model;

class KkGiaCatSanCt extends Model
{
    protected $table = 'kkgiacatsanct';
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
