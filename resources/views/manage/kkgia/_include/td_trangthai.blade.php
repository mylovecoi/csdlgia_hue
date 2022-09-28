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
        <span class="badge badge-danger">Bị trả lại</span>
    </td>
@elseif($tt->trangthai == 'CB')
    <td align="center">
        <span class="badge badge-success">Đã công bố</span>
        <br>Thời gian:<br><b>{{ getDateTime($tt->ngaychuyen) }}</b>
    </td>
@elseif($tt->trangthai == 'CCB')
    <td align="center">
        <span class="badge badge-success">Chưa công bố</span>
        <br>Thời gian chuyển:<br><b>{{ getDateTime($tt->ngaychuyen) }}</b>
    </td>
@else
    <td align="center">
        <span class="badge badge-success">Đã duyệt</span>
        <br>Thời gian chuyển:<br><b>{{ getDateTime($tt->ngaychuyen) }}</b>
    </td>
@endif
