<?php

namespace App\Model\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Database\Eloquent\Model;

class chisogiatieudung_KichBan_ChiTiet extends Model
{
    protected $table = 'chisogiatieudung_KichBan_ChiTiet';
    protected $fillable = [
        'id',
        'masokichban',
            'masohanghoa',
            'phanloai',
            'ketqua',
    ];
}
