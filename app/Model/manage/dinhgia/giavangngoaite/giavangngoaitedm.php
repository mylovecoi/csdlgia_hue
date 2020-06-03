<?php

namespace App\Model\manage\dinhgia\giavangngoaite;

use Illuminate\Database\Eloquent\Model;

class giavangngoaitedm extends Model
{
    protected $table = 'giavangngoaitedm';
    protected $fillable = [
        'id',
        'mahhdv',
        'tenhhdv',
        'dacdiemkt',
        'dvt',
        'xuatxu',
        'theodoi'
    ];
    /*
     INSERT INTO "giavangngoaitedm" ("matt", "mahhdv", "tenhhdv", "dacdiemkt", "xuatxu", "dvt", "theodoi", "created_at", "updated_at") VALUES
(N'1588994567',N'10.0001',N'Vàng 99,99%',N'Kiểu nhẫn tròn 1 chỉ', NULL,N'1000 đ/chỉ',N'TD', NULL, NULL),
(N'1588994567',N'10.0002',N'Đô la Mỹ',N'Loại tờ 100USD', NULL,N'đ/USD',N'TD', NULL, NULL);
     **/
}
