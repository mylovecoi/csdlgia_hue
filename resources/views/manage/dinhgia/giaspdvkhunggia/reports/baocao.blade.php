@extends('reports.main_rps')
@section('content')
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <span style="text-transform: uppercase">{{$m_donvi->tendvcqhienthi}}</span><br>
                <span style="text-transform: uppercase;font-weight: bold">{{$m_donvi->tendvhienthi}}</span>
                <hr style="width: 10%;vertical-align: top;  margin-top: 2px">

            </td>
            <td style="vertical-align: top;">
                <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc</b>
                <hr style="width: 15%;vertical-align: top; margin-top: 2px">

            </td>
        </tr>
        <tr>
            <td>
                Số: ..............
            </td>
            <td style="text-align: right">
                <i style="margin-right: 25%;">{{$m_donvi->diadanh}}, ngày .... tháng .... năm ....</i>
            </td>
        </tr>
    </table>

    <p style="text-align: center;font-weight: bold;font-size: 14px;text-transform:uppercase;">
        Hồ sơ GIÁ SẢN PHẨM, DỊCH VỤ khung giá
    </p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
        <tr>
            <th width="2%" style="text-align: center">STT</th>
            <th style="text-align: center">Phân loại</th>
            <th style="text-align: center">Tên hàng hóa</th>
            <th style="text-align: center" width="8%">Đơn vị<br>tính</th>
            <th style="text-align: center" width="10%">Mức giá<br>tối thiều</th>
            <th style="text-align: center" width="10%">Mức giá<br>tối đa</th>

        </tr>
        @foreach($model as $key=>$tt)
            <tr id={{$tt->id}}>
                <td style="text-align: center">{{($key +1)}}</td>
                <td class="active" style="font-weight: bold">{{$tt->phanloai}}</td>
                <td class="active" style="font-weight: bold">{{$tt->tenspdv}}</td>
                <td style="text-align: left;">{{$tt->dvt}}</td>
                <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->giatoithieu)}}</td>
                <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->giatoida)}}</td>
            </tr>
        @endforeach

    </table>

    <table width="96%" border="0" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">
                <span style="font-weight: bold;font-style: italic">Nơi nhận:</span><br>
                - UBND tỉnh;<br>
                - Bộ tài chính;<br>
                - Lưu: VT, QLGCS.
            </td>
            <td style="vertical-align: top;">
                <b>THỦ TRƯỞNG ĐƠN VỊ</b><br>
                <i>(Ký tên, đóng dấu)</i>
            </td>
        </tr>
    </table>
@stop
