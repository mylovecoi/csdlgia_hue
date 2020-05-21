<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giadatdaugia extends Model
{
    protected $table = 'view_giadatdaugia';
    protected $fillable = [];
}
/*
SELECT        dbo.daugiadat.madiaban, dbo.daugiadat.maxp, dbo.daugiadat.mahs, dbo.daugiadat.tenduan, dbo.daugiadat.soqdpagia, dbo.daugiadat.soqddaugia, dbo.daugiadat.soqdgiakhoidiem, dbo.daugiadat.soqdkqdaugia,
                         dbo.daugiadat.ipf1, dbo.daugiadat.ipf2, dbo.daugiadat.ipf3, dbo.daugiadat.ipf4, dbo.daugiadat.ipf5, dbo.daugiadat.congbo, dbo.daugiadat.lichsu, dbo.daugiadat.thoidiem, dbo.daugiadat.macqcq, dbo.daugiadat.madv,
                         dbo.daugiadat.lydo, dbo.daugiadat.thongtin, dbo.daugiadat.trangthai, dbo.daugiadat.thoidiem_h, dbo.daugiadat.macqcq_h, dbo.daugiadat.madv_h, dbo.daugiadat.lydo_h, dbo.daugiadat.thongtin_h, dbo.daugiadat.trangthai_h,
                         dbo.daugiadat.thoidiem_t, dbo.daugiadat.macqcq_t, dbo.daugiadat.madv_t, dbo.daugiadat.lydo_t, dbo.daugiadat.thongtin_t, dbo.daugiadat.trangthai_t, dbo.daugiadat.thoidiem_ad, dbo.daugiadat.madv_ad,
                         dbo.daugiadat.lydo_ad, dbo.daugiadat.thongtin_ad, dbo.daugiadat.trangthai_ad, dbo.daugiadatct.loaidat, dbo.daugiadatct.khuvuc, dbo.daugiadatct.mota, dbo.daugiadatct.dientich, dbo.daugiadatct.giakhoidiem,
                         dbo.daugiadatct.giadaugia, dbo.daugiadat.macqcq_ad
FROM            dbo.daugiadat INNER JOIN
                         dbo.daugiadatct ON dbo.daugiadat.mahs = dbo.daugiadatct.mahs
 */