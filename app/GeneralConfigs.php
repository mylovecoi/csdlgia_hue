<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralConfigs extends Model
{
    protected $table = 'general_configs';
    protected $fillable = [
        'id',
        'maqhns',
        'tendonvi',
        'diachi',
        'tel',
        'thutruong',
        'ketoan',
        'nguoilapbieu',
        'diadanh',
        'setting',
        'thongtinhd',
        'thoihanlt',
        'thoihanvt',
        'thoihangs',
        'thoihantacn',
        'emailql',
        'tendvhienthi',
        'tendvcqhienthi',
        'ipf1',
        'ipf2',
        'ipf3',
        'ipf4',
        'ipf5',
        'sudungemail'
    ];
}
