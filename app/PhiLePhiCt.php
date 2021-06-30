<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhiLePhiCt extends Model
{
    protected $table = 'philephict';
    protected $fillable = [
        'id',
        'mahs',
        'phanloai',
        'ptcp',
        'dvt',
        'phantram',
        'mucthutu',
        'mucthuden',
        'ghichu'

    ];
}
