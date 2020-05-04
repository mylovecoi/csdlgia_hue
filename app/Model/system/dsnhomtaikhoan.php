<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dsnhomtaikhoan extends Model
{
    protected $table = 'dsnhomtaikhoan';
    protected $fillable = [
        'id',
        'maso',
        'mota',
        'permission',
        'macdinh',
        'ghichu',
    ];
}
