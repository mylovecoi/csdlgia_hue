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
            $('#frm_delete').find("[name='maso']").val(maso);
        }

        function ClickDelete() {
            $('#frm_delete').submit();
        }

        function ClickEdit(maso,tenhhdv,dvt,hienthi,stt) {
            var form = $('#frm_create');
            form.find("[name='maso']").val(maso);
            form.find("[name='tenhhdv']").val(tenhhdv);
            form.find("[name='dvt']").val(dvt).trigger('change');
            form.find("[name='hienthi']").val(hienthi);
            form.find("[name='stt']").val(stt);
        }

        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='maso']").val('NEW');
            form.find("[name='tenhhdv']").val(null);  
            form.find("[name='hienthi']").val(null);
            form.find("[name='stt']").val(99);         
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
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvcuthe', 'hoso', 'modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs"
                                data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
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
                                    <th style="text-align: center" width="5%">STT</th>
                                    <th style="text-align: center" width="7%">Hiển thị</th>
                                    {{-- <th style="text-align: center">Mã số</th> --}}
                                    <th style="text-align: center">Tên hàng hóa, dịch vụ</th>
                                    <th style="text-align: center">Đơn vị<br>tính</th>
                                    <th style="text-align: center" width="10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model as $key => $tt)
                                    <tr class="odd gradeX">
                                        <td style="text-align: center">{{ $tt->stt }}</td>
                                        <td>{{ $tt->hienthi }}</td>
                                        {{-- <td>{{ $tt->maso }}</td> --}}
                                        <td class="success" style="font-weight: bold">{{ $tt->tenhhdv }}</td>
                                        <td style="text-align: center">{{ $tt->dvt }}({{ $a_dvt[$tt->dvt] ?? '' }})
                                        </td>
                                        <td>
                                            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvcuthe', 'hoso', 'modify'))
                                                <button type="button" onclick="ClickEdit('{{ $tt->maso }}','{{ $tt->tenhhdv }}','{{ $tt->dvt }}','{{ $tt->hienthi }}','{{ $tt->stt }}')"
                                                    class="btn btn-default btn-xs mbs" data-target="#modal-create"
                                                    data-toggle="modal">
                                                    <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                <button type="button" onclick="getId('{{ $tt->maso }}')"
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
                {!! Form::open(['url' => $inputs['url'] . '/chitiet_dm', 'id' => 'frm_create']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới hàng hóa dịch vụ ?</h4>
                </div>
                <div class="modal-body">                   

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Hiện thị</label>
                                <input type="text" name="hienthi" class="form-control">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Đơn vị tính</label>
                                {!! Form::select('dvt', $a_dvt, null, [
                                    'id' => 'dvt',
                                    'class' => 'form-control select2me',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">STT</label>
                                <input type="text" name="stt" class="form-control" value="99" data-mask="fdecimal" />
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="manhom" value="{{ $inputs['manhom'] }}">
                <input type="hidden" name="maso">
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
                <input type="hidden" name="maso" id="maso">
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
                <input type="hidden" name="manhom" value="{{ $inputs['manhom'] }}">
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
