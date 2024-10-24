<?php

namespace App\Model\manage\dinhgia\giaspdvcuthe;

use Illuminate\Database\Eloquent\Model;

class giaspdvcuthe_dm extends Model
{
    protected $table = 'giaspdvcuthe_dm';
    protected $fillable = [
        'id',
        'manhom',
        'maso',
        'tenhhdv',
        'dacdiemkt',
        'dvt',
        'hienthi',
        'theodoi',
        'stt',
    ];
}
