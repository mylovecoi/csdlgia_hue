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
            $('#phanloai').change(function() {
                window.location.href = '/KetNoiAPI/ThietLapChung?phanloai=' + $('#phanloai').val();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thiết lập kết nối API
    </h3>
    <hr>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
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
                        <div class="form-group">
                            <div class="col-md-6">
                                <label style="font-weight: bold">Phân loại</label>
                                {!! Form::select('phanloai', getPhanLoaiAPI(), $inputs['phanloai'], array('id' => 'phanloai', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <table id="sample_4" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th>Tên trường</th>
                                    <th>Mô tả</th>
                                    <th>Kiểu</th>
                                    <th>Định dạng</th>
                                    <th>Độ dài</th>
                                    <th>Bắt buộc</th>
                                    <th>Giá trị<br>mặc định</th>
                                    <th width="10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($model as $chitiet)
                                    <tr>
                                        <td>{{$chitiet->stt}}</td>
                                        <td>{{$chitiet->tendong}}</td>
                                        <td>{{$chitiet->mota}}</td>
                                        <td>{{$chitiet->kieudulieu}}</td>
                                        <td>{{$chitiet->dinhdang}}</td>
                                        <td>{{$chitiet->dodai}}</td>
                                        <td>{{$chitiet->batbuoc}}</td>
                                        <td>{{$chitiet->macdinh}}</td>
                                        <td class="text-center">
                                            <button type="button" onclick="change('{{$chitiet->id}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                                <i class="fa fa-edit"></i></button>
                                            <button type="button" onclick="getId('{{$chitiet->id}}','{{$inputs['url'].'/XoaTLChung'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal">
                                                <i class="fa fa-trash-o"></i></button>
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

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/KetNoiAPI/LuuChung','id' => 'frm_create'])!!}
                <input type="hidden" name="id" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phân loại<span class="require">*</span></label>
                                {!! Form::select('phanloai', getPhanLoaiAPI(), $inputs['phanloai'], array('class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tên trường<span class="require">*</span></label>
                                {!!Form::text('tendong',null, array('class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mô tả</label>
                                {!!Form::textarea('mota', null, array('class' => 'form-control', 'rows' => '2'))!!}
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
                    <input type="hidden" name="maso" value="{{$inputs['phanloai']}}">
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
        function change(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/KetNoiAPI/LayTLChung',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id,
                },
                dataType: 'JSON',
                success: function (data) {
                    $("#frm_create input[name=id]").val(data.id);
                    $("#frm_create input[name=stt]").val(data.stt);
                    $("#frm_create select[name=phanloai]").val(data.phanloai).trigger('change');
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