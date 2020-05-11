<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_phichuyengia extends Model
{
    protected $table = 'view_phichuyengia';
    protected $fillable = [];
}
/*
SELECT        dbo.phichuyengia.madiaban, dbo.phichuyengia.maxp, dbo.phichuyengia.mahs, dbo.phichuyengia.soqd, dbo.phichuyengia.mota, dbo.phichuyengia.congbo, dbo.phichuyengia.lichsu, dbo.phichuyengia.ghichu,
                         dbo.phichuyengia.thoidiem, dbo.phichuyengia.macqcq, dbo.phichuyengia.madv, dbo.phichuyengia.lydo, dbo.phichuyengia.thongtin, dbo.phichuyengia.trangthai, dbo.phichuyengia.thoidiem_h, dbo.phichuyengia.macqcq_h,
                         dbo.phichuyengia.madv_h, dbo.phichuyengia.lydo_h, dbo.phichuyengia.thongtin_h, dbo.phichuyengia.trangthai_h, dbo.phichuyengia.thoidiem_t, dbo.phichuyengia.macqcq_t, dbo.phichuyengia.madv_t, dbo.phichuyengia.lydo_t,
                         dbo.phichuyengia.thongtin_t, dbo.phichuyengia.trangthai_t, dbo.phichuyengia.thoidiem_ad, dbo.phichuyengia.macqcq_ad, dbo.phichuyengia.madv_ad, dbo.phichuyengia.lydo_ad, dbo.phichuyengia.thongtin_ad,
                         dbo.phichuyengia.trangthai_ad, dbo.phichuyengiact.maso, dbo.phichuyengiact.mucgia, dbo.dmphichuyengia.tenphi, dbo.dmphichuyengia.tengia, dbo.dmphichuyengia.dvt
FROM            dbo.dmphichuyengia INNER JOIN
                         dbo.phichuyengiact ON dbo.dmphichuyengia.maso = dbo.phichuyengiact.maso INNER JOIN
                         dbo.phichuyengia ON dbo.phichuyengiact.mahs = dbo.phichuyengia.mahs
 */