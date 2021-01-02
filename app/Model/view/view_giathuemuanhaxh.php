<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giathuemuanhaxh extends Model
{
    protected $table = 'view_giathuemuanhaxh';
    protected $fillable = [];
}
/*
SELECT        dbo.giathuemuanhaxh.madiaban, dbo.giathuemuanhaxh.maxp, dbo.giathuemuanhaxh.mahs, dbo.giathuemuanhaxh.soqd, dbo.giathuemuanhaxh.congbo, dbo.giathuemuanhaxh.lichsu, dbo.giathuemuanhaxh.ghichu,
                         dbo.giathuemuanhaxh.thoidiem, dbo.giathuemuanhaxh.macqcq, dbo.giathuemuanhaxh.madv, dbo.giathuemuanhaxh.lydo, dbo.giathuemuanhaxh.thongtin, dbo.giathuemuanhaxh.trangthai, dbo.giathuemuanhaxh.thoidiem_h,
                         dbo.giathuemuanhaxh.macqcq_h, dbo.giathuemuanhaxh.madv_h, dbo.giathuemuanhaxh.lydo_h, dbo.giathuemuanhaxh.thongtin_h, dbo.giathuemuanhaxh.trangthai_h, dbo.giathuemuanhaxh.thoidiem_t,
                         dbo.giathuemuanhaxh.macqcq_t, dbo.giathuemuanhaxh.madv_t, dbo.giathuemuanhaxh.lydo_t, dbo.giathuemuanhaxh.thongtin_t, dbo.giathuemuanhaxh.trangthai_t, dbo.giathuemuanhaxh.thoidiem_ad,
                         dbo.giathuemuanhaxh.macqcq_ad, dbo.giathuemuanhaxh.madv_ad, dbo.giathuemuanhaxh.lydo_ad, dbo.giathuemuanhaxh.thongtin_ad, dbo.giathuemuanhaxh.trangthai_ad, dbo.giathuemuanhaxhct.phanloai,
                         dbo.giathuemuanhaxhct.dvt, dbo.giathuemuanhaxhct.dongia, dbo.giathuemuanhaxhct.dongiathue, dbo.giathuemuanhaxhct.tungay, dbo.giathuemuanhaxhct.denngay, dbo.dmnhaxh.tennha, dbo.dmnhaxh.diachi,
                         dbo.dmnhaxh.donviql, dbo.dmnhaxh.dientich, dbo.dmnhaxh.hientrang
FROM            dbo.dmnhaxh INNER JOIN
                         dbo.giathuemuanhaxhct ON dbo.dmnhaxh.maso = dbo.giathuemuanhaxhct.maso INNER JOIN
                         dbo.giathuemuanhaxh ON dbo.giathuemuanhaxhct.mahs = dbo.giathuemuanhaxh.mahs
 */