<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dsvanphong extends Model
{
    protected $table = 'vanphonghotro';
    protected $fillable = [
        'id',
        'maso',
        'vanphong',
        'hoten',
        'chucvu',
        'sdt',
        'skype',
        'facebook',
        'sapxep',
    ];
}
