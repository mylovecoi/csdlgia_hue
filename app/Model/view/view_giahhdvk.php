<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giahhdvk extends Model
{
    protected $table = 'view_giahhdvk';
    protected $fillable = [];
}
/*
SELECT        dbo.giahhdvk.mahs, dbo.giahhdvk.madiaban, dbo.giahhdvk.maxp, dbo.giahhdvk.matt, dbo.giahhdvk.soqd, dbo.giahhdvk.thoidiemlk, dbo.giahhdvk.soqdlk, dbo.giahhdvk.phanloai, dbo.giahhdvk.thang, dbo.giahhdvk.nam,
                         dbo.giahhdvk.congbo, dbo.giahhdvk.lichsu, dbo.giahhdvk.tinhtrang, dbo.giahhdvk.ghichu, dbo.giahhdvk.thoidiem, dbo.giahhdvk.macqcq, dbo.giahhdvk.madv, dbo.giahhdvk.lydo, dbo.giahhdvk.thongtin, dbo.giahhdvk.trangthai,
                         dbo.giahhdvk.thoidiem_h, dbo.giahhdvk.macqcq_h, dbo.giahhdvk.madv_h, dbo.giahhdvk.lydo_h, dbo.giahhdvk.thongtin_h, dbo.giahhdvk.trangthai_h, dbo.giahhdvk.thoidiem_t, dbo.giahhdvk.macqcq_t, dbo.giahhdvk.madv_t,
                         dbo.giahhdvk.lydo_t, dbo.giahhdvk.thongtin_t, dbo.giahhdvk.trangthai_t, dbo.giahhdvk.thoidiem_ad, dbo.giahhdvk.macqcq_ad, dbo.giahhdvk.madv_ad, dbo.giahhdvk.lydo_ad, dbo.giahhdvk.thongtin_ad,
                         dbo.giahhdvk.trangthai_ad, dbo.giahhdvkct.mahhdv, dbo.giahhdvkct.gialk, dbo.giahhdvkct.gia, dbo.giahhdvkct.loaigia, dbo.giahhdvkct.nguontt, dbo.dmhhdvk.tenhhdv, dbo.dmhhdvk.dacdiemkt, dbo.dmhhdvk.xuatxu,
                         dbo.dmhhdvk.dvt
FROM            dbo.giahhdvk INNER JOIN
                         dbo.giahhdvkct ON dbo.giahhdvk.mahs = dbo.giahhdvkct.mahs INNER JOIN
                         dbo.dmhhdvk ON dbo.giahhdvkct.mahhdv = dbo.dmhhdvk.mahhdv
 */