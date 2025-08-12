@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop


@section('custom-script-cb')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            $('#phanloai').change(function() {
                window.location.href = '/CBKetNoiAPI/ThietLapChung?phanloai=' + $('#phanloai').val();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="col-sm-12">
        <h3 class="page-title text-uppercase">
            Thiết lập hồ sơ kết nối API - {{session('admin')['a_chucnang'][$inputs['maso']] ?? 'hồ sơ'}}
        </h3>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box">
            <div class="portlet-title">
                <div class="actions">
                    <button type="button" onclick="add(-1)" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                        <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                    <button type="button" class="btn btn-default btn-xs mbs" data-target="#default-modal" data-toggle="modal">
                        <i class="fa fa-refresh"></i>&nbsp;Mặc định</button>
                </div>
            </div>
            <div class="portlet-body form-horizontal">
                <div class="row">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th>Tên trường</th>
                                <th>Tên dòng</th>
                                <th width="10%">Kiểu</th>
                                <th width="10%">Định dạng</th>
                                <th width="5%">Độ dài</th>
                                <th width="5%">Bắt buộc</th>
                                <th>Giá trị<br>mặc định</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $val)
                                <tr>
                                    <td>{{$val->stt}}</td>
                                    <td>{{$val->tentruong}}</td>
                                    <td>{{$val->tendong}}</td>
                                    <td>{{$val->kieudulieu}}</td>
                                    <td>{{$val->dinhdang}}</td>
                                    <td class="text-center">{{$val->dodai}}</td>
                                    <td class="text-center">{{$val->batbuoc}}</td>
                                    <td>{{$val->macdinh}}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="getHoSo('{{$val->id}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                            <i class="fa fa-edit"></i></button>
                                        <button type="button" onclick="getId('{{$val->id}}','{{$inputs['url'].'/XoaHoSo'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal">
                                            <i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <?php
                                    $chitiet = $model_ct->where('tendong_goc',$val->tendong);
                                ?>
                                @foreach($chitiet as $ct)
                                    <tr style="font-style: italic;">
                                        <td class="text-right">{{$ct->stt}}</td>
                                        <td>{{$ct->tentruong}}</td>
                                        <td>{{$ct->tendong}}</td>
                                        <td>{{$ct->kieudulieu}}</td>
                                        <td>{{$ct->dinhdang}}</td>
                                        <td class="text-center">{{$ct->dodai}}</td>
                                        <td class="text-center">{{$ct->batbuoc}}</td>
                                        <td>{{$ct->macdinh}}</td>
                                        <td class="text-center">
                                            <button type="button" onclick="getHoSoChiTiet('{{$ct->id}}','{{$val->tendong}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create-chitiet" data-toggle="modal">
                                                <i class="fa fa-edit"></i></button>
                                            <button type="button" onclick="getId('{{$ct->id}}','{{$inputs['url'].'/XoaHoSoChiTiet'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal">
                                                <i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <a href="{{url('/CBKetNoiAPI/ThietLapChiTiet')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/CBKetNoiAPI/LuuHoSo','id' => 'frm_create', 'method' => 'POST'])!!}
                <input type="hidden" name="id" />
                <input type="hidden" name="maso" value="{{$inputs['maso']}}" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên dòng (API)<span class="require">*</span></label>
                                {!!Form::text('tendong',null, array('class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên trường (CSDL)<span class="require">*</span></label>
                                {!!Form::text('tentruong',null, array('class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Kiểu dữ liệu<span class="require">*</span></label>
                                {!! Form::select('kieudulieu', getKieuDuLieu(), null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Định dạng</label>
                                {!!Form::text('dinhdang',null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Độ dài<span class="require">*</span></label>
                                {!!Form::text('dodai',null, array('class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Bắt buộc<span class="require">*</span></label>
                                {!! Form::select('batbuoc', ['0'=>'Không','1'=>'Có'], null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giá trị mặc định</label>
                                {!!Form::text('macdinh',null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Số thứ tự</label>
                                {!! Form::text('stt', $inputs['stt'], array('class' => 'form-control'))!!}
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

    {{--    Hồ sơ chi tiết--}}
    <div class="modal fade" id="modal-create-chitiet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/CBKetNoiAPI/LuuHoSoChiTiet','id' => 'frm_create_chitiet', 'method' => 'POST'])!!}
                <input type="hidden" name="id" />
                <input type="hidden" name="maso" value="{{$inputs['maso']}}" />
                <input type="hidden" name="tendong_goc" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên dòng (API)<span class="require">*</span></label>
                                {!!Form::text('tendong',null, array('class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên trường (CSDL)<span class="require">*</span></label>
                                {!!Form::text('tentruong',null, array('class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Kiểu dữ liệu<span class="require">*</span></label>
                                {!! Form::select('kieudulieu', getKieuDuLieu(), null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Định dạng</label>
                                {!!Form::text('dinhdang',null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Độ dài<span class="require">*</span></label>
                                {!!Form::text('dodai',null, array('class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Bắt buộc<span class="require">*</span></label>
                                {!! Form::select('batbuoc', ['0'=>'Không','1'=>'Có'], null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giá trị mặc định</label>
                                {!!Form::text('macdinh',null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Số thứ tự</label>
                                {!! Form::text('stt', $inputs['stt'], array('class' => 'form-control'))!!}
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

    <!--Modal Delete-->
    <div id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'/','id' => 'frm_delete'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickDelete()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!--Modal Default-->
    <div id="default-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>$inputs['url'].'/MacDinh','id' => 'frm_default','method'=>'POST'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý khôi phục?</h4>
                    <input type="hidden" name="maso" value="{{$inputs['maso']}}">

                </div>
                <div class="modal-body">
                    <p style="color: #0000FF">Bạn có chắc chắn muốn xóa hết thiết lập hiện tại để khôi phục về ban đầu không ?</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Chọn phân loại để lấy thông tin thiết lập</label>
                                {!! Form::select('machucnang', getAPITenThietLap(), null, array('class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <script>
        function getHoSo(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/CBKetNoiAPI/LayHoSo',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso,
                },
                dataType: 'JSON',
                success: function (data) {
                    $("#frm_create input[name=id]").val(data.id);
                    $("#frm_create input[name=stt]").val(data.stt);
                    $("#frm_create input[name=tentruong]").val(data.tentruong);
                    $("#frm_create input[name=tendong]").val(data.tendong);
                    $("#frm_create textarea[name=mota]").val(data.mota);
                    $("#frm_create select[name=kieudulieu]").val(data.kieudulieu).trigger('change');
                    $("#frm_create input[name=dinhdang]").val(data.dinhdang);
                    $("#frm_create input[name=dodai]").val(data.dodai);
                    $("#frm_create select[name=batbuoc]").val(data.batbuoc).trigger('change');
                    $("#frm_create input[name=macdinh]").val(data.macdinh);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function getHoSoChiTiet(maso, magoc) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/CBKetNoiAPI/LayHoSoChiTiet',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso,
                },
                dataType: 'JSON',
                success: function (data) {
                    $("#frm_create_chitiet input[name=id]").val(data.id);
                    $("#frm_create_chitiet input[name=stt]").val(data.stt);
                    $("#frm_create_chitiet input[name=tendong_goc]").val(data.tendong_goc);
                    $("#frm_create_chitiet input[name=tentruong]").val(data.tentruong);
                    $("#frm_create_chitiet input[name=tendong]").val(data.tendong);
                    $("#frm_create_chitiet textarea[name=mota]").val(data.mota);
                    $("#frm_create_chitiet select[name=kieudulieu]").val(data.kieudulieu).trigger('change');
                    $("#frm_create_chitiet input[name=dinhdang]").val(data.dinhdang);
                    $("#frm_create_chitiet input[name=dodai]").val(data.dodai);
                    $("#frm_create_chitiet select[name=batbuoc]").val(data.batbuoc).trigger('change');
                    $("#frm_create_chitiet input[name=macdinh]").val(data.macdinh);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function add(id) {
            $("#frm_create input[name=id]").val(id);
        }
        function getId(id, url){
            $('#frm_delete').attr('action', url);
            $("#frm_delete input[name=id]").val(id);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
    </script>
@stop