<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giadvgddt extends Model
{
    protected $table = 'view_giadvgddt';
    protected $fillable = [];
}
/*
SELECT        dbo.giadvgddt.madiaban, dbo.giadvgddt.maxp, dbo.giadvgddt.mahs, dbo.giadvgddt.soqd, dbo.giadvgddt.nam, dbo.giadvgddt.mota, dbo.giadvgddt.congbo, dbo.giadvgddt.lichsu, dbo.giadvgddt.ghichu, dbo.giadvgddt.thoidiem,
                         dbo.giadvgddt.macqcq, dbo.giadvgddt.madv, dbo.giadvgddt.lydo, dbo.giadvgddt.thongtin, dbo.giadvgddt.trangthai, dbo.giadvgddt.thoidiem_h, dbo.giadvgddt.macqcq_h, dbo.giadvgddt.madv_h, dbo.giadvgddt.lydo_h,
                         dbo.giadvgddt.thongtin_h, dbo.giadvgddt.trangthai_h, dbo.giadvgddt.thoidiem_t, dbo.giadvgddt.macqcq_t, dbo.giadvgddt.madv_t, dbo.giadvgddt.lydo_t, dbo.giadvgddt.thongtin_t, dbo.giadvgddt.trangthai_t,
                         dbo.giadvgddt.thoidiem_ad, dbo.giadvgddt.macqcq_ad, dbo.giadvgddt.madv_ad, dbo.giadvgddt.lydo_ad, dbo.giadvgddt.thongtin_ad, dbo.giadvgddt.trangthai_ad, dbo.giadvgddtct.maspdv, dbo.dmgiadvgddt.tenspdv,
                         dbo.dmgiadvgddt.phanloai, dbo.giadvgddtct.giadvthanhthi, dbo.giadvgddtct.giadvnongthon, dbo.giadvgddtct.giadvmiennui, dbo.giadvgddtct.created_at
FROM            dbo.giadvgddt INNER JOIN
                         dbo.giadvgddtct ON dbo.giadvgddt.mahs = dbo.giadvgddtct.mahs INNER JOIN
                         dbo.dmgiadvgddt ON dbo.giadvgddtct.maspdv = dbo.dmgiadvgddt.maspdv
 */