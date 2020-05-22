<?php

namespace App\Model\manage\dinhgia\giathuemuanhaxh;

use Illuminate\Database\Eloquent\Model;

class dmnhaxh extends Model
{
    protected $table = 'dmnhaxh';
    protected $fillable = [
        'id',
        'maso',
        'phanloai',
        'tennha',
        'diachi',
        'donviql',
        'thoigian',
        'dientich',
        'hientrang',
        'ghichu',
    ];
}
