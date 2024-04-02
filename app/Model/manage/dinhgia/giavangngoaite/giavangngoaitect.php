<?php

namespace App\Model\manage\dinhgia\giavangngoaite;

use Illuminate\Database\Eloquent\Model;

class giavangngoaitect extends Model
{
    protected $table = 'giavangngoaitect';
    protected $fillable = [
        'id',
        'mahs',
        'mahhdv',
        'tenhhdv',
        'dacdiemkt',
        'dvt',
        'xuatxu',
        'gialk',
        'gia',//Giá mua
        'giabanlk',
        'giaban',//Giá bán
        'loaigia',
        'nguontt',
        'ghichu',
    ];
}
