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
    <p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">GIÁ CHO THUÊ MÔI TRƯỜNG RỪNG</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
        <thead>
        <tr>
            <th style="text-align: center" width="2%">STT</th>
            <th style="text-align: center" >Số quyết định</th>
            <th style="text-align: center">Thời điểm</th>
            <th style="text-align: center">Địa bàn</th>
            <th style="text-align: center">Loại rừng</th>
            <th style="text-align: center">Tên dự án</th>
            <th style="text-align: center" >Đơn giá</th>

            <th style="text-align: center" >Ghi chú</th>
        </tr>
        </thead>
        <tbody>
            @foreach($model as $key => $tt)
                <tr>
                    <td style="text-align: center">{{$key+1}}</td>
                    <td style="text-align: center">{{$tt->soqd}}</td>
                    <td><b>{{getDayVn($tt->thoidiem)}}</b></td>
                    <td><b>{{$a_diaban[$tt->madiaban] ?? ''}}</b></td>
                    <td style="text-align: left;"><b>{{$a_loairung[$tt->manhom] ?? ''}}</b></td>
                    <td style="text-align: left" class="active">{{$tt->tenduan}}</td>
                    <td style="text-align: center">{{dinhdangsothapphan($tt->dongia,2)}}</td>
                    <td style="text-align: center">{{$tt->ghichu}}</td>
                </tr>
            @endforeach
        </tbody>
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