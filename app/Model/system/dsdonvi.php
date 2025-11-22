<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dsdonvi extends Model
{
    protected $table = 'dsdonvi';
    protected $fillable = [
        'id',
        'madiaban',
        'madiaban_cu',
        'maqhns',
        'madv',
        'madv_cu',
        'tendv',
        'diachi',
        'ttlienhe',
        'emailql',
        'emailqt',
        'songaylv',
        'tendvhienthi',
        'tendvcqhienthi',
        'chucvuky',
        'chucvukythay',
        'nguoiky',
        'diadanh',
        'chucnang',//Tổng hợp; Nhập liệu; Quản trị
    ];
}
