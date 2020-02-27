<?php

namespace App\Model\manage\dinhgia\giadvkcb;

use Illuminate\Database\Eloquent\Model;

class dvkcbct extends Model
{
    protected $table = 'dvkcbct';
    protected $fillable = [
        'id',
        'mahs',
        'maspdv',
        'dvt',
        'giadv',
        'ghichu',
    ];
}
