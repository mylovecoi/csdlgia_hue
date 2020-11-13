<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giaspdvkhunggia extends Model
{
    protected $table = 'view_giaspdvkhunggia';
    protected $fillable = [];
}
/*
SELECT        dbo.giaspdvkhunggia.mahs, dbo.giaspdvkhunggia.madiaban, dbo.giaspdvkhunggia.maxp, dbo.giaspdvkhunggia.soqd, dbo.giaspdvkhunggia.ttqd, dbo.giaspdvkhunggia.congbo, dbo.giaspdvkhunggia.thaotac,
                         dbo.giaspdvkhunggia.ghichu, dbo.giaspdvkhunggia.lichsu, dbo.giaspdvkhunggia.tinhtrang, dbo.giaspdvkhunggia.thoidiem, dbo.giaspdvkhunggia.macqcq, dbo.giaspdvkhunggia.madv, dbo.giaspdvkhunggia.lydo,
                         dbo.giaspdvkhunggia.thongtin, dbo.giaspdvkhunggia.trangthai, dbo.giaspdvkhunggia.ipf1, dbo.giaspdvkhunggia.ipf2, dbo.giaspdvkhunggia.ipf3, dbo.giaspdvkhunggia.ipf4, dbo.giaspdvkhunggia.ipf5,
                         dbo.giaspdvkhunggia.thoidiem_h, dbo.giaspdvkhunggia.macqcq_h, dbo.giaspdvkhunggia.madv_h, dbo.giaspdvkhunggia.lydo_h, dbo.giaspdvkhunggia.thongtin_h, dbo.giaspdvkhunggia.trangthai_h,
                         dbo.giaspdvkhunggia.thoidiem_t, dbo.giaspdvkhunggia.macqcq_t, dbo.giaspdvkhunggia.madv_t, dbo.giaspdvkhunggia.lydo_t, dbo.giaspdvkhunggia.thongtin_t, dbo.giaspdvkhunggia.trangthai_t,
                         dbo.giaspdvkhunggia.thoidiem_ad, dbo.giaspdvkhunggia.macqcq_ad, dbo.giaspdvkhunggia.madv_ad, dbo.giaspdvkhunggia.lydo_ad, dbo.giaspdvkhunggia.thongtin_ad, dbo.giaspdvkhunggia.trangthai_ad,
                         dbo.giaspdvkhunggia_ct.giatoithieu, dbo.giaspdvkhunggia_ct.giatoida, dbo.giaspdvkhunggia_dm.maspdv, dbo.giaspdvkhunggia_dm.tenspdv, dbo.giaspdvkhunggia_dm.dvt, dbo.giaspdvkhunggia_dm.mota,
                         dbo.giaspdvkhunggia_dm.phanloai
FROM            dbo.giaspdvkhunggia INNER JOIN
                         dbo.giaspdvkhunggia_ct ON dbo.giaspdvkhunggia.mahs = dbo.giaspdvkhunggia_ct.mahs INNER JOIN
                         dbo.giaspdvkhunggia_dm ON dbo.giaspdvkhunggia_ct.maspdv = dbo.giaspdvkhunggia_dm.maspdv
 */