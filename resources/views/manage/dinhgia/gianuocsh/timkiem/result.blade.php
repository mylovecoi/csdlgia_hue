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
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" width="2%" style="text-align: center">STT</th>
                                <th rowspan="2" style="text-align: center">Đơn vị nhập</th>
                                <th rowspan="2" style="text-align: center">Thời điểm</th>
                                <th rowspan="2" style="text-align: center">Đối tượng sử dụng</th>
                                <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                                <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                                <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                                <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                                <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                            </tr>
                            <tr>
                                @for($i=0; $i < 5; $i++)
                                    <th style="text-align: center">Năm<br>áp<br>dụng</th>
                                    <th width="7%" style="text-align: center">Giá<br>tiền</th>
                                @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$a_donvi[$tt->madv] ?? ''}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td>{{$tt->doituongsd}}</td>
                                    <td class="text-center">{{$tt->namchuathue}}</td>
                                    <td class="text-right">{{dinhdangsothapphan($tt->giachuathue)}}</td>
                                    <td class="text-center">{{$tt->namchuathue1}}</td>
                                    <td class="text-right">{{dinhdangsothapphan($tt->giachuathue1)}}</td>
                                    <td class="text-center">{{$tt->namchuathue2}}</td>
                                    <td class="text-right">{{dinhdangsothapphan($tt->giachuathue2)}}</td>
                                    <td class="text-center">{{$tt->namchuathue3}}</td>
                                    <td class="text-right">{{dinhdangsothapphan($tt->giachuathue3)}}</td>
                                    <td class="text-center">{{$tt->namchuathue4}}</td>
                                    <td class="text-right">{{dinhdangsothapphan($tt->giachuathue4)}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <a href="{{url('gianuocsachsinhhoat/timkiem')}}" class="btn btn-danger">
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