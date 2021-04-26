<?php

namespace App\Model\manage\dinhgia\giadatphanloai;

use Illuminate\Database\Eloquent\Model;

class GiaDatPhanLoaiCt extends Model
{
    protected $table = 'giadatphanloai_ct';
    protected $fillable = [
        'id',
        'mahs',
        'maloaidat',
        'khuvuc',
        'vitri',
        'banggiadat',
        'giacuthe',
        'hesodc',
        'sapxep',
    ];
}
