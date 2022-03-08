<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class DMHinhThucThanhToan extends Model
{
    protected $table = 'DMHinhThucThanhToan';
    protected $fillable = [
        'id',
        'mahinhthucthanhtoan',
        'tenhinhthucthanhtoan',
        'ghichu',
    ];
}