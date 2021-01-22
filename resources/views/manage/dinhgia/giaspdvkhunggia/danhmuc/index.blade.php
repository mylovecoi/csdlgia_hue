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
            $('#frm_delete').find("[id='maspdv']").val(maso);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(maso){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_dm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maspdv: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='maspdv']").val(data.maspdv);
                    form.find("[name='tenspdv']").val(data.tenspdv);
                    form.find("[name='dvt']").val(data.dvt).trigger('change');
                    // form.find("[name='mota']").val(data.mota);
                    form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            //Nhà xã hội cho thuê
            form.find("[name='maspdv']").val('NEW');
        }

        function addpl(){
            $('#modal-phanloai').modal('hide');
            var gt = $('#phanloai_add').val();
            $('#phanloai').append(new Option(gt, gt, true, true));
            $('#phanloai').val(gt).trigger('change');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục sản phẩm, dịch vụ
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giaspdvkhunggia', 'danhmuc','modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr>
                                <th width="2%" style="text-align: center">STT</th>
                                <th style="text-align: center">Phân loại</th>
                                <th style="text-align: center">Tên hàng hóa</th>
                                <th style="text-align: center">Đơn vị<br>tính</th>
{{--                                <th style="text-align: center">Mô tả</th>--}}
                                <th width="15%" style="text-align: center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td>{{$tt->phanloai}}</td>
                                <td class="success">{{$tt->tenspdv}}</td>
                                <td>{{$tt->dvt}}</td>
{{--                                <td>{{$tt->mota}}</td>--}}
                                <td>
                                    @if(chkPer('csdlmucgiahhdv','dinhgia', 'giaspdvtoida', 'danhmuc','modify'))
                                        <button type="button" onclick="ClickEdit('{{$tt->maspdv}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                            <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                        <button type="button" onclick="getId('{{$tt->maspdv}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

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
                {!! Form::open(['url'=>$inputs['url'].'/danhmuc', 'method'=>'post','id' => 'frm_create'])!!}
                <input type="hidden" name="maspdv" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin hàng hóa</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="control-label">Phân loại sản phẩm, dịch vụ</label>
                                {!!Form::select('phanloai', $a_phanloai, null, array('id' => 'phanloai','class' => 'form-control select2me'))!!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Thêm</label>
                                <button type="button" class="btn btn-default" data-target="#modal-phanloai" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên hàng hóa<span class="require">*</span></label>
                                <input name="tenspdv" id="tenspdv" class="form-control" required>
                            </div>
                        </div>
                    </div>

{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="control-label">Mô tả</label>--}}
{{--                                <input name="mota" id="mota" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                @include('manage.include.form.input_dvt')
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
                <input type="hidden" name="maspdv" id="maspdv">
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

    <div id="modal-phanloai" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin phân loại</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-control-label">Phân loại sản phẩm, dịch vụ<span class="require">*</span></label>
                            {!!Form::text('phanloai_add', null, array('id' => 'phanloai_add','class' => 'form-control','required'=>'required'))!!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button class="btn btn-primary" onclick="addpl()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    @include('manage.include.form.modal_dvt')
    @include('includes.script.create-header-scripts')
@stop