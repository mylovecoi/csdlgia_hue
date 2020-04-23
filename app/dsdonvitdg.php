<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dsdonvitdg extends Model
{
    protected $table = 'dsdonvitdg';
    protected $fillable = [
        'id',
        'maso',
        'tendv',
        'diachi',
        'nguoidaidien',
        'chucvu',
        'sothe',
        'ngaycap',
    ];
}
