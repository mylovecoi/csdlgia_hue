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
                <i>{{session('admin')->diadanh}}, ngày .... tháng .... năm ....</i>
            </td>
        </tr>
    </table>

<p style="text-align: center; font-weight: bold; font-size: 16px;">BÁO CÁO<br>GIÁ THỊ TRƯỜNG HÀNG HÓA, DỊCH VỤ</p>
<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
    <thead>
        <tr>
            <th width="2%" style="text-align: center" rowspan="2">STT</th>
            <th style="text-align: center" rowspan="2">Mã hàng hóa<br> dịch vụ</th>
            <th style="text-align: center" rowspan="2">Tên hàng hóa dịch vụ</th>
            <th style="text-align: center" rowspan="2">Đặc điểm kỹ thuật</th>
            <th style="text-align: center" rowspan="2">Đơn vị tính</th>
            <th style="text-align: center" width="10%" rowspan="2">Giá hàng<br>hóa, dịch vụ<br>liền kề</th>
            <th style="text-align: center" width="10%" rowspan="2">Giá hàng<br>hóa, dịch vụ<br>kê khai</th>
            <th style="text-align: center" width="5%" colspan="2">Tăng, giảm</th>
            <th style="text-align: center" width="10%" rowspan="2">Ghi chú</th>
        </tr>
        <tr>
            <th>Mức</th>
            <th>%</th>
        </tr>
        <tr style="font-size: 10px">
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8=7-6</th>
            <th>9=8/6</th>
            <th>10</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($a_nhomhhdv as $key=>$tt)
        <?php
            $chitiet = a_getelement_equal($a_chitiet,['manhom'=>$key]);
            $k = 1;
            if(count($chitiet) == 0)
                continue;
        ?>
        <tr style="font-weight: bold;">
            <td>{{IntToRoman($i++)}}</td>
            <td colspan="9">{{$tt}}</td>
        </tr>
        @foreach($chitiet as $ct)
            <tr>
                <td style="text-align: center">{{$k++}}</td>
                <td style="text-align: center">{{$ct['mahhdv']}}</td>
                <td>{{$ct['tenhhdv']}}</td>
                <td>{{$ct['dacdiemkt']}}</td>
                <td style="text-align: center">{{$ct['dvt']}}</td>
                <td style="text-align: right;">{{dinhdangsothapphan($ct['giathlk'],5)}}</td>
                <td style="text-align: right;">{{dinhdangsothapphan($ct['giath'],5)}}</td>
                <td style="text-align: right;">{{dinhdangsothapphan($ct['chenhlech'],5)}}</td>
                <td style="text-align: center;">{{dinhdangsothapphan($ct['phantram'],5).($ct['phantram'] != 0 ? '%':'')}}</td>
                <td></td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
    <table width="96%" border="0" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">

            </td>
            <td style="vertical-align: top;">
                <b>{{session('admin')->chucvuky}}</b><br>
                <i>(Ký tên, đóng dấu)</i>
                </br></br></br></br></br></br>
            </td>
        </tr>
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">
            </td>
            <td style="vertical-align: top;">
                {{session('admin')->nguoiky}}
            </td>
        </tr>
    </table>
@stop