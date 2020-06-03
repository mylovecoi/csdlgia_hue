<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giacuocvanchuyen extends Model
{
    protected $table = 'view_giacuocvanchuyen';
    protected $fillable = [];
}
/*
SELECT        dbo.giacuocvanchuyen.mahs, dbo.giacuocvanchuyen.madiaban, dbo.giacuocvanchuyen.maxp, dbo.giacuocvanchuyen.soqd, dbo.giacuocvanchuyen.ttqd, dbo.giacuocvanchuyen.congbo, dbo.giacuocvanchuyen.thaotac,
                         dbo.giacuocvanchuyen.ghichu, dbo.giacuocvanchuyen.lichsu, dbo.giacuocvanchuyen.tinhtrang, dbo.giacuocvanchuyen.phanloai, dbo.giacuocvanchuyen.ipf1, dbo.giacuocvanchuyen.ipf2, dbo.giacuocvanchuyen.ipf3,
                         dbo.giacuocvanchuyen.ipf4, dbo.giacuocvanchuyen.ipf5, dbo.giacuocvanchuyen.thoidiem, dbo.giacuocvanchuyen.macqcq, dbo.giacuocvanchuyen.madv, dbo.giacuocvanchuyen.lydo, dbo.giacuocvanchuyen.thongtin,
                         dbo.giacuocvanchuyen.trangthai, dbo.giacuocvanchuyen.thoidiem_h, dbo.giacuocvanchuyen.macqcq_h, dbo.giacuocvanchuyen.madv_h, dbo.giacuocvanchuyen.lydo_h, dbo.giacuocvanchuyen.thongtin_h,
                         dbo.giacuocvanchuyen.trangthai_h, dbo.giacuocvanchuyen.thoidiem_t, dbo.giacuocvanchuyen.macqcq_t, dbo.giacuocvanchuyen.madv_t, dbo.giacuocvanchuyen.lydo_t, dbo.giacuocvanchuyen.thongtin_t,
                         dbo.giacuocvanchuyen.trangthai_t, dbo.giacuocvanchuyen.thoidiem_ad, dbo.giacuocvanchuyen.macqcq_ad, dbo.giacuocvanchuyen.madv_ad, dbo.giacuocvanchuyen.lydo_ad, dbo.giacuocvanchuyen.thongtin_ad,
                         dbo.giacuocvanchuyen.trangthai_ad, dbo.giacuocvanchuyenct.tencuoc, dbo.giacuocvanchuyenct.tukm, dbo.giacuocvanchuyenct.denkm, dbo.giacuocvanchuyenct.bachh, dbo.giacuocvanchuyenct.phanloai AS phanloaict,
                         dbo.giacuocvanchuyenct.giavc1, dbo.giacuocvanchuyenct.giavc2, dbo.giacuocvanchuyenct.giavc3, dbo.giacuocvanchuyenct.giavc4, dbo.giacuocvanchuyenct.giavc5, dbo.giacuocvanchuyenct.gc
FROM            dbo.giacuocvanchuyen INNER JOIN
                         dbo.giacuocvanchuyenct ON dbo.giacuocvanchuyen.mahs = dbo.giacuocvanchuyenct.mahs
 */