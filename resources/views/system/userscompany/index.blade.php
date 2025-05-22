@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });

        function getSelectedCheckboxes() {

            var ids = '';
            $.each($("input[name='ck_value']:checked"), function() {
                ids += ($(this).attr('value')) + '-';
            });
            return ids = ids.substring(0, ids.length - 1);

        }

        function multiLock() {

            var ids = getSelectedCheckboxes();
            var pl = $('#phanloai').val();
            if (ids == '') {
                $('#btnMultiLockUser').attr('data-target', '#notid-modal-confirm');
            } else {

                $('#btnMultiLockUser').attr('data-target', '#lockuser-modal-confirm');
                $('#frmLockUser').attr('action', "{{ url('users/lock') }}/" + ids + '/' + pl);
            }

        }

        function multiUnLock() {

            var ids = getSelectedCheckboxes();
            var pl = $('#phanloai').val();
            if (ids == '') {
                $('#btnMultiUnLockUser').attr('data-target', '#notid-modal-confirm');
            } else {
                $('#btnMultiUnLockUser').attr('data-target', '#unlockuser-modal-confirm');
                $('#frmUnLockUser').attr('action', "{{ url('users/unlock') }}/" + ids + '/' + pl);
            }

        }

        function confirmDelete(madv) {
            $('#frm_delete').find("[id='madv']").val(madv);
            //document.getElementById("madv").value=madv;
        }

        function ClickDelete() {
            $('#frm_delete').submit();
        }
    </script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        Quản lý thông tin doanh nghiệp
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{ url('doanhnghiep/dstaikhoan/create') }}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i>Thêm mới
                        </a>
                    </div>

                </div>
                <hr>
                <div class="portlet-body">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Tên tài khoản</th>
                            <th style="text-align: center" width="10%">Username</th>
                            <th style="text-align: center">Đơn vị quản lý</th>
                            <th style="text-align: center" width="5%">Trạng thái</th>
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </thead>
                        <tbody>
                            {{--                        @if ($model->count() != 0) --}}
                            @foreach ($model as $key => $tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td>{{ $tt->name }}</td>
                                    <td class="active">{{ $tt->username }}</td>
                                    <td>{{ $tt->tendiaban }}</td>
                                    <td style="text-align: center">
                                        @if ($tt->status == 'Kích hoạt')
                                            <span class="label label-sm label-success">{{ $tt->status }}</span><br>
                                        @else
                                            <span class="label label-sm label-danger">{{ $tt->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (chkPer('hethong', 'hethong_pq', 'dangky', 'danhmuc', 'modify'))
                                            <a href="{{ url('doanhnghiep/dstaikhoan/edit?madv=' . $tt->madv) }}"
                                                class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Sửa</a>

                                            <button type="button" onclick="confirmDelete('{{ $tt->madv }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#delete-modal"
                                                data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            {{--                        @else --}}
                            {{--                            <tr> --}}
                            {{--                                <td style="text-align: center" colspan="6">Không tìm thấy thông tin. Bạn cần kiểm tra lại điều kiện tìm kiếm!!!</td> --}}
                            {{--                            </tr> --}}
                            {{--                        @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- BEGIN DASHBOARD STATS -->
    <!-- END DASHBOARD STATS -->


    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => 'doanhnghiep/dstaikhoan/delete', 'id' => 'frm_delete']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="madv" id="madv">
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop
