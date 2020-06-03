<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giathuedatnuoc extends Model
{
    protected $table = 'view_giathuedatnuoc';
    protected $fillable = [];
}
/*
SELECT        dbo.giathuedatnuoc.mahs, dbo.giathuedatnuoc.madiaban, dbo.giathuedatnuoc.maxp, dbo.giathuedatnuoc.soqd, dbo.giathuedatnuoc.thoidiem, dbo.giathuedatnuoc.macqcq, dbo.giathuedatnuoc.madv, dbo.giathuedatnuoc.lydo,
                         dbo.giathuedatnuoc.thongtin, dbo.giathuedatnuoc.trangthai, dbo.giathuedatnuoc.thoidiem_h, dbo.giathuedatnuoc.macqcq_h, dbo.giathuedatnuoc.madv_h, dbo.giathuedatnuoc.lydo_h, dbo.giathuedatnuoc.thongtin_h,
                         dbo.giathuedatnuoc.trangthai_h, dbo.giathuedatnuoc.thoidiem_t, dbo.giathuedatnuoc.macqcq_t, dbo.giathuedatnuoc.madv_t, dbo.giathuedatnuoc.lydo_t, dbo.giathuedatnuoc.thongtin_t, dbo.giathuedatnuoc.trangthai_t,
                         dbo.giathuedatnuoc.thoidiem_ad, dbo.giathuedatnuoc.macqcq_ad, dbo.giathuedatnuoc.madv_ad, dbo.giathuedatnuoc.lydo_ad, dbo.giathuedatnuoc.thongtin_ad, dbo.giathuedatnuoc.trangthai_ad, dbo.giathuedatnuocct.vitri,
                         dbo.giathuedatnuocct.mota, dbo.giathuedatnuocct.dientich, dbo.giathuedatnuocct.dongia, dbo.giathuedatnuoc.ghichu, dbo.giathuedatnuoc.lichsu, dbo.giathuedatnuoc.congbo, dbo.giathuedatnuocct.diemdau,
                         dbo.giathuedatnuocct.diemcuoi
FROM            dbo.giathuedatnuoc INNER JOIN
                         dbo.giathuedatnuocct ON dbo.giathuedatnuoc.mahs = dbo.giathuedatnuocct.mahs
 */