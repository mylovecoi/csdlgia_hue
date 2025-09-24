<?php

namespace App\Model\manage\kekhaigia\kkdvlt;

use Illuminate\Database\Eloquent\Model;

class KkGiaDvLt extends Model
{
    protected $table = 'kkgiadvlt';
    protected $fillable = [
        'id',
        'madiaban',
        'maxp',
        'mahs',
        'macskd',
        'ngaynhap',
        'socv',
        'socvlk',
        'ngaycvlk',
        'ngayhieuluc',
        'dtll',
        'email',
        'fax',
        'ghichu',
        'ptnguyennhan',
        'chinhsachkm',
        'plhs',
        'thoihan',
        'lichsu',
        'congbo',

        //Thông tin hồ sơ khi khởi tạo (level lấy theo thông tin đơn vị)
        'macqcq',
        'macqcq1',
        'macqcq2',
        'madv',
        'ngaynhan',
        'sohsnhan',
        'nguoichuyen',
        'ngaychuyen',
        'lydo',
        'trangthai',

        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'macqcq_h',
        'macqcq_h1',
        'macqcq_h2',
        'madv_h',
        'ngaynhan_h',
        'sohsnhan_h',
        'nguoichuyen_h',
        'ngaychuyen_h',
        'lydo_h',
        'trangthai_h',

        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'macqcq_t',
        'macqcq_t1',
        'macqcq_t2',
        'madv_t',
        'ngaynhan_t',
        'sohsnhan_t',
        'nguoichuyen_t',
        'ngaychuyen_t',
        'lydo_t',
        'trangthai_t',

        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'macqcq_ad',
        'macqcq_ad1',
        'macqcq_ad2',
        'madv_ad',
        'ngaynhan_ad',
        'sohsnhan_ad',
        'nguoichuyen_ad',
        'ngaychuyen_ad',
        'lydo_ad',
        'trangthai_ad',
        'truyendulieu',
        'thoigiantruyen',
    ];
}
