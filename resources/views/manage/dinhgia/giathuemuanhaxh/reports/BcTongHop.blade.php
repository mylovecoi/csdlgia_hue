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
        <td></td>
        <td style="text-align: right"><i style="margin-right: 25%;">{{$m_donvi->diadanh}}, ngày .... tháng .... năm ....</i></td>
    </tr>
</table>
<p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">TỔNG HỢP GIÁ BÁN - CHO THUÊ - THUÊ MUA NHÀ THUỘC SỞ HỮU NHÀ NƯỚC</p>
<p style="text-align: center;font-style: italic;">{{'Từ ngày: '.getDayVn($inputs['tungay']).' đến ngày '.getDayVn($inputs['denngay'])}}</p>
<p style="text-align: right;font-style: italic;">Đơn vị tính: Diện tích: m2; Giá trị: ngàn đồng </p>

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center" width="2%">STT</th>
            <th rowspan="2"  style="text-align: center">Tên khu nhà đất</th>
            <th rowspan="2"  style="text-align: center">Tên đơn vị thuê</th>
            <th rowspan="2"  style="text-align: center">Địa chỉ</th>
            <th colspan="2" style="text-align: center">Quyết định phê<br>duyệt chủ trương</th>
            <th colspan="2" style="text-align: center">Quyết định phê<br>duyệt giá</th>
            <th colspan="3" style="text-align: center">Giá dịch vụ/ năm</th>
            <th rowspan="2"  style="text-align: center">Hợp đồng thuê</th>
            <th rowspan="2"  style="text-align: center">Thời gian<br>cho thuê</th>
            <th rowspan="2"  style="text-align: center">Từ ngày<br>đến ngày</th>
            <th rowspan="2"  style="text-align: center">Ghi chú</th>
        </tr>
        <tr>
            <th>Số QĐ</th>
            <th>Ngày tháng</th>
            <th>Số QĐ</th>
            <th>Ngày tháng</th>
            <th>Diện tích</th>
            <th>Giá thuê</th>
            <th>Giá bán</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach($model as $key => $tt)
            <tr>
                <td style="text-align: center">{{$i++}}</td>
                <td>{{$tt->tennha}}</td>
                <td>{{$tt->dvthue}}</td>
                <td>{{$tt->diachi}}</td>
                <td style="text-align: center">{{$tt->soqdpd}}</td>
                <td style="text-align: center">{{getDayVn($tt->thoigianpd)}}</td>
                <td style="text-align: center">{{$tt->soqddg}}</td>
                <td style="text-align: center">{{getDayVn($tt->thoigiandg)}}</td>
                <td style="text-align: right">{{dinhdangsothapphan($tt->dientich,2)}}</td>
                <td style="text-align: right">{{dinhdangsothapphan($tt->dongiathue,2)}}</td>
                <td style="text-align: right">{{dinhdangsothapphan($tt->dongia,2)}}</td>
                <td style="text-align: center">{{$tt->hdthue}}</td>
                <td style="text-align: center">{{$tt->ththue}}</td>
                <td style="text-align: center">{{'Từ ngày: '.getDayVn($tt->thuetungay).' đến ngày '.getDayVn($tt->thuedenngay)}}</td>
                <td></td>
            </tr>
        @endforeach
        <tr style="font-weight: bold" class="text-right;">
            <td colspan="4">Tổng cộng</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right">{{dinhdangsothapphan($model->sum('dongiathue'),2)}}</td>
            <td style="text-align: right">{{dinhdangsothapphan($model->sum('dongia'),2)}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
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