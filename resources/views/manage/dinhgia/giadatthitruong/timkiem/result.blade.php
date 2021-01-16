@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
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
    <h3 class="page-title">
        Kết quả tìm kiếm hồ sơ
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body form-horizontal">
                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                        <tr class="text-center">
                            <th rowspan="2" width="5%">STT</th>
                            {{--                                        <th style="text-align: center">Khu vực</th>--}}
                            <th rowspan="2" style="text-align: center">Tên khu đất</th>
                            <th colspan="3">Giá đất</th>
                            <th colspan="3">Giá tài sản trên đất</th>
                            <th rowspan="2" style="text-align: center">Tổng giá trị </th>
                            <th rowspan="2" style="text-align: center">Kết quả đấu giá </th>
                        </tr>
                        <tr class="text-center">
                            <th>Diện<br>tích</th>
                            <th>Đơn<br>giá</th>
                            <th>Thành<br>tiền</th>
                            <th>Diện<br>tích</th>
                            <th>Đơn<br>giá</th>
                            <th>Thành<br>tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($model as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$i++}}</td>
                                <td class="active">{{$tt->tenkhudat}}</td>
                                <td>{{dinhdangsothapphan($tt->dientichdat)}}</td>
                                <td>{{dinhdangsothapphan($tt->dongiadat)}}</td>
                                <td>{{dinhdangsothapphan($tt->giatridat)}}</td>
                                <td>{{dinhdangsothapphan($tt->dientichts)}}</td>
                                <td>{{dinhdangsothapphan($tt->dongiats)}}</td>
                                <td>{{dinhdangsothapphan($tt->giatrits)}}</td>
                                <td>{{dinhdangsothapphan($tt->tonggiatri)}}</td>
                                <td>{{dinhdangsothapphan($tt->giadaugia)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <a href="{{url('giadatthitruong/timkiem')}}" class="btn btn-danger">
                                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

        </div>
        <!-- BEGIN DASHBOARD STATS -->
        <!-- END DASHBOARD STATS -->
        </div>
    </div>
@stop