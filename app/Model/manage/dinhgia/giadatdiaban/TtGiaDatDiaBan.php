<?php

namespace App\Model\manage\dinhgia\giadatdiaban;

use Illuminate\Database\Eloquent\Model;

class TtGiaDatDiaBan extends Model
{
    protected $table = 'ttgiadatdiaban';
    protected $fillable = [
        'id',
        'soqd',
        'ngayqd_banhanh',
        'ngayqd_apdung',
        'mota',
        'ipf1',
        'ghichu',
    ];
}
