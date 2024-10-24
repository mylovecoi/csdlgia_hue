<?php

namespace App\Model\manage\dinhgia\giaspdvcuthe;

use Illuminate\Database\Eloquent\Model;

class giaspdvcuthe_nhomdm extends Model
{
    protected $table = 'giaspdvcuthe_nhomdm';
    protected $fillable = [
        'id',
        'manhom',
        'mota',
        'theodoi',
        'apdungtungay',
        'apdungdenngay',
        'truyendulieu',
        'thoigiantruyen',
        'ghichu',
    ];
}
