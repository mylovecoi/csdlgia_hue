<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaDatDiaBan extends Model
{
    protected $table = 'giadatdiaban';
    protected $fillable = [
        'id',
        'maso', //lưu thay id -- để trong trường hợp cần lưu chi tiết thay đổi giá
        'madiaban',
        'maxp',
        'madv',
        'soqd',
        'nam',

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
        'trangthai',
        'congbo',
        'lichsu', //Thao tác lịch sử hồ sơ theo dạng JSON
    ];
}
