<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_thgiahhdvk extends Model
{
    protected $table = 'view_thgiahhdvk';
    protected $fillable = [];
}
/*
SELECT        dbo.thgiahhdvk.ngaybc, dbo.thgiahhdvk.ngaychotbc, dbo.thgiahhdvk.sobc, dbo.thgiahhdvk.ttbc, dbo.thgiahhdvk.matt, dbo.thgiahhdvk.mahs, dbo.thgiahhdvk.phanloai, dbo.thgiahhdvk.thang, dbo.thgiahhdvk.nam, 
                         dbo.thgiahhdvk.ghichu, dbo.thgiahhdvk.congbo, dbo.thgiahhdvk.trangthai, dbo.thgiahhdvkct.gialk, dbo.thgiahhdvkct.gia, dbo.thgiahhdvkct.loaigia, dbo.thgiahhdvkct.nguontt, dbo.dmhhdvk.tenhhdv, dbo.dmhhdvk.dacdiemkt, 
                         dbo.dmhhdvk.xuatxu, dbo.dmhhdvk.dvt, dbo.thgiahhdvkct.mahhdv
FROM            dbo.thgiahhdvk INNER JOIN
                         dbo.thgiahhdvkct ON dbo.thgiahhdvk.mahs = dbo.thgiahhdvkct.mahs LEFT OUTER JOIN
                         dbo.dmhhdvk ON dbo.thgiahhdvkct.mahhdv = dbo.dmhhdvk.mahhdv
 */