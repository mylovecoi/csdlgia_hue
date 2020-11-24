<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class view_dsdoanhnghiep_dangky extends Model
{
    protected $table = 'view_dsdoanhnghiep_dangky';
    protected $fillable = [];
}
/*
SELECT dbo.company.madv, dbo.company.tendn, dbo.users.name, dbo.users.username, dbo.users.password, dbo.users.status, dbo.company.madiaban, dbo.dsdiaban.tendiaban, dbo.dsdiaban.[level]
FROM     dbo.company INNER JOIN
                  dbo.users ON dbo.company.madv = dbo.users.madv INNER JOIN
                  dbo.dsdiaban ON dbo.company.madiaban = dbo.dsdiaban.madiaban
 */