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
    <script src="{{ url('minhtran/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });

        function getId(id) {
            document.getElementById("iddelete").value = id;
        }

        function ClickDelete() {
            $('#frm_delete').submit();
        }

        function edit(maloaidat, loaidat) {
            $('#maloaidat').val(maloaidat);
            $('#loaidat').val(loaidat);
        }

        function new_hs() {
            $('#maloaidat').val(null);
            $('#loaidat').val(null);
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Danh mục loại đất
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if (chkPer('hethong', 'hethong_pq', 'ngaynghile', 'danhmuc', ' modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs"
                                data-target="#modify-modal" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr>
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Mã số</th>
                                <th style="text-align: center">Loại đất</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td class="active">{{ $tt->maloaidat }}</td>
                                    <td class="active">{{ $tt->loaidat }}</td>

                                    <td>
                                        @if (chkPer('hethong', 'hethong_pq', 'ngaynghile', 'danhmuc', ' modify'))
                                            <button type="button"
                                                onclick="edit('{{ $tt->maloaidat }}','{{ $tt->loaidat }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#modify-modal"
                                                data-toggle="modal">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                            <button type="button" onclick="getId('{{ $tt->id }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#modal-delete"
                                                data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>

    <!--Modal thông tin chi tiết -->
    {!! Form::open(['url' => 'dmloaidat/modify', 'id' => 'frm_modify']) !!}
    <div id="modify-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin danh mục</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Mã số</label>
                                {!! Form::text('maloaidat', null, ['id' => 'maloaidat', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Tên địa bàn<span class="require">*</span></label>
                                {!! Form::text('loaidat', null, ['id' => 'loaidat', 'class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                        ý</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => 'dmloaidat/delete', 'id' => 'frm_delete']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="iddelete" id="iddelete">
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
    @include('includes.script.inputmask-ajax-scripts')
@stop
