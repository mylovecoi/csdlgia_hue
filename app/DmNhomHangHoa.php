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
        'phanloai'
    ];
}
/*
USE [db_giahue]
GO

INSERT INTO "dmnhomhanghoa" ("manhom", "tennhom", "theodoi", "phanloai") VALUES
('01',N'Văn phòng phẩm', 'TD'),
('02',N'Máy móc văn phòng (vi tính, máy in, máy photo...)', 'TD', 'THAMDINHGIA'),
('03',N'Thiết bị văn phòng (bàn, ghế, tủ...)', 'TD', 'THAMDINHGIA'),
('04',N'Máy móc nông nghiệp (phân bón, thức ăn gia súc….)', 'TD', 'THAMDINHGIA'),
('05',N'Giống cây', 'TD', 'THAMDINHGIA'),
('06',N'Con giống', 'TD', 'THAMDINHGIA'),
('07',N'Sửa xe ôtô', 'TD', 'THAMDINHGIA'),
('08',N'Vật tư y tế, hóa chất', 'TD', 'THAMDINHGIA'),
('09',N'Hàng hóa đặc thù', 'TD', 'THAMDINHGIA'),
('10',N'In ấn', 'TD', 'THAMDINHGIA'),
('11',N'Thuê xe', 'TD', 'THAMDINHGIA'),
('12',N'Rèm mành', 'TD', 'THAMDINHGIA'),
('13',N'Vật tư, đồ dùng thể thao', 'TD', 'THAMDINHGIA'),
('14',N'Pano, market', 'TD', 'THAMDINHGIA'),
('15',N'Đồ dùng hàng ngày (bát, ấm chén, chăn màn….)', 'TD', 'THAMDINHGIA'),
('16',N'Đồ dịch vụ công ích, cây cảnh', 'TD', 'THAMDINHGIA'),
('17',N'Hàng hóa khác', 'TD', 'THAMDINHGIA'),

('01',N'LƯƠNG THỰC, THỰC PHẨM', 'TD', 'GIAHHDVK'),
('02',N'VẬT TƯ NÔNG NGHIỆP', 'TD', 'GIAHHDVK'),
('03',N'ĐỒ UỐNG', 'TD', 'GIAHHDVK'),
('04',N'VẬT LIỆU XÂY DỰNG, CHẤT ĐỐT, NƯỚC SINH HOẠT', 'TD', 'GIAHHDVK'),
('05',N'THUỐC CHỮA BỆNH CHO NGƯỜI', 'TD', 'GIAHHDVK'),
('06',N'DỊCH VỤ Y TẾ', 'TD', 'GIAHHDVK'),
('07',N'GIAO THÔNG', 'TD', 'GIAHHDVK'),
('08',N'DỊCH VỤ GIÁO DỤC', 'TD', 'GIAHHDVK'),
('09',N'GIẢI TRÍ VÀ DU LỊCH', 'TD', 'GIAHHDVK'),
('10',N'VÀNG, ĐÔ LA MỸ', 'TD', 'GIAHHDVK'),
('11',N'GIÁ KÊ KHAI CÁC MẶT HÀNG TRÊN ĐỊA BÀN', 'TD', 'GIAHHDVK'),
('12',N'GIÁ ĐĂNG KÝ CÁC MẶT HÀNG TRONG DANH MỤC BÌNH ỔN GIÁ TRONG THỜI GIAN THỰC HIỆN BIỆN PHÁP BÌNH ỔN GIÁ', 'TD', 'GIAHHDVK')

 * */
