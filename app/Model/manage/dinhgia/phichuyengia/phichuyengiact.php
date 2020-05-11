<?php

namespace App\Model\manage\dinhgia\phichuyengia;

use Illuminate\Database\Eloquent\Model;

class phichuyengiact extends Model
{
    protected $table = 'phichuyengiact';
    protected $fillable = [
        'id',
        'mahs',
        'maso',
        'mucgia',
    ];
}
