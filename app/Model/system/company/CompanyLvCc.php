<?php

namespace App\Model\system\company;

use Illuminate\Database\Eloquent\Model;

class CompanyLvCc extends Model
{
    protected $table = 'companylvcc';
    protected $fillable = [
        'id',
        'mahs',
        'madv',
        'manganh',
        'manghe',
        'macqcq',
        'trangthai',
    ];
}
