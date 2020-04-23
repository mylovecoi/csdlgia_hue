<?php

namespace App\Model\manage\dinhgia\phichuyengia;

use Illuminate\Database\Eloquent\Model;

class dmphichuyengia extends Model
{
    protected $table = 'dmphichuyengia';
    protected $fillable = [
        'id',
        'maso',
        'tenphi',
        'tengia',
        'dvt',
        'ghichu',
    ];
}
