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
            $('#frm_delete').find("[id='maso']").val(maso);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(maso){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}' + '/show_dm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='thoigian']").val(data.thoigian);
                    form.find("[name='maso']").val(data.maso);
                    form.find("[name='tennha']").val(data.tennha);
                    form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                    form.find("[name='hientrang']").val(data.hientrang).trigger('change');
                    form.find("[name='diachi']").val(data.diachi);
                    form.find("[name='donviql']").val(data.donviql);
                    form.find("[name='dientich']").val(data.dientich);
                    form.find("[name='ghichu']").val(data.ghichu);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            //Nhà xã hội cho thuê
            form.find("[name='maso']").val('NEW');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục nhà ở xã hội, nhà ở công vụ
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuemuanhaxh', 'danhmuc','modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                                <tr>
                                    <th style="text-align: center" width="2%">STT</th>
                                    <th style="text-align: center">Phân loại</th>
                                    <th style="text-align: center">Tên nhà</th>
                                    <th style="text-align: center">Địa chỉ</th>
                                    <th style="text-align: center">Thời điểm</br>hoàn thành</th>
                                    <th style="text-align: center">Hiện trạng</th>
                                    <th style="text-align: center" width="20%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key=>$tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$a_phanloai[$tt->phanloai] ?? ''}}</td>
                                    <td class="active">{{$tt->tennha}}</td>
                                    <td>{{$tt->diachi}}</td>
                                    <td>{{getDayVn($tt->thoigian)}}</td>
                                    <td>{{$a_hientrang[$tt->hientrang] ?? ''}}</td>
                                    <td>
                                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuemuanhaxh', 'danhmuc','modify'))
                                            <button type="button" onclick="ClickEdit('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                            <button type="button" onclick="getId('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                                <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        @endif
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
    </div>
    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$url.'/danhmuc', 'method'=>'post','id' => 'frm_create'])!!}
                <input type="hidden" name="maso" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin nhà xã hội</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Thời gian hoàn thành</label>
                                {!! Form::input('date', 'thoigian', null, array('id' => 'thoigian', 'class' => 'form-control', 'required'))!!}
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Tên nhà xã hội<span class="require">*</span></label>
                                <input name="tennha" id="tennha" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Địa chỉ</label>
                                <input name="diachi" id="diachi" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Diện tích</label>
                                <input type="text" name="dientich" id="dientich" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Hiện trạng</label>
                                {!!Form::select('hientrang', $a_hientrang, 'CHUASD', array('id' => 'hientrang','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Phân loại</label>
                                {!!Form::select('phanloai', $a_phanloai, null, array('id' => 'phanloai','class' => 'form-control'))!!}
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
                {!! Form::open(['url'=>$url.'/delete_dm','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="maso" id="maso">
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
    @include('includes.script.create-header-scripts')
@stop