<?php

namespace App\Model\manage\dinhgia;

use Illuminate\Database\Eloquent\Model;

class GiaDvGdDtCt extends Model
{
    protected $table = 'giadvgddtct';
    protected $fillable = [
        'id',
        'mahs',
        'maspdv',
        'mota',
        'giadv',
    ];
}
