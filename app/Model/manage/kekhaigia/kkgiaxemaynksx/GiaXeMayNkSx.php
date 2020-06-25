<?php

namespace App\Model\manage\kekhaigia\kkgiaxemaynksx;

use Illuminate\Database\Eloquent\Model;

class GiaXeMayNkSx extends Model
{
    protected $table = 'giaxemaynksx';
    protected $fillable = [
        'id',
        'mahs',
        'madiaban',
        'ngaynhap',
        'ngayhieuluc',
        'socv',
        'socvlk',
        'ngaycvlk',
        'ytcauthanhgia',
        'thydggadgia',
        'ttnguoinop',
        'plhs',
        'thoihan',
        'dvt',
        'congbo',
        'lichsu',
        'ghichu',

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
