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

        function getId(maso) {
            $('#frm_delete').find("[id='mahhdv']").val(maso);
        }

        function ClickDelete() {
            $('#frm_delete').submit();
        }

        function ClickEdit(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ $inputs['url'] }}' + '/show_dm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahhdv: maso
                },
                dataType: 'JSON',
                success: function(data) {
                    var form = $('#frm_create');
                    form.find("[name='mahhdv']").prop('readonly', true);
                    form.find("[name='mahhdv']").val(data.mahhdv);
                    form.find("[name='tenhhdv']").val(data.tenhhdv);
                    form.find("[name='dacdiemkt']").val(data.dacdiemkt);
                    form.find("[name='dvt']").val(data.dvt).trigger('change');
                    form.find("[name='manhom']").val(data.manhom).trigger('change');
                    form.find("[name='trangthai']").val('EDIT');
                    //form.find("[name='theodoi']").val(data.theodoi).trigger('change');

                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }

        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='mahhdv']").val(null);
            form.find("[name='tenhhdv']").val(null);
            form.find("[name='dacdiemkt']").val(null);
            form.find("[name='trangthai']").val('ADD');
            form.find("[name='mahhdv']").prop('readonly', false);
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        {{ $modelnhom->tentt }}<small>&nbsp;chi tiết</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'danhmuc', 'modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs"
                                data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                        <a href="{{ url('/data/download/filemau/FileExcelGiaThiTruong116.xls') }}" target="_blank"
                            class="btn btn-success btn-xs mbs"><i class="fa fa-file-excel-o"></i>&nbsp;Tải file mẫu</a>

                        <a href="{{ url('giahhdvk/danhmuc/detail/nhanexcel?matt=' . $inputs['matt']) }}"
                            class="btn btn-default btn-sm">
                            <i class="fa fa-file-excel-o"></i> Nhận dữ liệu</a>

                        <button type="button" class="btn btn-default btn-xs" data-target="#delete-all-modal"
                            data-toggle="modal">

                            <i class="fa fa-file-excel-o"></i> Xoá tất cả danh mục</button>
                        <a href="{{ url($inputs['url'] . '/danhmuc') }}" class="btn btn-default btn-xs mbs">
                            <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_4">
                            <thead>
                                <tr>
                                    <th style="text-align: center" width="2%">STT</th>
                                    <th style="text-align: center">Mã số</th>
                                    <th style="text-align: center">Tên hàng hóa dịch vụ</th>
                                    <th style="text-align: center">Đặc điểm kỹ thuật</th>
                                    <th style="text-align: center">Đơn vị<br>tính</th>
                                    {{--                            <th style="text-align: center">Theo dõi</th> --}}
                                    <th style="text-align: center" width="15%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model as $key => $tt)
                                    <tr class="odd gradeX">
                                        <td style="text-align: center">{{ $key + 1 }}</td>
                                        <td>{{ $tt->mahhdv }}</td>
                                        <td class="success" style="font-weight: bold">{{ $tt->tenhhdv }}</td>
                                        <td>{{ $tt->dacdiemkt }}</td>
                                        <td style="text-align: center">{{ $tt->dvt }}({{$a_dvt[$tt->dvt] ?? ''}})</td>
                                        <td>
                                            @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'danhmuc', 'modify'))
                                                <button type="button" onclick="ClickEdit('{{ $tt->mahhdv }}')"
                                                    class="btn btn-default btn-xs mbs" data-target="#modal-create"
                                                    data-toggle="modal">
                                                    <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                <button type="button" onclick="getId('{{ $tt->id }}')"
                                                    class="btn btn-default btn-xs mbs" data-target="#delete-modal"
                                                    data-toggle="modal" style="margin: 2px">
                                                    <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => $inputs['url'] . '/dm', 'id' => 'frm_create']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới hàng hóa dịch vụ ?</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nhóm hàng hóa, dịch vụ</label>
                                {!! Form::select('manhom', $a_nhomhh, null, ['id' => 'manhom', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mã hàng hóa dịch vụ<span class="require">*</span></label>
                                <input type="text" name="mahhdv" id="mahhdv" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên hàng hóa dịch vụ<span class="require">*</span></label>
                                <input type="text" name="tenhhdv" id="tenhhdv" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Đặc điểm kỹ thuật</label>
                                <input type="text" name="dacdiemkt" id="dacdiemkt" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Đơn vị tính</label>
                                {!! Form::select('dvt', $a_dmdvt, null, [
                                    'id' => 'dvt',
                                    'class' => 'form-control select2me',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="matt" id="matt" value="{{ $inputs['matt'] }}">
                <input type="hidden" name="trangthai" id="trangthai">
                <div class="modal-footer">
                    <button type="submit" class="btn blue">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => $inputs['url'] . '/delete_dm', 'id' => 'frm_delete']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="mahhdv" id="mahhdv">
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
                {!! Form::open(['url' => $inputs['url'] . '/delete_all', 'id' => 'frm_delete_all']) !!}
                <input type="hidden" name="matt" value="{{$inputs['matt']}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa tất cả danh mục hàng hoá?</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    @include('manage.include.form.modal_dvt')
@stop
