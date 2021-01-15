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
        'namapdung1',
        'giathanhthi1',
        'gianongthon1',
        'giamiennui1',
        'namapdung2',
        'giathanhthi2',
        'gianongthon2',
        'giamiennui2',
        'namapdung3',
        'giathanhthi3',
        'gianongthon3',
        'giamiennui3',
        'namapdung4',
        'giathanhthi4',
        'gianongthon4',
        'giamiennui4',
        'namapdung5',
        'giathanhthi5',
        'gianongthon5',
        'giamiennui5',
        'gc',
    ];
}
