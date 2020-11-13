<?php

namespace App\Model\manage\dinhgia\giadaugiadat;

use Illuminate\Database\Eloquent\Model;

class DauGiaDatCt extends Model
{
    protected $table = 'daugiadatct';
    protected $fillable = [
        'id',
        'mahs',
        'loaidat',
        'khuvuc',
        'mota',
        'dientich',
        'giakhoidiem',
        'giadaugia',
        'solo',
        'sothua',
        'sotobando',
        'dvt',
    ];
}
