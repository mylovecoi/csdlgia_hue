<?php

namespace App\Model\manage\dinhgia;

use Illuminate\Database\Eloquent\Model;

class GiaRungCt extends Model
{
    protected $table = 'giarungct';
    protected $fillable = [
        'id',
        'mahs',
        'manhom',
        'phanloai',
        'noidung',
        'dvt',
        'dientich',
        'dientichsd',
        'giatri',
        'giakhoidiem',
        'dongia',
        'dvthue',
        'diachi',
        'soqdpd',
        'thoigianpd',
        'soqdgkd',
        'thoigiangkd',
        'thuetungay',
        'thuedenngay',
    ];
}
