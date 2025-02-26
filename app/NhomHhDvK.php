<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhomHhDvK extends Model
{
    protected $table = 'nhomhhdvk';
    protected $fillable = [
        'id',
        'matt',
        'tentt',
        'theodoi',
        'truyendulieu',
        'thoigiantruyen',
    ];
}
