<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class dsvanphong extends Model
{
    protected $table = 'dsvanphong';
    protected $fillable = [
        'id',
        'maso',
        'vanphong',
        'hoten',
        'chucvu',
        'sdt',
        'skype',
        'facebook',
        'stt',
    ];
}
