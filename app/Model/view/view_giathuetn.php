<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giathuetn extends Model
{
    protected $table = 'view_giathuetn';
    protected $fillable = [];
}
/*
SELECT        dbo.thuetainguyen.mahs, dbo.thuetainguyen.madiaban, dbo.thuetainguyen.maxp, dbo.thuetainguyen.soqd, dbo.thuetainguyen.thoidiemlk, dbo.thuetainguyen.soqdlk, dbo.thuetainguyen.cqbh, dbo.thuetainguyen.manhom,
                         dbo.thuetainguyen.congbo, dbo.thuetainguyen.lichsu, dbo.thuetainguyen.tinhtrang, dbo.thuetainguyen.ghichu, dbo.thuetainguyen.thoidiem, dbo.thuetainguyen.macqcq, dbo.thuetainguyen.madv, dbo.thuetainguyen.lydo,
                         dbo.thuetainguyen.thongtin, dbo.thuetainguyen.trangthai, dbo.thuetainguyen.thoidiem_h, dbo.thuetainguyen.macqcq_h, dbo.thuetainguyen.madv_h, dbo.thuetainguyen.lydo_h, dbo.thuetainguyen.thongtin_h,
                         dbo.thuetainguyen.trangthai_h, dbo.thuetainguyen.thoidiem_t, dbo.thuetainguyen.macqcq_t, dbo.thuetainguyen.madv_t, dbo.thuetainguyen.lydo_t, dbo.thuetainguyen.thongtin_t, dbo.thuetainguyen.trangthai_t,
                         dbo.thuetainguyen.thoidiem_ad, dbo.thuetainguyen.macqcq_ad, dbo.thuetainguyen.madv_ad, dbo.thuetainguyen.lydo_ad, dbo.thuetainguyen.thongtin_ad, dbo.thuetainguyen.trangthai_ad, dbo.thuetainguyenct.[level],
                         dbo.thuetainguyenct.cap1, dbo.thuetainguyenct.cap2, dbo.thuetainguyenct.cap3, dbo.thuetainguyenct.cap4, dbo.thuetainguyenct.cap5, dbo.thuetainguyenct.ten, dbo.thuetainguyenct.dvt, dbo.thuetainguyenct.gia
FROM            dbo.thuetainguyen INNER JOIN
                         dbo.thuetainguyenct ON dbo.thuetainguyen.mahs = dbo.thuetainguyenct.mahs COLLATE SQL_Latin1_General_CP1_CI_AS
 */