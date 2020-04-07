<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giadvkcb extends Model
{
    protected $table = 'view_giadvkcb';
    protected $fillable = [];
}
/*
SELECT        dbo.dvkcb.id, dbo.dvkcb.mahs, dbo.dvkcb.madiaban, dbo.dvkcb.maxp, dbo.dvkcb.maspdv, dbo.dvkcb.soqd, dbo.dvkcb.tenbv, dbo.dvkcb.mota, dbo.dvkcb.dongia, dbo.dvkcb.ttqd, dbo.dvkcb.congbo, dbo.dvkcb.thaotac,
                         dbo.dvkcb.ghichu, dbo.dvkcb.lichsu, dbo.dvkcb.tinhtrang, dbo.dvkcb.thoidiem, dbo.dvkcb.macqcq, dbo.dvkcb.madv, dbo.dvkcb.lydo, dbo.dvkcb.thongtin, dbo.dvkcb.trangthai, dbo.dvkcb.thoidiem_h, dbo.dvkcb.macqcq_h,
                         dbo.dvkcb.madv_h, dbo.dvkcb.lydo_h, dbo.dvkcb.thongtin_h, dbo.dvkcb.trangthai_h, dbo.dvkcb.thoidiem_t, dbo.dvkcb.macqcq_t, dbo.dvkcb.madv_t, dbo.dvkcb.lydo_t, dbo.dvkcb.thongtin_t, dbo.dvkcb.trangthai_t,
                         dbo.dvkcb.thoidiem_ad, dbo.dvkcb.macqcq_ad, dbo.dvkcb.madv_ad, dbo.dvkcb.lydo_ad, dbo.dvkcb.thongtin_ad, dbo.dvkcb.trangthai_ad, dbo.dvkcb.created_at, dbo.dvkcb.updated_at, dbo.dmdvkcb.tenspdv, dbo.dvkcbct.dvt,
                         dbo.dvkcbct.giadv, dbo.dmdvkcb.phanloai
FROM            dbo.dvkcb INNER JOIN
                         dbo.dvkcbct ON dbo.dvkcb.mahs = dbo.dvkcbct.mahs INNER JOIN
                         dbo.dmdvkcb ON dbo.dvkcbct.maspdv = dbo.dmdvkcb.maspdv

 */