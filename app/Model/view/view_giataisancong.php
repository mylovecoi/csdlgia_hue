<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giataisancong extends Model
{
    protected $table = 'view_giataisancong';
    protected $fillable = [];
}
/*
SELECT        dbo.giataisancong.madiaban, dbo.giataisancong.maxp, dbo.giataisancong.mahs, dbo.giataisancong.soqd, dbo.giataisancong.congbo, dbo.giataisancong.lichsu, dbo.giataisancong.ghichu, dbo.giataisancong.thoidiem,
                         dbo.giataisancong.macqcq, dbo.giataisancong.madv, dbo.giataisancong.lydo, dbo.giataisancong.thongtin, dbo.giataisancong.trangthai, dbo.giataisancong.thoidiem_h, dbo.giataisancong.macqcq_h, dbo.giataisancong.madv_h,
                         dbo.giataisancong.lydo_h, dbo.giataisancong.thongtin_h, dbo.giataisancong.trangthai_h, dbo.giataisancong.thoidiem_t, dbo.giataisancong.macqcq_t, dbo.giataisancong.madv_t, dbo.giataisancong.lydo_t,
                         dbo.giataisancong.thongtin_t, dbo.giataisancong.trangthai_t, dbo.giataisancong.thoidiem_ad, dbo.giataisancong.macqcq_ad, dbo.giataisancong.madv_ad, dbo.giataisancong.lydo_ad, dbo.giataisancong.thongtin_ad,
                         dbo.giataisancong.trangthai_ad, dbo.giataisancongct.mataisan, dbo.giataisancongct.tentaisan, dbo.giataisancongct.dacdiem, dbo.giataisancongct.giathue, dbo.giataisancongct.giaban, dbo.giataisancongct.giapheduyet,
                         dbo.giataisancongct.giaconlai
FROM            dbo.giataisancong INNER JOIN
                         dbo.giataisancongct ON dbo.giataisancong.mahs = dbo.giataisancongct.mahs
 */