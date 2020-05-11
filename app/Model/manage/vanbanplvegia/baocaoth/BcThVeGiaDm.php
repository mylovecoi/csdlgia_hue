<?php

namespace App\Model\manage\vanbanplvegia\baocaoth;

use Illuminate\Database\Eloquent\Model;

class BcThVeGiaDm extends Model
{
    protected $table = 'bcthvegiadm';
    protected $fillable = [
        'id',
        'phanloai',
        'mota',
        'theodoi',
    ];
    /*
     * 1
     *
     INSERT INTO [bcthvegiadm]([phanloai],[mota],[theodoi]) VALUES
    ('VBHDCSVGIA',N'Các văn bản hướng dẫn, tham gia, góp ý với các đơn vị khác có liên quan đến cơ chế chính sách về giá.','TD'),
    ('BCHTKN', N'Các báo cáo, tài liệu học tập kinh nghiệm', 'TD'),
    ('KQNCKH', N'Kết quả, đề tài nghiên cứu khoa học', 'TD')
     * */
}
