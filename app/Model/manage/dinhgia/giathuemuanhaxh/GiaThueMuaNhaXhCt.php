<?php

namespace App\Model\manage\dinhgia\giathuemuanhaxh;

use Illuminate\Database\Eloquent\Model;

class GiaThueMuaNhaXhCt extends Model
{
    protected $table = 'giathuemuanhaxhct';
    protected $fillable = [
        'id',
        'mahs',
        'maso',
        'mota',
        'phanloai',
        'dvt',
        'dongia',
        'dongiathue',
        'tungay',
        'denngay',
        'dvthue',
        'hdthue',
        'ththue',
        'diachi',
        'soqdpd',
        'thoigianpd',
        'soqddg',
        'thoigiandg',
    ];
}
