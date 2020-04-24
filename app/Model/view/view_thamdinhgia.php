<?php
namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_thamdinhgia extends Model
{
    protected $table = 'view_thamdinhgia';
    protected $fillable = [];
}
/*
SELECT        dbo.thamdinhgia.madiaban, dbo.thamdinhgia.maxp, dbo.thamdinhgia.mahs, dbo.thamdinhgia.diadiem, dbo.thamdinhgia.ppthamdinh, dbo.thamdinhgia.mucdich, dbo.thamdinhgia.dvyeucau, dbo.thamdinhgia.thoihan,
                         dbo.thamdinhgia.sotbkl, dbo.thamdinhgia.hosotdgia, dbo.thamdinhgia.nguonvon, dbo.thamdinhgia.phanloai, dbo.thamdinhgia.quy, dbo.thamdinhgia.thuevat, dbo.thamdinhgia.songaykq, dbo.thamdinhgia.tttstd,
                         dbo.thamdinhgia.ghichu, dbo.thamdinhgia.congbo, dbo.thamdinhgia.thaotac, dbo.thamdinhgia.ipf1, dbo.thamdinhgia.ipf2, dbo.thamdinhgia.ipf3, dbo.thamdinhgia.ipf4, dbo.thamdinhgia.ipf5, dbo.thamdinhgia.lichsu,
                         dbo.thamdinhgia.thoidiem, dbo.thamdinhgia.macqcq, dbo.thamdinhgia.madv, dbo.thamdinhgia.lydo, dbo.thamdinhgia.thongtin, dbo.thamdinhgia.trangthai, dbo.thamdinhgia.thoidiem_h, dbo.thamdinhgia.macqcq_h,
                         dbo.thamdinhgia.madv_h, dbo.thamdinhgia.lydo_h, dbo.thamdinhgia.thongtin_h, dbo.thamdinhgia.trangthai_h, dbo.thamdinhgia.thoidiem_t, dbo.thamdinhgia.macqcq_t, dbo.thamdinhgia.madv_t, dbo.thamdinhgia.lydo_t,
                         dbo.thamdinhgia.thongtin_t, dbo.thamdinhgia.trangthai_t, dbo.thamdinhgia.thoidiem_ad, dbo.thamdinhgia.macqcq_ad, dbo.thamdinhgia.madv_ad, dbo.thamdinhgia.lydo_ad, dbo.thamdinhgia.thongtin_ad,
                         dbo.thamdinhgia.trangthai_ad, dbo.thamdinhgiact.manhom, dbo.thamdinhgiact.mats, dbo.thamdinhgiact.tents, dbo.thamdinhgiact.dacdiempl, dbo.thamdinhgiact.thongsokt, dbo.thamdinhgiact.nguongoc, dbo.thamdinhgiact.dvt,
                         dbo.thamdinhgiact.sl, dbo.thamdinhgiact.nguyengiadenghi, dbo.thamdinhgiact.giadenghi, dbo.thamdinhgiact.nguyengiathamdinh, dbo.thamdinhgiact.giatritstd, dbo.thamdinhgiact.giaththamdinh,
                         dbo.thamdinhgiact.giakththamdinh, dbo.thamdinhgiact.gc
FROM            dbo.thamdinhgia INNER JOIN
                         dbo.thamdinhgiact ON dbo.thamdinhgia.mahs = dbo.thamdinhgiact.mahs
 */