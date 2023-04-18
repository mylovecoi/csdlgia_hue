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
        function getId(id){
            $('#frm_delete').find("[name='id']").val(id);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(maso){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/layTieuChi',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='masohanghoa_tieuchi']").val(data.masohanghoa_tieuchi).trigger('change');                    
                    form.find("[name='masohanghoa_ketqua']").val(data.masohanghoa_ketqua).trigger('change');
                    form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                    form.find("[name='tu']").val(data.tu);
                    form.find("[name='den']").val(data.den);
                    form.find("[name='ketqua']").val(data.ketqua);
                    form.find("[name='id']").val(data.id);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='id']").val('-1');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh sách dự báo thay đổi chỉ số CPI
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
                            <th style="text-align: center">Ngày lập</th>                            
                            <th style="text-align: center">Nội dung</th>
                            <th style="text-align: center">Kỳ báo cáo gốc</th>
                            <th style="text-align: center" width="10%">Thao tác</th>
                        </tr>
                        
                        </thead>
                        <tbody>
                           <?php $i=1; ?>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$i++}}</td>
                            <td>{{getDayVn($tt->ngaybaocao)}}</td>
                            <td class="text-center">{{$tt->noidung}}</td>
                            <td class="text-center">{{$tt->kybaocaogoc}}</td>
                            <td class="text-center">                                
                                    <button title="Sửa" type="button" onclick="ClickEdit('{{$tt->masokichban}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                        <i class="fa fa-edit"></i></button>
                                    <a title="Chi tiết tiêu chí" href="{{url($inputs['url'].'/ChiTiet?masokichban='.$tt->masokichban)}}" class="btn btn-default btn-xs mbs">
                                        <i class="fa fa-list"></i></a>
                                    <a title="Dự báo chỉ số" href="{{url($inputs['url'].'/DuBao?masokichban='.$tt->masokichban)}}" class="btn btn-default btn-xs mbs">
                                        <i class="fa fa-print"></i></a>
                                    <button title="Xoá" type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                        <i class="fa fa-trash-o"></i></button>
                                
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
                {!! Form::open(['url'=>$inputs['url'].'/KichBan', 'method'=>'post','id' => 'frm_create'])!!}
                <input type="hidden" name="id" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin kịch bản thay đổi</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mô tả kịch bản dự báo<span class="require">*</span></label>
                                {!!Form::textarea('noidung',  null, array('id' => 'noidung','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>                   
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Ngày bắt đầu<span class="require">*</span></label>
                                {!! Form::input('date', 'ngaybaocao', null, array('id' => 'ngaybaocao', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tháng cơ sở</label>
                                {!!Form::select('thang', getThang(), null, array('id' => 'thang','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Năm cơ sở</label>
                                {!!Form::select('nam', getNam(), null, array('id' => 'nam','class' => 'form-control'))!!}
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
                {!! Form::open(['url'=>$inputs['url'].'/Xoa','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="id" />
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