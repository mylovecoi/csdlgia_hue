<?php

namespace App\Model\manage\kekhaigia\kkdvlt;

use Illuminate\Database\Eloquent\Model;

class CsKdDvLt extends Model
{
    protected $table = 'cskddvlt';
    protected $fillable = [
        'id',
        'macskd',
        'madv',
        'mahuyen',
        'tencskd',
        'loaihang',
        'diachikd',
        'telkd',
        'link',
        'avatar',
        'town',
        'district',
    ];
}
