<?php

namespace App\Model\system\dmnganhnghekd;

use Illuminate\Database\Eloquent\Model;

class DmNgheKd extends Model
{
    protected $table = 'dmnghekd';
    protected $fillable = [
        'id',
        'manganh',
        'manghe',
        'tennghe',
        'madv',
        'theodoi',
        'phanloai',
    ];
}
/*
 INSERT INTO "dmnganhkd" ("manganh", "tennganh", "theodoi") VALUES
('KKNYGIA', 'Mặt hàng kê khai, đăng ký, niêm yết giá', 'TD'),
('BOG','Mặt bình ổn giá','TD');

 INSERT INTO "dmnghekd" ("manganh", "manghe", "tennghe", "madv", "theodoi", "phanloai") VALUES
('BOG', 'XD', N'Xăng Dầu', 'STCCB', 'TD','KK'),
('BOG', 'DBL', N'Điện bán lẻ', 'STCCB', 'TD','KK'),
('BOG', 'KDMHL', N'Khí dầu mỏ hóa lỏng (LPG)', 'STCCB', 'TD','KK'),
('BOG', 'PDURENPK', N'Phân đạm urê; phân NPK', 'STCCB', 'TD','KK'),
('BOG', 'TBVTV', N'Thuốc bảo vệ thực vật, bao gồm: thuốc trừ sâu, thuốc trừ bệnh, thuốc trừ cỏ', 'STCCB', 'TD','KK'),
('BOG', 'VXGSGC', N'Vac-xin phòng bệnh cho gia súc, gia cầm', 'STCCB', 'TD','KK'),
('BOG', 'MA', N'Muối ăn', 'STCCB', 'TD','KK'),
('BOG', 'STED6T', N'Sữa dành cho trẻ em dưới 06 tuổi', 'SCT', 'TD','KK'),
('BOG', 'DADTL', N'Đường ăn, bao gồm đường trắng và đường tinh luyện', 'STCCB', 'TD','KK'),
('BOG', 'TGTT', N'Thóc, gạo tẻ thường', 'STCCB', 'TD','KK'),
('BOG', 'TPCB', N'Thuốc phòng bệnh, chữa bệnh cho người thuộc danh mục thuốc chữa bệnh thiết yếu sử dụng tại cơ sở khám bệnh, chữa bệnh.', 'SYT', 'TD','KK'),
('KKNYGIA', 'VLXD', N'Vật liệu xây dựng', 'SXD', 'TD','KK'),
('KKNYGIA', 'XMTXD', N'Xi măng, thép xây dựng', 'STCCB', 'TD','KK'),
('KKNYGIA', 'DVHDTMCK', N'Dịch vụ hỗ trợ hoạt động thương mại tại cửa khẩu', 'BQLKKTT', 'TD','KK'),
('KKNYGIA', 'THAN', N'Than', 'STCCB', 'TD','KK'),
('KKNYGIA', 'TACN', N'Thức ăn chăn nuôi', 'STCCB', 'TD','KK'),
('KKNYGIA', 'GIAY', N'Giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước', 'STCCB', 'TD','KK'),
('KKNYGIA', 'SACH', N'Sách giáo khoa', 'STCCB', 'TD','KK'),
('KKNYGIA', 'ETANOL', N'Etanol nhiên liệu không biến tính, khí tự nhiên hóa lỏng(LNG); khí thiên nhiên nén (CNG)', 'STCCB', 'TD','KK'),
('KKNYGIA', 'KCBTN', N'Dịch vụ khám chữa bệnh cho người tại cơ sở khám chữa bệnh tư nhân; khám chữa bệnh theo yêu cầu tại cơ sở khám chữa bệnh của nhà nước', 'SYT', 'TD','KK'),
('KKNYGIA', 'TPCNTE6T', N'Thực phẩm chức năng cho trẻ em dưới 6 tuổi', 'SCT', 'TD','KK'),
('KKNYGIA', 'DVLT', N'Dịch vụ lưu trú', 'UBNDTBRVT', 'TD','KK'),
('KKNYGIA', 'VTXK', N'Cước vận tải hành khách bằng ôtô tuyến cố định', 'SGTVT', 'TD','KK'),
('KKNYGIA', 'VTXB', N'Cước vận tải hành khách bằng xe buýt theo tuyến cố định', 'SGTVT', 'TD','KK'),
('KKNYGIA', 'VTXTX', N'Cước vận tải hành khách bằng xe taxi', 'SGTVT', 'TD','KK'),
('KKNYGIA', 'VCHK', N'Cước vận chuyển hành khách: xe buýt, xe điện, bè mảng', 'SGTVT', 'TD','KK');
('KKNYGIA', 'CAHUE', N'Giá dịch vụ xem ca Huế trên sông Hương', 'SGTVT', 'TD','KK'),
('KKNYGIA', 'HOCPHILX', N'Mức thu học phí đào tạo lái xe cơ giới đường bộ', 'SGTVT', 'TD','KK'),
('KKNYGIA', 'CATSAN', N'Vật liệu xây dựng: cát, sạn', 'SGTVT', 'TD','KK'),
('KKNYGIA', 'DATSANLAP', N'Vật liệu xây dựng: đất san lấp', 'SGTVT', 'TD','KK'),
('KKNYGIA', 'DAXAYDUNG', N'Vật liệu xây dựng: đá xây dựng', 'SGTVT', 'TD','KK');
 * */
