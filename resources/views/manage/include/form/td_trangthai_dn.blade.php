<td style="text-align: center">
    @if ($tt->trangthai == "CC")
        <span class="badge badge-default">Chờ chuyển</span>
    @elseif ($tt->trangthai == "CD")
        <span class="badge badge-danger">Chờ duyệt</span>
    @elseif ($tt->trangthai == "DD")
        <span class="badge badge-info">Đã duyệt</span>
        </br> {{getDayVn($tt->ngaynhan)}}
    @elseif ($tt->trangthai == "CB")
        <span class="badge badge-success">Công bố</span>
    @elseif ($tt->trangthai == "HCB")
        <span class="badge badge-danger">Hủy công bố</span>
    @elseif ($tt->trangthai == "TL")
        <span class="badge badge-warning">Trả lại</span>
@elseif ($tt->trangthai == "CCB")
        <span class="badge badge-info">Chờ công bố</span>
    @else
        <span class="badge badge-warning">{{$tt->trangthai}}</span>
    @endif
</td>
