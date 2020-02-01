<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dsxaphuong extends Model
{
    protected $table = 'dsxaphuong';
    protected $fillable = [
        'id',
        'madiaban',
        'maxp',
        'tenxp',
        'level',
        'ghichu',
    ];
}
