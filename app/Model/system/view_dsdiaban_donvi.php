<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class view_dsdiaban_donvi extends Model
{
    protected $table = 'view_dsdiaban_donvi';
    protected $fillable = [];
}
/*
SELECT        dbo.gianuocsh.madiaban, dbo.gianuocsh.maxp, dbo.gianuocsh.mahs, dbo.gianuocsh.soqd, dbo.gianuocsh.mota, dbo.gianuocsh.congbo, dbo.gianuocsh.lichsu, dbo.gianuocsh.ghichu, dbo.gianuocsh.thoidiem,
                         dbo.gianuocsh.macqcq, dbo.gianuocsh.madv, dbo.gianuocsh.lydo, dbo.gianuocsh.thongtin, dbo.gianuocsh.trangthai, dbo.gianuocsh.thoidiem_h, dbo.gianuocsh.macqcq_h, dbo.gianuocsh.madv_h, dbo.gianuocsh.lydo_h,
                         dbo.gianuocsh.thongtin_h, dbo.gianuocsh.trangthai_h, dbo.gianuocsh.thoidiem_t, dbo.gianuocsh.macqcq_t, dbo.gianuocsh.madv_t, dbo.gianuocsh.lydo_t, dbo.gianuocsh.thongtin_t, dbo.gianuocsh.trangthai_t,
                         dbo.gianuocsh.thoidiem_ad, dbo.gianuocsh.macqcq_ad, dbo.gianuocsh.madv_ad, dbo.gianuocsh.lydo_ad, dbo.gianuocsh.thongtin_ad, dbo.gianuocsh.trangthai_ad, dbo.gianuocsh.created_at, dbo.gianuocsh.updated_at,
                         dbo.gianuocshct.madoituong, dbo.gianuocshct.giachuathue, dbo.gianuocshct.thuevat, dbo.gianuocshct.giacothue, dbo.gianuocshct.phibvmttyle, dbo.gianuocshct.phibvmt, dbo.gianuocshct.thanhtien,
                         dbo.gianuocshct.doituongsd
FROM            dbo.gianuocsh INNER JOIN
                         dbo.gianuocshct ON dbo.gianuocsh.mahs = dbo.gianuocshct.mahs
 */