<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_trogiatrocuoc extends Model
{
    protected $table = 'view_trogiatrocuoc';
    protected $fillable = [];
}
/*
SELECT        dbo.trogiatrocuoc.mahs, dbo.trogiatrocuoc.madiaban, dbo.trogiatrocuoc.maxp, dbo.trogiatrocuoc.soqd, dbo.trogiatrocuoc.ttqd, dbo.trogiatrocuoc.congbo, dbo.trogiatrocuoc.thaotac, dbo.trogiatrocuoc.ghichu,
                         dbo.trogiatrocuoc.lichsu, dbo.trogiatrocuoc.tinhtrang, dbo.trogiatrocuoc.thoidiem, dbo.trogiatrocuoc.macqcq, dbo.trogiatrocuoc.madv, dbo.trogiatrocuoc.lydo, dbo.trogiatrocuoc.thongtin, dbo.trogiatrocuoc.trangthai,
                         dbo.trogiatrocuoc.thoidiem_h, dbo.trogiatrocuoc.macqcq_h, dbo.trogiatrocuoc.madv_h, dbo.trogiatrocuoc.lydo_h, dbo.trogiatrocuoc.thongtin_h, dbo.trogiatrocuoc.trangthai_h, dbo.trogiatrocuoc.thoidiem_t,
                         dbo.trogiatrocuoc.macqcq_t, dbo.trogiatrocuoc.madv_t, dbo.trogiatrocuoc.lydo_t, dbo.trogiatrocuoc.thongtin_t, dbo.trogiatrocuoc.trangthai_t, dbo.trogiatrocuoc.thoidiem_ad, dbo.trogiatrocuoc.macqcq_ad,
                         dbo.trogiatrocuoc.madv_ad, dbo.trogiatrocuoc.lydo_ad, dbo.trogiatrocuoc.thongtin_ad, dbo.trogiatrocuoc.trangthai_ad, dbo.trogiatrocuocct.dongia, dbo.trogiatrocuocdm.tenspdv, dbo.trogiatrocuocdm.dvt,
                         dbo.trogiatrocuocdm.phanloai
FROM            dbo.trogiatrocuoc INNER JOIN
                         dbo.trogiatrocuocct ON dbo.trogiatrocuoc.mahs = dbo.trogiatrocuocct.mahs INNER JOIN
                         dbo.trogiatrocuocdm ON dbo.trogiatrocuocct.maspdv = dbo.trogiatrocuocdm.maspdv
 */