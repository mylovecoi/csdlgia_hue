<?php

namespace App\Model\manage\dinhgia\giadatthitruong  ;

use Illuminate\Database\Eloquent\Model;

class giadatthitruongct extends Model
{
    protected $table = 'giadatthitruongct';
    protected $fillable = [
        'id',
        'mahs',
        'hdban',
        'loaidat',
        'khuvuc',
        'tenkhudat',
        'diachi',
        'soqdban',
        'thoigianban',
        'soqdgiakd',
        'thoigiangiakd',
        'dientichdat',
        'dongiadat',
        'giatridat',
        'dientichts',
        'dongiats',
        'giatrits',
        'tonggiatri',
        'giadaugia',
        'giathitruong',
    ];
}
