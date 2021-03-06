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

    </script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        Danh sách doanh nghiệp đăng ký tài khoản kê khai giá</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">

                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th style="text-align: center" width="5%">STT</th>
                                <th style="text-align: center" width="10%">Mã số thuế</th>
                                <th style="text-align: center" width="30%">Tên đơn vị</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Địa bàn đăng ký</th>
                                <th style="text-align: center">Tài khoản<br>truy cập</th>
                                <th style="text-align: center" width="5%">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($model as $key=>$tt)
                                    <tr class="odd gradeX">
                                        <td style="text-align: center">{{$key + 1}}</td>
                                        <td>{{$tt->madv}}</td>
                                        <td class="active" >{{$tt->tendn}}</td>
                                        <td>{{$tt->status}}</td>
                                        <td>{{$tt->tendiaban}}</td>
                                        <td>{{$tt->username}}</td>
                                        <td>
                                            <a href="{{url('/dangky/modify?madv='.$tt->madv)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Xét duyệt</a>
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
@stop