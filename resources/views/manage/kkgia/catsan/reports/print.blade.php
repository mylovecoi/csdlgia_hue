@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <p style="text-align: center; font-weight: bold">Phụ lục 4: MẪU VĂN BẢN KÊ KHAI GIÁ</p>
    <p style="font-style: italic; text-align: center">(Ban hành kèm theo Thông tư số 233/2016/TT-BTC ngày 11/11/2016 của Bộ
        Tài chính)</p>
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <span style="text-transform: uppercase;font-weight: bold">{{ $modeldn->tendn }}</span>
                <hr style="width: 10%;vertical-align: top;  margin-top: 2px">

            </td>
            <td style="vertical-align: top;">
                <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc</b>
                <hr style="width: 15%;vertical-align: top; margin-top: 2px">

            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Số: {{ $modelkk->socv }}<br>V/v kê khai giá hàng hóa, dịch<br>vụ bán trong nước
                hoặc xuất<br>khẩu</td>
            <td style="text-align: right; vertical-align: top"><i style="margin-right: 25%;">{{ $modeldn->diadanh }},
                    ngày..{{ date('d', strtotime($modelkk->ngaynhap)) }}..tháng..{{ date('m', strtotime($modelkk->ngaynhap)) }}..năm..{{ date('Y', strtotime($modelkk->ngaynhap)) }}..</i>
            </td>
        </tr>
    </table>
    <p style="text-align: center; font-weight: bold; font-size: 16px;"><i><u>Kính gửi</u></i>:
        {{ $modelcqcq->tendvhienthi ?? '' }}</p>
    <br><br>
    <p>Thực hiện Thông tư số 56/2014/TT-BTC ngày 28/4/2014 của Bộ Tài chính hướng dẫn thực hiện Nghị định 177/2013/NĐ-CP
        ngày 14 tháng 11 năm 2013 của Chính phủ quy định chi tiết và hướng dẫn thi hành một số điều của Luật Giá và Thông tư
        số 233/2016/TT-BTC ngày 11/11/2016 của Bộ Tài chính sửa đổi, bổ sung một số điều của Thông tư số 56/2014/TT-BTC </p>

    <p><b>{{ $modeldn->tendn }}</b> gửi Bảng kê khai mức giá hàng hoá, dịch vụ (đính kèm).</p>

    <p>Mức giá kê khai này thực hiện từ ngày {{ getDayVn($modelkk->ngayhieuluc) }}</p>

    <p><b>{{ $modeldn->tendn }}</b> xin chịu trách nhiệm trước pháp luật về tính chính xác của mức giá mà chúng tôi đã kê
        khai./.</p>


    <table width="96%" border="0" cellspacing="0" height cellpadding="0"
        style="margin: 20px auto;text-align: center; height:200px">
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
    <p>- Họ và tên người nộp biểu mẫu : {{ $modelkk->ttnguoinop }}</p>
    <p>- Địa chỉ đơn vị thực hiện kê khai: {{ $modeldn->diachi }}</p>
    <p>- Số điện thoại liên lạc : {{ $modelkk->dtll }}</p>
    <p>- Email : {{ $modelkk->email }}</p>
    <p>- Số Fax : {{ $modelkk->fax }}</p>
    <p style="font-weight: bold; text-align: center">Ghi nhận ngày nộp Văn bản kê khai giá <br>của cơ quan tiếp nhận</p>
    <table cellspacing="0" cellpadding="0" border="1" style="margin-top: 5px;; border-collapse: collapse;width:30%">
        <td><b>{{ $modelcqcq->tendvhienthi ?? '' }}</b></td>
        <tr>
        </tr>
        <tr>
            <td style="text-align: left;">
                <b>Số:</b> {{ $modelkk->sohsnhan }}<br>
                <b>Ngày nhận hồ sơ:</b> {{ getDateTime($modelkk->ngaychuyen) }}<br>
                <b>Ngày duyệt hồ sơ:</b> {{ getDayVn($modelkk->ngaynhan) }}
            </td>
        </tr>
    </table>
    <hr class="in">
    <p style="page-break-before: always">
        <!--Trang2-->
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <span style="text-transform: uppercase;font-weight: bold">{{ $modeldn->tendn }}</span>
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
            <td style="text-align: right"><i style="margin-right: 25%;">{{ $modeldn->diadanh }},
                    ngày..{{ date('d', strtotime($modelkk->ngaynhap)) }}..tháng..{{ date('m', strtotime($modelkk->ngaynhap)) }}..năm..{{ date('Y', strtotime($modelkk->ngaynhap)) }}..</i>
            </td>
        </tr>
    </table>
    <p style="text-align: center; font-weight: bold; font-size: 16px;">BẢNG KÊ KHAI MỨC GIÁ</p>
    <p style="text-align: center;;font-style: italic">(Kèm theo công văn số {{ $modelkk->socv }} ngày
        {{ date('d', strtotime($modelkk->ngaynhap)) }} tháng {{ date('m', strtotime($modelkk->ngaynhap)) }} năm
        {{ date('Y', strtotime($modelkk->ngaynhap)) }} của {{ $modeldn->tendn }})</p>
    <p>1. Mức giá kê khai bán trong nước hoặc xuất khẩu (bán buôn, bán lẻ): Các mức giá tại cửa kho/ nhà máy, tại các địa
        bàn, khu vực khác (nếu có)</p>
    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;"
        id="data" style="font:normal 14px Times, serif;">
        <thead>
            <tr>
                <th width="2%">STT</th>
                <th>Tên hàng hóa, dịch vụ</th>
                <th>Quy cách, <br>chất lượng</th>
                <th>Đơn vị<br>tính</th>
                <th width="10%">Mức giá <br>kê khai hiện<br>hành</th>
                <th width="10%">Mức giá <br>kê khai mới</th>
                <th>Mức tăng giảm</th>
                <th>Tỷ lệ % tăng giảm</th>
                <th>Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modelkkct as $key => $tt)
                <tr>
                    <td style="text-align: center">{{ $key + 1 }}</td>
                    <td>{{ $tt->tendvcu }}</td>
                    <td>{{ $tt->qccl }}</td>
                    <td style="text-align: center">{{ $tt->dvt }}</td>
                    <td style="text-align: right">{{ number_format($tt->gialk) }}</td>
                    <td style="text-align: right">{{ number_format($tt->giakk) }}</td>
                    <td style="text-align: right">{{ number_format($tt->giakk - $tt->gialk) }}</td>
                    <td style="text-align: right">
                        {{ $tt->gialk == 0 ? '100' : number_format((($tt->giakk - $tt->gialk) / $tt->gialk) * 100) }}%</td>
                    <td>{{ $tt->ghichu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>2. Các yếu tố chi phí cấu thành giá (đối với kê khai lần đầu); phân tích nguyên nhân, nêu rõ biến động của các yếu tố
        hình thành giá, tác động làm tăng
        hoặc giảm giá(đối với kê khai lại)</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $modelkk->ytcauthanhgia }}</p>
    <p>3. Các trường hợp ưu đãi; giảm giá; điều kiện áp dụng giá (nếu có)</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $modelkk->thydggadgia }}</p>
    <p>Mức giá kê khai này thực hiện từ ngày {{ getDayVn($modelkk->ngayhieuluc) }}</p>

@stop
