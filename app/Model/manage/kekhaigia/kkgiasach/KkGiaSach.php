<?php

namespace App\Model\manage\kekhaigia\kkgiasach;

use Illuminate\Database\Eloquent\Model;

class KkGiaSach extends Model
{
    protected $table = 'kkgiasach';
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
        'nguoinop',
        'dtll',
        'email',
        'fax',
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
        'ptnguyennhan',
        'chinhsachkm',

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
    ];
}
