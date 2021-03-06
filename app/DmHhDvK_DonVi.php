<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmHhDvK_DonVi extends Model
{
    protected $table = 'dmgiahhdvk_donvi';
    protected $fillable = [
        'id',
        'manhom',
        'matt',
        'mahhdv',
        'tenhhdv',
        'dacdiemkt',
        'dvt',
        'xuatxu',
        'theodoi',
        'madv',
    ];
    /*
     INSERT INTO "dmhhdvk" ("matt", "mahhdv", "tenhhdv", "dacdiemkt", "xuatxu", "dvt", "theodoi", "created_at", "updated_at") VALUES
(N'1588994567', N'01.0001',N'Thóc, gạo tẻ thường',N'Khang dân hoặc tương đương', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0002',N'Gạo tẻ ngon',N'Tám thơm hoặc tương đương', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0003',N'Thịt lợn hơi (Thịt heo hơi)',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0004',N'Thịt lợn nạc thăn (Thịt heo nạc thăn)',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0005',N'Thịt bò thăn',N'Loại 1 hoặc phổ biến', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0006',N'Thịt bò bắp',N'Bắp hoa hoặc bắp lõi, loại 200 – 300 gram/ cái', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0007',N'Gà ta',N'Còn sống, loại 1,5 – 2kg /1 con hoặc phổ biến', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0008',N'Gà công nghiệp',N'Làm sẵn, nguyên con, bỏ lòng, loại 1,5 – 2kg /1 con hoặc phổ biến', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0009',N'Giò lụa',N'Loại 1 kg', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0010',N'Cá quả (cá lóc)',N'Loại  2 con/1 kg hoặc phổ biến', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0011',N'Cá chép',N'Loại  2 con/1 kg hoặc phổ biến', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0012',N'Tôm rảo, tôm nuôi nước ngọt',N'Loại 40-45 con/kg', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0013',N'Bắp cải trắng',N'Loại to vừa khoảng 0,5-1kg/bắp', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0014',N'Cải xanh',N'Cải ngọt hoặc cải cay theo mùa', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0015',N'Bí xanh',N'Quả từ 1-2 kg hoặc phổ biến', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0016',N'Cà chua',N'Quả to vừa, 8-10 quả/kg', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0017',N'Muối hạt',N'Gói 01 kg', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0018',N'Dầu thực vật',N'Chai 01 lít', NULL,N'đ/lít',N'TD', NULL, NULL),
(N'1588994567', N'01.0019',N'Đường trắng kết tinh, nội',N'Gói 01 kg', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'01.0020',N'Sữa bột dùng cho trẻ em dưới 06 tuổi',N'Ghi rõ quy cách', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0005',N'Giống lúa Nếp 97, cấp NC',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0010',N'Giống lúa Khang dân 18',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0026',N'Giống ngô HN68',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0027',N'Giống ngô B21',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0028',N'Giống ngô B9698',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0046',N'Hạt giống Cải ngọt Quảng Phủ Trung Quốc, cấp xác nhận',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0047',N'Hạt giống Cải xanh lùn Thanh Giang Trung Quốc, cấp xác nhận',N'', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567',N'02.0051',N'Vac-xin Lở mồm long móng',N'', NULL,N'Đồng/liều',N'TD', NULL, NULL),
(N'1588994567',N'02.0052',N'Vac-xin Tai xanh (PRRS)',N'', NULL,N'Đồng/liều',N'TD', NULL, NULL),
(N'1588994567',N'02.0053',N'Vac-xin tụ huyết trùng',N'', NULL,N'Đồng/liều',N'TD', NULL, NULL),
(N'1588994567',N'02.0054',N'Vac-xin dịch tả lợn',N'', NULL,N'Đồng/liều',N'TD', NULL, NULL),
(N'1588994567',N'02.0055',N'Vac-xin cúm gia cầm',N'', NULL,N'Đồng/liều',N'TD', NULL, NULL),
(N'1588994567',N'02.0056',N'Vac-xin dịch tả vịt',N'', NULL,N'Đồng/liều',N'TD', NULL, NULL),
(N'1588994567',N'02.0057',N'Thuốc thú y',N'Chứa các hoạt chất: Ampicillin, Amoxicillin; Colistin; Florfenicol; Tylosin; Doxycyclin; Gentamycine; Spiramycin; Oxytetracyline; Kanammycin; Streptomycin; Lincomycin; Celphalexin; Flumequin.', NULL,N'đ/lít, kg, liều, chai, gói, can, lọ, bao',N'TD', NULL, NULL),
(N'1588994567',N'02.0058',N'Thuốc trừ sâu',N'Chứa hoạt chất Fenobucarb; Pymethrozin; Dinotefuran; Ethofenprox ; Buprofezin ; Imidacloprid ; Fipronil.', NULL,N'đ/lít, kg, liều, chai, gói, can, lọ, bao',N'TD', NULL, NULL),
(N'1588994567',N'02.0059',N'Thuốc trừ bệnh',N'Chứa hoạt chất: Isoprothiolane; Tricyclazole; Kasugamycin; Fenoxanil; Fosetyl-aluminium; Metalaxy; Mancozeb; Zined .', NULL,N'đ/lít, kg, liều, chai, gói, can, lọ, bao',N'TD', NULL, NULL),
(N'1588994567',N'02.0060',N'Thuốc trừ cỏ',N'Chứa hoạt chất: Glyphosate; Pretilachlor; Quinclorac; Ametryn.', NULL,N'đ/lít, kg, liều, chai, gói, can, lọ, bao',N'TD', NULL, NULL),
(N'1588994567',N'02.0061',N'Phân đạm urê',N'Có hàm lượng Nitơ (N) tổng số ≥ 46%;', NULL,N'đ/kg, gói, bao',N'TD', NULL, NULL),
(N'1588994567',N'02.0062',N'Phân NPK',N'Có tổng hàm lượng các chất dinh dưỡng Nitơ tổng số (Nts), lân hữu hiệu (P2O5hh), kali hữu hiệu (K2Ohh) ≥ 18%.', NULL,N'đ/kg, gói, bao',N'TD', NULL, NULL),
(N'1588994567', N'03.0001',N'Nước khoáng Lavie',N'Chai nhựa 500ml', NULL,N'đ/chai',N'TD', NULL, NULL),
(N'1588994567', N'03.0002',N'Rượu vang Đà Lạt',N'Chai 750ml', NULL,N'đ/chai',N'TD', NULL, NULL),
(N'1588994567', N'03.0003',N'Nước giải khát có ga coca-cola.',N'Thùng 24 lon 330ml loại phổ biến', NULL,N'đ/thùng 24 lon',N'TD', NULL, NULL),
(N'1588994567', N'03.0004',N'Bia lon Sài Gòn',N'Thùng 24 lon 330ml loại phổ biến', NULL,N'đ/thùng 24 lon',N'TD', NULL, NULL),
(N'1588994567', N'04.0001',N'Xi măng PCB30 – Cao Bằng',N'PCB30 bao 50kg', NULL,N'đ/bao',N'TD', NULL, NULL),
(N'1588994567', N'04.0002',N'Thép xây dựng',N'Ghi rõ quy cách', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'04.0003',N'Cát xây',N'Mua rời dưới 2m3/lần, tại nơi cung ứng (không phải nơi khai thác)', NULL,N'đ/m3',N'TD', NULL, NULL),
(N'1588994567', N'04.0004',N'Cát vàng',N'Mua rời dưới 2m3/lần, tại nơi cung ứng (không phải nơi khai thác)', NULL,N'đ/m3',N'TD', NULL, NULL),
(N'1588994567', N'04.0005',N'Cát đen đổ nền',N'Mua rời dưới 2m3/lần, tại nơi cung ứng (không phải nơi khai thác)', NULL,N'đ/m3',N'TD', NULL, NULL),
(N'1588994567', N'04.0006',N'Gạch xây',N'Gạch ống 2 lỗ, cỡ rộng 10 x dài 22, loại 1, mua rời tại nơi cung ứng hoặc tương đương', NULL,N'đ/viên',N'TD', NULL, NULL),
(N'1588994567', N'04.0007',N'Ống nhựa',N'Phi 90 loại 1', NULL,N'đ/m',N'TD', NULL, NULL),
(N'1588994567', N'04.0008',N'Gas đun',N'Loại bình 12kg (không kể tiền bình)', NULL,N'đ/kg',N'TD', NULL, NULL),
(N'1588994567', N'04.0009',N'Nước sạch sinh hoạt',N'Ghi rõ tên doanh nghiệp cung cấp, địa bàn cung cấp', NULL,N'đ/m3',N'TD', NULL, NULL),
(N'1588994567',N'05.0001',N'Thuốc tim mạch',N'Hoạt chất Amlodipin 10 mg hoặc Hoạt chất Atorvastatin 10mg hoặc Hoạt chất Nifedipin 20mg.', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0002',N'Thuốc chống nhiễm, điều trị ký sinh trùng',N'Hoạt chất Cefuroxim 500mg hoặc Hoạt chất Amoxicilin  500mg', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0003',N'Thuốc dị ứng và các trường hợp quá mẫn cảm',N'Hoạt chất Cinnarizin 25mg hoặc Hoạt chất Fexofenadin 60mg', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0004',N'Thuốc giảm đau, hạ sốt, chống viêm không steroid và thuốc điều trị gut và các bệnh xương',N'Hoạt chất Paracetamol 500mg hoặc Hoạt chất Alpha Chymotrypsin 4.2mg', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0005',N'Thuốc tác dụng trên đường hô hấp',N'Hoạt chất N-acetylcystein 200mg', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0006',N'Thuốc vitamin và khoáng chất',N'Vitamin B1 hoặc B6 hoặc B12', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0007',N'Thuốc đường tiêu hóa',N'Hoạt chất Omeprazone 20 mg hoặc Hoạt chất Domperdone 10 mg', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0008',N'Hóc môn và các thuốc tác động vào hệ nội tiết',N'Hoạt chất Methyl Prednisolon 4mg hoặc Hoạt chất Gliclazid 30 mg hoặc Hoạt chất Metformin 500mg', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'05.0009',N'Thuốc khác',N'Hoạt chất Sulfamethoxazol 400mg', NULL,N'đ/đơn vị đóng gói nhỏ nhất',N'TD', NULL, NULL),
(N'1588994567',N'06.0001',N'Khám bệnh',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0002',N'Ngày giường điều trị nội trú nội khoa, loại 1',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/ngày',N'TD', NULL, NULL),
(N'1588994567',N'06.0003',N'Siêu âm',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0004',N'X-quang số hóa 1 phim',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0005',N'Xét nghiệm tế bào cặn nước tiểu hoặc cặn Adis',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0006',N'Điện tâm đồ',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0007',N'Nội soi thực quản-dạ dày- tá tràng ống mềm không sinh thiết',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0008',N'Hàn composite cổ răng',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0009',N'Châm cứu (có kim dài)',N'Giá dịch vụ khám bệnh, chữa bệnh không thuộc phạm vi thanh toán của Quỹ bảo hiểm y tế trong các cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0010',N'Khám bệnh',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0011',N'Ngày giường điều trị nội trú nội khoa, loại 1',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/ngày',N'TD', NULL, NULL),
(N'1588994567',N'06.0012',N'Siêu âm',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0013',N'X-quang số hóa 1 phim',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0014',N'Xét nghiệm tế bào cặn nước tiểu hoặc cặn Adis',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0015',N'Điện tâm đồ',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0016',N'Nội soi thực quản-dạ dày- tá tràng ống mềm không sinh thiết',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0017',N'Hàn composite cổ răng',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0018',N'Châm cứu (có kim dài)',N'Giá dịch vụ khám bệnh, chữa bệnh theo yêu cầu tại cơ sở khám bệnh, chữa bệnh của Nhà nước', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0019',N'Khám bệnh',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0020',N'Ngày giường điều trị nội trú nội khoa, loại 1',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/ngày',N'TD', NULL, NULL),
(N'1588994567',N'06.0021',N'Siêu âm',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0022',N'X-quang số hóa 1 phim',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0023',N'Xét nghiệm tế bào cặn nước tiểu hoặc cặn Adis',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0024',N'Điện tâm đồ',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0025',N'Nội soi thực quản-dạ dày- tá tràng ống mềm không sinh thiết',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0026',N'Hàn composite cổ răng',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'06.0027',N'Châm cứu (có kim dài)',N'Giá dịch vụ khám bệnh, chữa bệnh  tại cơ sở khám bệnh, chữa bệnh tư nhân.', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'07.0001',N'Trông giữ xe máy',N'', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'07.0002',N'Trông giữ ô tô',N'', NULL,N'đ/lượt',N'TD', NULL, NULL),
(N'1588994567',N'07.0003',N'Giá cước ô tô đi đường dài',N'Chọn 1 tuyến phổ biến, xe đường dài máy lạnh', NULL,N'đ/vé',N'TD', NULL, NULL),
(N'1588994567',N'07.0004',N'Giá cước xe buýt công cộng',N'Đi trong nội tỉnh, dưới 30km', NULL,N'đ/vé',N'TD', NULL, NULL),
(N'1588994567',N'07.0005',N'Giá cước taxi',N'Lấy giá 10km đầu, loại xe 4 chỗ', NULL,N'đ/km',N'TD', NULL, NULL),
(N'1588994567',N'07.0006',N'Xăng E5 Ron 92',N'', NULL,N'đ/lít',N'TD', NULL, NULL),
(N'1588994567',N'07.0007',N'Xăng Ron 95',N'', NULL,N'đ/lít',N'TD', NULL, NULL),
(N'1588994567',N'07.0008',N'Dầu Diezel',N'', NULL,N'đ/lít',N'TD', NULL, NULL),
(N'1588994567',N'08.0001',N'Dịch vụ giáo dục trường mầm non công lập',N'Trường chuẩn quốc gia 3-10', NULL,N'Đồng/tháng',N'TD', NULL, NULL),
(N'1588994567',N'08.0002',N'Dịch vụ giáo dục trường trung học cơ sở công lập (lớp 8)',N'Trường thuộc các phường trừ phường Hợp giang', NULL,N'Đồng/tháng',N'TD', NULL, NULL),
(N'1588994567',N'08.0003',N'Dịch vụ giáo dục trường trung học phổ thông công lập (lớp 11)',N'Ttrường trung học phổ thông công lập', NULL,N'Đồng/tháng',N'TD', NULL, NULL),
(N'1588994567',N'08.0004',N'Dịch vụ giáo dục đào tạo nghề công lập',N'Trình độ trung cấp nghề', NULL,N'Đồng/tháng hoặc đồng/tín chỉ',N'TD', NULL, NULL),
(N'1588994567',N'08.0005',N'Dịch vụ giáo dục đào tạo trung cấp, trường thuộc cấp Bộ quản lý',N'Khoa học xã hội, kinh tế, luật, nông , lâm, thủy sản', NULL,N'Đồng/tháng hoặc đồng/tín chỉ',N'TD', NULL, NULL),
(N'1588994567',N'08.0006',N'Dịch vụ giáo dục đào tạo cao đẳng công lập',N'Khoa học xã hội, kinh tế, luật, nông , lâm, thủy sản', NULL,N'Đồng/tháng hoặc đồng/tín chỉ',N'TD', NULL, NULL),
(N'1588994567',N'08.0008',N'Dịch vụ giáo dục đào tạo đại học công lập hoặc tương đương đại học công lập',N'Ghi rõ tên trường, ngành nghề đào tạo', NULL,N'Đồng/tháng hoặc đồng/tín chỉ',N'TD', NULL, NULL),
(N'1588994567',N'09.0001',N'Du lịch trọn gói trong nước',N'Du lịch trọn gói trong nước cho 1 người chuyến 2 ngày 1 đêm (từ Hà Nội, đến Thác Bản Giốc)', NULL,N'đ/người/ chuyến',N'TD', NULL, NULL),
(N'1588994567',N'09.0002',N'Phòng khách sạn 3 sao hoặc tương đương',N'Hai giường đơn hoặc 1 giường đôi, có tivi, điêu hòa nước nóng, điện thoại cố định, vệ sinh khép kín,Wifí', NULL,N'đ/ngày-đêm',N'TD', NULL, NULL),
(N'1588994567',N'09.0003',N'Phòng nhà khách tư nhân',N'1 giường, điều hoà, nước nóng-lạnh, phòng vệ sinh khép kín', NULL,N'đ/ngày-đêm',N'TD', NULL, NULL),
(N'1588994567',N'10.0001',N'Vàng 99,99%',N'Kiểu nhẫn tròn 1 chỉ', NULL,N'1000 đ/chỉ',N'TD', NULL, NULL),
(N'1588994567',N'10.0002',N'Đô la Mỹ',N'Loại tờ 100USD', NULL,N'đ/USD',N'TD', NULL, NULL);
     **/
}
