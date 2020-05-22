<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giaetanol extends Model
{
    protected $table = 'view_giaetanol';
    protected $fillable = [];
}

/*SELECT        dbo.kkgiaetanol.*, dbo.kkgiaetanolct.tthhdv, dbo.kkgiaetanolct.qccl, dbo.kkgiaetanolct.dvt, dbo.kkgiaetanolct.dongialk, dbo.kkgiaetanolct.dongia, dbo.kkgiaetanolct.plhs
FROM            dbo.kkgiaetanol INNER JOIN
                         dbo.kkgiaetanolct ON dbo.kkgiaetanol.mahs = dbo.kkgiaetanolct.mahs*/

