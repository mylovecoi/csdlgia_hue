<?php

namespace App\Model\manage\dinhgia\giadvkcb;

use Illuminate\Database\Eloquent\Model;

class dvkcbdm extends Model
{
    protected $table = 'dmdvkcb';
    protected $fillable = [
        'id',
        'maspdv',
        'tenspdv',
        'mota',
        'dvt',
        'phanloai',
        'hientrang',
    ];
}
