<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giadatthitruong extends Model
{
    protected $table = 'view_giadatthitruong';
    protected $fillable = [];
}
/*
SELECT        dbo.giadatthitruong.madiaban, dbo.giadatthitruong.maxp, dbo.giadatthitruong.mahs, dbo.giadatthitruong.tenduan, dbo.giadatthitruong.soqdpagia, dbo.giadatthitruong.soqddaugia, dbo.giadatthitruong.soqdgiakhoidiem,
                         dbo.giadatthitruong.soqdkqdaugia, dbo.giadatthitruong.ipf1, dbo.giadatthitruong.ipf2, dbo.giadatthitruong.ipf3, dbo.giadatthitruong.ipf4, dbo.giadatthitruong.ipf5, dbo.giadatthitruong.congbo, dbo.giadatthitruong.lichsu,
                         dbo.giadatthitruong.thoidiem, dbo.giadatthitruong.macqcq, dbo.giadatthitruong.madv, dbo.giadatthitruong.lydo, dbo.giadatthitruong.thongtin, dbo.giadatthitruong.trangthai, dbo.giadatthitruong.thoidiem_h,
                         dbo.giadatthitruong.macqcq_h, dbo.giadatthitruong.madv_h, dbo.giadatthitruong.lydo_h, dbo.giadatthitruong.thongtin_h, dbo.giadatthitruong.trangthai_h, dbo.giadatthitruong.thoidiem_t, dbo.giadatthitruong.macqcq_t,
                         dbo.giadatthitruong.madv_t, dbo.giadatthitruong.lydo_t, dbo.giadatthitruong.thongtin_t, dbo.giadatthitruong.trangthai_t, dbo.giadatthitruong.thoidiem_ad, dbo.giadatthitruong.macqcq_ad, dbo.giadatthitruong.madv_ad,
                         dbo.giadatthitruong.lydo_ad, dbo.giadatthitruong.thongtin_ad, dbo.giadatthitruong.trangthai_ad, dbo.giadatthitruongct.khuvuc, dbo.giadatthitruongct.mota, dbo.giadatthitruongct.dientich, dbo.giadatthitruongct.giaquydinh,
                         dbo.giadatthitruongct.giathitruong, dbo.giadatthitruongct.loaidat
FROM            dbo.giadatthitruong INNER JOIN
                         dbo.giadatthitruongct ON dbo.giadatthitruong.mahs = dbo.giadatthitruongct.mahs
 */