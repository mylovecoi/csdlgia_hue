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
                                <th rowspan="2" style="text-align: center">Tên sản phẩm, dịch vụ</th>
                                <th rowspan="2" style="text-align: center">Thông tin hồ sơ</th>
                                <th colspan="4" style="text-align: center">Mức thu học phí</th>
                                <th colspan="4" style="text-align: center">Mức thu học phí</th>
                                <th colspan="4" style="text-align: center">Mức thu học phí</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">Năm<br>học</th>
                                <th style="text-align: center">Thành<br>thị</th>
                                <th style="text-align: center">Nông<br>thôn</th>
                                <th style="text-align: center">Miền<br>núi</th>

                                <th style="text-align: center">Năm<br>học</th>
                                <th style="text-align: center">Thành<br>thị</th>
                                <th style="text-align: center">Nông<br>thôn</th>
                                <th style="text-align: center">Miền<br>núi</th>

                                <th style="text-align: center">Năm<br>học</th>
                                <th style="text-align: center">Thành<br>thị</th>
                                <th style="text-align: center">Nông<br>thôn</th>
                                <th style="text-align: center">Miền<br>núi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$a_donvi[$tt->madv] ?? ''}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td>{{$a_dm[$tt->maspdv] ?? ''}}</td>
                                    <td>{{$tt->mota}}</td>
                                    <td class="text-center">{{$tt->namapdung1}}</td>
                                    <td>{{dinhdangso($tt->giathanhthi1)}}</td>
                                    <td>{{dinhdangso($tt->gianongthon1)}}</td>
                                    <td>{{dinhdangso($tt->giamiennui1)}}</td>

                                    <td class="text-center">{{$tt->namapdung2}}</td>
                                    <td>{{dinhdangso($tt->giathanhthi2)}}</td>
                                    <td>{{dinhdangso($tt->gianongthon2)}}</td>
                                    <td>{{dinhdangso($tt->giamiennui2)}}</td>

                                    <td class="text-center">{{$tt->namapdung3}}</td>
                                    <td>{{dinhdangso($tt->giathanhthi3)}}</td>
                                    <td>{{dinhdangso($tt->gianongthon3)}}</td>
                                    <td>{{dinhdangso($tt->giamiennui3)}}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <a href="{{url('giadvgddt/timkiem')}}" class="btn btn-danger">
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