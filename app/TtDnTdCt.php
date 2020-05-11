<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtDnTdCt extends Model
{
    protected $table = 'ttdntdct';
    protected $fillable = [
        'id',
        'madv',
        'manganh',
        'manghe',
        'mahuyen',
        'trangthai',
    ];
}
