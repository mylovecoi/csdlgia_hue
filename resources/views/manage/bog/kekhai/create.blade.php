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
{{--    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>--}}
{{--    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>--}}
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>

{{--    <script src="{{url('assets/admin/pages/scripts/dataTables-rowGroup.min.js')}}"></script>--}}
{{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}

    <!--End date new-->

    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            // $(":input").inputmask();
        });

        function clearForm(){
            $('#tenhh').val('');
            $('#quycach').val('');
            $('#gialk').val('');
            $('#giakk').val('');
            $('#dvt').val('');
            $('#ghichu').val('');
            $('#id').val(-100);
            InputMask();
        }

        function createmhbog(){
            if($('#tenhh').val() == ''){
                toastr.error('Tên hàng hóa không được bỏ trống','Lỗi.');
                return false;
            }
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' +'/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    plhh:  $('#plhh').val(),
                    tenhh:  $('#tenhh').val(),
                    quycach:  $('#quycach').val(),
                    gialk: $('#gialk').val(),
                    giakk: $('#giakk').val(),
                    dvt: $('#dvt').val(),
                    ghichu: $('#ghichu').val(),
                    madv: $('#madv').val(),
                    mahs: $('#mahs').val(),
                    id: $('#id').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Cập nhật thông tin mặt hàng kê khai giá", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");

                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })
        }

        function editmhbog(mahs) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: mahs
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#plhh').val(data.plhh).trigger('change');
                    $('#tenhh').val(data.tenhh);
                    $('#quycach').val(data.quycach);
                    $('#dvt').val(data.dvt);
                    $('#gialk').val(data.gialk);
                    $('#giakk').val(data.giakk);
                    $('#ghichu').val(data.ghichu);
                    $('#id').val(data.id);
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
                url: '{{$inputs['url']}}' +'/del_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs: $('input[name="mahs"]').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin mặt hàng!", "Thành công!");
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
        {{$m_nghe->tennghe}} <small> thêm mới</small>
        <p><h5 style="color: blue">{{$m_dn->tendn}}&nbsp;- Mã số thuế: {{$m_dn->madv}}</h5></p>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row" >
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <!--div class="portlet-title">
                </div-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {!! Form::model($model, ['url'=>'binhongia\create', 'files'=>true, 'id' => 'create_kkdkg', 'class'=>'horizontal-form']) !!}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />

                    <div class="form-body">
                        <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngày kê khai<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số công văn<span class="require">*</span></label>
                                    {!!Form::text('socv', null, array('id' => 'socv','class' => 'form-control', 'required'))!!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngày thực hiện mức giá kê khai<span class="require">*</span></label>
                                    {!! Form::input('date', 'ngayhieuluc', null, array('id' => 'ngayhieuluc', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số công văn liền kề</label>
                                    {!!Form::text('socvlk', null, array('id' => 'socvlk','class' => 'form-control'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngày nhập số công văn liền kề</label>
                                    {!! Form::input('date', 'ngaycvlk', null, array('id' => 'ngaycvlk', 'class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="selGender" class="control-label">Phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá tác động
                                        làm tăng hoặc giảm giá hàng hóa, dịch vụ thực hiện kê khai giá</label>
                                    {!! Form::textarea('ptnguyennhan', null, array('id' => 'ptnguyennhan','class' => 'form-control', 'rows'=>'2')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label for="selGender" class="control-label">Ghi rõ cách chính sách và mức khuyến mại, giảm giá hoặc chiết khấu đối với các đối
                                        tượng khách hàng, các Điều kiện vận chuyển, giao hàng, bán hàng kèm theo mức giá kê khai (nếu có)</label>
                                    {!! Form::textarea('chinhsachkm', null, array('id' => 'chinhsachkm','class' => 'form-control', 'rows'=>'2')) !!}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">
                        <input type="hidden" name="manghe" id="manghe" value="{{$model->manghe}}">
                        <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                        <!--/row-->
                        <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" onclick="clearForm()" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs">
                                        <i class="fa fa-plus"></i>&nbsp;Bổ sung mặt hàng</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">STT</th>
                                        <th style="text-align: center">Phân loại hàng<br>hoá, dịch vụ</th>
                                        <th style="text-align: center">Tên hàng hoá,<br>dịch vụ</th>
                                        <th style="text-align: center">Đơn vị<br>tính</th>
                                        <th style="text-align: center">Mức giá <br>liền kề</th>
                                        <th style="text-align: center">Mức giá <br>kê khai</th>
                                        <th style="text-align: center">Ghi chú</th>
                                        <th style="text-align: center" width="15%">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($model_ct as $key=>$tt)
                                        <tr>
                                            <td style="text-align: center">{{$key+1}}</td>
                                            <td>{{$tt->plhh}}</td>
                                            <td class="active">{{$tt->tenhh}}</td>
                                            <td style="text-align: center">{{$tt->dvt}}</td>
                                            <td style="text-align: right">{{dinhdangsothapphan($tt->gialk,2)}}</td>
                                            <td style="text-align: right">{{dinhdangsothapphan($tt->giakk,2)}}</td>
                                            <td>{{$tt->ghichu}}</td>
                                            <td>
                                                <button type="button" onclick="editmhbog({{$tt->id}});" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                {{--<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editmhbog({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>--}}
                                                {{--<button type="button" data-target="#modal-nhapkhau" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editnhapkhau({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Thuyết minh với MH nhập khẩu</button>--}}
                                                {{--<button type="button" data-target="#modal-sanxuat" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editsanxuat({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Thuyết minh với MH sản xuất</button>--}}
                                                <button type="button" onclick="getid({{$tt->id}});"  data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
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
                <button type="submit" class="btn green" onclick="validateForm()">
                    <i class="fa fa-check"></i> Hoàn thành</button>
            </div>
        {!! Form::close() !!}
        <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create_kkdkg").validate({
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
    {!! Form::open(['method' => 'post', 'url'=>'', 'class'=>'horizontal-form','id'=>'frm_create']) !!}
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin mặt hàng</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-11" style="padding-left: 0px;">
                                    <label class="form-control-label">Phân loại hàng hóa, dịch vụ</label>
                                    {!!Form::select('plhh', $a_pl, null, array('id' => 'plhh','class' => 'form-control select2me'))!!}
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <label class="control-label">&nbsp;&nbsp;Thêm</label>
                                    <button type="button" class="btn btn-default" data-target="#modal-pl" data-toggle="modal">
                                        <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label class="control-label">Tên mặt hàng hóa, dịch vụ<span class="require">*</span></label>
                                <div><input type="text" name="tenhh" id="tenhh" class="form-control" required ></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label class="control-label">Quy cách, chất lượng</label>
                                <div><input type="text" name="quycach" id="quycach" class="form-control" ></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('manage.include.form.input_dvt')
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group"><label class="control-label">Giá liền kề</label>
                                <div><input type="text" id="gialk" name="gialk" class="form-control text-right" data-mask="fdecimal"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group"><label class="control-label">Giá kê khai</label>
                                <div><input type="text" id="giakk" name="giakk" class="form-control text-right" data-mask="fdecimal"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label class="control-label">Ghi chú</label>
                                <div><input type="text" id="ghichu" name="ghichu" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id" name="id">
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

    <!--Model Edit-->
    <div class="modal fade bs-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa thông tin mặt hàng</h4>
                </div>
                <div class="modal-body" id="ttmhbogedit">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="updatemhbog()">Cập nhật</button>
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
                    <button type="button" class="btn btn-primary" onclick="delmhbog()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="modal-pl" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin phân loại hàng hóa, dịch vụ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-control-label">Phân loại hàng hóa, dịch vụ<span class="require">*</span></label>
                            {!!Form::text('plhh_add', null, array('id' => 'plhh_add','class' => 'form-control','required'=>'required'))!!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button class="btn btn-primary" onclick="add_plhh()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function add_plhh(){
            $('#modal-pl').modal('hide');
            var gt = $('#plhh_add').val();
            $('#plhh').append(new Option(gt, gt, true, true));
            $('#plhh').val(gt).trigger('change');
        }
    </script>

    @include('manage.include.form.modal_dvt')
    @include('includes.script.create-header-scripts')
    @include('includes.script.inputmask-ajax-scripts')
@stop