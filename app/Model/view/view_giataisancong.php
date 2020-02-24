<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giataisancong extends Model
{
    protected $table = 'view_giataisancong';
    protected $fillable = [];
}
/*
SELECT        dbo.giataisancong.id, dbo.giataisancong.madiaban, dbo.giataisancong.maxp, dbo.giataisancong.mahs, dbo.giataisancong.soqd, dbo.giataisancong.mataisan, dbo.giataisancong.thongtinhs, dbo.giataisancong.tungay,
                         dbo.giataisancong.denngay, dbo.giataisancong.giathue, dbo.giataisancong.congbo, dbo.giataisancong.lichsu, dbo.giataisancong.ghichu, dbo.giataisancong.thoidiem, dbo.giataisancong.macqcq, dbo.giataisancong.madv,
                         dbo.giataisancong.lydo, dbo.giataisancong.thongtin, dbo.giataisancong.trangthai, dbo.giataisancong.thoidiem_h, dbo.giataisancong.macqcq_h, dbo.giataisancong.madv_h, dbo.giataisancong.lydo_h,
                         dbo.giataisancong.thongtin_h, dbo.giataisancong.trangthai_h, dbo.giataisancong.thoidiem_t, dbo.giataisancong.macqcq_t, dbo.giataisancong.madv_t, dbo.giataisancong.lydo_t, dbo.giataisancong.thongtin_t,
                         dbo.giataisancong.trangthai_t, dbo.giataisancong.thoidiem_ad, dbo.giataisancong.macqcq_ad, dbo.giataisancong.madv_ad, dbo.giataisancong.lydo_ad, dbo.giataisancong.thongtin_ad, dbo.giataisancong.trangthai_ad,
                         dbo.giataisancong.created_at, dbo.giataisancong.updated_at, dbo.giataisancongdm.tentaisan, dbo.giataisancongdm.dientich, dbo.giataisancongdm.dvt, dbo.giataisancongdm.mota, dbo.giataisancongdm.giatri,
                         dbo.giataisancongdm.hientrang
FROM            dbo.giataisancong INNER JOIN
                         dbo.giataisancongdm ON dbo.giataisancong.mataisan = dbo.giataisancongdm.mataisan
 */