<?php

namespace App\Model\manage\dinhgia\giacuocvanchuyen;

use Illuminate\Database\Eloquent\Model;

class giacuocvanchuyenct extends Model
{
    protected $table = 'giacuocvanchuyenct';
    protected $fillable = [
        'id',
        'mahs',
        'tencuoc',
        'tukm',
        'denkm',
        'bachh',
        'phanloai',

        'giavc1',
        'giavc2',
        'giavc3',
        'giavc4',
        'giavc5',
        'gc',
    ];
}
