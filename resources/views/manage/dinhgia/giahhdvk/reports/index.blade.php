@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop

@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->

@stop

@section('content')
    <h3 class="page-title text-uppercase">
        Báo cáo tổng hợp {{session('admin')['a_chucnang']['giahhdvk'] ?? 'giá hàng hóa, dịch vụ'}}
    </h3>
    <!-- END PAGE HEADER-->
<hr>
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ol>
                                <li>
                                    <a data-target="#pl1-thoai-confirm" data-toggle="modal" data-href="">Báo cáo giá bán lẻ hàng hóa thị trường</a>
                                </li>

                                <li>
                                    <a data-target="#pl2-thoai-confirm" data-toggle="modal" data-href="">Báo cáo giá hàng hóa thị trường theo tháng</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.dinhgia.giahhdvk.reports.modal-thoai')
@stop