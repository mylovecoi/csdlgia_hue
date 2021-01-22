<?php

namespace App\Model\manage\dinhgia\giaspdvcuthe;

use Illuminate\Database\Eloquent\Model;

class giaspdvcuthe_ct extends Model
{
    protected $table = 'giaspdvcuthe_ct';
    protected $fillable = [
        'id',
        'mahs',
        'maspdv',
        'phanloaidv',
        'mota',
        'mucgia',
        'dvt',
    ];
}
