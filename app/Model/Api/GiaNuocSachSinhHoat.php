<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class GiaNuocSachSinhHoat extends Model
{
    protected $table = 'gianuocsh';
    protected $fillable = [
        'id',
        'madiaban',
        'maxp',
        'mahs',
        'soqd',
        'mota',
        'congbo',
        'lichsu', //Thao tác lịch sử hồ sơ theo dạng JSON
        'ghichu',
        //Thông tin hồ sơ khi khởi tạo (level lấy theo thông tin đơn vị)
        'thoidiem',
        'macqcq',
        'madv',
        'lydo',
        'thongtin',
        'trangthai',
        'ipf1',
        'ipf2',
        'ipf3',
        'ipf4',
        'ipf5',
        'tunam',
        'dennam',
//Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'thoidiem_h',
        'macqcq_h',
        'madv_h',
        'lydo_h',
        'thongtin_h',
        'trangthai_h',
//Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp T tùy theo level đơn vị khởi tạo)
        'thoidiem_t',
        'macqcq_t',
        'madv_t',
        'lydo_t',
        'thongtin_t',
        'trangthai_t',
//Thông tin Hồ sơ khi gửi đến đơn vị tổng hợp toàn Tỉnh
        'thoidiem_ad',
        'macqcq_ad',
        'madv_ad',
        'lydo_ad',
        'thongtin_ad',
        'trangthai_ad',
    ];
}
