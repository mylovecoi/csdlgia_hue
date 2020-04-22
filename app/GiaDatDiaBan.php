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
        'congbo',
        'lichsu', //Thao tác lịch sử hồ sơ theo dạng JSON

        'macqcq',
        'trangthai',
        'madv',
        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'macqcq_h',
        'madv_h',
        'trangthai_h',
        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp T tùy theo level đơn vị khởi tạo)
        'macqcq_t',
        'madv_t',
        'trangthai_t',
        //Thông tin Hồ sơ khi gửi đến đơn vị tổng hợp toàn Tỉnh
        'macqcq_ad',
        'madv_ad',
        'trangthai_ad',
    ];
}
