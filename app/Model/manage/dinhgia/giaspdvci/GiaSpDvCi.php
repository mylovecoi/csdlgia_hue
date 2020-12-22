<?php

namespace App\Model\manage\dinhgia\giaspdvci;

use Illuminate\Database\Eloquent\Model;

class GiaSpDvCi extends Model
{
    protected $table = 'giaspdvci';
    protected $fillable = [
        'id',
        'mahs',
        'madiaban',
        'maxp',
        'soqd',
        'ttqd',
        'congbo',
        'thaotac',
        'ghichu',
        'lichsu', //Thao tác lịch sử hồ sơ theo dạng JSON
        'tinhtrang',//Vị trị hiện tại của Hô sơ: Khởi tạo; Gửi Huyện; Gửi Tỉnh
        //Thông tin hồ sơ khi khởi tạo (level lấy theo thông tin đơn vị)
        'thoidiem',
        'macqcq',
        'madv',
        'lydo',
        'thongtin',
        'trangthai',
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
        'ipf1',
        'ipf2',
        'ipf3',
        'ipf4',
        'ipf5',
    ];
}
