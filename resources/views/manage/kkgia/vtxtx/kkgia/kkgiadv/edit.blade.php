@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--Date-->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <!--End Date-->

@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>


    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>

    <!--Date>
    <script type="text/javascript" src="{{ url('js/jquery-1.10.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>

    <End Date-->
    <!--Date new-->
    <!--script src="{{url('minhtran/jquery.min.js')}}"></script-->
{{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}

    <script>
        $(document).ready(function(){
            TableManaged.init();
            InputMask();
        });

        function clearForm(){
            $('#tendvcu').val('');
            $('#mota').val('');
            $('#qccl').val('');
            $('#dvt').val('');
            $('#gialk').val(0);
            $('#giakk').val(0);
            $('#gialk1').val(0);
            $('#giakk1').val(0);
            $('#gialk2').val(0);
            $('#giakk2').val(0);
            $('#ghichu').val('');
            $('#id_ct').val(-1);
            document.getElementById('btn-comp').disabled = false;
            InputMask();
        }

        function createttp(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/giavtxtxct/storett',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    tendvcu: $('#tendvcu').val(),
                    qccl: $('#qccl').val(),
                    dvt: $('#dvt').val(),
                    sokm: $('#sokm').val(),
                    gialk: $('#gialk').val(),
                    giakk: $('#giakk').val(),
                    sokm1: $('#sokm1').val(),
                    gialk1: $('#gialk1').val(),
                    giakk1: $('#giakk1').val(),
                    sokm2: $('#sokm2').val(),
                    gialk2: $('#gialk2').val(),
                    giakk2: $('#giakk2').val(),
                    ghichu: $('#ghichu').val(),
                    mahs: $('#mahs').val(),
                    madv: $('#madv').val(),
                    id: $('#id_ct').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Bổ xung thông tin thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");

                    }
                }
            })
        }

        function editTtPh(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/giavtxtxct/edittt',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    // var form = $('#frm_modify');
                    // form.find("[name='maspdv']").val(data.maspdv).trigger('change');
                    // form.find("[name='dongia']").val(data.dongia);

                    $('#tendvcu').val(data.tendvcu);
                    $('#qccl').val(data.qccl);
                    $('#dvt').val(data.dvt);
                    $('#sokm').val(data.sokm);
                    $('#gialk').val(data.gialk);
                    $('#giakk').val(data.giakk);
                    $('#sokm1').val(data.sokm1);
                    $('#gialk1').val(data.gialk1);
                    $('#giakk1').val(data.giakk1);
                    $('#sokm2').val(data.sokm2);
                    $('#gialk2').val(data.gialk2);
                    $('#giakk2').val(data.giakk2);
                    $('#ghichu').val(data.ghichu);
                    $('#id_ct').val(id);
                    InputMask();
                    document.getElementById('btn-comp').disabled = false;
                }
            })
        }


        function getid(id){
            document.getElementById("iddelete").value=id;
        }

        function deleteRow() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/giavtxtxct/deletett',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs: $('input[name="mahs"]').val()
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
    <h3 class="page-title">
        Thông tin kê khai hồ sơ giá vận tải xe taxi<small>&nbsp;chỉnh sửa</small>
        <p><h5 style="color: blue">{{$modeldn->tendn}}&nbsp;- Mã số thuế: {{$modeldn->madv}}</h5></p>
    </h3>
    <hr>
    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::model($model, ['method' => 'post', 'url'=>'kekhaigiavantaixetaxi/store', 'class'=>'horizontal-form','id'=>'update_kkvtxtx']) !!}
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-body">
                    <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày kê khai<span class="require">*</span></label>
                                {!! Form::input('date', 'ngaynhap', null, array('id' => 'ngaynhap', 'class' => 'form-control','required'))!!}
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày thực hiện mức giá kê khai<span class="require">*</span></label>
                                {!! Form::input('date', 'ngayhieuluc', null, array('id' => 'ngayhieuluc', 'class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                        <!--/span-->

                    </div>

                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số công văn<span class="require">*</span></label>
                                {!!Form::text('socv', null, array('id' => 'socv','class' => 'form-control required'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số công văn liền kề</label>
                                {!!Form::text('socvlk',null, array('id' => 'socvlk','class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày nhập số công văn liền kề<span class="require">*</span></label>
                                {!! Form::input('date', 'ngaycvlk', $model->ngaycvlk != '' ? date('d/m/Y',  strtotime($model->ngaycvlk)) : '', array('id' => 'ngaycvlk', 'class' => 'form-control'))!!}
                                {{-- {!!Form::text('ngaycvlk',$model->ngaycvlk != '' ? date('d/m/Y',  strtotime($model->ngaycvlk)) : '', array('id' => 'ngaycvlk','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!} --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label">Các yếu tố chi phí cấu thành giá (đối với kê khai lần đầu); phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá tác động làm tăng hoặc giảm giá (đối với kê khai lại).</label>
                                <div>
                                    <textarea id="ytcauthanhgia" class="form-control" name="ytcauthanhgia" cols="30" rows="5">{{$model->ytcauthanhgia}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label">Các trường hợp ưu đãi, giảm giá; điều kiện áp dụng giá (nếu có).</label>
                                <div>
                                    <textarea id="thydggadgia" class="form-control" name="thydggadgia" cols="30" rows="5">{{$model->thydggadgia}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                    <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">

                    <!--/row-->
                    <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()"><i class="fa fa-plus"></i>&nbsp;Kê khai bổ sung dịch vụ</button>
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="row" id="dsts">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_4">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="text-align: center" width="2%">STT</th>
                                        <th rowspan="2" style="text-align: center">Tên dịch vụ cung ứng</th>
                                        <th rowspan="2" style="text-align: center">Đơn vị<br>tính</th>
                                        <th colspan="3" style="text-align: center">Kê khai giá</th>
                                        <th colspan="3" style="text-align: center">Kê khai giá</th>
                                        <th colspan="3" style="text-align: center">Kê khai giá</th>
                                        <th rowspan="2" style="text-align: center">Ghi chú</th>
                                        <th rowspan="2" style="text-align: center">Thao tác</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center">Số Km</th>
                                        <th style="text-align: center">Giá<br>kê<br>khai</th>
                                        <th style="text-align: center">Giá<br>liền<br>kề</th>
                                        <th style="text-align: center">Số Km</th>
                                        <th style="text-align: center">Giá<br>kê<br>khai</th>
                                        <th style="text-align: center">Giá<br>liền<br>kề</th>
                                        <th style="text-align: center">Số Km</th>
                                        <th style="text-align: center">Giá<br>kê<br>khai</th>
                                        <th style="text-align: center">Giá<br>liền<br>kề</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($modelct as $key=>$tt)
                                    <tr>
                                        <td style="text-align: center">{{($key +1)}}</td>
                                        <td class="active">{{$tt->tendvcu}}</td>
                                        <td style="text-align: center">{{$tt->dvt}}</td>
                                        <td>{{$tt->sokm}}</td>
                                        <td style="text-align: right">{{number_format($tt->gialk)}}</td>
                                        <td style="text-align: right">{{number_format($tt->giakk)}}</td>
                                        <td>{{$tt->sokm1}}</td>
                                        <td style="text-align: right">{{number_format($tt->gialk1)}}</td>
                                        <td style="text-align: right">{{number_format($tt->giakk1)}}</td>
                                        <td>{{$tt->sokm2}}</td>
                                        <td style="text-align: right">{{number_format($tt->gialk2)}}</td>
                                        <td style="text-align: right">{{number_format($tt->giakk2)}}</td>
                                        <td style="text-align: left">{{$tt->ghichu}}</td>
                                        <td>
                                            <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                            <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$tt->id}});" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                            <button type="button" data-target="#modal-pag" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editPag({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Phương án giá</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
            <div style="text-align: center">
                <a href="{{url('kekhaigiavantaixetaxi?&madv='.$model->madv)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Hoàn thành</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>

    <!--Validate Form-->
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#update_kkvtxtx").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>

    <!--Model them moi ttp-->
    {!! Form::open(['method' => 'post', 'url'=>'', 'class'=>'horizontal-form','id'=>'frm_modify']) !!}
    <input type="hidden" id="id_ct" name="id_ct">
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết hồ sơ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Tên dịch vụ cung ứng</b><span class="require">*</span></label>
                                {!!Form::text('tendvcu', null, array('id' => 'tendvcu','class' => 'form-control','required'=>'required'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Quy cách chất lượng dịch vụ</b></label>
                                {!!Form::textarea('qccl', null, array('id' => 'qccl','class' => 'form-control','rows'=>'3'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label"><b>Đơn vị tính</b><span class="require">*</span></label>
                                {!!Form::text('dvt', null, array('id' => 'dvt','class' => 'form-control','required'=>'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Số Km</b></label>
                                {!!Form::text('sokm', null, array('id' => 'sokm','class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Giá kê khai hiện hành</b><span class="require">*</span></label>
                                <input type="text" name="gialk" id="gialk" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Giá kê khai mới</b><span class="require">*</span></label>
                                <input type="text" name="giakk" id="giakk" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Số Km</b></label>
                                {!!Form::text('sokm1', null, array('id' => 'sokm1','class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Giá kê khai hiện hành</b><span class="require">*</span></label>
                                <input type="text" name="gialk1" id="gialk1" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Giá kê khai mới</b><span class="require">*</span></label>
                                <input type="text" name="giakk1" id="giakk1" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Số Km</b></label>
                                {!!Form::text('sokm2', null, array('id' => 'sokm2','class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Giá kê khai hiện hành</b><span class="require">*</span></label>
                                <input type="text" name="gialk2" id="gialk2" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label"><b>Giá kê khai mới</b><span class="require">*</span></label>
                                <input type="text" name="giakk2" id="giakk2" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Ghi chú</b></label>
                                {!!Form::textarea('ghichu', null, array('id' => 'ghichu','class' => 'form-control','rows'=>'2'))!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" id="btn-comp"
                            onclick="createttp();this.disabled = true;"> Hoàn thành</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! Form::close() !!}


    <!--Modal Xoá-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa thông tin?</h4>
                </div>
                <input type="hidden" id="iddelete" name="iddelete">
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="deleteRow()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('manage.kkgia.vtxtx.kkgia.kkgiadv.modal_pag')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')


@stop