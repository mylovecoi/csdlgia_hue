@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--Date-->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <!--End Date-->
@stop

@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>

{{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}

{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $(":input").inputmask();--}}
{{--        });--}}
{{--    </script>--}}
{{--    <!--End date new-->--}}

    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
        function clearForm(){
            var form = $('#frm_modify');
            form.find("[name='mucthutu']").val(0);
            form.find("[name='mucthuden']").val(0);
            form.find("[name='ptcp']").val('');
            form.find("[name='idct']").val(0);
            InputMask();
        }
        function createmhbog(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    phanloai: $('#phanloai').val(),
                    ptcp: $('#ptcp').val(),
                    phantram: $('#phantram').val(),
                    mucthutu: $('#mucthutu').val(),
                    mucthuden: $('#mucthuden').val(),
//                    ghichu: $('#ghichuct').val(),
                    mahs: $('#mahs').val(),
                    id: $('#idct').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Cập nhật thông tin phí lệ phí", "Thành công!");
                        $('#dsmhbog').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");

                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })

        }
        function editmhbog(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='mucthutu']").val(data.mucthutu);
                    form.find("[name='mucthuden']").val(data.mucthuden);
                    form.find("[name='phantram']").val(data.phantram);
                    form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                    form.find("[name='ptcp']").val(data.ptcp);
//                    form.find("[name='ghichuct']").val(data.ghichu);
                    form.find("[name='idct']").val(data.id);
                    InputMask();
                }
            })
        }

        function getid(id){
            document.getElementById("iddelete").value=id;
        }

        function delmhbog() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/del_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs: $('#mahs').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin phí lệ phí!", "Thành công!");
                    $('#dsmhbog').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });

                    $('#modal-delete').modal("hide");

                    //}
                }
            })
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
    <h3 class="page-title text-uppercase">
        {{session('admin')['a_chucnang']['giaphilephi'] ?? 'hồ sơ giá tính lệ phí trước bạ'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <!--div class="portlet-title">
                </div-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/modify', 'class'=>'horizontal-form','id'=>'update_philephi', 'files'=>true]) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                        <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">
                        <div class="form-body">
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="control-label">Nhóm phí lệ phí<span class="require">*</span></label>--}}
                                        {{--{!!Form::select('manhom', $a_dm, null, array('id' => 'manhom','class' => 'form-control select2me'))!!}--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số quyết định</label>
                                        {!!Form::text('soqd',null, array('id' => 'soqd','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ngày áp dụng<span class="require">*</span></label>
                                        {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Mô tả</label>
                                        {!!Form::textarea('mota',null, array('id' => 'mota','class' => 'form-control', 'rows'=>'2'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Ghi chú</label>
                                        {!!Form::textarea('ghichu',null, array('id' => 'ghichu','class' => 'form-control', 'rows'=>'2'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">File đính kèm</label>
                                        @if($model->ipf1 != '')
                                            <a href="{{url('/data/giaphilephi/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                        @endif
                                        <input name="ipf1" id="ipf1" type="file">
                                    </div>
                                </div>
                            </div>

                            @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()">
                                                <i class="fa fa-plus"></i>&nbsp;Thêm mới thông tin</button>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                            @endif

                            <div class="row" id="dsmhbog">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2" width="5%">STT</th>
                                                <th rowspan="2">Phân loại</th>
                                                <th rowspan="2">Tên phí, lệ phí</th>
                                                <th rowspan="2">Phần<br>trăm</th>
                                                <th colspan="2">Mức thu</th>
                                                <th rowspan="2">Ghi chú</th>
                                                <th rowspan="2" width="15%">Thao tác</th>
                                            </tr>

                                            <tr class="text-center">
                                                <th>Từ</th>
                                                <th>Đến</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($modelct as $key=>$ct)
                                        <tr>
                                            <td style="text-align: center">{{$key+1}}</td>
                                            <td>{{$ct->phanloai}}</td>
                                            <td>{{$ct->ptcp}}</td>
                                            <td class="text-center">{{$ct->phantram}}</td>
                                            <td style="text-align: right;">{{dinhdangso($ct->mucthutu)}}</td>
                                            <td style="text-align: right;">{{dinhdangso($ct->mucthuden)}}</td>
                                           <td style="text-align: left">{{$ct->ghichu}}</td>
                                            <td>
                                                @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                    <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editmhbog({{$ct->id}})">
                                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                    <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$ct->id}})" >
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
                    <!-- END FORM-->
                </div>
            </div>
            <div style="text-align: center">
                <a href="{{url($inputs['url'].'/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                    <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                @if(!isset($inputs['act']) || $inputs['act'] == 'true')
                    <button type="submit" class="btn green" onclick="validateForm()">
                        <i class="fa fa-check"></i> Hoàn thành</button>
                @endif
            </div>

            <!-- END VALIDATION STATES-->
        </div>
        {!! Form::close() !!}
    </div>
    <script type="text/javascript">
        function validateForm(){
            var validator = $("#update_philephi").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>
    <!--Model Create-->
    {!! Form::open(['url'=>'', 'class'=>'horizontal-form','id'=>'frm_modify']) !!}
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin phí lệ phí</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label class="control-label">Tên phân nhóm phí, lệ phí</label>
                                {!!Form::select('phanloai', $a_phanloai ,null, array('id' => 'phanloai','class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group" style="margin-top: 25px;">
                                <button type="button" class="btn btn-default" data-target="#modal-phanloai" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên phí</label>
                                {!!Form::textarea('ptcp',null, array('id' => 'ptcp','class' => 'form-control','rows'=>'3'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Phần trăm</label>
                                <input type="text" id="phantram" name="phantram" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Mức thu phí - Từ</label>
                                <input type="text" id="mucthutu" name="mucthutu" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Mức thu phí - Đến</label>
                                <input type="text" id="mucthuden" name="mucthuden" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="control-label">Ghi chú</label>--}}
                                {{--{!!Form::textarea('ghichuct',null, array('id' => 'ghichuct','class' => 'form-control','rows'=>'3'))!!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <input type="hidden" name="idct" id="idct" />
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="createmhbog()">Hoàn thành</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! Form::close() !!}

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
                    <button type="button" class="btn btn-primary" onclick="delmhbog()">Đồng ý</button>
                </div>
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

    @include('includes.script.create-header-scripts')
    @include('includes.script.inputmask-ajax-scripts')
@stop