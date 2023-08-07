<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class KetNoiAPI_DanhSach extends Model
{
    protected $table = 'KetNoiAPI_DanhSach';
    protected $fillable = [
        'id',
        'maso',//Mã chức năng
        'linkTruyenGet',
        'linkTruyenPost',
        'linkTruyenPut',
        //Link Xuất dữ liệu
        'linkDuLieuGet',
        'linkDuLieuPost',
        'linkDuLieuPut',
        'ghichu',
    ];
}
