<?php

namespace App\Model\manage\dinhgia\trogiatrocuoc;

use Illuminate\Database\Eloquent\Model;

class trogiatrocuocdm extends Model
{
    protected $table = 'trogiatrocuocdm';
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
