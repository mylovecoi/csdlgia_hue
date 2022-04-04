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
        function getId(maso){
            $('#frm_delete').find("[id='matt']").val(maso);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(maso){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_nhomdm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    matt: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='matt']").val(data.matt);
                    form.find("[name='tentt']").val(data.tentt);
                    form.find("[name='theodoi']").val(data.theodoi).trigger('change');
                    //form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='matt']").val('NEW');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục nhóm hàng hóa dịch vụ
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'danhmuc', 'modify'))
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
                            <th style="text-align: center" width="5%">STT</th>
                            <th style="text-align: center">Tên thông tư</th>
                            <th style="text-align: center">Ngày bắt đầu</th>
                            <th style="text-align: center">Ngày kết thúc</th>
                            <th style="text-align: center" width="8%">Theo dõi</th>
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$key + 1}}</td>
                            <td class="active" >{{$tt->noidung}}</td>
                            <td>{{getDayVn($tt->tungay)}}</td>
                            <td>{{getDayVn($tt->denngay)}}</td>
                            <td style="text-align: center">
                                @if($tt->trangthai == 'KTD')
                                    <span class="badge badge-active">Không theo dõi</span>
                                @else
                                    <span class="badge badge-success">Theo dõi</span>
                                @endif
                            </td>
                            <td>
                                
                                    <button type="button" onclick="ClickEdit('{{$tt->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                    <button type="button" onclick="getId('{{$tt->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                        <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                
                                    <a href="{{url($inputs['url'].'/ChiTietDM?masodanhmuc='.$tt->masodanhmuc)}}" class="btn btn-default btn-xs mbs">
                                        <i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                
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
                {!! Form::open(['url'=>$inputs['url'].'/DanhMuc', 'method'=>'post','id' => 'frm_create'])!!}
                <input type="hidden" name="masodanhmuc" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin thông tư, quyết định</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên thông tư, quyết định<span class="require">*</span></label>
                                <input name="noidung" id="noidung" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày bắt đầu<span class="require">*</span></label>
                                {!! Form::input('date', 'tungay', null, array('id' => 'tungay', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày kết thúc<span class="require">*</span></label>
                                {!! Form::input('date', 'denngay', null, array('id' => 'denngay', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Trạng thái</label>
                                <select name="trangthai" id="trangthai" class="form-control">
                                    <option value="TD">Đang theo dõi</option>
                                    <option value="KTD">Không theo dõi</option>
                                </select>
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
                {!! Form::open(['url'=>$inputs['url'].'/delete_nhomdm','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="matt" id="matt">
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
@stop