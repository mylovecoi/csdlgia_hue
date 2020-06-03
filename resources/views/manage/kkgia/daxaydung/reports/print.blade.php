@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <p style="page-break-before: always">
        <!--Trang2-->
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <span style="text-transform: uppercase;font-weight: bold">{{$modeldn->tendn}}</span>
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
            <td style="text-align: right"><i style="margin-right: 25%;">{{$modeldn->diadanh}}, ngày..{{ date("d",strtotime($modelkk->ngaynhap))}}..tháng..{{ date("m",strtotime($modelkk->ngaynhap))}}..năm..{{ date("Y",strtotime($modelkk->ngaynhap))}}..</i></td>
        </tr>
    </table>
    <p style="text-align: center; font-weight: bold; font-size: 16px;">BẢNG KÊ KHAI MỨC GIÁ</p>
    <p style="text-align: center;">(Kèm theo công văn số {{$modelkk->socv}}  ngày {{ date("d",strtotime($modelkk->ngaynhap))}} tháng {{ date("m",strtotime($modelkk->ngaynhap))}} năm {{ date("Y",strtotime($modelkk->ngaynhap))}} của {{$modeldn->tendn}})</p>
    <p>1. Tên đơn vị thực hiện kê khai giá: {{$modeldn->tendn}}</p>

    <p>2. Trụ sở (nơi đơn vị đăng ký kinh doanh): {{$modeldn->diachi}}</p>

    <p>3. Giấy chứng nhận kinh doanh {{$modeldn->giayphepkd}}</p>

    <p>4. Nội dung kê khai:</p>
    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" id="data">
        <tr>
            <th width="2%">STT</th>
            <th style="text-align: center">Tên dịch vụ cung ứng</th>
            <th>Quy cách, <br>chất lượng</th>
            <th>Đơn vị<br>tính</th>
            <th width="10%">Mức giá <br>đăng ký hiện<br>hành</th>
            <th width="10%">Mức giá <br>đăng ký mới</th>
            <th>Mức tăng giảm</th>
            <th>Tỷ lệ % tăng giảm</th>
            <th>Ghi chú</th>
        </tr>
        @foreach($modelkkct as $key=>$tt)
            <tr>
                <td style="text-align: center">{{$key+1}}</td>
                <td>{{$tt->tendvcu}}</td>
                <td>{{$tt->qccl}}</td>
                <td style="text-align: center">{{$tt->dvt}}</td>
                <td style="text-align: right">{{number_format($tt->gialk)}}</td>
                <td style="text-align: right">{{number_format($tt->giakk)}}</td>
                <td style="text-align: right">{{number_format($tt->giakk - $tt->gialk)}}</td>
                <td style="text-align: right">{{$tt->gialk == 0 ? '100' : number_format(($tt->giakk - $tt->gialk)/$tt->gialk*100)}}%</td>
                <td>{{$tt->ghichu}}</td>
            </tr>
        @endforeach
    </table>
    <p>5. Các yếu tố chi phí cấu thành giá (đối với kê khai lần đầu); phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá, tác động làm tăng
        hoặc giảm giá(đối với kê khai lại)</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$modelkk->ytcauthanhgia}}</p>
    <p>6. Các trường hợp ưu đãi; giảm giá; điều kiện áp dụng giá (nếu có)</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$modelkk->thydggadgia}}</p>

    <table width="96%" border="0" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">
                <span style="font-weight: bold;font-style: italic">Nơi nhận:</span><br>
                - Như trên:<br>
                - Lưu.
            </td>
            <td style="vertical-align: top;">
                <b>THỦ TRƯỞNG ĐƠN VỊ</b><br>
                <i>(Ký tên, đóng dấu)</i>
            </td>
        </tr>
    </table>
@stop