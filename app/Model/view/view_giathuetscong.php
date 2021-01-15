<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giathuetscong extends Model
{
    protected $table = 'view_giathuetscong';
    protected $fillable = [];
}
/*
SELECT        dbo.giathuetscong.madiaban, dbo.giathuetscong.maxp, dbo.giathuetscong.mahs, dbo.giathuetscong.soqd, dbo.giathuetscong.congbo, dbo.giathuetscong.lichsu, dbo.giathuetscong.ghichu, dbo.giathuetscong.thoidiem,
                         dbo.giathuetscong.macqcq, dbo.giathuetscong.madv, dbo.giathuetscong.lydo, dbo.giathuetscong.thongtin, dbo.giathuetscong.trangthai, dbo.giathuetscong.thoidiem_h, dbo.giathuetscong.macqcq_h, dbo.giathuetscong.madv_h,
                         dbo.giathuetscong.lydo_h, dbo.giathuetscong.thongtin_h, dbo.giathuetscong.trangthai_h, dbo.giathuetscong.thoidiem_t, dbo.giathuetscong.macqcq_t, dbo.giathuetscong.madv_t, dbo.giathuetscong.lydo_t,
                         dbo.giathuetscong.thongtin_t, dbo.giathuetscong.trangthai_t, dbo.giathuetscong.thoidiem_ad, dbo.giathuetscong.macqcq_ad, dbo.giathuetscong.madv_ad, dbo.giathuetscong.lydo_ad, dbo.giathuetscong.thongtin_ad,
                         dbo.giathuetscong.trangthai_ad, dbo.giathuetscongct.mataisan, dbo.giathuetscongct.dongiathue, dbo.giathuetscongct.dvthue, dbo.giathuetscongct.hdthue, dbo.giathuetscongct.ththue, dbo.giathuetscongct.sotienthuenam,
                         dbo.giataisancongdm.tentaisan, dbo.giataisancongdm.dientich, dbo.giataisancongdm.dvt, dbo.giataisancongdm.giatri, dbo.giataisancongdm.mota, dbo.giataisancongdm.hientrang, dbo.giathuetscong.thongtinhs,
                         dbo.giathuetscongct.diachi, dbo.giathuetscongct.soqdpd, dbo.giathuetscongct.thoigianpd, dbo.giathuetscongct.soqddg, dbo.giathuetscongct.thoigiandg, dbo.giathuetscongct.thuetungay, dbo.giathuetscongct.thuedenngay
FROM            dbo.giathuetscong INNER JOIN
                         dbo.giathuetscongct ON dbo.giathuetscong.mahs = dbo.giathuetscongct.mahs INNER JOIN
                         dbo.giataisancongdm ON dbo.giathuetscongct.mataisan = dbo.giataisancongdm.mataisan
 */