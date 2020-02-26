<?php

namespace App\Model\manage\dinhgia;

use Illuminate\Database\Eloquent\Model;

class giadvgddtdm extends Model
{
    protected $table = 'dmgiadvgddt';
    protected $fillable = [
        'id',
        'maspdv',
        'tenspdv',
        'phanloai',
        'hientrang'
    ];
}
