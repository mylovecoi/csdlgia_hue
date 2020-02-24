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

    <p style="text-align: center;font-weight: bold;font-size: 20px">
        HỒ SƠ THUÊ TÀI SẢN CÔNG
    </p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
        <tr>
            <th width="2%" style="text-align: center">STT</th>
            <th style="text-align: center">Tên tài sản</th>
            <th style="text-align: center" width="10%">Số lượng/<br>diện tích</th>
            <th style="text-align: center" width="5%">Đơn vị<br>tính</th>
            <th style="text-align: center" width="10%">Đơn giá<br> thuê</th>
            <th style="text-align: center">Đơn vị thuê</th>
            <th style="text-align: center">Hợp đồng số</th>
            <th style="text-align: center">Thời hạn</th>
            <th style="text-align: center">Thành tiền</th>
        </tr>
        @foreach($model as $key=>$tt)
            <tr id={{$tt->id}}>
                <td style="text-align: center">{{($key +1)}}</td>
                <td class="active" style="font-weight: bold">{{$a_ts[$tt->mataisan]}}</td>
                <td style="text-align: center;" >{{dinhdangso($tt->soluong)}}</td>
                <td style="text-align: center;" >{{$tt->dvt}}</td>
                <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->dongiathue)}}</td>
                <td style="text-align: left;">{{$tt->dvthue}}</td>
                <td style="text-align: left;">{{$tt->hdthue}}</td>
                <td style="text-align: left;">{{$tt->ththue}}</td>
                <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->sotienthuenam)}}</td>
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
