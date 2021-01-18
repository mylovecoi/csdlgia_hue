<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giarung extends Model
{
    protected $table = 'view_giarung';
    protected $fillable = [];
}
/*
SELECT        dbo.giarung.madiaban, dbo.giarung.maxp, dbo.giarung.mahs, dbo.giarung.soqd, dbo.giarung.congbo, dbo.giarung.lichsu, dbo.giarung.ghichu, dbo.giarung.thoidiem, dbo.giarung.macqcq, dbo.giarung.madv, dbo.giarung.lydo,
                         dbo.giarung.thongtin, dbo.giarung.trangthai, dbo.giarung.thoidiem_h, dbo.giarung.macqcq_h, dbo.giarung.madv_h, dbo.giarung.lydo_h, dbo.giarung.thongtin_h, dbo.giarung.trangthai_h, dbo.giarung.thoidiem_t,
                         dbo.giarung.macqcq_t, dbo.giarung.madv_t, dbo.giarung.lydo_t, dbo.giarung.thongtin_t, dbo.giarung.trangthai_t, dbo.giarung.thoidiem_ad, dbo.giarung.macqcq_ad, dbo.giarung.madv_ad, dbo.giarung.lydo_ad,
                         dbo.giarung.thongtin_ad, dbo.giarung.trangthai_ad, dbo.giarungct.manhom, dbo.giarungct.phanloai, dbo.giarungct.noidung, dbo.giarungct.dvt, dbo.giarungct.dientich, dbo.giarungct.dientichsd, dbo.giarungct.giatri,
                         dbo.giarung.mota, dbo.giarungct.giakhoidiem, dbo.giarungct.dongia, dbo.giarungct.dvthue, dbo.giarungct.diachi, dbo.giarungct.soqdpd, dbo.giarungct.thoigianpd, dbo.giarungct.soqdgkd, dbo.giarungct.thoigiangkd,
                         dbo.giarungct.thuetungay, dbo.giarungct.thuedenngay
FROM            dbo.giarung INNER JOIN
                         dbo.giarungct ON dbo.giarung.mahs = dbo.giarungct.mahs
 */