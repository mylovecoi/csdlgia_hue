@extends('reports.main_rps')
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
            <td>
                Số: {{$m_hoso->soqd != ''? $m_hoso->soqd: '..............'}}
            </td>
            <td style="text-align: right">
                <i style="margin-right: 25%;">{{$m_donvi->diadanh}},{{getNt2Bc($m_hoso->thoidiem)}}</i>
            </td>
        </tr>
    </table>

    <p style="text-align: center;font-weight: bold;font-size: 14px;text-transform:uppercase;">
        Hồ sơ {{session('admin')['a_chucnang']['giadatpl'] ?? 'giá đất theo phân loại'}}
    </p>
    <p style="text-align: center;">{{'Số quyết định: '. $m_hoso->soqd . ', ' .getNt2Bc($m_hoso->thoidiem)}}</p>
    <p style="text-align: center;">{{$m_hoso->thongtin}}</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
        <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Tên đường, giới<br>hạn, khu vực</th>
            <th>Loại đất</th>
            <th>Vị trí</th>
            <th width="8%">Giá đất<br>tại bảng giá</th>
            <th width="8%">Giá đất<br>cụ thể</th>
            <th width="5%">Hệ số<br>điều chỉnh</th>

        </tr>
        </thead>
        <?php $i = 1; ?>
        @foreach($a_group as $kv)
            <?php
                $chitiet = $model->where('khuvuc', $kv['khuvuc'])->where('maloaidat',$kv['maloaidat']);
                $kv = count($chitiet) > 1 ? count($chitiet) : 1;
                $i_kv = 1;
                $i_pl = 1;
            ?>

            @foreach($chitiet as $key=>$tt)
                <tr>
                    @if($i_kv == 1)
                        <td style="text-align: center" rowspan="{{$kv}}">{{$i++}}</td>
                        <td rowspan="{{$kv}}">{{$tt->khuvuc}}</td>
                        <td style="text-align: center" rowspan="{{$kv}}">{{$tt->maloaidat}}</td>
                        <?php $i_kv++; ?>
                    @endif
                    <td style="text-align: center">{{$tt->vitri}}</td>
                    <td style="text-align: right;">{{dinhdangsothapphan($tt->banggiadat,4)}}</td>
                    <td style="text-align: right;">{{dinhdangsothapphan($tt->giacuthe,4)}}</td>
                    <td style="text-align: right;">{{dinhdangsothapphan($tt->hesodc,4)}}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
    <p style="text-align: left;">{!! nl2br($m_hoso->ghichu) !!}</p>

    <table width="96%" border="0" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">
                <span style="font-weight: bold;font-style: italic">Nơi nhận:</span><br>
                - UBND tỉnh;<br>
                - Bộ tài chính;<br>
                - Lưu: VT, QLGCS.
            </td>
            <td style="vertical-align: top;">
                <b>{{$m_donvi->chucvuky}}</b><br>
                <i>(Ký tên, đóng dấu)</i>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
               <br><br><br><br><br><br><br><br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                {{$m_donvi->nguoiky}}
            </td>
        </tr>
    </table>
@stop
