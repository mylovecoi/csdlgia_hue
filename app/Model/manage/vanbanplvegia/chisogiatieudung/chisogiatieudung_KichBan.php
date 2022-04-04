<?php

namespace App\Model\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Database\Eloquent\Model;

class chisogiatieudung_KichBan extends Model
{
    protected $table = 'chisogiatieudung_KichBan';
    protected $fillable = [
        'id',
        'masokichban',
            'ngaybaocao',
            'mahs_goc',
            'masodubao',
            'noidung',
    ];
}
