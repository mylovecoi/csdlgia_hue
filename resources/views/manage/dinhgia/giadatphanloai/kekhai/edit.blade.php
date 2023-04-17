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
    <script src="{{url('assets/admin/pages/scripts/table-managed-class.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            TableManagedclass.init();
            function getHeSo(hscu, hsmoi) {
                if(hscu == 0){
                    return 0;
                }
                return parseFloat(hsmoi / hscu).toFixed(4);
            }
            $('#banggiadat').change(function () {
                $('#hesodc').val(getHeSo(getdl($('#banggiadat').val()),getdl($('#giacuthe').val())));
            });
            $('#giacuthe').change(function () {
                $('#hesodc').val(getHeSo(getdl($('#banggiadat').val()),getdl($('#giacuthe').val())));
            });
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
            $('#vitri').val(1).trigger('change');
            $('#banggiadat').val(0);
            $('#giacuthe').val(0);
            $('#hesodc').val(0);
            $('#id').val(-1);
            InputMask();
        }

        function capnhatts(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahs:$('#mahs').val(),
                    khuvuc: $('#khuvuc').val(),
                    vitri: $('#vitri').val(),
                    diagioitu: $('#diagioitu').val(),
                    diagioiden: $('#diagioiden').val(),
                    maloaidat: $('#maloaidat').val(),
                    banggiadat: $('#banggiadat').val(),
                    giacuthe:$('#giacuthe').val(),
                    hesodc:$('#hesodc').val(),
                    id:$('#id').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Cập nhật thông tin chi tiết hồ sơ thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");
                    }
                    else
                        toastr.error("Có lỗi khi thêm chi tiết hồ sơ.", "Lỗi!");
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
                    form.find("[name='id']").val(data.id);
                    form.find("[name='vitri']").val(data.vitri).trigger('change');
                    form.find("[name='maloaidat']").val(data.maloaidat).trigger('change');
                    form.find("[name='khuvuc']").val(data.khuvuc);
                    form.find("[name='banggiadat']").val(data.banggiadat);
                    form.find("[name='giacuthe']").val(data.giacuthe);
                    form.find("[name='hesodc']").val(data.hesodc);
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
                url: '{{$inputs['url']}}' + '/del_ct',
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

        function addkv(){
            $('#modal-khuvuc').modal('hide');
            var gt = $('#khuvuc_add').val();
            $('#khuvuc').append(new Option(gt, gt, true, true));
            $('#khuvuc').val(gt).trigger('change');
        }

        function setLoaiDat (maloaidat){
            $('#modal-loaidat').modal('hide');
            $('#maloaidat').val(maloaidat).trigger('change');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        {{session('admin')['a_chucnang']['giadatpl'] ?? 'giá đất theo phân loại'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/modify', 'class'=>'horizontal-form','files'=>true]) !!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                    <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">
                    <input type="hidden" name="trangthai" id="trangthai" value="{{$model->trangthai}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Địa bàn</label>
                                    {!!Form::select('madiaban', $a_diaban, null, array('id' => 'madiaban','class' => 'form-control'))!!}
                                </div>
                            </div>

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
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Thông tin hồ sơ</label>
                                    {!!Form::text('thongtin',null, array('id' => 'thongtin','class' => 'form-control'))!!}
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
                                        <a href="{{url('/data/giadatphanloai/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                    @endif
                                    <input name="ipf1" id="ipf1" type="file" accept="{{getFileExtension()}}" onchange="chkFile(this)" />
                                </div>
                            </div>
                        </div>

                        @if($inputs['act'] == 'true')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()">
                                            <i class="fa fa-plus"></i>&nbsp;Thêm mới vị trí</button>                                    &nbsp;
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                    <tr>
                                        <th width="2%" style="text-align: center">STT</th>
                                        <th style="text-align: center">Tên đường, giới hạn, khu vực</th>
                                        <th style="text-align: center">Loại đất</th>
                                        <th style="text-align: center">Địa giới - Từ</th>
                                        <th style="text-align: center">Địa giới - Đến</th>
                                        <th style="text-align: center">Vị trí</th>
                                        <th style="text-align: center" width="8%">Giá đất<br>tại bảng giá</th>
                                        <th style="text-align: center" width="8%">Giá đất<br>cụ thể</th>
                                        <th style="text-align: center" width="8%">Hệ số<br>điều chỉnh</th>
                                        <th style="text-align: center" width="10%">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <?php $i = 1; ?>
                                    <tbody id="ttts">
                                        @foreach($modelct as $key=>$tt)
                                            <tr>
                                                <td style="text-align: center">{{$i++}}</td>
                                                <td class="active" style="font-weight: bold">{{$tt->khuvuc}}</td>
                                                <td>{{$a_loaidat[$tt->maloaidat] ?? ''}}</td>
                                                <td class="text-center">{{$tt->diagioitu}}</td>
                                                <td class="text-center">{{$tt->diagioiden}}</td>
                                                <td class="text-center">{{$tt->vitri}}</td>
                                                <td style="text-align: right;">{{dinhdangsothapphan($tt->banggiadat,4)}}</td>
                                                <td style="text-align: right;">{{dinhdangsothapphan($tt->giacuthe,4)}}</td>
                                                <td style="text-align: right;">{{dinhdangsothapphan($tt->hesodc,4)}}</td>
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
                        <a href="{{url($inputs['url'].'/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                            <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        <button type="submit" class="btn green"><i class="fa fa-check"></i> Hoàn thành</button>
                    </div>
                </div>
        @endif
        {!! Form::close() !!}
        <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <!--Model frm_modify-->
    {!! Form::open(['method' => 'post', 'url'=>'', 'class'=>'horizontal-form','id'=>'frm_modify']) !!}
    <input type="hidden" name="id" id="id" />
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết hồ sơ</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label class="control-label">Tên đường, giới hạn, khu vực<span class="require">*</span></label>
                                {!!Form::select('khuvuc', $a_khuvuc ,null, array('id' => 'khuvuc','class' => 'form-control select2me'))!!}
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group" style="margin-top: 25px;">
                                <button type="button" class="btn btn-default" data-target="#modal-khuvuc" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label class="control-label">Loại đất</label>
                                {!!Form::select('maloaidat', $a_loaidat ,null, array('id' => 'maloaidat','class' => 'form-control select2me'))!!}
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group" style="margin-top: 25px;">
                                <button type="button" class="btn btn-default" data-target="#modal-loaidat" data-toggle="modal">
                                    <i class="fa fa-list"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Địa giới - Từ</label>
                                {!!Form::text('diagioitu', null, array('id' => 'diagioitu','class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Địa giới - Đến</label>
                                {!!Form::text('diagioiden', null, array('id' => 'diagioiden','class' => 'form-control'))!!}
                            </div>
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Vị trí</label>
                                {!!Form::select('vitri', ['1'=>'1','2'=>'2','3'=>'3','4'=>'4',] ,null, array('id' => 'vitri','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá tại bảng giá</label>
                                <input type="text" id="banggiadat" name="banggiadat" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá đất cụ thể</label>
                                <input type="text" id="giacuthe" name="giacuthe" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Hệ số điều chỉnh</label>
                                <input type="text" id="hesodc" name="hesodc" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
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

    <div id="modal-khuvuc" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin khu vực</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-control-label">Tên đường, giới hạn, khu vực<span class="require">*</span></label>
                            {!!Form::text('khuvuc_add', null, array('id' => 'khuvuc_add','class' => 'form-control','required'=>'required'))!!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="button" class="btn btn-primary" onclick="addkv()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-loaidat" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin loại đất</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="dulieubang table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center">STT</th>
                                        <th style="text-align: center">Phân loại</th>
                                        <th style="text-align: center">Mã loại đất</th>
                                        <th style="text-align: center">Tên loại đất</th>
                                        <th style="text-align: center" width="5%">Thao tác</th>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                <tbody id="ttts">
                                @foreach($m_loaidat as $key=>$tt)
                                    <tr>
                                        <td style="text-align: center">{{$i++}}</td>
                                        <td style="font-weight: bold">{{$tt->phanloai}}</td>
                                        <td class="active text-center">{{$tt->maloaidat}}</td>
                                        <td>{{$tt->loaidat}}</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs mbs" onclick="setLoaiDat('{{$tt->maloaidat}}')">
                                                <i class="fa fa-check-circle-o"></i>&nbsp;Chọn</button>
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

    @include('includes.script.set_date_thoihanthamdinh')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
    @include('includes.crumbs.scrip_chkFileExtension')
@stop