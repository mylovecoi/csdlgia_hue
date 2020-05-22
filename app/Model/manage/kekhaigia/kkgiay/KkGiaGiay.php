<?php

namespace App\Model\manage\kekhaigia\kkgiay;

use Illuminate\Database\Eloquent\Model;

class KkGiaGiay extends Model
{
    protected $table = 'kkgiagiay';
    protected $fillable = [
        'id',
        'maxa',
        'mahuyen',
        'mahs',
        'ngaynhap',
        'ngayhieuluc',
        'socv',
        'socvlk',
        'ngaycvlk',
        'ytcauthanhgia',
        'thydggadgia',
        'ttnguoinop',
        'ngaynhan',
        'sohsnhan',
        'ngaychuyen',
        'lydo',
        'trangthai',
        'plhs',
        'thoihan',
        'dvt',
        'congbo',
        'ghichu',

        'phanloai',
        'madv',
        'madv_t',
        'madv_ad',
        'madv_h',
        'macqcq',
        'macqcq_t',
        'macqcq_ad',
        'macqcq_h',
        'ngaychuyen_t',
        'ngaychuyen_ad',
        'ngaychuyen_h',
        'trangthai_t',
        'trangthai_ad',
        'trangthai_h',
        'thoidiem',
        'ngaynhan_t',
        'ngaynhan_ad',
        'ngaynhan_h',
        'lydo_t',
        'lydo_ad',
        'lydo_h',
        'lichsu',
        'madiaban',
        'manghe',
        'theoqd',
        'ptnguyennhan',
        'chinhsachkm',
        'dtll',
        'email',
        'fax',
    ];
}
