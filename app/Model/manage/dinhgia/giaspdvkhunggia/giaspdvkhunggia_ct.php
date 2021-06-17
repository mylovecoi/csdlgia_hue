<?php

namespace App\Model\manage\dinhgia\giaspdvkhunggia;

use Illuminate\Database\Eloquent\Model;

class giaspdvkhunggia_ct extends Model
{
    protected $table = 'giaspdvkhunggia_ct';
    protected $fillable = [
        'id',
        'mahs',
        'maspdv',
        'phanloaidv',
        'mota',
        'dvt',
        'giatoithieu',
        'giatoida',
    ];
}
