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
        function getId(manhom){
            $('#frm_delete').find("[id='manhom']").val(manhom);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(manhom){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_dm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    manhom: manhom
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='stt']").val(data.stt);
                    form.find("[name='manhom']").val(data.manhom);
                    form.find("[name='tennhom']").val(data.tennhom);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }

        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='stt']").val('{{$inputs['stt']}}');
            form.find("[name='manhom']").val('NEW');
            form.find("[name='tennhom']").val('');
            InputMask();
        }

        function addpl(){
            $('#modal-phanloai').modal('hide');
            var gt = $('#phanloai_add').val();
            $('#phanloai').append(new Option(gt, gt, true, true));
            $('#phanloai').val(gt).trigger('change');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục nhóm lệ phí trước bạ
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if (chkPer('csdlmucgiahhdv', 'philephi', 'giaphilephi', 'khac', 'api') &&
                                session('admin')->phanloaiketnoi != 'KHONGKETNOI')
                            <div class="btn-group btn-group-solid">
                                <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-cog"></i> Truyền lên CSDLQG <i class="fa fa-angle-down"></i>
                                </button>

                                <ul class="dropdown-menu" style="position: static">
                                    <li>
                                        <a href="{{ url('/KetNoiAPI/HoSo?maso=dmgiaphilephi') }}" style="border: none;"
                                            target="_blank" class="btn btn-default">
                                            <i class="fa fa-caret-right"></i> Thiết lập thông điệp</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/KetNoiAPI/XemHoSo?maso=dmgiaphilephi&mahs=null') }}"
                                            style="border: none;" target="_blank" class="btn btn-default">
                                            <i class="fa fa-caret-right"></i> Xem trước thông điệp</a>
                                    </li>

                                    <li>
                                        <button type="button" style="border: none;"
                                            onclick="ketnoiapi(null,'dmgiaphilephi', '{{ $inputs['url'] . '/danhmuc/' }}')"
                                            class="btn btn-default" data-target="#ketnoiapi-modal" data-toggle="modal">
                                            <i class="fa fa-caret-right"></i>&nbsp;Truyền dữ liệu
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','philephi', 'giaphilephi','danhmuc','modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">

                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">STT</th>
                                <th>Nhóm phí, lệ phí</th>
                                <th>Tên phí, lệ phí</th>
                                <th width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$tt->stt}}</td>
                                <td>{{$tt->phanloai}}</td>
                                <td class="success">{{$tt->tennhom}}</td>
                                <td>
                                    @if(chkPer('csdlmucgiahhdv','philephi', 'giaphilephi','danhmuc','modify'))
                                        <button type="button" onclick="ClickEdit('{{$tt->manhom}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                            <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                        <button type="button" onclick="getId('{{$tt->manhom}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
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
                {!! Form::open(['url'=>$inputs['url'].'/danhmuc', 'method'=>'post','id' => 'frm_create', 'class'=>'horizontal-form'])!!}
                <input type="hidden" name="manhom" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin nhóm phí, lệ phí1</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Số thứ tự</label>
                                <input name="stt" id="stt" class="form-control" required data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="control-label">Tên phân nhóm phí, lệ phí</label>
                                {!!Form::select('phanloai', $a_phanloai ,null, array('id' => 'phanloai','class' => 'form-control select2me'))!!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" style="margin-top: 25px;">
                                <button type="button" class="btn btn-default" data-target="#modal-phanloai" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên phí, lệ phí<span class="require">*</span></label>
                                <input name="tennhom" id="tennhom" class="form-control" required>
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
                {!! Form::open(['url'=>$inputs['url'].'/delete_dm','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="manhom" id="manhom">
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

    <div id="modal-phanloai" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin chi tiết</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-control-label">Tên phân loại phí, lệ phí<span class="require">*</span></label>
                            {!!Form::text('phanloai_add', null, array('id' => 'phanloai_add','class' => 'form-control','required'=>'required'))!!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="button" class="btn btn-primary" onclick="addpl()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    @include('includes.script.inputmask-ajax-scripts')
    @include('manage.include.form.modal_ketnoi_api')
@stop