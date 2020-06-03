<?php

namespace App\Model\manage\dinhgia\phichuyengia;

use Illuminate\Database\Eloquent\Model;

class dmphichuyengia extends Model
{
    protected $table = 'dmphichuyengia';
    protected $fillable = [
        'id',
        'manhom',
        'maso',
        'tenphi',
        'tengia',
        'dvt',
        'ghichu',
    ];
}
