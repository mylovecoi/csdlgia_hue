<?php

namespace App\Model\manage\dinhgia\giaspdvkhunggia;

use Illuminate\Database\Eloquent\Model;

class giaspdvkhunggia_dm extends Model
{
    protected $table = 'giaspdvkhunggia_dm';
    protected $fillable = [
        'id',
        'maspdv',
        'tenspdv',
        'dvt',
        'mota',
        'phanloai',
        'hientrang',
    ];
}
