@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <span style="text-transform: uppercase">{{session('admin')->tendvcqhienthi}}</span><br>
                <span style="text-transform: uppercase;font-weight: bold">{{session('admin')->tendvhienthi}}</span>
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
            <td style="text-align: right"><i style="margin-right: 25%;">{{session('admin')->diadanh}}, ngày .... tháng .... năm ....</i></td>
        </tr>
    </table>

    <p style="text-align: center; font-weight: bold; font-size: 16px;text-transform: uppercase;">BÁO CÁO CHI TIẾT KÊ KHAI, ĐĂNG KÝ GIÁ SÁCH</p>
    <p style="text-align: center; font-size: 14px;">
        Từ ngày {{getDayVn($inputs['tungay']).' đến ngày '.getDayVn($inputs['denngay'])}}
    </p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
        <thead>
        <tr>
            <th style="text-align: center ; margin: auto" width="2%">STT</th>
            <th style="text-align: center">Tên hàng hóa, dịch vụ</th>
            <th style="text-align: center">Quy cách, chất lượng</th>
            <th style="text-align: center">Đơn vị<br>tính</th>
            <th style="text-align: center">Giá<br>liền kề</th>
            <th style="text-align: center">Giá <br>kê khai</th>
        </tr>
        </thead>
        <tbody>
        @foreach($modeldvql as $dvql)
            <tr>
                <td></td>
                <td colspan="6" style="font-weight: bold; text-align: left">{{$dvql->tendv}}</td>
            </tr>
            <?php $model = $model->where('macqcq',$dvql->madv)?>
            @foreach($model as $key=>$tt)
                <tr>
                    <td style="text-align: center">{{$key+1}}</td>
                    <td class="active" colspan="5"><b> {{$a_com[$tt->madv] ?? ''}} </b><br>
                        -<b>Mã số thuế:</b> {{$tt->maxa}}<br>
                        -<b>Mã hồ sơ:</b> {{$tt->mahs}}<br>
                        -<b>Số công văn:</b>{{$tt->socv}}<br>
                        -<b>Ngày hiệu lực:</b> {{getDayVn($tt->ngayhieuluc)}}<br>
                        -<b>Ngày chuyển:</b> {{getDateTime($tt->ngaychuyen)}}<br>
                        -<b>Số hồ sơ nhận:</b> {{$tt->sohsnhan}} - Ngày nhận: {{getDayVn($tt->ngaynhan)}}
                    </td>
                </tr>
                <?php $modelct = $modelct->where('mahs',$tt->mahs)?>
                @foreach($modelct as $key2=>$tt)
                    <tr>
                        <td style="text-align: right">{{($key2 +1)}}</td>
                        <td class="active" style="font-style: italic">{{$tt->tthhdv}}</td>
                        <td style="text-align: left;font-style: italic">{{$tt->qccl}}</td>
                        <td style="text-align: center">{{$tt->dvt}}</td>
                        <td style="text-align: right">{{number_format($tt->dongialk)}}</td>
                        <td style="text-align: right">{{number_format($tt->dongia)}}</td>
                    </tr>
                @endforeach
            @endforeach
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