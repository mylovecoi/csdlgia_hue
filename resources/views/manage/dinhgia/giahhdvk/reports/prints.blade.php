@extends('reports.main_rps')

@section('content')
    <p style="text-align: center;font-weight: bold">PHỤ LỤC SỐ 1</p>
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%">
                <span style="text-transform: uppercase">{{$m_dv->dvcaptren}}</span><br>
                <span style="text-transform: uppercase;font-weight: bold">{{$m_dv->dv}}</span><br>
                <hr style="width: 10%"> <br>
                Số: {{$model->soqd}}
            </td>
            <td>
                <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc</b><br>
                <hr style="width: 15%"><br>
                <i>{{$m_dv->diadanh}}, ngày {{date('d',strtotime($model->thoidiem))}} tháng {{date('m',strtotime($model->thoidiem))}} năm {{date('Y',strtotime($model->thoidiem))}}</i>
            </td>
        </tr>
    </table>

<p style="text-align: center; font-weight: bold; font-size: 16px;text-transform: uppercase;">BẢNG GIÁ THỊ TRƯỜNG HÀNG HÓA, DỊCH VỤ THÁNG {{$model->thang}} NĂM {{$model->nam}}</p>
<p style="text-align: center; font-size: 16px;font-style: italic">(Ban hành kèm theo Thông tư số 116/2018/TT-BTC ngày 28/11/2018 của Bộ Tài chính quy định chế độ báo cáo giá thị trường)</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
        <thead>
            <tr>
                <th width="2%" style="text-align: center">STT</th>
                <th style="text-align: center">Mã<br> hàng hóa</th>
                <th style="text-align: center">Tên hàng hóa dịch vụ</th>
                <th style="text-align: center" width="20%">Đặc điểm kinh tế, <br>kỹ thuật, quy cách</th>
                <th style="text-align: center">Đơn <br>vị<br> tính</th>
                <th style="text-align: center" >Loại giá</th>
                <th style="text-align: center" >Giá kỳ <br>trước</th>
                <th style="text-align: center" >Giá kỳ <br>này</th>
                <th style="text-align: center">Mức tăng<br>(giảm)</th>
                <th style="text-align: center">Tỷ lệ<br>tăng<br>(giảm)<br>(%)</th>
                <th style="text-align: center">Nguồn thông tin</th>
                <th style="text-align: center" width="5%">Ghi chú</th>
            </tr>
            <tr>
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
        <tbody id="ttts">

        <?php $i = 1; ?>
        @foreach($a_nhomhhdv as $key=>$tt)
            <?php
            $chitiet = $modelct->where('manhom',$key);
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
                    <td style="text-align: left">{{$ct->loaigia}}</td>
                    <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($ct->gialk,5)}}</td>
                    <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($ct->gia,5)}}</td>
                    <td style="text-align: right;font-weight: bold">{{number_format($ct->gialk) == 0 ? '' : dinhdangsothapphan($ct->gia - $ct->gialk,5)}}</td>
                    <td style="text-align: right;font-weight: bold">{{number_format($ct->gialk) == 0 ? ''
                                : dinhdangsothapphan(($ct->gia - $ct->gialk)*100/$ct->gialk,2)}}</td>
                    <td>{{$ct->nguontt}}</td>
                    <td>{{$ct->ghichu}}</td>
                </tr>
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
                <b>{{$m_dv->chucvuky}}</b><br>
                <i>(Ký tên, đóng dấu)</i>
                </br></br></br></br></br></br>
            </td>
        </tr>
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">
            </td>
            <td style="vertical-align: top;">
                {{$m_dv->nguoiky}}
            </td>
        </tr>
    </table>
@stop