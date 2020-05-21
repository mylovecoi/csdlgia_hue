<?php

namespace App\Model\manage\dinhgia\giadatthitruong  ;

use Illuminate\Database\Eloquent\Model;

class giadatthitruongct extends Model
{
    protected $table = 'giadatthitruongct';
    protected $fillable = [
        'id',
        'mahs',
        'loaidat',
        'khuvuc',
        'mota',
        'dientich',
        'giaquydinh',
        'giathitruong',
    ];
}
