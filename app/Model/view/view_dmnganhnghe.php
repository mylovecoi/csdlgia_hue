<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_dmnganhnghe extends Model
{
    protected $table = 'view_dmnganhnghe';
    protected $fillable = [];
}
/*
SELECT        dbo.dmnganhkd.manganh, dbo.dmnganhkd.tennganh, dbo.dmnghekd.manghe, dbo.dmnghekd.tennghe, dbo.dmnghekd.madv, dbo.dmnghekd.phanloai, dbo.dmnghekd.theodoi
FROM            dbo.dmnganhkd INNER JOIN
                         dbo.dmnghekd ON dbo.dmnganhkd.manganh = dbo.dmnghekd.manganh
 */