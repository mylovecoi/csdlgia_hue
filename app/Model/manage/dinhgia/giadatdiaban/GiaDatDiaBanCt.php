<?php

namespace App\Model\manage\dinhgia\giadatdiaban;

use Illuminate\Database\Eloquent\Model;

class GiaDatDiaBanCt extends Model
{
    protected $table = 'giadatdiabanct';
    protected $fillable = [
        'id',
        'mahs',
        'madiaban',
        'maxp',
        'maloaidat',
        'khuvuc',//tên đường, phố, ...
        'diemdau',
        'diemcuoi',
        'loaiduong',
        'mota',
        'mdsd',
        'giavt1',
        'giavt2',
        'giavt3',
        'giavt4',
        'giavt5',
        'hesok',
        'sapxep',
    ];
}
