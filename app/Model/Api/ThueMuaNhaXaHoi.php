<?php

namespace App\Model\Api;

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
