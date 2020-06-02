<?php

namespace App\Model\manage\dinhgia\phichuyengia;

use Illuminate\Database\Eloquent\Model;

class nhomphichuyengia extends Model
{
    protected $table = 'nhomphichuyengia';
    protected $fillable = [
        'id',
        'manhom',
        'tennhom',
        'theodoi',
    ];
}
