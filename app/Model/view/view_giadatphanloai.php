<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giadatphanloai extends Model
{
    protected $table = 'view_giadatphanloai';
    protected $fillable = [];
}
/*
SELECT        dbo.giadatphanloai.mahs, dbo.giadatphanloai.madiaban, dbo.giadatphanloai.soqd, dbo.giadatphanloai.thoidiem, dbo.giadatphanloai.trangthai_ad, dbo.giadatphanloai.thongtin_ad, dbo.giadatphanloai.lydo_ad,
                         dbo.giadatphanloai.madv_ad, dbo.giadatphanloai.macqcq_ad, dbo.giadatphanloai.thoidiem_ad, dbo.giadatphanloai.trangthai_t, dbo.giadatphanloai.thongtin_t, dbo.giadatphanloai.lydo_t, dbo.giadatphanloai.macqcq_t,
                         dbo.giadatphanloai.madv_t, dbo.giadatphanloai.thoidiem_t, dbo.giadatphanloai.trangthai_h, dbo.giadatphanloai.thongtin_h, dbo.giadatphanloai.lydo_h, dbo.giadatphanloai.madv_h, dbo.giadatphanloai.macqcq_h,
                         dbo.giadatphanloai.thoidiem_h, dbo.giadatphanloai.trangthai, dbo.giadatphanloai.thongtin, dbo.giadatphanloai.lydo, dbo.giadatphanloai.madv, dbo.giadatphanloai.macqcq, dbo.giadatphanloai.tinhtrang,
                         dbo.giadatphanloai.congbo, dbo.giadatphanloai_ct.maloaidat, dbo.giadatphanloai_ct.khuvuc, dbo.giadatphanloai_ct.vitri, dbo.giadatphanloai_ct.banggiadat, dbo.giadatphanloai_ct.giacuthe, dbo.giadatphanloai_ct.hesodc
FROM            dbo.giadatphanloai INNER JOIN
                         dbo.giadatphanloai_ct ON dbo.giadatphanloai.mahs = dbo.giadatphanloai_ct.mahs
 */