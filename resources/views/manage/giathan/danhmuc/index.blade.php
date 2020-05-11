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
        function ClickUpdate(){
            $("#frm_update").unbind('submit').submit();
        }
        function ClickEdit(manghe, phanloai){
            $("#frm_update").find("[id='manghe']").val(manghe);
            $("#frm_update").find("[id='phanloai']").val(phanloai);
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin  mặt hàng<small>&nbsp;than</small>
    </h3>
    <!-- END PAGE HEADER-->
    {{--<div class="row">
        <div class="col-md-12">
            <div class="note note-success">
                <p>-Hàng hóa, dịch vụ thực hiện bình ổn giá: Quy định chi tiết tại Khoản 1 Điều 3- Nghị định số 177/2013/NĐ-CP ngày 14/11/2013</p>
                </p>
            </div>
        </div>
    </div>--}}

    <div class="row"  >
        <div class="col-md-12" >
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">

                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th style="text-align: center" width="5%">STT</th>
                                <th style="text-align: center">Nhóm mặt hàng</th>
                                <th style="text-align: center">Hình thức kê khai</th>
                                <th style="text-align: center" width="10%">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key=>$tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td class="active">{{$tt->tennghe}}</td>
                                    <td class="text-center">{{$a_phanloai[$tt->phanloai] ?? ''}}</td>
                                    <td>
                                        {{--@if(chkPer('csdlmucgiahhdv','bog', 'bog', 'danhmuc','modify'))--}}
                                        <button type="button" onclick="ClickEdit('{{$tt->manghe}}','{{$tt->phanloai}}')" class="btn btn-default btn-xs mbs" data-target="#modal-edit" data-toggle="modal">
                                            <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                        {{--@endif--}}
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

    <!--Model-edit-->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa mặt hàng than?</h4>
                </div>
                {!! Form::open(['url'=>$inputs['url'].'/mathang/update','id' => 'frm_update'])!!}
                <input type="hidden" name="manghe" id="manghe">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Phân loại kê khai</label>
                                {!! Form::select('phanloai', $a_phanloai, null,['id'=>'phanloai','class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
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