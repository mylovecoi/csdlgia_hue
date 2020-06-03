<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class ThueMuaNhaXaHoi extends Model
{
    protected $table = 'dmgiathuemuanhaxh';
    protected $fillable = [
        'id',
        'manhom',
        'tennhom',
    ];
}
