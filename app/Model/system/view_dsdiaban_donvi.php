<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class view_dsdiaban_donvi extends Model
{
    protected $table = 'view_dsdiaban_donvi';
    protected $fillable = [];
}
/*
SELECT        dbo.dsdiaban.madiaban, dbo.dsdiaban.tendiaban, dbo.dsdiaban.[level], dbo.dsdonvi.madv, dbo.dsdonvi.tendv, dbo.dsdonvi.chucnang, dbo.dsdonvi.tendvhienthi, dbo.dsdonvi.tendvcqhienthi, dbo.dsdonvi.chucvuky,
                         dbo.dsdonvi.chucvukythay, dbo.dsdonvi.nguoiky, dbo.dsdonvi.diadanh
FROM            dbo.dsdiaban INNER JOIN
                         dbo.dsdonvi ON dbo.dsdiaban.madiaban = dbo.dsdonvi.madiaban
 */