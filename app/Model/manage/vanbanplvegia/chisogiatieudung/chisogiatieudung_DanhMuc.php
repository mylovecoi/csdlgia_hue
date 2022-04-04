<?php

namespace App\Model\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Database\Eloquent\Model;

class chisogiatieudung_DanhMuc extends Model
{
    protected $table = 'chisogiatieudung_DanhMuc';
    protected $fillable = [
        'id',
        'masodanhmuc',
        'noidung',
        'tungay',
        'denngay',
        'trangthai',
        'ghichu',
    ];
}
