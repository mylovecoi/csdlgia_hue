<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class KetNoiAPI_HoSo_ChiTiet extends Model
{
    protected $table = 'KetNoiAPI_HoSo_ChiTiet';
    protected $fillable = [
        'id',
        'maso',//Mã chức năng
        'tendong_goc',//Rằng buộc với bảng hồ sơ gốc để lập tạo danh sách (do tên trường có thể giống nhau nên có cả maso)
        'tentruong',
        'tendong',
        'mota',
        'kieudulieu',
        'dinhdang',
        'dodai',
        'batbuoc',
        'macdinh',
        'stt',
        'ghichu',
    ];
}
