@if ($tt->trangthai == 'CC')
    <td align="center"><span class="badge badge-warning">Chờ chuyển</span></td>
@elseif($tt->trangthai == 'CD')
    <td align="center"><span class="badge badge-blue">Chờ duyệt</span>
        <br>Thời gian chuyển:<br><b>{{ getDateTime($tt->ngaychuyen) }}</b>
    </td>
@elseif($tt->trangthai == 'CN')
    <td align="center"><span class="badge badge-warning">Chờ nhận</span>
        <br>Thời gian chuyển:<br><b>{{ getDateTime($tt->ngaychuyen) }}</b>
    </td>
    @elseif($tt->trangthai == 'BTL')
    <td align="center">
        <span class="badge badge-danger">Bị trả lại</span><br>&nbsp;
    </td>
@elseif($tt->trangthai == 'CB')
<td align="center">
    <span class="badge badge-success">Đã công bố</span><br>&nbsp;
</td>
@else
    <td align="center">
        <span class="badge badge-success">Đã duyệt</span>
        <br>Thời gian chuyển:<br><b>{{ getDateTime($tt->ngaychuyen) }}</b>
    </td>
@endif
