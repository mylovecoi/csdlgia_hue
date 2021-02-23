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
                Số: {{$m_hoso->soqd != ''? $m_hoso->soqd: '..............'}}
            </td>
            <td style="text-align: right">
                <i style="margin-right: 25%;">{{$m_donvi->diadanh}},{{getNt2Bc($m_hoso->thoidiem)}}</i>
            </td>
        </tr>
    </table>

    <p style="text-align: center;font-weight: bold;font-size: 14px;text-transform:uppercase;">
        Hồ sơ GIÁ SẢN PHẨM, DỊCH VỤ TỐI ĐA
    </p>
    <p style="text-align: center;">{{'Số quyết định: '. $m_hoso->soqd . ', ' .getNt2Bc($m_hoso->thoidiem)}}</p>
    <p style="text-align: center;">{{$m_hoso->ttqd}}</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
        <tr>
            <th width="5%" style="text-align: center">STT</th>
            <th style="text-align: center">Phân loại</th>
            <th style="text-align: center" width="15%">Đơn vị<br>tính</th>
            <th style="text-align: center" width="15%">Đơn giá<br> thuê</th>

        </tr>
        <?php $i = 1; ?>
        @foreach($a_phanloai as $pl)
            <?php
                $chitiet = $model->where('phanloai', $pl);
                $k = 1;
            ?>
            <tr style="font-weight: bold;">
                <td>{{IntToRoman($i++)}}</td>
                <td colspan="3" style="text-align: left">{{$pl}}</td>
            </tr>
            @foreach($chitiet as $key=>$tt)
                <tr>
                    <td style="text-align: center">{{$k++}}</td>
                    <td>{{$tt->tenspdv}}</td>
                    <td style="text-align: center;">{{$tt->dvt}}</td>
                    <td style="text-align: right;">{{dinhdangso($tt->dongia)}}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
    <p style="text-align: left;">{!! $m_hoso->ghichu !!}}</p>

    <table width="96%" border="0" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">
                <span style="font-weight: bold;font-style: italic">Nơi nhận:</span><br>
                - UBND tỉnh;<br>
                - Bộ tài chính;<br>
                - Lưu: VT, QLGCS.
            </td>
            <td style="vertical-align: top;">
                <b>{{$m_donvi->chucvuky}}</b><br>
                <i>(Ký tên, đóng dấu)</i>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
               <br><br><br><br><br><br><br><br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                {{$m_donvi->nguoiky}}
            </td>
        </tr>
    </table>
@stop
