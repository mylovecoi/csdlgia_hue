@extends('main')

@section('custom-style')

@stop


@section('custom-script')

@stop

@section('content')


    <h3 class="page-title">
       Báo cáo tổng hợp đăng ký, kê khai mặt hàng bình ổn giá</small>
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
                                <li>
                                    <button data-target="#pl1-thoai-confirm" onclick="setUrl('{{$inputs['url'].'/bc1'}}')" data-toggle="modal" style="border-width: 0px" class="btn btn-default btn-xs mbs">Báo cáo tổng hợp giá đăng ký, kê khai theo thời điểm</button>
                                </li>
                                <li>
                                    <button data-target="#pl1-thoai-confirm" onclick="setUrl('{{$inputs['url'].'/bc2'}}')" data-toggle="modal" style="border-width: 0px" class="btn btn-default btn-xs mbs">Báo cáo chi tiết giá đăng ký, kê khai theo thời điểm</button>
                                </li>
                                {{--<li><a data-target="#pl2-thoai-confirm" data-toggle="modal" data-href="">Báo cáo chi tiết giá kê khai giá vật liệu xây dựng theo thời điểm</a> </li>--}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.bog.baocao.modal-thoai')
@stop