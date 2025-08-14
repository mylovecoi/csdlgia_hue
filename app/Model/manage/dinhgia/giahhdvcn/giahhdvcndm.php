<?php

namespace App\Model\manage\dinhgia\giahhdvcn;

use Illuminate\Database\Eloquent\Model;

class giahhdvcndm extends Model
{
    protected $table = 'giahhdvcndm';
    protected $fillable = [
        'id',
        'maspdv',
        'tenspdv',
        'dvt',
        'mota',
        'phanloai',
        'hientrang',
        'truyendulieu',
        'thoigiantruyen',
    ];
}
