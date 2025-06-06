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
        function getId(mahhdv){
            $('#frm_delete').find("[id='mahhdv']").val(mahhdv);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(mahhdv){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_dm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahhdv: mahhdv
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    //form.find("[name='mahhdv']").prop('readonly', true);
                    form.find("[name='mahhdv']").val(data.mahhdv);
                    form.find("[name='tenhhdv']").val(data.tenhhdv);
                    form.find("[name='dacdiemkt']").val(data.dacdiemkt);
                    form.find("[name='dvt']").val(data.dvt).trigger('change');
                    //form.find("[name='theodoi']").val(data.theodoi).trigger('change');
                    form.find("[name='gia']").val(data.gia);
                    form.find("[name='loaigia']").val(data.loaigia);

                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='mahhdv']").val(null);
            form.find("[name='tenhhdv']").val(null);
            form.find("[name='dacdiemkt']").val(null);
            form.find("[name='gia']").val(null);
            form.find("[name='loaigia']").val(null);
            //form.find("[name='mahhdv']").prop('readonly', false);
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Danh mục vàng, ngoại tệ
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','hhdv', 'giavangngoaite', 'danhmuc', 'modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Mã số</th>
                            <th style="text-align: center">Tên hàng hóa, dịch vụ</th>
                            <th style="text-align: center">Đặc điểm kỹ thuật</th>
                            <th style="text-align: center">Đơn vị<br>tính</th>
                            <th style="text-align: center">Giá</th>
                            <th style="text-align: center">Loại giá</th>
{{--                            <th style="text-align: center">Theo dõi</th>--}}
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$key + 1}}</td>
                            <td>{{$tt->mahhdv}}</td>
                            <td class="success" style="font-weight: bold">{{$tt->tenhhdv}}</td>
                            <td>{{$tt->dacdiemkt}}</td>
                            <td style="text-align: center">{{$tt->dvt}}</td>
                            <td style="text-align: right">{{number_format($tt->gia)}}</td>
                            <td>{{$tt->loaigia}}</td>
{{--                            <td style="text-align: center">--}}
{{--                                @if($tt->theodoi == 'KTD')--}}
{{--                                    <span class="badge badge-active">Không theo dõi</span>--}}
{{--                                @else--}}
{{--                                    <span class="badge badge-success">Theo dõi</span>--}}
{{--                                @endif--}}
{{--                            </td>--}}
                            <td>
                                @if(chkPer('csdlmucgiahhdv','hhdv', 'giavangngoaite', 'danhmuc', 'modify'))
                                    <button type="button" onclick="ClickEdit('{{$tt->mahhdv}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                    <button type="button" onclick="getId('{{$tt->mahhdv}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
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
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/danhmuc','id' => 'frm_create'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới hàng hóa dịch vụ ?</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mã hàng hóa dịch vụ<span class="require">*</span></label>
                                <input type="text" name="mahhdv" id="mahhdv" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên hàng hóa, dịch vụ<span class="require">*</span></label>
                                <input type="text" name="tenhhdv" id="tenhhdv" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Đặc điểm kỹ thuật</label>
                                <input type="text" name="dacdiemkt" id="dacdiemkt" class="form-control">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Giá</label>
                                <input type="text" name="gia" id="gia" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Loại giá</label>
                                <input type="text" name="loaigia" id="loaigia" class="form-control">
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

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/delete_dm','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="mahhdv" id="mahhdv">
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @include('manage.include.form.modal_dvt')
@stop