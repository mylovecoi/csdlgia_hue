<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giadatdiaban extends Model
{
    protected $table = 'view_giadatdiaban';
    protected $fillable = [];
}
/*
SELECT        dbo.giadatdiaban.mahs, dbo.giadatdiaban.madiaban, dbo.giadatdiaban.maxp, dbo.giadatdiaban.soqd, dbo.giadatdiaban.nam, dbo.giadatdiaban.noidung, dbo.giadatdiaban.congbo, dbo.giadatdiaban.lichsu,
                         dbo.giadatdiaban.macqcq, dbo.giadatdiaban.trangthai, dbo.giadatdiaban.madv, dbo.giadatdiaban.macqcq_h, dbo.giadatdiaban.madv_h, dbo.giadatdiaban.trangthai_h, dbo.giadatdiaban.macqcq_t, dbo.giadatdiaban.madv_t,
                         dbo.giadatdiaban.trangthai_t, dbo.giadatdiaban.macqcq_ad, dbo.giadatdiaban.madv_ad, dbo.giadatdiaban.trangthai_ad, dbo.giadatdiabanct.maloaidat, dbo.giadatdiabanct.khuvuc, dbo.giadatdiabanct.diemdau,
                         dbo.giadatdiabanct.diemcuoi, dbo.giadatdiabanct.loaiduong, dbo.giadatdiabanct.mota, dbo.giadatdiabanct.mdsd, dbo.giadatdiabanct.giavt1, dbo.giadatdiabanct.giavt2, dbo.giadatdiabanct.giavt3, dbo.giadatdiabanct.giavt4,
                         dbo.giadatdiabanct.giavt5, dbo.giadatdiabanct.hesok, dbo.giadatdiabanct.sapxep, dbo.giadatdiaban.thoidiem, dbo.giadatdiaban.thoidiem_h, dbo.giadatdiaban.thoidiem_t, dbo.giadatdiaban.thoidiem_ad
FROM            dbo.giadatdiaban INNER JOIN
                         dbo.giadatdiabanct ON dbo.giadatdiaban.mahs = dbo.giadatdiabanct.mahs
 */