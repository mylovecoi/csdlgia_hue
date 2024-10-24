<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dmtinhhuyenxa extends Model
{
    protected $table = 'dmtinhhuyenxa';
    protected $fillable = [
        'id',
        'madiaban',
        'tendiaban',
        'capdo', //T;H;X
        'theodoi',
        'ngaydung',
        'madiaban_goc',
    ];
}
