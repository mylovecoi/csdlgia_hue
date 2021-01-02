<?php

namespace App\Model\manage\dinhgia;

use Illuminate\Database\Eloquent\Model;

class GiaTaiSanCongCt extends Model
{
    protected $table = 'giataisancongct';
    protected $fillable = [
        'id',
        'mahs',
        'mataisan',
        'tentaisan',
        'dacdiem',
        'giathue',
        'giaban',
        'giapheduyet',
        'giaconlai',
    ];
}
