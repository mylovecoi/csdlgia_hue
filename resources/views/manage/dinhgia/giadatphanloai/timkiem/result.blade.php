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
                    <table id="sample_3" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="2%" style="text-align: center">STT</th>
                                <th style="text-align: center">Địa bàn</th>
                                <th style="text-align: center">Thời điểm <br>xác định</th>
                                <th style="text-align: center">Vị trí đất</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td style="text-align: center">{{$a_diaban[$tt->madiaban] ?? ''}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td style="text-align: left">{{$tt->vitri}}</td>
                                    @include('manage.include.form.td_trangthai')
                                    <td></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

        </div>
        <!-- BEGIN DASHBOARD STATS -->
        <!-- END DASHBOARD STATS -->
        </div>
    </div>
@stop