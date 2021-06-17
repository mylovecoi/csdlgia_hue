<?php

namespace App\Model\manage\dinhgia\giaspdvtoida;

use Illuminate\Database\Eloquent\Model;

class giaspdvtoida_ct extends Model
{
    protected $table = 'giaspdvtoida_ct';
    protected $fillable = [
        'id',
        'mahs',
        'maspdv',
        'phanloaidv',
        'mota',
        'dvt',
        'dongia',
    ];
}
