<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaThueDatNuocCt extends Model
{
    protected $table = 'giathuedatnuocct';
    protected $fillable = [
        'id',
        'mahs',
        'diemdau',
        'diemcuoi',
        'vitri',
        'mota',
        'dientich',
        'dongia',
    ];
}
