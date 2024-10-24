@extends('reports.main_rps')

@section('content')
<table id="data_header" width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%" style="vertical-align: top;">
            <span style="text-transform: uppercase">{{session('admin')->tendvhienthi}}</span><br>
            <span style="text-transform: uppercase;font-weight: bold">{{session('admin')->tendvcqhienthi}}</span><br>
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
        <td style="text-align: right"><i style="margin-right: 25%;">{{session('admin')->diadanh}}, {{getNt2Bc($m_hoso->ngaybc ?? '')}}</i></td>
    </tr>
    <tr style="text-align: center; font-weight: bold; font-size: 16px;">
        <td colspan="2">BẢNG GIÁ THỊ TRƯỜNG THÁNG {{$m_hoso->thang ?? '.....'}} NĂM {{$m_hoso->nam ?? '.....'}}</td>
    </tr>
    <tr style="font-style: italic; text-align: center">
        <td colspan="2">(Ban hành kèm theo Thông tư số 116/2018/TT-BTC ngày 28/11/2018 của Bộ Tài Chính quy định chế độ báo cáo giá thị trường)</td>
    </tr>
</table>

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data_body">
    <thead>
        <tr>
            <th width="2%" style="text-align: center">STT</th>
            <th style="text-align: center">Mã hàng hóa<br> dịch vụ</th>
            <th style="text-align: center" >Tên hàng hóa dịch vụ</th>
            <th style="text-align: center" >Đặc điểm kỹ thuật</th>
            <th style="text-align: center" >Đơn vị tính</th>
            <th style="text-align: center" >Loại giá</th>
            <th style="text-align: center" width="10%" >Giá kỳ trước</th>
            <th style="text-align: center" width="10%" >Giá kỳ này</th>
            <th style="text-align: center" width="5%" >Mức tăng giảm</th>
            <th style="text-align: center" width="5%" >Tỷ lệ tăng (giảm)(%)</th>
            <th style="text-align: center">Nguồn thông tin</th>
            <th style="text-align: center" width="5%" >Ghi chú</th>
        </tr>
        <tr style="font-size: 10px">
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9=8-7</th>
            <th>10=9/7</th>
            <th>11</th>
            <th>12</th>
        </tr>
    </thead>
    <tbody>

    <?php $i = 1; ?>
    @foreach($a_nhomhhdv as $key=>$tt)
        <?php
        $chitiet = $model->where('manhom',$key);
        $k = 1;
        ?>
        <tr style="font-weight: bold;">
            <td>{{IntToRoman($i++)}}</td>
            <td colspan="11">{{$tt}}</td>
        </tr>
        @foreach($chitiet as $ct)
            <tr>
                <td style="text-align: center">{{$k++}}</td>
                <td style="text-align: center">{{$ct->mahhdv}}</td>
                <td>{{$ct->tenhhdv}}</td>
                <td>{{$ct->dacdiemkt}}</td>
                <td style="text-align: center">{{$ct->dvt}}</td>
                <td style="text-align: center">{{$ct->loaigia}}</td>
                <td style="text-align: right;">{{dinhdangsothapphan($ct->gialk,5)}}</td>
                <td style="text-align: right;">{{dinhdangsothapphan($ct->gia,5)}}</td>
                <td style="text-align: right;">{{dinhdangsothapphan($ct->chenhlech,5)}}</td>
                <td style="text-align: center;">{{dinhdangsothapphan($ct->phantram,5).($ct->phantram != 0 ? '%':'')}}</td>
                {{--<td style="text-align: right;">{{dinhdangsothapphan($ct->gia - $ct->gialk,5)}}</td>--}}
                {{--<td style="text-align: center;">{{$ct->gialk == 0 ? '' : dinhdangsothapphan(($ct->gia - $ct->gialk)/$ct->gialk,5)}}</td>--}}
                <td>{{$ct->nguontt}}</td>
                <td>{{$ct->ghichu}}</td>
            </tr>
        @endforeach
    @endforeach

    </tbody>
</table>
<table id="data_footer" width="96%" border="0" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
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