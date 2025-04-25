<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giagocvlxd extends Model
{
    protected $table = 'view_giagocvlxd';
    protected $fillable = [];
}
// SELECT        dbo.thgiagocvlxd.mahs, dbo.thgiagocvlxd.quy, dbo.thgiagocvlxd.nam, dbo.thgiagocvlxd.sobc, dbo.thgiagocvlxd.thang, dbo.thgiagocvlxdct.tenhhdv, dbo.thgiagocvlxdct.qccl, dbo.thgiagocvlxdct.dvt, dbo.thgiagocvlxdct.giagoc, 
//                          dbo.thgiagocvlxdct.qcad, dbo.thgiagocvlxdct.ghichu, dbo.thgiagocvlxd.trangthai
// FROM            dbo.thgiagocvlxd INNER JOIN
//                          dbo.thgiagocvlxdct ON dbo.thgiagocvlxd.mahs = dbo.thgiagocvlxdct.mahs