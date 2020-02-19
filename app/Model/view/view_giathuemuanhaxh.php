<?php

namespace App\Model\view;

use Illuminate\Database\Eloquent\Model;

class view_giathuemuanhaxh extends Model
{
    protected $table = 'view_giathuemuanhaxh';
    protected $fillable = [];
}
/*
SELECT        dbo.giathuemuanhaxh.*, dbo.dmnhaxh.tennha, dbo.dmnhaxh.diachi, dbo.dmnhaxh.donviql, dbo.dmnhaxh.thoigian, dbo.dmnhaxh.dientich, dbo.dmnhaxh.hientrang
FROM            dbo.dmnhaxh INNER JOIN
                         dbo.giathuemuanhaxh ON dbo.dmnhaxh.maso = dbo.giathuemuanhaxh.maso
 */