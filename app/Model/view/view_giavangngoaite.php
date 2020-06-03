<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giavangngoaite extends Model
{
    protected $table = 'view_giavangngoaite';
    protected $fillable = [];
}
/*

SELECT        dbo.giavangngoaite.mahs, dbo.giavangngoaite.madiaban, dbo.giavangngoaite.maxp, dbo.giavangngoaite.soqd, dbo.giavangngoaite.thoidiemlk, dbo.giavangngoaite.soqdlk, dbo.giavangngoaite.phanloai,
                         dbo.giavangngoaite.congbo, dbo.giavangngoaite.lichsu, dbo.giavangngoaite.tinhtrang, dbo.giavangngoaite.ghichu, dbo.giavangngoaite.thoidiem, dbo.giavangngoaite.macqcq, dbo.giavangngoaite.madv, dbo.giavangngoaite.lydo,
                          dbo.giavangngoaite.thongtin, dbo.giavangngoaite.trangthai, dbo.giavangngoaite.thoidiem_h, dbo.giavangngoaite.macqcq_h, dbo.giavangngoaite.madv_h, dbo.giavangngoaite.lydo_h, dbo.giavangngoaite.thongtin_h,
                         dbo.giavangngoaite.trangthai_h, dbo.giavangngoaite.thoidiem_t, dbo.giavangngoaite.macqcq_t, dbo.giavangngoaite.madv_t, dbo.giavangngoaite.lydo_t, dbo.giavangngoaite.thongtin_t, dbo.giavangngoaite.trangthai_t,
                         dbo.giavangngoaite.thoidiem_ad, dbo.giavangngoaite.macqcq_ad, dbo.giavangngoaite.madv_ad, dbo.giavangngoaite.lydo_ad, dbo.giavangngoaite.thongtin_ad, dbo.giavangngoaite.trangthai_ad, dbo.giavangngoaitect.mahhdv,
                         dbo.giavangngoaitect.tenhhdv, dbo.giavangngoaitect.dacdiemkt, dbo.giavangngoaitect.xuatxu, dbo.giavangngoaitect.dvt, dbo.giavangngoaitect.gialk, dbo.giavangngoaitect.gia, dbo.giavangngoaitect.loaigia,
                         dbo.giavangngoaitect.nguontt
FROM            dbo.giavangngoaite INNER JOIN
                         dbo.giavangngoaitect ON dbo.giavangngoaite.mahs = dbo.giavangngoaitect.mahs
 */