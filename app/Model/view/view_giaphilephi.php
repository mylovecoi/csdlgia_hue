<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giaphilephi extends Model
{
    protected $table = 'view_giaphilephi';
    protected $fillable = [];
}
/*
SELECT        dbo.philephi.mahs, dbo.philephi.mota, dbo.philephi.soqd, dbo.philephi.ngayapdung, dbo.philephi.manhom, dbo.philephi.congbo, dbo.philephi.lichsu, dbo.philephi.thoidiem, dbo.philephi.macqcq, dbo.philephi.madv,
                         dbo.philephi.lydo, dbo.philephi.thongtin, dbo.philephi.trangthai, dbo.philephi.thoidiem_h, dbo.philephi.macqcq_h, dbo.philephi.madv_h, dbo.philephi.lydo_h, dbo.philephi.thongtin_h, dbo.philephi.trangthai_h,
                         dbo.philephi.thoidiem_t, dbo.philephi.macqcq_t, dbo.philephi.madv_t, dbo.philephi.lydo_t, dbo.philephi.thongtin_t, dbo.philephi.trangthai_t, dbo.philephi.thoidiem_ad, dbo.philephi.macqcq_ad, dbo.philephi.madv_ad,
                         dbo.philephi.lydo_ad, dbo.philephi.thongtin_ad, dbo.philephi.trangthai_ad, dbo.philephi.created_at, dbo.philephi.updated_at, dbo.philephi.dvt, dbo.philephi.madiaban, dbo.philephi.maxp, dbo.philephict.ptcp,
                         dbo.philephict.ghichu, dbo.philephict.mucthutu, dbo.philephict.mucthuden, dbo.dmphilephi.tennhom
FROM            dbo.philephi INNER JOIN
                         dbo.philephict ON dbo.philephi.mahs = dbo.philephict.mahs INNER JOIN
                         dbo.dmphilephi ON dbo.philephi.manhom = dbo.dmphilephi.manhom
 */