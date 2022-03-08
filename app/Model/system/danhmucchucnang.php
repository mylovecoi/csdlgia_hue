<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class danhmucchucnang extends Model
{
    protected $table = 'danhmucchucnang';
    protected $fillable = [
        'id',
        'maso',
        'capdo',
        'maso_goc',
        'menu',
        'mota',
        'api',
    ];
}
