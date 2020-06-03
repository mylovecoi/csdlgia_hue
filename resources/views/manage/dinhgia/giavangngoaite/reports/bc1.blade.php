@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%">
                <span style="text-transform: uppercase">{{session('admin')->tendvhienthi}}</span><br>
                <span style="text-transform: uppercase;font-weight: bold">{{session('admin')->tendvcqhienthi}}</span><br>
                <hr style="width: 10%"> <br>
                Số: ...
            </td>
            <td>
                <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc</b><br>
                <hr style="width: 15%"><br>

            </td>
        </tr>
    </table>

<p style="text-align: center; font-weight: bold; font-size: 16px;">BÁO CÁO GIÁ VÀNG, NGOẠI TỆ</p>
<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
    <thead>
        <tr>
            <th width="2%" style="text-align: center">STT</th>
            <th style="text-align: center">Mã hàng<br>hóa dịch<br>vụ</th>
            <th style="text-align: center">Tên hàng<br>hóa dịch<br>vụ</th>
            <th style="text-align: center">Đặc điểm<br>kỹ thuật</th>
            <th style="text-align: center">Đơn vị<br>tính</th>
            @foreach($a_col as $key=>$val)
                <th style="text-align: center">Ngày<br>{{getDayVn($val)}}</th>
            @endforeach
        </tr>

        <tr style="font-size: 10px">
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            @for($j= 5; $j< count($a_col) + 5; $j++)
                <th>{{$j}}</th>
            @endfor
        </tr>
    </thead>
    <tbody>

        @foreach($model as $key=>$tt)
            <tr>
                <td style="text-align: center">{{$key+1}}</td>
                <td style="text-align: center">{{$tt->mahhdv}}</td>
                <td>{{$tt->tenhhdv}}</td>
                <td>{{$tt->dacdiemkt}}</td>
                <td style="text-align: center">{{$tt->dvt}}</td>
                @foreach($a_col as $key=>$val)
                    <td style="text-align: right;">{{dinhdangsothapphan($tt->$key,5)}}</td>
                @endforeach
            </tr>
        @endforeach

    </tbody>
</table>
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:20px auto; text-align: center;">
    <tr>
        <td style="text-align: left;" width="30%">

        </td>
        <td style="text-align: center;text-transform: uppercase; " width="70%">
            <b></b><br>
        </td>
    </tr>
</table>
@stop