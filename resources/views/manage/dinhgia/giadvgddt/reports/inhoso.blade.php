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
        Hồ sơ GIÁ DỊCH VỤ ĐÀO TẠO
    </p>
    <p style="text-align: center;">{{'Số quyết định: '. $m_hoso->soqd . ', ' .getNt2Bc($m_hoso->thoidiem)}}</p>
    <p style="text-align: center;">{{$m_hoso->ttqd}}</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
        <thead>
        <tr>
            <th rowspan="2" width="3%" style="text-align: center">STT</th>
            <th rowspan="2" style="text-align: center">Tên sản phẩm<br>dịch vụ</th>
            @if($inputs['namhoc1'])
                <th colspan="4" style="text-align: center">Mức thu học phí</th>
            @endif
            @if($inputs['namhoc2'])
                <th colspan="4" style="text-align: center">Mức thu học phí</th>
            @endif
            @if($inputs['namhoc3'])
                <th colspan="4" style="text-align: center">Mức thu học phí</th>
            @endif
        </tr>
        <tr>
            @if($inputs['namhoc1'])
                <th style="text-align: center">Năm<br>học</th>
                <th style="text-align: center">Thành<br>thị</th>
                <th style="text-align: center">Nông<br>thôn</th>
                <th style="text-align: center">Miền<br>núi</th>
            @endif
            @if($inputs['namhoc2'])
                <th style="text-align: center">Năm<br>học</th>
                <th style="text-align: center">Thành<br>thị</th>
                <th style="text-align: center">Nông<br>thôn</th>
                <th style="text-align: center">Miền<br>núi</th>
            @endif
            @if($inputs['namhoc3'])
                <th style="text-align: center">Năm<br>học</th>
                <th style="text-align: center">Thành<br>thị</th>
                <th style="text-align: center">Nông<br>thôn</th>
                <th style="text-align: center">Miền<br>núi</th>
            @endif

        </tr>
        </thead>
        <?php $i = 1; ?>

        @foreach($model as $key=>$tt)
            <tr class="text-right">
                <td style="text-align: center">{{$i++}}</td>
                <td class="text-left">{{$tt->tenspdv}}</td>
                @if($inputs['namhoc1'])
                    <td style="text-align: center">{{$tt->namapdung1}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->giathanhthi1)}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->gianongthon1)}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->giamiennui1)}}</td>
                @endif
                @if($inputs['namhoc2'])
                    <td style="text-align: center">{{$tt->namapdung2}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->giathanhthi2)}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->gianongthon2)}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->giamiennui2)}}</td>
                @endif
                @if($inputs['namhoc3'])
                    <td style="text-align: center">{{$tt->namapdung3}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->giathanhthi3)}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->gianongthon3)}}</td>
                    <td style="text-align: right">{{dinhdangso($tt->giamiennui3)}}</td>
                @endif
            </tr>
        @endforeach

    </table>
    <p style="text-align: left;">{!! nl2br($m_hoso->ghichu) !!}</p>

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
