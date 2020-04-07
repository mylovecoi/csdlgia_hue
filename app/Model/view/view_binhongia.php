<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_binhongia extends Model
{
    protected $table = 'view_binhongia';
    protected $fillable = [];
}
/*
SELECT        dbo.kkmhbog.*, dbo.kkmhbogct.tenhh, dbo.kkmhbogct.quycach, dbo.kkmhbogct.dvt, dbo.kkmhbogct.gialk, dbo.kkmhbogct.giakk, dbo.kkmhbogct.plhh
FROM            dbo.kkmhbog INNER JOIN
                         dbo.kkmhbogct ON dbo.kkmhbog.mahs = dbo.kkmhbogct.mahs
 */