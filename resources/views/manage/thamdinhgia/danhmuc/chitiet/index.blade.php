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
        });

        function ClickEdit(mahanghoa){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_dm_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahanghoa: mahanghoa
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='mahanghoa']").val(data.mahanghoa);
                    form.find("[name='tenhanghoa']").val(data.tenhanghoa);
                    form.find("[name='thongsokt']").val(data.thongsokt);
                    form.find("[name='xuatxu']").val(data.xuatxu);
                    form.find("[name='dvt']").val(data.dvt).trigger('change');
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='mahanghoa']").val(null);
            form.find("[name='mahanghoa']").val(null);
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Nhóm hàng hóa: {{$modelnhom->tennhom}}
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlthamdinhgia','thamdinhgia', 'dmhhthamdinhgia', 'danhmuc','modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                        <a href="{{url($inputs['url'].'/danhmuc')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-reply"></i> Quay lại </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Mã hàng hóa</th>
                            <th style="text-align: center">Tên hàng hóa</th>
                            <th style="text-align: center">Thông số kỹ thuật</th>
                            <th style="text-align: center">Xuất xứ</th>
                            <th style="text-align: center">Đơn vị<br>tính</th>
                            <th style="text-align: center">Theo dõi</th>
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center;">{{$key + 1}}</td>
                            <td class="active" >{{$tt->mahanghoa}}</td>
                            <td class="success" style="font-weight: bold">{{$tt->tenhanghoa}}</td>
                            <td>{{$tt->thongsokt}}</td>
                            <td>{{$tt->xuatxu}}</td>
                            <td style="text-align: center">{{$tt->dvt}}</td>
                            <td style="text-align: center">
                                @if($tt->theodoi == 'KTD')
                                    <span class="badge badge-active">Không theo dõi</span>
                                @else
                                    <span class="badge badge-success">Theo dõi</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" onclick="ClickEdit('{{$tt->mahanghoa}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                    <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/danhmuc/detail','id' => 'frm_create'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin hàng hóa!</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nhóm hàng hóa: <b style="color: blue"> {{$modelnhom->tennhom}}</b> </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mã hàng hóa<span class="require">*</span></label>
                                <input type="text" name="mahanghoa" id="mahanghoa" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên hàng hóa<span class="require">*</span></label>
                                <input type="text" name="tenhanghoa" id="tenhanghoa" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Thông số kỹ thuật<span class="require">*</span></label>
                                <input type="text" name="thongsokt" id="thongsokt" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Xuất xứ<span class="require">*</span></label>
                                <input type="text" name="xuatxu" id="xuatxu" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                @include('manage.include.form.input_dvt')
                            </div>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="manhom" id="manhom" value="{{$inputs['manhom']}}">
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickCreate()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

    @include('manage.include.form.modal_dvt')
@stop