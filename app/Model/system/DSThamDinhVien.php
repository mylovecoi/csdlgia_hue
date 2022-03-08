<?php

namespace App\Model\system;

use Illuminate\Database\Eloquent\Model;

class DSThamDinhVien extends Model
{
    protected $table = 'DSThamDinhVien';
    protected $fillable = [
        'id',
        'GIAY_CN_DU_DK_DKKD',
        'TEN_TIENG_VIET',
        'HO_TEN',
        'NGAY_SINH',
        'GIOI_TINH',
        'CMT_HO_CHIEU',
        'NGAY_CAP_CMT',
        'NOI_CAP_CMT',
        'NGUYEN_QUAN',
        'TINH_THANH',
        'DIA_CHI_THUONG_TRU',
        'DIA_CHI_TAM_TRU',
        'DIEN_THOAI',
        'EMAIL',
        'SO_THE_TDV',
        'NGAY_CAP_THE_TDV',
        'LA_NGUOI_DAI_DIEN_PL',
        'LA_LANH_DAO_DN',
        'ghichu',
    ];
}