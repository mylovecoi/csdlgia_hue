<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class DMLoaiGia extends Model
{
    protected $table = 'DMLoaiGia';
    protected $fillable = [
        'id',
        'maloaigia',
        'tenloaigia',
        'ghichu',
    ];
}