<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class KetNoiAPI extends Model
{
    protected $table = 'KetNoiAPI';
    protected $fillable = [
        'id',
        'phanloai',//Heder;Body;Security/Signature
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
