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
                            <tr class="text-center">
                                <th rowspan="2"width="2%">STT</th>
                                <th rowspan="2">Đơn vị nhập liệu</th>
                                <th rowspan="2">Thời điểm</th>
                                <th rowspan="2">Mô tả</th>
                                <th rowspan="2">Phân loại</th>
                                <th rowspan="2">Tên phí, lệ phí</th>
                                <th rowspan="2">Phần<br>trăm</th>
                                <th colspan="2">Mức thu</th>
                            </tr>
                            <tr class="text-center">
                                <th>Từ</th>
                                <th>Đến</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$a_donvi[$tt->madv] ?? ''}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td>{{$tt->mota}}</td>
                                    <td>{{$tt->phanloai}}</td>
                                    <td>{{$tt->ptcp}}</td>
                                    <td style="text-align: center">{{$tt->phantram}}</td>
                                    <td style="text-align: center">{{dinhdangso($tt->mucthutu)}}</td>
                                    <td style="text-align: center">{{dinhdangso($tt->mucthuden)}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <a href="{{url('giaphilephi/timkiem')}}" class="btn btn-danger">
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