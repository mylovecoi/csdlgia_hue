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
                         dbo.dmgiadvgddt.phanloai, dbo.giadvgddt.tunam, dbo.giadvgddt.dennam, dbo.giadvgddtct.namapdung1, dbo.giadvgddtct.giathanhthi1, dbo.giadvgddtct.gianongthon1, dbo.giadvgddtct.giamiennui1, dbo.giadvgddtct.namapdung2,
                         dbo.giadvgddtct.giathanhthi2, dbo.giadvgddtct.gianongthon2, dbo.giadvgddtct.giamiennui2, dbo.giadvgddtct.namapdung3, dbo.giadvgddtct.giathanhthi3, dbo.giadvgddtct.gianongthon3, dbo.giadvgddtct.giamiennui3,
                         dbo.giadvgddtct.namapdung4, dbo.giadvgddtct.giathanhthi4, dbo.giadvgddtct.gianongthon4, dbo.giadvgddtct.giamiennui4, dbo.giadvgddtct.namapdung5, dbo.giadvgddtct.giathanhthi5, dbo.giadvgddtct.gianongthon5,
                         dbo.giadvgddtct.giamiennui5, dbo.giadvgddtct.gc
FROM            dbo.giadvgddt INNER JOIN
                         dbo.giadvgddtct ON dbo.giadvgddt.mahs = dbo.giadvgddtct.mahs INNER JOIN
                         dbo.dmgiadvgddt ON dbo.giadvgddtct.maspdv = dbo.dmgiadvgddt.maspdv
 */