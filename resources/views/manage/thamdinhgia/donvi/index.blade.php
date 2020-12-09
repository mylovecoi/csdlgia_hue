@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
        function getId(maso){
            $('#frm_delete').find("[id='maso']").val(maso);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(maso){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_dv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='maso']").val(data.maso);
                    form.find("[name='tendv']").val(data.tendv);
                    form.find("[name='diachi']").val(data.diachi);
                    form.find("[name='nguoidaidien']").val(data.nguoidaidien);
                    form.find("[name='chucvu']").val(data.chucvu);
                    form.find("[name='sothe']").val(data.sothe);
                    form.find("[name='ngaycap']").val(data.ngaycap);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            //Nhà xã hội cho thuê
            form.find("[name='maso']").val('NEW');
            form.find("[name='tendv']").val(null);
            form.find("[name='diachi']").val(null);
            form.find("[name='nguoidaidien']").val(null);
            form.find("[name='chucvu']").val(null);
            form.find("[name='sothe']").val(null);
            form.find("[name='ngaycap']").val(null);
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục đơn vị thẩm định giá
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlthamdinhgia','thamdinhgia', 'dmdonvi', 'danhmuc','modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
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
                            <th style="text-align: center">Tên đơn vị</th>
                            <th style="text-align: center">Người đại diện</th>
                            <th style="text-align: center">Chức vụ</th>
                            <th width="15%" style="text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td class="success">{{$tt->tendv}}</td>
                                <td>{{$tt->nguoidaidien}}</td>
                                <td>{{$tt->chucvu}}</td>
                                <td>
                                    @if(chkPer('csdlthamdinhgia','thamdinhgia', 'dmdonvi', 'danhmuc','modify'))
                                        <button type="button" onclick="ClickEdit('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                            <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                        <button type="button" onclick="getId('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
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
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/donvi', 'method'=>'post','id' => 'frm_create'])!!}
                <input type="hidden" name="maso" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin đơn vị thẩm định giá</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên đơn vị<span class="require">*</span></label>
                                <input name="tendv" id="tendv" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Địa chỉ trụ sở<span class="require">*</span></label>
                                <input name="diachi" id="diachi" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Người đại diện<span class="require">*</span></label>
                                <input name="nguoidaidien" id="nguoidaidien" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Chức vụ</label>
                                <input name="chucvu" id="chucvu" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Mã thẻ thẩm định</label>
                                <input name="sothe" id="sothe" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày cấp</label>
                                {!! Form::input('date', 'ngaycap', null, array('id' => 'ngaycap', 'class' => 'form-control'))!!}
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

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/delete_dv','id' => 'frm_delete'])!!}
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

    @include('manage.include.form.modal_dvt')
    @include('includes.script.create-header-scripts')
@stop