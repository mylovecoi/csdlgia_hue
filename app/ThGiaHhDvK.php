<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThGiaHhDvK extends Model
{
    protected $table = 'thgiahhdvk';
    protected $fillable = [
        'id',
        'sobc',
        'ngaybc',
        'ngaychotbc',
        'ttbc',
        'matt',
        'mahs',
        'thang',
        'nam',
        'phanloai',
        'ghichu',
        'congbo',
        'trangthai',
        'mahstonghop',
        'ipf_word',
        'ipf_word_base64',
        'ipf_pdf',
        'ipf_pdf_base64',
        'ipf_excel',
        'ipf_excel_base64',
    ];
}
