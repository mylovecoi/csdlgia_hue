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
            $('#vitri').val('');
            $('#mota').val('');
            $('#dientich').val('');
            $('#dongia').val('');
        }
        function capnhatts(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}'+'/chitiet/store',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    diemdau: $('input[name="diemdau"]').val(),
                    diemcuoi: $('input[name="diemcuoi"]').val(),
                    vitri: $('input[name="vitri"]').val(),
                    mota: $('input[name="mota"]').val(),
                    dientich: $('input[name="dientich"]').val(),
                    dongia: $('input[name="dongia"]').val(),
                    mahs: $('input[name="mahs"]').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Cập nhật thông tin thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");
                    }
                    else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })
        }
        function editItem(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{$inputs['url']}}'+'/chitiet/edit',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id,
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        $('#tttsedit').replaceWith(data.message);
                        InputMask();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin.", "Lỗi!");
                }
            })
        }

        function updatets(){
            //alert('vcl');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}'+'/chitiet/update',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="idedit"]').val(),
                    vitri: $('input[name="vitriedit"]').val(),
                    diemcuoi: $('input[name="diemcuoiedit"]').val(),
                    diemdau: $('input[name="diemdauedit"]').val(),
                    mota: $('input[name="motaedit"]').val(),
                    dientich: $('input[name="dientichedit"]').val(),
                    dongia: $('input[name="dongiaedit"]').val(),
                    mahs: $('input[name="mahs"]').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Chỉnh sửa thông tin thành công.", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-edit').modal("hide");
                    }else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập.", "Lỗi!");
                }
            })
        }
        function getid(id){
            document.getElementById("iddelete").value=id;
        }
        function delrow(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}'+'/chitiet/del',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs: $('input[name="mahs"]').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin thành công.", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });
                    $('#modal-delete').modal("hide");
                }
            })

        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Hồ sơ thuê mặt đất mặt nước<small> chỉnh sửa</small>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>'giathuematdatmatnuoc/modify', 'class'=>'horizontal-form','id'=>'update_giathuematdatmatnuoc']) !!}
            <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định</label>
                                    {!!Form::text('soqd',null, array('id' => 'soqd','class' => 'form-control', 'autofocus'))!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Địa bàn</label>
                                    {!!Form::select('madiaban', array_column($m_diaban->where('level','H')->toarray(),'tendiaban', 'madiaban'),
                                        null, array('id' => 'madiaban','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    {!!Form::textarea('mota',null, array('id' => 'mota','class' => 'form-control', 'rows'=>2))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()">
                                        <i class="fa fa-plus"></i>&nbsp;Thêm mới vị trí</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                        <tr>
                                            <th width="2%" style="text-align: center">STT</th>
                                            <th style="text-align: center">Vị trí</th>
                                            <th style="text-align: center">Địa giới từ</th>
                                            <th style="text-align: center">Địa giới đến</th>
                                            <th style="text-align: center">Mô tả</th>
                                            <th style="text-align: center" width="10%">Diện tích</th>
                                            <th style="text-align: center" width="10%">Đơn giá</th>
                                            <th style="text-align: center" width="15%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ttts">
                                        @foreach($modelct as $key=>$tt)
                                            <tr id={{$tt->id}}>
                                                <td style="text-align: center">{{($key +1)}}</td>
                                                <td class="active">{{$tt->vitri}}</td>
                                                <td>{{$tt->diemdau}}</td>
                                                <td>{{$tt->diemcuoi}}</td>
                                                <td>{{$tt->mota}}</td>
                                                <td style="text-align: center;font-weight: bold" >{{number_format($tt->dientich)}}</td>
                                                <td style="text-align: right;font-weight: bold">{{number_format($tt->dongia)}}</td>
                                                <td>
                                                    @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                        <button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>
                                                        <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$tt->id}})" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
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
                            <a href="{{url('giathuematdatmatnuoc/delete?mahs='.$model->mahs)}}" class="btn btn-danger">
                                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        @else
                            <a href="{{url('giathuematdatmatnuoc/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
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

    <!--Modal Edit-->
    <div class="modal fade bs-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa thông tin vị trí cho thuê</h4>
                </div>
                <div class="modal-body" id="tttsedit">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="updatets()">Cập nhật</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Model Create-->
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin vị trí cho thuê</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Vị trí<span class="require">*</span></label>
                                <input type="text" id="vitri" name="vitri" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Địa giới từ</label>
                                <input type="text" id="diemdau" name="diemdau" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Địa giới đến</label>
                                <input type="text" id="diemcuoi" name="diemcuoi" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mô tả</label>
                                <input type="text" name="mota" id="mota" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Diện tích</label>
                                <input type="text" name="dientich" id="dientich" data-mask="fdecimal" class="form-control" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Đơn giá<span class="require">*</span></label>
                                <input type="text" name="dongia" id="dongia" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="capnhatts()">Thêm mới</button>
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

    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop