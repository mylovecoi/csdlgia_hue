<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giadvkcb extends Model
{
    protected $table = 'view_giadvkcb';
    protected $fillable = [];
}
/*
SELECT        dbo.dvkcb.mahs, dbo.dvkcb.madiaban, dbo.dvkcb.maxp, dbo.dvkcb.soqd, dbo.dvkcb.mota, dbo.dvkcb.ttqd, dbo.dvkcb.congbo, dbo.dvkcb.thaotac, dbo.dvkcb.ghichu, dbo.dvkcb.lichsu, dbo.dvkcb.tinhtrang, dbo.dvkcb.thoidiem,
                         dbo.dvkcb.macqcq, dbo.dvkcb.madv, dbo.dvkcb.lydo, dbo.dvkcb.thongtin, dbo.dvkcb.trangthai, dbo.dvkcb.thoidiem_h, dbo.dvkcb.macqcq_h, dbo.dvkcb.madv_h, dbo.dvkcb.lydo_h, dbo.dvkcb.thongtin_h, dbo.dvkcb.trangthai_h,
                         dbo.dvkcb.thoidiem_t, dbo.dvkcb.macqcq_t, dbo.dvkcb.madv_t, dbo.dvkcb.lydo_t, dbo.dvkcb.thongtin_t, dbo.dvkcb.trangthai_t, dbo.dvkcb.thoidiem_ad, dbo.dvkcb.macqcq_ad, dbo.dvkcb.madv_ad, dbo.dvkcb.lydo_ad,
                         dbo.dvkcb.thongtin_ad, dbo.dvkcb.trangthai_ad, dbo.dvkcbct.maspdv, dbo.dvkcbct.dvt, dbo.dvkcbct.giadv, dbo.dvkcbct.phanloai, dbo.dvkcbct.madichvu, dbo.dvkcbct.tenspdv
FROM            dbo.dvkcb INNER JOIN
                         dbo.dvkcbct ON dbo.dvkcb.mahs = dbo.dvkcbct.mahs

 */