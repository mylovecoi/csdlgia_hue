@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
<p style="text-align: center; font-weight: bold;">BIỂU MẪU ĐĂNG KÝ GIÁ</p>
<p style="font-style: italic; text-align: center">(Kèm theo Nghị định số 85/2024/NĐ-CP ngày 10 tháng 7 năm 2024 của Chính phủ)</p>
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="50%">
            <b>{{$modeldn->tendn}}</b><br>
            <hr style="width: 10%"> <br>
            Số: {{$modelkk->socv}}<br>V/v kê khai giá hàng hóa, dịch vụ <br>bán trong nước hoặc xuất khẩu
        </td>
        <td>
            <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập - Tự do - Hạnh phúc</b><br>
            <hr style="width: 15%"> <br>
            <i>{{$modeldn->diadanh}}, ngày..{{ date("d",strtotime($modelkk->thoidiem))}}..tháng..{{ date("m",strtotime($modelkk->thoidiem))}}..năm..{{ date("Y",strtotime($modelkk->thoidiem))}}..</i>
        </td>
    </tr>
</table>
<p style="text-align: center; font-weight: bold; font-size: 16px;"><i><u>Kính gửi</u></i>: {{$modelcqcq->tendvhienthi ?? ''}}</p>
<br><br>
<p>Thực hiện quy định tại Luật Giá, Nghị định số 85/2024/NĐ-CP ngày 10 tháng 7 năm 2024 của Chính phủ quy định chi tiết một số điều của Luật Giá.</p>

<p><b>{{$modeldn->tendn}}</b> gửi Bảng kê khai mức giá hàng hoá, dịch vụ (đính kèm).</p>

<p>Mức giá kê khai này thực hiện từ ngày {{getDayVn($modelkk->ngayhieuluc)}}</p>

<p><b>{{$modeldn->tendn}}</b> xin chịu trách nhiệm trước pháp luật về tính chính xác của mức giá mà chúng tôi đã kê khai./.</p>

<table width="96%" border="0" cellspacing="0" cellpadding="0" style="margin:10px auto;" id="data">
    <tr>
        <td style="text-align: left" width="40%">
            <b style="padding-top:0px;"><i>Nơi nhận:</i></b><br>
            - Như trên:<br>
            - Lưu.
            <br>
        </td>

        <td style="text-align: center; text-transform: uppercase;" width="60%">
            <b>{{$modeldn->chucdanhky != '' ? $modeldn->chucdanhky : 'Giám đốc'}}</b>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <b style="text-transform: uppercase;">{{$modeldn->nguoiky}}</b>
        </td>
    </tr>
</table>
<p>- Họ và tên người nộp biểu mẫu : {{$modelkk->nguoinop}}</p>
<p>- Địa chỉ đơn vị thực hiện kê khai: {{$modeldn->diachi}}</p>
<p>- Số điện thoại liên lạc : {{$modelkk->dtll}}</p>
<p>- Email : {{$modelkk->email}}</p>
<p>- Số Fax : {{$modelkk->fax}}</p>
<p style="font-weight: bold; text-align: center">Ghi nhận ngày nộp Văn bản kê khai giá <br>của cơ quan tiếp nhận</p>
<table cellspacing="0" cellpadding="0" border="1" style="margin-top: 5px;; border-collapse: collapse;width:30%">
    <td><b>{{$modelcqcq->tendvhienthi ?? ''}}</b></td>
    <tr>
    </tr>
    <tr>
        <td style="text-align: left;">
            <b>Số:</b> {{$modelkk->sohsnhan}}<br>
            <b>Ngày nhận hồ sơ:</b> {{getDateTime($modelkk->ngaychuyen)}}<br>
            <b>Ngày duyệt hồ sơ:</b> {{getDayVn($modelkk->ngaynhan)}}
        </td>
    </tr>
</table>
<hr class="in">
<p style="page-break-before: always">
    <!--Trang2-->
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%">
            <b>{{$modeldn->tendn}}</b><br>
            <hr style="width: 10%"> <br>
        </td>
        <td>
            <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập - Tự do - Hạnh phúc</b><br>
            <hr style="width: 15%"><br>
            <i>{{$modeldn->diadanh}}, ngày..{{ date("d",strtotime($modelkk->thoidiem))}}..tháng..{{ date("m",strtotime($modelkk->thoidiem))}}..năm..{{ date("Y",strtotime($modelkk->thoidiem))}}..</i>
        </td>
    </tr>
</table>
<p style="text-align: center; font-weight: bold; font-size: 16px;">BẢNG KÊ KHAI MỨC GIÁ</p>
<p style="text-align: center;; font-style: italic">(Kèm theo công văn số {{$modelkk->socv}}  ngày {{ date("d",strtotime($modelkk->thoidiem))}} tháng {{ date("m",strtotime($modelkk->thoidiem))}} năm {{ date("Y",strtotime($modelkk->thoidiem))}} của {{$modeldn->tendn}})</p>
<p>1. Mức giá kê khai bán trong nước hoặc xuất khẩu (bán buôn, bán lẻ):  Các mức giá tại cửa kho/ nhà máy, tại các địa bàn, khu vực khác (nếu có)</p>
<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
    <tr>
        <th width="2%">STT</th>
        <th width="30%">Tên hàng hóa, dịch vụ</th>
        <th>Quy cách, <br>chất lượng</th>
        <th>Đơn vị<br>tính</th>
        <th width="10%">Mức giá kê<br>khai hiện<br>hành</th>
        <th width="10%">Mức giá kê<br>khai mới</th>
        <th>Mức<br> tăng<br>/ giảm</th>
        <th>Tỷ lệ<br> tăng<br>/ giảm</th>
        <th>Ghi chú</th>
    </tr>
    @foreach($modelkkct as $key=>$tt)
        <tr>
            <td style="text-align: center">{{$key+1}}</td>
            <td>{{$tt->tenhh}}</td>
            <td>{{$tt->quycach}}</td>
            <td style="text-align: center">{{$tt->dvt}}</td>
            <td style="text-align: right">{{dinhdangsothapphan($tt->gialk,2)}}</td>
            <td style="text-align: right">{{dinhdangsothapphan($tt->giakk,2)}}</td>
            <td style="text-align: center">{{dinhdangsothapphan($tt->chenhlech)}}</td>
            <td style="text-align: center">{{$tt->phantram == 0 ? '' : dinhdangsothapphan($tt->phantram).'%'}}</td>
            <td>{{$tt->ghichu}}</td>
        </tr>
    @endforeach
</table>
<p>2. Phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá tác động làm tăng hoặc giảm giá hàng hóa dịch vụ thực hiện kê khai giá</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$modelkk->ptnguyennhan}}</p>
<p>3. Ghi rõ các chính sách và mức khuyến mại, giảm giá hoặc chiết khấu đối với các đối tượng khách hàng, các Điều kiện vận chuyển, giao hàng, bán hàng kèm theo mức giá kê khai (nếu có)</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$modelkk->chinhsachkm}}</p>
<p>Mức giá kê khai này thực hiện từ ngày {{getDayVn($modelkk->ngayhieuluc)}}</p>

@if(count($a_plhh) > 1)
    @foreach($a_plhh as $plhh)
        <hr class="in">
        <p style="page-break-before: always">
            <!--Trang3-->

        <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
            <tr>
                <td width="40%">
                    <b>{{$modeldn->tendn}}</b><br>
                    <hr style="width: 10%"> <br>
                </td>
                <td>
                    <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                        Độc lập - Tự do - Hạnh phúc</b><br>
                    <hr style="width: 15%"><br>
                    <i>{{$modeldn->diadanh}}, ngày..{{ date("d",strtotime($modelkk->thoidiem))}}..tháng..{{ date("m",strtotime($modelkk->thoidiem))}}..năm..{{ date("Y",strtotime($modelkk->thoidiem))}}..</i>
                </td>
            </tr>
        </table>
        <p style="text-align: center; font-weight: bold; font-size: 16px;">BẢNG ĐĂNG KÝ MỨC GIÁ BÁN CỤ THỂ</p>
        <p style="text-align: center;; font-style: italic">(Kèm theo công văn số {{$modelkk->socv}}  ngày {{ date("d",strtotime($modelkk->thoidiem))}} tháng {{ date("m",strtotime($modelkk->thoidiem))}} năm {{ date("Y",strtotime($modelkk->thoidiem))}} của {{$modeldn->tendn}})</p>
        <p>1. Mức giá kê khai bán trong nước hoặc xuất khẩu (bán buôn, bán lẻ):  Các mức giá tại cửa kho/ nhà máy, tại các địa bàn, khu vực khác (nếu có)</p>
        <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
            <tr>
                <th width="2%">STT</th>
                <th width="30%">Tên hàng hóa, dịch vụ</th>
                <th>Quy cách, <br>chất lượng</th>
                <th>Đơn vị<br>tính</th>
                <th width="10%">Mức giá kê<br>khai hiện<br>hành</th>
                <th width="10%">Mức giá kê<br>khai mới</th>
                <th>Mức<br> tăng<br>/ giảm</th>
                <th>Tỷ lệ<br> tăng<br>/ giảm</th>
                <th>Ghi chú</th>
            </tr>
            <?php
            $chitiet = $modelkkct->where('plhh',$plhh);
            $i = 1;
            ?>
            @if($plhh != '')
                <tr>
                    <td></td>
                    <td style="font-weight: bold" colspan="8">{{$plhh}}</td>
                </tr>
            @endif
            @foreach($chitiet as $key=>$tt)
                <tr>
                    <td style="text-align: center">{{$i++}}</td>
                    <td>{{$tt->tenhh}}</td>
                    <td>{{$tt->quycach}}</td>
                    <td style="text-align: center">{{$tt->dvt}}</td>
                    <td style="text-align: right">{{dinhdangsothapphan($tt->gialk,2)}}</td>
                    <td style="text-align: right">{{dinhdangsothapphan($tt->giakk,2)}}</td>
                    <td style="text-align: center">{{dinhdangsothapphan($tt->chenhlech)}}</td>
                    <td style="text-align: center">{{$tt->phantram == 0 ? '' : dinhdangsothapphan($tt->phantram).'%'}}</td>
                    <td>{{$tt->ghichu}}</td>
                </tr>
            @endforeach
        </table>
        <p>2. Phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá tác động làm tăng hoặc giảm giá hàng hóa dịch vụ thực hiện kê khai giá</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$modelkk->ptnguyennhan}}</p>
        <p>3. Ghi rõ các chính sách và mức khuyến mại, giảm giá hoặc chiết khấu đối với các đối tượng khách hàng, các Điều kiện vận chuyển, giao hàng, bán hàng kèm theo mức giá kê khai (nếu có)</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$modelkk->chinhsachkm}}</p>
        <p>Mức giá kê khai này thực hiện từ ngày {{getDayVn($modelkk->ngayhieuluc)}}</p>

    @endforeach
@endif
@stop