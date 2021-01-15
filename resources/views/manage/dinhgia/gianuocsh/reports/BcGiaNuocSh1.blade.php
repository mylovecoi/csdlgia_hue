@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

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
<p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">GIÁ NƯỚC SẠCH SINH HOẠT </p>
<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center" width="2%">STT</th>
            <th rowspan="2"  style="text-align: center">Mục đích sử dụng</th>
            @if($inputs['mahslk'] != 'ALL')
                <th colspan="{{$inputs['col_lk'] * 2}}" style="text-align: center">Đơn giá theo quyết định số {{$ttlk->soqd ?? ''}} - Ngày {{getDayVn($ttlk->thoidiem ?? '')}}<br>{{$ttlk->mota ?? ''}}</th>
            @endif
            @if($inputs['mahsbc'] != 'ALL')
                <th colspan="{{$inputs['col_bc'] * 2}}" style="text-align: center">Đơn giá theo quyết định số {{$ttbc->soqd ?? ''}} - Ngày {{getDayVn($ttbc->thoidiem ?? '')}}<br>{{$ttbc->mota ?? ''}}</th>
            @endif
        </tr>
        <tr>
            @if($inputs['mahslk'] != 'ALL')
                @for($i=0;$i<$inputs['col_lk'];$i++)
                   <th>Năm<br>áp<br>dụng</th>
                   <th>Giá<br>tiền</th>
                @endfor
            @endif
            @if($inputs['mahsbc'] != 'ALL')
                @for($i=0;$i<$inputs['col_bc'];$i++)
                    <th>Năm<br>áp<br>dụng</th>
                    <th>Giá<br>tiền</th>
                @endfor
            @endif
        </tr>
    </thead>
    <tbody>
    @if($model->count() != 0)
        @foreach($model as $key => $tt)
            <tr>
                <td style="text-align: center">{{$key+1}}</td>
                <td><b>{{$tt->doituongsd}}</b></td>
                @if($inputs['mahslk'] != 'ALL')
                    @for($i=0;$i<$inputs['col_lk'];$i++)
                        <?php
                            $namlk = $a_col_namlk[$i];
                            $gialk = $a_col_gialk[$i];
                        ?>
                        <td style="text-align: center">{{$tt->$namlk==0?'':$tt->$namlk}}</td>
                        <td style="text-align: right">{{dinhdangsothapphan($tt->$gialk,2)}}</td>
                    @endfor
                @endif
                @if($inputs['mahsbc'] != 'ALL')
                    @for($i=0;$i<$inputs['col_bc'];$i++)
                        <?php
                        $nambc = $a_col_nambc[$i];
                        $giabc = $a_col_giabc[$i];
                        ?>
                        <td style="text-align: center">{{$tt->$nambc==0?'':$tt->$nambc}}</td>
                        <td style="text-align: right">{{dinhdangsothapphan($tt->$giabc,2)}}</td>
                    @endfor
                @endif
            </tr>
        @endforeach
    @endif
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