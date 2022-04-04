<?php

namespace App\Model\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Database\Eloquent\Model;

class chisogiatieudung_TieuChi extends Model
{
    protected $table = 'chisogiatieudung_TieuChi';
    protected $fillable = [
        'id',
        'masohanghoa_tieuchi',
        'masohanghoa_ketqua',
        'phanloai',
        'tu',
        'den',
        'ketqua',
        'mota',
    ];
}
