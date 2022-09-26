<?php

namespace App\Model\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Database\Eloquent\Model;

class chisogiatieudung_DanhMuc_ChiTiet extends Model
{
    protected $table = 'chisogiatieudung_DanhMuc_ChiTiet';
    protected $fillable = [
        'id',
        'masodanhmuc',
        'masonhomhanghoa',
        'masohanghoa',
        'tenhanghoa',
        'masogoc',
        'stt',
        'stt_bc',
        'dvt',
        'quyensogoc',
        'quyensogoc_thanhthi',
        'quyensogoc_nongthon',
        'baocao',
    ];
}
