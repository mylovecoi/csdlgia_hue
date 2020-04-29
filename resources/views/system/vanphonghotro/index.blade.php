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
    </script>

@stop

@section('content')

    <h3 class="page-title">
        Danh sách&nbsp;văn phòng hỗ trợ
    </h3>
    <hr>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                            <i class="fa fa-plus"></i> Thêm mới</button>
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="7%">STT</th>
                                <th>Văn phòng</th>
                                <th>Cán bộ</th>
                                <th>Chức vụ</th>
                                <th>Số ĐT</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($model as $ct)
                                <tr>
                                    <td class="text-left" style="text-transform: uppercase;">{{$ct->stt}}</td>
                                    <td>{{$ct->vanphong}}</td>
                                    <td class="success">{{$ct->hoten}}</td>
                                    <td>{{$ct->chucvu}}</td>
                                    <td>{{$ct->sdt}}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="change('{{$ct->maso}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                            <i class="fa fa-edit"></i> Sửa</button>

                                        <button type="button" onclick="getId('{{$ct->maso}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/vanphonghotro/store','id' => 'frm_modify','method'=>'POST'])!!}
                <input type="hidden" name="maso" id="maso" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin cán bộ</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-11" style="padding-left: 0px;">
                                <label class="control-label">Văn phòng</label>
                                {!!Form::select('vanphong', $a_vp ,null, array('id' => 'vanphong','class' => 'form-control'))!!}
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-default" data-target="#modal-vanphong" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Họ tên cán bộ</label>
                            {!!Form::text('hoten', null, array('id' => 'hoten','class' => 'form-control'))!!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Chức vụ</label>
                            {!!Form::text('chucvu', null, array('id' => 'chucvu','class' => 'form-control'))!!}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Số điện thoại</label>
                            {!!Form::text('sdt', null, array('id' => 'sdt','class' => 'form-control'))!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Sắp xếp</label>
                            {!!Form::text('stt', null, array('id' => 'stt','class' => 'form-control'))!!}
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

    <div id="modal-vanphong" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin văn phòng</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-control-label">Tên văn phòng<span class="require">*</span></label>
                            {!!Form::text('vanphong_add', null, array('id' => 'vanphong_add','class' => 'form-control','required'=>'required'))!!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button class="btn btn-primary" onclick="add_vanphong()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/vanphonghotro/delete','id' => 'frm_delete'])!!}
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

    <script>
        function getId(maso){
            $('#frm_delete').find("[id='maso']").val(maso);
        }

        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function add_vanphong(){
            $('#modal-vanphong').modal('hide');
            var gt = $('#vanphong_add').val();
            $('#vanphong').append(new Option(gt, gt, true, true));
            $('#vanphong').val(gt).trigger('change');
        }

        function new_hs() {
            $('#maso').val('NEW');
            $('#hoten').val(null);
            $('#chucvu').val(null);
            $('#sdt').val(null);
            $('#stt').val(99);
        }

        function change(maso, magoc, capdo) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/vanphonghotro/get_chucnang',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso: maso,
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#maso').val(data.maso);
                    $('#vanphong').val(data.vanphong).trigger('change');
                    $('#hoten').val(data.hoten);
                    $('#chucvu').val(data.chucvu);
                    $('#sdt').val(data.sdt);
                    $('#stt').val(data.stt);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
    </script>
@stop