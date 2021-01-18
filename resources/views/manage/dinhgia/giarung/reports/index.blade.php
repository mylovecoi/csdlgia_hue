@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js') }}"></script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        Báo cáo tổng hợp {{session('admin')['a_chucnang']['giarung'] ?? 'giá rừng'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ol>
                                <li><a onclick="setPLHS('Khai thác')" data-target="#pl1-thoai-confirm" data-toggle="modal" data-href="">Báo cáo tổng hợp giá khai thác, thanh lý rừng</a> </li>
                                <li><a onclick="setPLHS('Thuê môi trường')" data-target="#pl1-thoai-confirm" data-toggle="modal" data-href="">Báo cáo tổng hợp giá dịch vụ môi trường rừng</a> </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.dinhgia.giarung.reports.modal-thoai')
@stop