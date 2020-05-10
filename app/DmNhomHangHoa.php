<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmNhomHangHoa extends Model
{
    protected $table = 'dmnhomhanghoa';
    protected $fillable = [
        'id',
        'manhom',
        'tennhom',
        'theodoi',
    ];
}
/*
USE [db_giahue]
GO

INSERT INTO "dmnhomhanghoa" ("manhom", "tennhom", "theodoi") VALUES
('01',N'Văn phòng phẩm', 'TD'),
('02',N'Máy móc văn phòng (vi tính, máy in, máy photo...)', 'TD'),
('03',N'Thiết bị văn phòng (bàn, ghế, tủ...)', 'TD'),
('04',N'Máy móc nông nghiệp (phân bón, thức ăn gia súc….)', 'TD'),
('05',N'Giống cây', 'TD'),
('06',N'Con giống', 'TD'),
('07',N'Sửa xe ôtô', 'TD'),
('08',N'Vật tư y tế, hóa chất', 'TD'),
('09',N'Hàng hóa đặc thù', 'TD'),
('10',N'In ấn', 'TD'),
('11',N'Thuê xe', 'TD'),
('12',N'Rèm mành', 'TD'),
('13',N'Vật tư, đồ dùng thể thao', 'TD'),
('14',N'Pano, market', 'TD'),
('15',N'Đồ dùng hàng ngày (bát, ấm chén, chăn màn….)', 'TD'),
('16',N'Đồ dịch vụ công ích, cây cảnh', 'TD'),
('17',N'Hàng hóa khác', 'TD')

 * */
