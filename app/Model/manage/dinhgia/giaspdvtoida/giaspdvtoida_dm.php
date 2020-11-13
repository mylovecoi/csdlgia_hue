<?php

namespace App\Model\manage\dinhgia\giaspdvtoida;

use Illuminate\Database\Eloquent\Model;

class giaspdvtoida_dm extends Model
{
    protected $table = 'giaspdvtoida_dm';
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
