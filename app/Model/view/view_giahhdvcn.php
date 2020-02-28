<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giahhdvcn extends Model
{
    protected $table = 'view_giahhdvcn';
    protected $fillable = [];
}
/*
SELECT        dbo.giahhdvcn.*, dbo.giahhdvcnct.maspdv, dbo.giahhdvcnct.dongia, dbo.giahhdvcndm.tenspdv
FROM            dbo.giahhdvcn INNER JOIN
                         dbo.giahhdvcnct ON dbo.giahhdvcn.mahs = dbo.giahhdvcnct.mahs INNER JOIN
                         dbo.giahhdvcndm ON dbo.giahhdvcnct.maspdv = dbo.giahhdvcndm.maspdv
 */