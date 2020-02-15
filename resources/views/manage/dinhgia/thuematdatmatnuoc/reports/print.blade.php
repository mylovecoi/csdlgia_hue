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
        <td>Số: ..............</td>
        <td style="text-align: right"><i style="margin-right: 25%;">{{$m_donvi->diadanh}}, ngày .... tháng .... năm ....</i></td>
    </tr>
</table>
<p style="font-weight: bold;font-size: 16px;text-transform: uppercase;text-align: center">THÔNG TIN VỀ CHO THUÊ ĐẤT, MẶT NƯỚC</p>

<table width="96%" cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
    <tr>
        <th style="text-align: center;width: 1%">STT</th>
        <th style="text-align: center" >Số quyết định</th>
        <th style="text-align: center">Ngày áp dụng</th>
        <th style="text-align: center">Vị trí</th>
        <th style="text-align: center">Mô tả</th>
        <th style="text-align: center">Diện tích</th>
        <th style="text-align: center">Giá tiền</th>
        <th style="text-align: center">Ghi chú</th>
    </tr>

    <tr>
        <th style="text-align: center">1</th>
        <th style="text-align: center">2</th>
        <th style="text-align: center">3</th>
        <th style="text-align: center">4</th>
        <th style="text-align: center">5</th>
        <th style="text-align: center">6</th>
        <th style="text-align: center">7</th>
        <th style="text-align: center">8</th>
    </tr>
    <?php $i=1; ?>
    @foreach($m_diaban as $diaban)
        <?php
            $hoso = $model->where('madiaban',$diaban->madiaban);
            if (count($model) == 0) continue;
        ?>

        <tr>
            <td style="text-align: center;font-weight: bold;text-transform: uppercase">{{toAlpha($i++)}}</td>
            <td colspan="7" style="font-weight: bold;">{{$diaban->tendiaban}}</td>
        </tr>
            <?php $j=1; ?>
        @foreach($hoso as $gr2=>$tt)
            <tr style="font-weight: bold;font-style: italic;">
                <td>{{IntToRoman($j++)}}</td>
                <td>{{$tt->soqd}}</td>
                <td>{{getDayVn($tt->thoidiem)}}</td>
                <td>{{$tt->vitri}}</td>
                <td>{{$tt->mota}}</td>
                <td style="text-align: right">{{dinhdangso($tt->dientich)}}</td>
                <td style="text-align: right">{{dinhdangso($tt->dongia)}}</td>
                <td></td>
            </tr>
        @endforeach
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