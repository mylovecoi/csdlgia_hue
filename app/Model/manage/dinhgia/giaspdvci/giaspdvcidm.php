<?php

namespace App\Model\manage\dinhgia\giaspdvci;

use Illuminate\Database\Eloquent\Model;

class giaspdvcidm extends Model
{
    protected $table = 'giaspdvcidm';
    protected $fillable = [
        'id',
        'maspdv',
        'tenspdv',
        'dvt',
        'mota',
        'phanloai',
        'hientrang',
        'madiaban',
        'truyendulieu',
        'thoigiantruyen',
    ];
}
