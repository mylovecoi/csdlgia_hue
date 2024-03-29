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
    <script src="{{url('assets/admin/pages/scripts/table-managed-m.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
    {{--    });--}}
    {{--</script>--}}
    {{--<script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}
    {{--<script>--}}
    {{--    $(document).ready(function(){--}}
    {{--        $(":input").inputmask();--}}

            $('#songaykq').change(function(){
                addngay();
            });
            $('#thoidiem').change(function(){
                addngay();
            });
            InputMask();
        });
        function addngay(){
            var thoidiem = $('#thoidiem').val();
            var songay = $('#songaykq').val();
            $('#thoihan').val(add_date(thoidiem,songay));
        }

        function clearForm(){
            $('#mats').val('');
            $('#tents').val('');
            $('#dacdiempl').val('');
            $('#thongsokt').val('');
            $('#nguongoc').val('');
            $('#dvt').val('');
            $('#sl').val('1');
            $('#nguyengiadenghi').val('0');
            $('#giadenghi').val('0');
            $('#nguyengiathamdinh').val('0');
            $('#giatritstd').val('0');
            $('#gc').val('');
            InputMask();
        }

        function capnhatts(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mats: $('input[name="mats"]').val(),
                    tents: $('input[name="tents"]').val(),
                    dacdiempl: $('input[name="dacdiempl"]').val(),
                    thongsokt: $('input[name="thongsokt"]').val(),
                    nguongoc: $('input[name="nguongoc"]').val(),
                    dvt: $('input[name="dvt"]').val(),
                    sl: $('input[name="sl"]').val(),
                    nguyengiadenghi: $('input[name="nguyengiadenghi"]').val(),
                    giadenghi: $('input[name = "giadenghi"]').val(),
                    nguyengiathamdinh: $('input[name="nguyengiathamdinh"]').val(),
                    giatritstd:$('input[name="giatritstd"]').val(),
                    gc: $('textarea[name="gc"]').val(),
                    mahs:$('#mahs').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Cập nhật thông tin thuê tài sản công thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged_m.init();
                        });
                        $('#modal-create').modal("hide");
                    }
                    else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })
        }

        function editItem(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{$inputs['url']}}' + '/get_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='mats']").val(data.mats);
                    form.find("[name='tents']").val(data.tents);
                    form.find("[name='dacdiempl']").val(data.dacdiempl);
                    form.find("[name='thongsokt']").val(data.thongsokt);
                    form.find("[name='nguongoc']").val(data.nguongoc);
                    form.find("[name='dvt']").val(data.dvt).trigger('change');
                    form.find("[name='sl']").val(data.sl);
                    form.find("[name='nguyengiadenghi']").val(data.nguyengiadenghi);
                    form.find("[name='giadenghi']").val(data.giadenghi);
                    form.find("[name='nguyengiathamdinh']").val(data.nguyengiathamdinh);
                    form.find("[name='giatritstd']").val(data.giatritstd);
                    form.find("[name='gc']").val(data.gc);
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
                url: '{{$inputs['url']}}' + '/delete_ct',
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
                        TableManaged_m.init();
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
                    {!!Form::hidden('mahs',null,['id'=>'mahs'])!!}
                    {!!Form::hidden('madv',null,['id'=>'madv'])!!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-11" style="padding-left: 0px;">
                                        <label class="control-label">Đơn vị yêu cầu thẩm định<span class="require">*</span></label>
                                        {!!Form::text('dvyeucau',null, array('id' => 'dvyeucau','class' => 'form-control', 'required','autofocus'))!!}
                                    </div>
                                    <div class="col-md-1" style="padding-left: 0px;">
                                        <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                        <button type="button" class="btn btn-default" data-target="#modal-donvi" data-toggle="modal">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thông tin tờ trình<span class="require">*</span></label>
                                    {!!Form::text('hosotdgia',null, array('id' => 'hosotdgia','class' => 'form-control', 'required'))!!}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên nhóm hàng hóa yêu cầu thẩm định<span class="require">*</span></label>
                                    {!!Form::text('tttstd',null, array('id' => 'tttstd','class' => 'form-control', 'required'))!!}
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
                                    <label class="control-label">Địa điểm thẩm định</label>
                                    {!!Form::text('diadiem',null, array('id' => 'diadiem','class' => 'form-control'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số thông báo kết luận<span class="require">*</span></label>
                                    {!!Form::text('sotbkl',null, array('id' => 'sotbkl','class' => 'form-control', 'required'))!!}

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số ngày sử dụng kết quả thẩm định</label>
                                    {!!Form::text('songaykq',null, array('id' => 'songaykq','data-mask'=>'fdecimal','class' => 'form-control'))!!}
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
                                            <td style="text-align: center">{{dinhdangso($tt->sl)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->nguyengiadenghi)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->giadenghi)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->nguyengiathamdinh)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->giatritstd)}}</td>
                                            <td>
                                                <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
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
                            <a href="{{url($inputs['url'].'/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
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

    <div id="modal-donvi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin đơn vị thẩm định giá</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th width="2%" style="text-align: center">STT</th>
                                    <th style="text-align: center">Tên đơn vị</th>
                                    <th style="text-align: center">Người đại diện</th>
                                    <th style="text-align: center">Địa chỉ</th>
                                    <th style="text-align: center">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody id="ttts">
                                @foreach($m_dvtdg as $key=>$tt)
                                    <tr>
                                        <td style="text-align: center">{{($key +1)}}</td>
                                        <td class="active">{{$tt->tendv}}</td>
                                        <td style="text-align: left">{{$tt->nguoidaidien}}</td>
                                        <td style="text-align: left">{{$tt->diachi}}</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs mbs" onclick="adddonvi('{{$tt->tendv}}')">
                                                <i class="fa fa-edit"></i>&nbsp;Chọn</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-hanghoa" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Danh mục hàng hóa</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tbl_hh" class="table-dulieubang table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                <tr>
                                    <th style="text-align: center" width="2%">STT</th>
                                    <th style="text-align: center">Mã số</th>
                                    <th style="text-align: center">Tên hàng hóa</th>
                                    <th style="text-align: center">Thông số kỹ thuật</th>
                                    <th style="text-align: center">Xuất xứ</th>
                                    <th style="text-align: center">Đơn vị<br>tính</th>
                                    <th style="text-align: center" width="15%">Thao tác</th>
                                </tr>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($m_dmhh as $key=>$tt)
                                    <tr id={{'hh_'.$tt->id}}>
                                        <td style="text-align: center;">{{$key + 1}}</td>
                                        <td class="active">{{$tt->mahanghoa}}</td>
                                        <td class="success" style="font-weight: bold">{{$tt->tenhanghoa}}</td>
                                        <td>{{$tt->thongsokt}}</td>
                                        <td>{{$tt->xuatxu}}</td>
                                        <td style="text-align: center">{{$tt->dvt}}</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs mbs" onclick="add_hanghoa('{{'hh_'.$tt->id}}')">
                                                <i class="fa fa-edit"></i>&nbsp;Chọn</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function adddonvi(tendv){
            $('#modal-donvi').modal('hide');
            $('#dvyeucau').val(tendv);
        }

        function add_hanghoa(mahh){
            var element = document.getElementById(mahh);
            $('#mats').val(element.cells.item(1).innerText);
            $('#tents').val(element.cells.item(2).innerText);
            $('#thongsokt').val(element.cells.item(3).innerText);
            $('#nguongoc').val(element.cells.item(4).innerText);
            $('#dvt').val(element.cells.item(5).innerText).trigger('change');
            $('#modal-hanghoa').modal('hide');
        }

        function validateForm(){
            var validator = $("#update_hsthamdinh").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>

    @include('manage.include.form.modal_dvt')
    @include('includes.script.set_date_thoihanthamdinh')
    @include('includes.script.create-header-scripts')
@stop