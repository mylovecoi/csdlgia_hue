<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class KetNoiAPI_HoSo extends Model
{
    protected $table = 'KetNoiAPI_HoSo';
    protected $fillable = [
        'id',
        'maso',//Mã chức năng
        'tentruong',
        'tendong',
        'mota',
        'kieudulieu',
        'dinhdang',
        'dodai',
        'batbuoc',
        'macdinh',
        'stt',
        'ghichu',
    ];
}
