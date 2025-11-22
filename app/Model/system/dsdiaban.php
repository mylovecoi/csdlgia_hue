<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dsdiaban extends Model
{
    protected $table = 'dsdiaban';
    protected $fillable = [
        'id',
        'madiaban',
        'madiaban_cu',
        'tendiaban',
        'level',
        'ghichu',
    ];
}
