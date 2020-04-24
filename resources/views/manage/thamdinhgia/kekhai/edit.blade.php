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
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(":input").inputmask();
        });
    </script>
    <script>
        function capnhatts(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maspdv: $('#maspdv').val(),
                    dongia: $('#dongia').val(),
                    mahs:$('#mahs').val(),
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
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })
        }
        function editItem(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{$inputs['url']}}' + '/get_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='maspdv']").val(data.maspdv).trigger('change');
                    form.find("[name='dongia']").val(data.dongia);
                },
            })
        }

        function getid(id){
            document.getElementById("iddelete").value=id;
        }

        function delrow(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/del_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs:$('#mahs').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    toastr.success("Bạn đã xóa thông tin thành công!", "Thành công!");
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
        Hồ sơ thẩm định giá
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post','url'=> $inputs['url'].'/modify', 'class'=>'horizontal-form','id'=>'update_hsthamdinh', 'files'=>true]) !!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn vị yêu cầu thẩm định<span class="require">*</span></label>
                                    {!!Form::text('dvyeucau',null, array('id' => 'dvyeucau','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thông tin tờ trình<span class="require">*</span></label>
                                    {!!Form::text('hosotdgia',null, array('id' => 'hosotdgia','class' => 'form-control required','autofocus'))!!}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên hàng hóa yêu cầu thẩm định<span class="require">*</span></label>
                                    {!!Form::text('tttstd',null, array('id' => 'tttstd','class' => 'form-control required','autofocus'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm thẩm định<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Địa điểm thẩm định<span class="require">*</span></label>
                                    {!!Form::text('diadiem',null, array('id' => 'diadiem','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số thông báo kết luận<span class="require">*</span></label>
                                    {!!Form::text('sotbkl',null, array('id' => 'sotbkl','class' => 'form-control required'))!!}

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số ngày sử dụng kết quả thẩm định</label>
                                    {!!Form::text('songaykq',null, array('id' => 'songaykq','data-mask'=>'fdecimal','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời hạn sử dụng kết quả thẩm định</label>
                                    {!! Form::input('date', 'thoihan', null, array('id' => 'thoihan', 'class' => 'form-control', 'readonly'))!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="selGender" class="control-label">Ghi chú</label>
                                    {!!Form::textarea('ghichu',null, array('id' => 'ghichu','data-mask'=>'fdecimal','class' => 'form-control', 'rows' => '2'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm 1</label>
                                    @if(isset($model->ipf1))
                                        <a href="{{url('/data/thamdinhgia/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                    @endif
                                    <input name="ipf1" id="ipf1" type="file">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm 2</label>
                                    @if(isset($model->ipf2))
                                        <a href="{{url('/data/thamdinhgia/'.$model->ipf2)}}" target="_blank">{{$model->ipf2}}</a>
                                    @endif
                                    <input name="ipf2" id="ipf2" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm 3</label>
                                    @if(isset($model->ipf3))
                                        <a href="{{url('/data/thamdinhgia/'.$model->ipf3)}}" target="_blank">{{$model->ipf3}}</a>
                                    @endif
                                    <input name="ipf3" id="ipf3" type="file">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm 4</label>
                                    @if(isset($model->ipf4))
                                        <a href="{{url('/data/thamdinhgia/'.$model->ipf4)}}" target="_blank">{{$model->ipf4}}</a>
                                    @endif
                                    <input name="ipf4" id="ipf4" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()">
                                        <i class="fa fa-plus"></i>&nbsp;Thêm mới sản phẩm</button>                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                    <tr>
                                        <th width="2%" style="text-align: center">STT</th>
                                        <th style="text-align: center">Mã hàng hóa</th>
                                        <th style="text-align: center">Tên hàng hóa-Quy cách</th>
                                        <th style="text-align: center">Thông số kỹ thuật</th>
                                        <th style="text-align: center">Xuất xứ</th>
                                        <th style="text-align: center">Đơn vị</br>tính</th>
                                        <th style="text-align: center">Số <br>lượng</th>
                                        <th style="text-align: center">Đơn giá</br>đề nghị</th>
                                        <th style="text-align: center">Giá trị</br>đề nghị</th>
                                        <th style="text-align: center">Đơn giá</br>thẩm định</th>
                                        <th style="text-align: center">Giá trị</br>thẩm định</th>
                                        <th style="text-align: center">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="ttts">
                                    @foreach($modelct as $key=>$tt)
                                        <tr id={{$tt->id}}>
                                            <td style="text-align: center">{{($key +1)}}</td>
                                            <td style="text-align: center">{{$tt->mats}}</td>
                                            <td class="active">{{$tt->tents}}-{{$tt->dacdiempl}}</td>
                                            <td style="text-align: left">{{$tt->thongsokt}}</td>
                                            <td style="text-align: left">{{$tt->nguongoc}}</td>
                                            <td style="text-align: center">{{$tt->dvt}}</td>
                                            <td style="text-align: center">{{number_format($tt->sl)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->nguyengiadenghi)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->giadenghi)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->nguyengiathamdinh)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->giatritstd)}}</td>
                                            <td>
                                                <button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
                                                    <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$tt->id}})" >
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
            </div>

                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <!-- thêm mới hồ sơ, sau đó nhấn quay lại ==> tự động xoa hồ sơ thêm mới -->
                        @if(!isset($inputs['act']) || $inputs['act'] == 'true')
                            <a href="{{url('giaspdvci/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>

                            <button type="submit" class="btn green">
                                <i class="fa fa-check"></i> Hoàn thành</button>
                        @endif
                    </div>
                </div>

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
    {!! Form::open(['method' => 'post', 'class'=>'horizontal-form','id'=>'frm_modify']) !!}
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin hàng hóa</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Mã hàng hóa<span class="require">*</span></label>
                                <input type="text" id="mats" name="mats" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <div class="col-md-11" style="padding-left: 0px;">
                                    <label class="control-label">Tên hàng hóa<span class="require">*</span></label>
                                    <input type="text" id="tents" name="tents" class="form-control">
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                    <button type="button" class="btn btn-default" data-target="#modal-hanghoa" data-toggle="modal">
                                        <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Quy cách chất lượng</label>
                                <input type="text" id="dacdiempl" name="dacdiempl" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Thông số kỹ thuật</label>
                                <input type="text" name="thongsokt" id="thongsokt" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Xuất xứ</label>
                                <input type="text" name="nguongoc" id="nguongoc" class="form-control">
                            </div>
                        </div>
                        <!--/span-->

                        <div class="col-md-3">
                            <div class="form-group">
                                @include('manage.include.form.input_dvt')
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Số lượng<span class="require">*</span></label>
                                <input type="text" name="sl" id="sl" class="form-control" data-mask="fdecimal" value="1">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Đơn giá đề nghị<span class="require">*</span></label>
                                <input type="text" name="nguyengiadenghi" id="nguyengiadenghi" class="form-control" data-mask="fdecimal" value="0" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá trị đề nghị<span class="require">*</span></label>
                                <input type="text" name="giadenghi" id="giadenghi" class="form-control" data-mask="fdecimal" value="0" style="text-align: right;font-weight: bold">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Đơn giá thẩm định<span class="require">*</span></label>
                                <input type="text" name="nguyengiathamdinh" id="nguyengiathamdinh" class="form-control" data-mask="fdecimal" value="0" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá trị tài sản thẩm định<span class="require">*</span></label>
                                <input type="text" name="giatritstd" id="giatritstd" class="form-control" data-mask="fdecimal" value="0" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <textarea id="gc" class="form-control" name="gc" cols="30" rows="2"></textarea>
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
                    <button type="button" class="btn btn-primary" onclick="delrow()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('manage.include.form.modal_dvt')
    @include('includes.script.set_date_thoihanthamdinh')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop