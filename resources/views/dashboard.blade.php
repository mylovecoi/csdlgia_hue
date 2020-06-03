@extends('main')

@section('custom-style')
    <style type="text/css">
        table, p {
        }
        table tr td:first-child {
            text-align: center;
        }
        td, th {
            padding: 10px;
        }
    </style>
@stop


@section('custom-script')

@stop

@section('content')
{{--    <h3 class="page-title">--}}
{{--        Màn hình thống kê--}}
{{--    </h3>--}}
{{--    <div class="row">--}}
{{--        @if(chkPer('csdlmucgiahhdv','bog', 'bog', 'hoso', 'index')--}}
{{--            && (session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA'))--}}
{{--            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
{{--                <div class="dashboard-stat purple-plum">--}}
{{--                    <div class="visual">--}}
{{--                        <i class="fa fa-building"></i>--}}
{{--                    </div>--}}
{{--                    <div class="details">--}}
{{--                        <div class="number"></div>--}}
{{--                        {{session('admin')['a_chucnang']['bog'] ?? 'Bình ổn giá'}}--}}
{{--                        <div class="desc">--}}
{{--                            <h5>Chờ nhận:  hồ sơ</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a class="more" href="{{url('/binhongia/xetduyet')}}">--}}
{{--                        Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}

    <h3 class="page-title">
        Thông tin hỗ trợ<small></small>
    </h3>
    @include('supports')
@stop