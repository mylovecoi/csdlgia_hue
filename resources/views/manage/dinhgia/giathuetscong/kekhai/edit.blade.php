@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
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
{{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $(":input").inputmask();--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        function clearForm(){
            $('#dongiathue').val('0');
            $('#dvt').val('');
            $('#dvthue').val('');
            $('#hdthue').val('');
            $('#ththue').val('');
            $('#sotienthuenam').val('0');
            $('#trangthai').val('ADD');
            InputMask();
        }

        function capnhatts(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/giathuetscong/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mataisan: $('#mataisan').val(),
                    dvt: $('#dvt').val(),
                    dongiathue: $('#dongiathue').val(),
                    dvthue:$('#dvthue').val(),
                    hdthue:$('#hdthue').val(),
                    ththue:$('#ththue').val(),
                    sotienthuenam:$('#sotienthuenam').val(),
                    mahs:$('#mahs').val(),
                    trangthai:$('#trangthai').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Cập nhật thông tin thuê tài sản công thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");
                    }
                    else
                        toastr.error("Tài sản đã được thêm vào hồ sơ.", "Lỗi!");
                }
            })
        }
        function editItem(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/giathuetscong/get_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='mataisan']").val(data.mataisan).trigger('change');
                    form.find("[name='dongiathue']").val(data.dongiathue);
                    form.find("[name='dvt']").val(data.dvt);
                    form.find("[name='dvthue']").val(data.dvthue);
                    form.find("[name='hdthue']").val(data.hdthue);
                    form.find("[name='ththue']").val(data.ththue);
                    form.find("[name='sotienthuenam']").val(data.sotienthuenam);
                    form.find("[name='trangthai']").val('EDIT');
                    InputMask();
                },
            })
        }

        function getid(id){
            document.getElementById("iddelete").value=id;
        }

        function delrow(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/giathuetscong/del_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs:$('#mahs').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin thành công!", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });
                    $('#modal-delete').modal("hide");

                    //}
                }
            })

        }
    </script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        {{session('admin')['a_chucnang']['giathuetscong'] ?? 'hồ sơ thuê tài sản công'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>'giathuetscong/modify', 'class'=>'horizontal-form','id'=>'update_thongtinthuetaisancong']) !!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định</label>
                                    {!!Form::text('soqd',null, array('id' => 'soqd','class' => 'form-control', 'autofocus'))!!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Thông tin hồ sơ</label>
                                    {!!Form::text('thongtinhs',null, array('id' => 'thongtinhs','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()">
                                        <i class="fa fa-plus"></i>&nbsp;Thêm mới tài sản</button>                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                        <tr>
                                            <th width="2%" style="text-align: center">STT</th>
                                            <th style="text-align: center">Tên tài sản</th>
                                            <th style="text-align: center">Đơn vị thuê</th>
                                            <th style="text-align: center">Hợp đồng số</th>
                                            <th style="text-align: center">Thời hạn</th>
                                            <th style="text-align: center" width="8%">Đơn vị<br>tính</th>
                                            <th style="text-align: center" width="8%">Đơn giá</th>
                                            <th style="text-align: center" width="8%">Thành tiền</th>
                                            <th style="text-align: center" width="10%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ttts">
                                    @foreach($modelct as $key=>$tt)
                                        <tr id={{$tt->id}}>
                                            <td style="text-align: center">{{($key +1)}}</td>
                                            <td class="active" style="font-weight: bold">{{$a_ts[$tt->mataisan] ?? ''}}</td>
                                            <td style="text-align: left;">{{$tt->dvthue}}</td>
                                            <td style="text-align: left;">{{$tt->hdthue}}</td>
                                            <td style="text-align: left;">{{$tt->ththue}}</td>
                                            <td style="text-align: center;">{{$tt->dvt}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->dongiathue)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->sotienthuenam)}}</td>
                                            <td>
                                                @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                    <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
                                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                    <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$tt->id}})" >
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
                </div>
            </div>
            @if($inputs['act'] == 'true')
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <!-- thêm mới hồ sơ, sau đó nhấn quay lại ==> tự động xoa hồ sơ thêm mới -->
                        @if(isset($inputs['addnew']))
                            <a href="{{url('giathuetscong/delete?mahs='.$model->mahs)}}" class="btn btn-danger">
                                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        @else
                            <a href="{{url('giathuetscong/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        @endif

                        <button type="submit" class="btn green"><i class="fa fa-check"></i> Hoàn thành</button>
                    </div>
                </div>
            @endif
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <script type="text/javascript">
        function validateForm(){

            var validator = $("#update_thongtinthuetaisancong").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>

    <!--Model frm_modify-->
    {!! Form::open(['method' => 'post', 'url'=>'', 'class'=>'horizontal-form','id'=>'frm_modify']) !!}
    <input type="hidden" name="trangthai" id="trangthai" />
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin tài sản công</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên tài sản<span class="require">*</span></label>
                                {!!Form::select('mataisan', $a_ts, null, array('id' => 'mataisan','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Đơn vị thuê</label>
                                <input type="text" id="dvthue" name="dvthue" class="form-control" style="font-weight: bold">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Hợp đồng số</label>
                                <input type="text" id="hdthue" name="hdthue"  class="form-control" style="font-weight: bold">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Thời hạn</label>
                                <input type="text" id="ththue" name="ththue"  class="form-control" style="font-weight: bold">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Đơn vị tính</label>
                                <input type="text" id="dvt" name="dvt" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Đơn giá thuê</label>
                                <input type="text" id="dongiathue" name="dongiathue" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Thành tiền</label>
                                <input type="text" id="sotienthuenam" name="sotienthuenam" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="capnhatts()">Hoàn thành</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Model Delete-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa thông tin?</h4>
                </div>
                <input type="hidden" id="iddelete" name="iddelete">
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="delrow()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('includes.script.set_date_thoihanthamdinh')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop