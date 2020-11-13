<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giaspdvtoida extends Model
{
    protected $table = 'view_giaspdvtoida';
    protected $fillable = [];
}
/*
SELECT        dbo.giaspdvtoida.mahs, dbo.giaspdvtoida.madiaban, dbo.giaspdvtoida.maxp, dbo.giaspdvtoida.soqd, dbo.giaspdvtoida.ttqd, dbo.giaspdvtoida.congbo, dbo.giaspdvtoida.thaotac, dbo.giaspdvtoida.ghichu,
                         dbo.giaspdvtoida.lichsu, dbo.giaspdvtoida.tinhtrang, dbo.giaspdvtoida.thoidiem, dbo.giaspdvtoida.macqcq, dbo.giaspdvtoida.madv, dbo.giaspdvtoida.lydo, dbo.giaspdvtoida.thongtin, dbo.giaspdvtoida.trangthai,
                         dbo.giaspdvtoida.ipf1, dbo.giaspdvtoida.ipf2, dbo.giaspdvtoida.ipf3, dbo.giaspdvtoida.ipf4, dbo.giaspdvtoida.ipf5, dbo.giaspdvtoida.thoidiem_h, dbo.giaspdvtoida.macqcq_h, dbo.giaspdvtoida.madv_h, dbo.giaspdvtoida.lydo_h,
                         dbo.giaspdvtoida.thongtin_h, dbo.giaspdvtoida.trangthai_h, dbo.giaspdvtoida.thoidiem_t, dbo.giaspdvtoida.macqcq_t, dbo.giaspdvtoida.madv_t, dbo.giaspdvtoida.lydo_t, dbo.giaspdvtoida.thongtin_t,
                         dbo.giaspdvtoida.trangthai_t, dbo.giaspdvtoida.thoidiem_ad, dbo.giaspdvtoida.macqcq_ad, dbo.giaspdvtoida.madv_ad, dbo.giaspdvtoida.lydo_ad, dbo.giaspdvtoida.thongtin_ad, dbo.giaspdvtoida.trangthai_ad,
                         dbo.giaspdvtoida_dm.maspdv, dbo.giaspdvtoida_dm.tenspdv, dbo.giaspdvtoida_dm.dvt, dbo.giaspdvtoida_dm.phanloai, dbo.giaspdvtoida_dm.mota, dbo.giaspdvtoida_ct.dongia
FROM            dbo.giaspdvtoida INNER JOIN
                         dbo.giaspdvtoida_dm ON dbo.giaspdvtoida.id = dbo.giaspdvtoida_dm.id INNER JOIN
                         dbo.giaspdvtoida_ct ON dbo.giaspdvtoida_dm.maspdv = dbo.giaspdvtoida_ct.maspdv AND dbo.giaspdvtoida.mahs = dbo.giaspdvtoida_ct.mahs
 */