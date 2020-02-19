<?php

namespace App\Model\manage\dinhgia\giathuemuanhaxh;

use Illuminate\Database\Eloquent\Model;

class dmnhaxh extends Model
{
    protected $table = 'dmnhaxh';
    protected $fillable = [
        'id',
        'maso',
        'tennha',
        'diachi',
        'donviql',
        'thoigian',
        'dientich',
        'hientrang',
        'ghichu',
    ];
}
