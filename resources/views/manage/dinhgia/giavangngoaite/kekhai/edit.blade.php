@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop


@section('custom-script')
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
@stop

@section('content')
    <h3 class="page-title">
        Hồ sơ giá vàng, ngoại tệ<small> chỉnh sửa</small>
    </h3>
    <!-- END PAGE HEADER-->
<hr>
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/store', 'class'=>'horizontal-form','id'=>'update_giahhdvkhac']) !!}
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <h4 style="color: blue">Thông tin hồ sơ</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngày báo cáo<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Ghi chú</label>
                                    {!!Form::text('ghichu',null, array('id' => 'ghichu','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                        <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">
                        <h4 style="color: blue">Thông tin chi tiết</h4>
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                    <tr>
                                        <th width="2%" style="text-align: center">STT</th>
                                        <th style="text-align: center">Mã <br>hàng hóa<br> dịch vụ</th>
                                        <th style="text-align: center">Tên hàng hóa dịch vụ</th>
                                        <th style="text-align: center">Đặc điểm kỹ thuật</th>
                                        <th style="text-align: center">Đơn<br> vị<br> tính</th>
                                        <th style="text-align: center" width="10%">Giá mua</th>
                                        <th style="text-align: center" width="10%">Giá bán</th>
                                        <th style="text-align: center">Loại giá</th>
                                        <th style="text-align: center" width="15%">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="ttts">
                                    @foreach($modelct as $key=>$tt)
                                        <tr>
                                            <td style="text-align: center">{{$key+1}}</td>
                                            <td style="text-align: center">{{$tt->mahhdv}}</td>
                                            <td class="active" style="font-weight: bold">{{$tt->tenhhdv}}</td>
                                            <td style="text-align: left">{{$tt->dacdiemkt}}</td>
                                            <td style="text-align: center">{{$tt->dvt}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->gia)}}</td>
                                            <td style="text-align: right;font-weight: bold">{{number_format($tt->giaban)}}</td>
                                            <td style="text-align: left">{{$tt->loaigia}}</td>
                                            <td>
                                                @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                    <button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
                                                        <i class="fa fa-edit"></i>&nbsp;Nhập giá</button>
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
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <a href="{{url($inputs['url'].'/danhsach')}}" class="btn btn-danger">
                        <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    @if($inputs['act'] == 'true')
                        <button type="reset" class="btn btn-default">
                            <i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                        <button type="submit" class="btn green" onclick="validateForm()">
                            <i class="fa fa-check"></i>Hoàn thành</button>
                    @endif
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <script>
        function editItem(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/edit_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#tenhhdv').val(data.tenhhdv);
                    $('#gia').val(data.gia);
                    $('#giaban').val(data.giaban);
                    $('#ghichu').val(data.ghichu);
                    $('#nguontt').val(data.nguontt);
                    $('#loaigia').val(data.loaigia);
                    $('#id').val(data.id);
                    InputMask();
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }

        function updatets(){           
            var formData = new FormData($('#frm_chitiet')[0]);
            $.ajax({
                url: '{{$inputs['url']}}' + '/update_ct',
                method: "POST",
                cache: false,
                dataType: false,
                processData: false,
                contentType: false,
                data: formData,
                success: function(data) {
                    if(data.status == 'success') {                        
                        toastr.success("Chỉnh sửa thông tin hàng hóa dịch vụ thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-edit').modal("hide");
                    }else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            });
            $('#modal-edit').modal("hide");
        }            
    </script>
{!! Form::open([
    'url' => '',
    'id' => 'frm_chitiet',
    'class' => 'form',
]) !!}
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Kê khai giá thị trường </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="mahs" value="{{$model->mahs}}" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên hàng hóa </label>
                                {!!Form::text('tenhhdv', null, array('id' => 'tenhhdv','class' => 'form-control', 'disabled'=>'disabled'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Loại giá</label>
                                <select class="form-control" id="loaigia" name="loaigia">
                                    <option value="Giá bán buôn">Giá bán buôn</option>
                                    <option value="Giá bán lẻ">Giá bán lẻ</option>
                                    <option value="Giá kê khai">Giá kê khai</option>
                                    <option value="Giá đăng ký">Giá đăng ký</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Giá mua</label>
                                <input type="text" name="gia" id="gia" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Giá bán</label>
                                <input type="text" name="giaban" id="giaban" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nguồn thông tin</label>
                                <select class="form-control" id="nguontt" name="nguontt">
                                    <option value="Do trực tiếp điều tra, thu thập">Do trục tiếp điều tra, thu thập</option>
                                    <option value="Hợp đồng mua tin">Hợp đồng mua tin</option>
                                    <option value="Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định">Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định</option>
                                    <option value="Từ thống kê đăng ký giá, kê khai giá, thông báo giá của doanh nghiệp">Từ thống kê đăng ký giá, kê khai giá, thông báo giá của doanh nghiệp</option>
                                    <option value="Các nguồn thông tin khác">Các nguồn thông tin khác</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <input type="text" id="ghichu" name="ghichu" class="form-control">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id">
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
    {!! Form::close() !!}
    <script type="text/javascript">
        function validateForm(){
            var validator = $("#update_giahhdvkhac").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>


    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop