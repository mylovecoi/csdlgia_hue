<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dsdonvi extends Model
{
    protected $table = 'dsdonvi';
    protected $fillable = [
        'id',
        'madiaban',
        'maqhns',
        'madv',
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
