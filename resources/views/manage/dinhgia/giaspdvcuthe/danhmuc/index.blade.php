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
            $('#frm_delete').find("[name='manhom']").val(maso);
        }

        function ClickDelete() {
            $('#frm_delete').submit();
        }

        function ClickEdit(manhom, mota, theodoi) {
            var form = $('#frm_create');
            form.find("[name='manhom']").val(manhom);
            form.find("[name='mota']").val(mota);
        }

        function new_hs() {
            var form = $('#frm_create');
            //Nhà xã hội cho thuê
            form.find("[name='manhom']").val('NEW');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục sản phẩm, dịch vụ
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
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr>
                                <th width="2%" style="text-align: center">STT</th>
                                <th style="text-align: center">Mô tả</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th width="15%" style="text-align: center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td>{{ $tt->mota }}</td>
                                    <td>{{ $tt->theodoi == '1' ? 'Đang theo dõi' : 'Không theo dõi' }}</td>
                                    <td>
                                        <a href="{{url($inputs['url'].'/chitiet_dm?manhom='.$tt->manhom)}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvcuthe', 'hoso', 'modify'))
                                            <button type="button"
                                                onclick="ClickEdit('{{ $tt->manhom }}','{{ $tt->mota }}','{{ $tt->theodoi }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#modal-create"
                                                data-toggle="modal">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                            <button type="button" onclick="getId('{{ $tt->manhom }}')"
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => $inputs['url'] . '/danhmuc', 'method' => 'post', 'id' => 'frm_create']) !!}
                <input type="hidden" name="manhom" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mô tả<span class="require">*</span></label>
                                <input name="mota" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Trạng thái</label>
                                {!! Form::select('theodoi', ['1' => 'Đang theo dõi', '0' => 'Không theo dõi'], null, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>
                    </div>
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

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => $inputs['url'] . '/delete_nhomdm', 'id' => 'frm_delete']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="manhom" />
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
    {{-- @include('includes.script.create-header-scripts') --}}
@stop
