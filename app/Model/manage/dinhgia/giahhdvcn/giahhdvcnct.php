<?php

namespace App\Model\manage\dinhgia\giahhdvcn;

use Illuminate\Database\Eloquent\Model;

class giahhdvcnct extends Model
{
    protected $table = 'giahhdvcnct';
    protected $fillable = [
        'id',
        'mahs',
        'maspdv',
        'mota',
        'dongia',
    ];
}
