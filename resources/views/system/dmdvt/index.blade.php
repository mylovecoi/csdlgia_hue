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

        function getId(id) {
            document.getElementById("iddelete").value = id;
        }

        function ClickDelete() {
            $('#frm_delete').submit();
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Danh mục đơn vị tính
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if (chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'danhmuc', 'modify'))
                            <button type="button" onclick="add()" class="btn btn-default btn-xs"
                                data-target="#modify-modal" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                            <a href="{{ url('/data/download/filemau/FileExcelMauDVT.xls') }}" target="_blank"
                                class="btn btn-success btn-xs mbs"><i class="fa fa-file-excel-o"></i>&nbsp;Tải file mẫu</a>

                            <button type="button" class="btn btn-default btn-xs" data-target="#nhanexcel-modal"
                                data-toggle="modal">
                                <i class="fa fa-file-excel-o"></i> Nhận dữ liệu</button>

                            <button type="button" class="btn btn-default btn-xs" data-target="#delete-all-modal"
                                data-toggle="modal">
                                <i class="fa fa-file-excel-o"></i> Xoá tất cả danh mục</button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr class="text-center">
                                <th width="10%">STT</th>
                                <th width="15%">Mã đơn vị tính</th>
                                <th>Tên đơn vị tính</th>
                                <th width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($model as $key => $tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $tt->madvt }}</td>
                                    <td class="active">{{ $tt->dvt }}</td>
                                    <td>
                                        @if (chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'danhmuc', 'modify'))
                                            <button type="button"
                                                onclick="edit('{{ $tt->madvt }}','{{ $tt->dvt }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#modify-modal"
                                                data-toggle="modal">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</button>

                                            <button type="button" onclick="getId('{{ $tt->id }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#delete-modal"
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
    <!--Modal thông tin chi tiết -->
    {!! Form::open(['url' => 'dmdvt/update', 'id' => 'frm_modify']) !!}
    <div id="modify-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin chi tiết</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Mã số</label>
                                {!! Form::text('madvt', null, ['id' => 'madvt', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Tên đơn vị tính<span class="require">*</span></label>
                                {!! Form::text('dvt', null, ['id' => 'dvt', 'class' => 'form-control', 'required' => 'required']) !!}
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

    {!! Form::open(['url' => 'dmdvt/nhanexcel', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
    <div id="nhanexcel-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin chi tiết</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Mã đơn vị tính<span class="require">*</span></label>
                                {!! Form::text('dvt', 'B', ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tên đơn vị tính<span class="require">*</span></label>
                                {!! Form::text('madvt', 'C', ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nhận từ dòng<span class="require">*</span></label>
                                {!! Form::text('tudong', '4', [
                                    'id' => 'tudong',
                                    'class' => 'form-control',
                                    'required',
                                    'data-mask' => 'fdecimal',
                                ]) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nhận đến dòng</label>
                                {!! Form::text('dendong', '200', [
                                    'id' => 'dendong',
                                    'class' => 'form-control',
                                    'required',
                                    'data-mask' => 'fdecimal',
                                ]) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">File dữ liệu<span class="require">*</span></label>
                                <input id="fexcel" required name="fexcel" type="file"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
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

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => 'dmdvt/delete', 'id' => 'frm_delete']) !!}
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

    <div class="modal fade" id="delete-all-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => 'dmdvt/delete_all', 'id' => 'frm_delete_all']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa tất cả danh mục đơn vị tính?</h4>
                </div>
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

    <script>
        function add() {
            $('#madvt').val('');
            $('#madvt').attr('readonly', true);
        }

        function edit(madvt, dvt) {
            $('#madvt').attr('readonly', false);
            $('#madvt').val(madvt);
            $('#dvt').val(dvt);
        }
    </script>
    </div>
@stop
