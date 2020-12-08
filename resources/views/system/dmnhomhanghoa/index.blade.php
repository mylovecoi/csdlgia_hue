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
            $('#frm_delete').find("[id='manhom']").val(manhom);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
        function ClickEdit(manhom){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_dm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    manhom: manhom
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='trangthai']").val('EDIT');
                    form.find("[name='manhom']").prop('readonly', true);
                    form.find("[name='manhom']").val(data.manhom);
                    form.find("[name='tennhom']").val(data.tennhom);
                    form.find("[name='theodoi']").val(data.theodoi);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            //Nhà xã hội cho thuê
            form.find("[name='trangthai']").val('ADD');
            form.find("[name='manhom']").prop('readonly', false);
            form.find("[name='manhom']").val(null);
            form.find("[name='tennhom']").val(null);
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục nhóm hàng hóa
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
{{--                        @if(chkPer('csdlthamdinhgia','thamdinhgia', 'dmhhthamdinhgia', 'danhmuc','modify'))--}}
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
{{--                        @endif--}}
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center" width="10%">Mã nhóm</th>
                            <th style="text-align: center">Tên nhóm</th>
                            <th style="text-align: center" width="10%">Theo dõi</th>
                            <th style="text-align: center" width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$key + 1}}</td>
                            <td>{{$tt->manhom}}</td>
                            <td class="active" >{{$tt->tennhom}}</td>
                            <td style="text-align: center">
                                @if($tt->theodoi == 'KTD')
                                    <span class="badge badge-active">Không theo dõi</span>
                                @else
                                    <span class="badge badge-success">Theo dõi</span>
                                @endif
                            </td>
                            <td>
{{--                                @if(chkPer('csdlthamdinhgia','thamdinhgia', 'dmhhthamdinhgia', 'danhmuc', 'modify'))--}}
                                    <button type="button" onclick="ClickEdit('{{$tt->manhom}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
{{--                                    <button type="button" onclick="getId('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">--}}
{{--                                        <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>--}}
{{--                                @endif--}}
{{--                                @if($tt->theodoi == 'TD')--}}
{{--                                    <a href="{{url($inputs['url'].'/danhmuc/detail?&manhom='.$tt->manhom)}}" class="btn btn-default btn-xs mbs">--}}
{{--                                        <i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>--}}
{{--                                    <a href="{{url($inputs['url'].'/epExcel?&manhom='.$tt->manhom)}}" class="btn btn-default btn-xs mbs" target="_blank">--}}
{{--                                        <i class="fa fa-cloud-download"></i>&nbsp;Xuất dữ liệu</a>--}}
{{--                                @endif--}}
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
                {!! Form::open(['url'=>$inputs['url'].'/danhsach','id' => 'frm_create'])!!}
                <input type="hidden" name="trangthai" value="ADD" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới nhóm  hàng hóa?</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mã nhóm<span class="require">*</span></label>
                                <input type="text" name="manhom" id="manhom" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên nhóm<span class="require">*</span></label>
                                <input type="text" name="tennhom" id="tennhom" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Theo dõi<span class="require">*</span></label>
                                <select  name="theodoi" id="theodoi" class="form-control">
                                    <option value="KTD" >Dừng theo dõi</option>
                                    <option value="TD" >Theo dõi</option>
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
    <!--Model-edit-->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa nhóm thẩm định giá hàng hóa?</h4>
                </div>
                {!! Form::open(['url'=>'dmnhomhanghoa/update','id' => 'frm_update'])!!}
                <div class="modal-body" id="edit-tt">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickUpdate()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop