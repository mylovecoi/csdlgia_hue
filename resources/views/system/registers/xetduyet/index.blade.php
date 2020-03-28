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
            $('#madiaban').change(function() {
                window.location.href = '{{$inputs['url']}}' + '/danhsach?madiaban=' + $(this).val();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Quản lý thông tin tài khoản<small>&nbsp; đăng ký</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label style="font-weight: bold">Địa bàn đăng ký</label>
                                {!! Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="5%">STT</th>
                            <th style="text-align: center">Tên doanh nghiệp</th>
                            <th style="text-align: center" width="10%">Mã số thuế</th>
                            <th style="text-align: center" width="10%">Trạng thái</th>
                            <th style="text-align: center" width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td class="active" ><b style="color: blue;">{{$tt->name}}</b><br>Ngày đăng ký:&nbsp;{{getDateTime($tt->created_at)}}<br>{{($tt->updated_at != $tt->created_at ? 'Ngày cập nhật: '.getDateTime($tt->updated_at) : '')}}</td>
                                <td>{{$tt->madv}}</td>
                                <td align="center">
                                    <span class="badge badge-danger">{{$tt->status}}</span>
                                    <br>
                                    @if($tt->status == 'Bị trả lại')
                                        <u>Lý do:</u> {{$tt->lydo}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url($inputs['url'].'/modify?madv='.$tt->madv)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
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
@stop