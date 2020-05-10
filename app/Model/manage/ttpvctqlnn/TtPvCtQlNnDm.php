<?php

namespace App\Model\manage\ttpvctqlnn;

use Illuminate\Database\Eloquent\Model;

class TtPvCtQlNnDm extends Model
{
    protected $table = 'ttpvctqlnndm';
    protected $fillable = [
        'id',
        'phanloai',
        'mota',
        'theodoi',
    ];
    /*
     INSERT INTO [ttpvctqlnndm]([phanloai],[mota],[theodoi]) VALUES
('KNTC', N'Tình hình thanh tra, kiểm tra, giải quyết khiếu nại, tố cáo và xử lý vi phạm pháp luật về giá và thẩm định giá','TD'),
('BOG', N'Qũy bình ổn giá các mặt hàng thuộc danh mục bình ổn giá theo quy định của pháp luật', 'TD'),
('TTKTCTKT', N'Các thông tin, chỉ tiêu kinh tế vĩ mô trong nước và thế giới như: Tài khoản quốc gia, tài chính công; tiền tệ, chứng khoán; thương mại; chỉ số giá; các chỉ tiêu phản ánh tăng trưởng kinh tế thế giới, trong nước; các thông tin; chỉ tiêu khác có liên quan đến pháp luật', 'TD'),
('TTKP', N'Các thông tin khắc phục vụ công tác quản lý nhà nước về giá.', 'TD')
     * */
}
