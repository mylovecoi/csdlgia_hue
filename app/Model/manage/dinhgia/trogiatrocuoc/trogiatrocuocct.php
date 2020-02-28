<?php

namespace App\Model\manage\dinhgia\trogiatrocuoc;

use Illuminate\Database\Eloquent\Model;

class trogiatrocuocct extends Model
{
    protected $table = 'trogiatrocuocct';
    protected $fillable = [
        'id',
        'mahs',
        'maspdv',
        'mota',
        'dongia',
    ];
}
