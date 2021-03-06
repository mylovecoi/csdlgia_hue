<?php

namespace App\Model\manage\kekhaidkg\kehaimhbog;

use Illuminate\Database\Eloquent\Model;

class

KkMhBog extends Model
{
    protected $table = 'kkmhbog';
    protected $fillable = [
        'id',
        'mahs',
        'madiaban',
        'maxp',
        'manghe',
        'theoqd',
        'thoidiem',
        'socv',
        'socvlk',
        'ngaycvlk',
        'ngayhieuluc',
        'dtll',
        'email',
        'fax',
        'plhs',
        'pldn',
        'thoihan',
        'phanloai',
        'ptnguyennhan',
        'chinhsachkm',
        'congbo',
        'thaotac',
        'ghichu',
        'lichsu', //Thao tác lịch sử hồ sơ theo dạng JSON
        'tinhtrang',//Vị trị hiện tại của Hô sơ: Khởi tạo; Gửi Huyện; Gửi Tỉnh
        'hoso',//lần đầu, thông báo
        //Thông tin hồ sơ khi khởi tạo (level lấy theo thông tin đơn vị)
        'macqcq',
        'madv',
        'ngaynhan',
        'sohsnhan',
        'nguoichuyen',
        'ngaychuyen',
        'lydo',
        'trangthai',
        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'macqcq_h',
        'madv_h',
        'ngaynhan_h',
        'sohsnhan_h',
        'nguoichuyen_h',
        'ngaychuyen_h',
        'lydo_h',
        'trangthai_h',
        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'macqcq_t',
        'madv_t',
        'ngaynhan_t',
        'sohsnhan_t',
        'nguoichuyen_t',
        'ngaychuyen_t',
        'lydo_t',
        'trangthai_t',
        //Thông tin Hô sơ khi gửi đơn vị cấp trên (Cấp H, T tùy theo level đơn vị khởi tạo)
        'macqcq_ad',
        'madv_ad',
        'ngaynhan_ad',
        'sohsnhan_ad',
        'nguoichuyen_ad',
        'ngaychuyen_ad',
        'lydo_ad',
        'trangthai_ad',
    ];
}
