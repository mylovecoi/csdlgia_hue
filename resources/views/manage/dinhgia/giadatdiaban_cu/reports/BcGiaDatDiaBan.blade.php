@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')

<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%" style="vertical-align: top;">
            <span style="text-transform: uppercase">{{$m_donvi->tendvcqhienthi ?? session('admin')->tendvcqhienthi}}</span><br>
            <span style="text-transform: uppercase;font-weight: bold">{{$m_donvi->tendvhienthi ?? session('admin')->tendvhienthi}}</span>
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
        <td style="text-align: right"><i style="margin-right: 25%;">{{$m_donvi->diadanh ?? session('admin')->diadanh}}, ngày .... tháng .... năm ....</i></td>
    </tr>
</table>
<p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">BẢNG GIÁ ĐẤT THEO ĐỊA BÀN </p>
@if($inputs['nam'] != 'all')
<p style="text-align: center;font-weight: bold;font-size: 16px">Năm {{$inputs['nam']}}</p>
@endif

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
    <thead>
    <tr>
        <th style="text-align: center" width="2%" rowspan="2">STT</th>
        <th style="text-align: center" width="2%" rowspan="2">Năm</th>
        <th style="text-align: center" rowspan="2" width="10%">Địa bàn</th>
        <th style="text-align: center" rowspan="2" width="10%">Xã phường, thị trấn</th>
        <th style="text-align: center" rowspan="2" width="10%">Loại đất</th>
        <th style="text-align: center" rowspan="2">Khu vực</th>
        <th style="text-align: center" rowspan="2" width="2%">Hệ số K</th>
        <th style="text-align: center" colspan="3">Giá đất</th>
    </tr>
    <tr>
        <th style="text-align: center">VT1</th>
        <th style="text-align: center">VT2</th>
        <th style="text-align: center">VT3</th>
    </tr>
    </thead>
    <tbody>
    @if($model->count() != 0)
        @foreach($model as $key => $tt)
            <tr>
                <td style="text-align: center">{{$key+1}}</td>
                <td><b>{{$tt->nam}}</b></td>
                <td><b>{{$a_diaban[$tt->madiaban] ?? ''}}</b></td>
                <td><b>{{$a_xp[$tt->maxp] ?? ''}}</b></td>
                <td style="text-align: left"><b>{{$a_loaidat[$tt->maloaidat] ?? ''}}</b></td>
                <td style="text-align: left;" class="active"><b>{{$tt->khuvuc}}</b></td>
                <td style="text-align: center">{{$tt->hesok}}</td>
                <td style="text-align: center">{{dinhdangsothapphan($tt->giavt1,2)}}</td>
                <td style="text-align: center">{{dinhdangsothapphan($tt->giavt2,2)}}</td>
                <td style="text-align: center">{{dinhdangsothapphan($tt->giavt3,2)}}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td style="text-align: center" colspan="15">Không tìm thấy thông tin. Bạn cần kiểm tra lại điều kiện tìm kiếm!!!</td>
        </tr>
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