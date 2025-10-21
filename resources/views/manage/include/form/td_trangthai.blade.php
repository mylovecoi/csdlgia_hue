<td style="text-align: center">
    @if ($tt->trangthai == "CHT")
        <span class="badge badge-default">Chưa hoàn thành</span>
    @elseif ($tt->trangthai == "HHT")
        <span class="badge badge-danger">Hủy hoàn thành</span>
    @elseif ($tt->trangthai == "TN")
        <span class="badge badge-warning">Tiếp nhận</span>
    @elseif ($tt->trangthai == "HT")
        <span class="badge badge-info">Hoàn thành</span>
    @elseif ($tt->trangthai == "CB")
        <span class="badge badge-success">Công bố</span>
    @elseif ($tt->trangthai == "HCB")
        <span class="badge badge-danger">Hủy công bố</span>
    @else
        <span class="badge badge-warning">Chưa công bố</span>
    @endif
</td>
