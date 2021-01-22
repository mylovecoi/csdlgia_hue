<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giaspdvcuthe extends Model
{
    protected $table = 'view_giaspdvcuthe';
    protected $fillable = [];
}
/*
SELECT        dbo.giaspdvcuthe.mahs, dbo.giaspdvcuthe.madiaban, dbo.giaspdvcuthe.maxp, dbo.giaspdvcuthe.soqd, dbo.giaspdvcuthe.ttqd, dbo.giaspdvcuthe.congbo, dbo.giaspdvcuthe.thaotac, dbo.giaspdvcuthe.ghichu,
                         dbo.giaspdvcuthe.lichsu, dbo.giaspdvcuthe.tinhtrang, dbo.giaspdvcuthe.phanloai, dbo.giaspdvcuthe.ipf1, dbo.giaspdvcuthe.ipf2, dbo.giaspdvcuthe.ipf3, dbo.giaspdvcuthe.ipf4, dbo.giaspdvcuthe.ipf5, dbo.giaspdvcuthe.thoidiem,
                         dbo.giaspdvcuthe.macqcq, dbo.giaspdvcuthe.madv, dbo.giaspdvcuthe.lydo, dbo.giaspdvcuthe.thongtin, dbo.giaspdvcuthe.trangthai, dbo.giaspdvcuthe.thoidiem_h, dbo.giaspdvcuthe.macqcq_h, dbo.giaspdvcuthe.madv_h,
                         dbo.giaspdvcuthe.lydo_h, dbo.giaspdvcuthe.thongtin_h, dbo.giaspdvcuthe.trangthai_h, dbo.giaspdvcuthe.thoidiem_t, dbo.giaspdvcuthe.macqcq_t, dbo.giaspdvcuthe.madv_t, dbo.giaspdvcuthe.lydo_t,
                         dbo.giaspdvcuthe.thongtin_t, dbo.giaspdvcuthe.trangthai_t, dbo.giaspdvcuthe.thoidiem_ad, dbo.giaspdvcuthe.macqcq_ad, dbo.giaspdvcuthe.madv_ad, dbo.giaspdvcuthe.lydo_ad, dbo.giaspdvcuthe.thongtin_ad,
                         dbo.giaspdvcuthe.trangthai_ad, dbo.giaspdvcuthe_ct.maspdv, dbo.giaspdvcuthe_ct.mota, dbo.giaspdvcuthe_ct.dvt, dbo.giaspdvcuthe_ct.mucgia, dbo.giaspdvcuthe_ct.phanloaidv
FROM            dbo.giaspdvcuthe INNER JOIN
                         dbo.giaspdvcuthe_ct ON dbo.giaspdvcuthe.mahs = dbo.giaspdvcuthe_ct.mahs
 */