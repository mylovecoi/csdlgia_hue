<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giaspdvci extends Model
{
    protected $table = 'view_giaspdvci';
    protected $fillable = [];
}
/*
SELECT        dbo.giaspdvci.mahs, dbo.giaspdvci.madiaban, dbo.giaspdvci.maxp, dbo.giaspdvci.soqd, dbo.giaspdvci.ttqd, dbo.giaspdvci.congbo, dbo.giaspdvci.thaotac, dbo.giaspdvci.ghichu, dbo.giaspdvci.lichsu, dbo.giaspdvci.tinhtrang,
                         dbo.giaspdvci.thoidiem, dbo.giaspdvci.macqcq, dbo.giaspdvci.madv, dbo.giaspdvci.lydo, dbo.giaspdvci.thongtin, dbo.giaspdvci.trangthai, dbo.giaspdvci.thoidiem_h, dbo.giaspdvci.macqcq_h, dbo.giaspdvci.madv_h,
                         dbo.giaspdvci.lydo_h, dbo.giaspdvci.thongtin_h, dbo.giaspdvci.trangthai_h, dbo.giaspdvci.thoidiem_t, dbo.giaspdvci.macqcq_t, dbo.giaspdvci.madv_t, dbo.giaspdvci.lydo_t, dbo.giaspdvci.thongtin_t, dbo.giaspdvci.trangthai_t,
                         dbo.giaspdvci.thoidiem_ad, dbo.giaspdvci.macqcq_ad, dbo.giaspdvci.madv_ad, dbo.giaspdvci.lydo_ad, dbo.giaspdvci.thongtin_ad, dbo.giaspdvci.trangthai_ad, dbo.giaspdvcict.mota, dbo.giaspdvcict.dongia,
                         dbo.giaspdvcict.maspdv, dbo.giaspdvcidm.tenspdv, dbo.giaspdvcidm.dvt, dbo.giaspdvcidm.phanloai
FROM            dbo.giaspdvci INNER JOIN
                         dbo.giaspdvcict ON dbo.giaspdvci.mahs = dbo.giaspdvcict.mahs INNER JOIN
                         dbo.giaspdvcidm ON dbo.giaspdvcict.maspdv = dbo.giaspdvcidm.maspdv
 */