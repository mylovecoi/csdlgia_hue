@extends('reports.main_rps')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <span style="text-transform: uppercase">{{ session('admin')->tendvcqhienthi }}</span><br>
                <span style="text-transform: uppercase;font-weight: bold">{{ session('admin')->tendvhienthi }}</span>
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
            <td style="text-align: right"><i style="margin-right: 25%;">{{ session('admin')->diadanh }}, ngày .... tháng
                    .... năm ....</i></td>
        </tr>
    </table>

    <p style="font-weight: bold;text-transform: uppercase;text-align: center">BÁO CÁO DANH SÁCH HỒ SƠ</p>
    <p style="text-align: center">Từ ngày: 01/08/2023 đến ngày 31/08/2023</p>
    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;"
        id="data">
        <tr>
            <th style="width:10%">Ngày báo cáo</th>
            <th style="width:10%">Số quyết định</th>
            <th>Nội dung</th>
            <th style="width:15%">Ghi chú</th>
        </tr>

        @foreach ($model as $tt)
            <tr>
                <td class="text-center">{{ getDayVn($tt->thoidiem) }}</td>
                <td class="text-center">{{ $tt->soqd }}</td>
                <td>{{ $tt->cqbh }}</td>
                <td></td>
            </tr>
        @endforeach
    </table>
    <table width="96%" border="0" cellspacing="0" height cellpadding="0"
        style="margin: 20px auto;text-align: center; height:200px">
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
