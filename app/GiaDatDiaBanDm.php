<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaDatDiaBanDm extends Model
{
    protected $table = 'giadatdiabandm';
    protected $fillable = [
        'id',
        'maloaidat',
        'loaidat'
    ];
}
/*
 USE [giahue]
GO
INSERT INTO [dbo].[giadatdiabandm] ( "maloaidat", "loaidat") VALUES
('DTL', N'Đất trồng lúa'),
('DTCHNK', N'Đất trồng cây hàng năm khác'),
('DTCLN', N'Đất trồng cây lâu năm'),
('DLN', N'Đất lâm nghiệp'),
('DNTTS', N'Đất nuôi trồng thủy sản'),
('DOTNT', N'Đất ở tại nông thôn'),
('DTMDVTNT', N'Đất thương mại, dịch vụ tại nông thôn'),
('DSXKDPNNTNN', N'Đất sản xuất, kinh doanh phi nông nghiệp không phải là đát thương mại, dịch vụ tại nông thôn'),
('DOTDT', N'Đất ở tại đô thị'),
('DTMDVTDT', N'Đất thương mại, dịch vụ tại đô thị'),
('DSXKDPNNTDT', N'Đất sản xuất kinh doanh phi nông nghiệp không phải là đất thương mại, dịch vụ tại đô thi');
 */
