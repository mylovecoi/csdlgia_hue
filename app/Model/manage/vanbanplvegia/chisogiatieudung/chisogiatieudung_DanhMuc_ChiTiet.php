<?php

namespace App\Model\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Database\Eloquent\Model;

class chisogiatieudung_DanhMuc_ChiTiet extends Model
{
    protected $table = 'chisogiatieudung_DanhMuc_ChiTiet';
    protected $fillable = [
        'id',
        'mahs',
        'madv',
        'thongtinbc',
        'ngaybaocao',
        'ghichu',
        'ipt1',
        'ipf1',
        'ipt2',
        'ipf2',
        'ipt3',
        'ipf3',
        'ipt4',
        'ipf4',
        'ipt5',
        'ipf5',
        'trangthai',
        'congbo',
    ];
}
