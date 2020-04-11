@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
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
            $(":input").inputmask();

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/tonghop?';
                var url = current_path_url + 'nam=' + $('#nam').val() + '&matt=' + $('#matt').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });

            $('#matt').change(function() {
                changeUrl();
            });
        });

        function confirmDelete(id) {
            document.getElementById("iddelete").value=id;
        }

        function clickcreate(){
            $('#frm_create').submit();
        }

        function clickcreatethang(){
            $('#frm_createthang').submit();
        }
    </script>
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>
@stop

@section('content')

    <h3 class="page-title">
        Tổng hợp <small>&nbsp;giá hàng hóa dịch vụ</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-default btn-sm" data-target="#createthang-modal-confirm" data-toggle="modal">
                            <i class="fa fa-plus"></i>&nbsp;Tổng hợp tháng</button>
                        {{--                        @if($inputs['phanloai'] == 'thang')--}}
{{--                            <button type="button" class="btn btn-default btn-sm" data-target="#createthang-modal-confirm" data-toggle="modal">--}}
{{--                                <i class="fa fa-plus"></i>&nbsp;Tổng hợp tháng</button>--}}
{{--                        @else--}}
{{--                            <button type="button" class="btn btn-default btn-sm" data-target="#create-modal-confirm" data-toggle="modal"><--}}
{{--                                i class="fa fa-plus"></i>&nbsp;Tổng hợp</button>--}}
{{--                        @endif--}}
                            <!--div class="btn-group">
                                <a class="btn btn-default btn-sm" href="" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="fa fa-file-excel-o"></i>&nbsp;Nhận dữ liệu <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="">File dữ liệu mẫu</a>
                                    </li>
                                    <li>
                                        <a href="">Nhận dữ liệu</a>
                                    </li>
                                </ul>
                            </div-->
                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Năm hồ sơ</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                        <!--div class="col-md-3">
                            <div class="form-group">
                                <label>Phân loại</label>
                                <select name="phanloai" id="phanloai" class="form-control">
                                    <option value="15ngaydau" {{$inputs['phanloai'] == '15ngaydau' ? 'selected' : ''}}>15 ngày đầu tháng</option>
                                    <option value="15ngaycuoi" {{$inputs['phanloai'] == '15ngaycuoi' ? 'selected' : ''}}>15 ngày cuối tháng</option>
                                    <option value="thang" {{$inputs['phanloai'] == 'thang' ? 'selected' : ''}}>Tháng</option>
                                </select>
                            </div>
                        </div-->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nhóm hàng hóa</label>
                                {!! Form::select('matt', $a_tt, $inputs['matt'], array('id' => 'matt', 'class' => 'form-control'))!!}
                            </div>
                        </div>

                    </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th width="5%" style="text-align: center">STT</th>
                            <th style="text-align: center">Theo thông tư quyết định</th>
                            <th style="text-align: center" width="10%">Thời điểm báo cáo</th>
                            {{--<th style="text-align: center">Thông tin báo cáo</th>--}}
                            <th style="text-align: center" width="10%">Ngày báo cáo</th>
                            <th style="text-align: center" width="10%">Số báo cáo</th>
                            <th style="text-align: center" width="10%">Trạng thái</th>
                            <th style="text-align: center" >Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$ct)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td style="font-weight: bold">{{$a_tt[$ct->matt]}}</td>
                                <td style="font-weight: bold">Tháng {{$ct->thang}} /Năm {{$ct->nam}}</td>
                                {{--<td>{{$ct->ttbc}}</td>--}}
                                <td style="text-align: center">{{getDayVn($ct->ngaybc)}}</td>
                                <td style="text-align: center">{{$ct->sobc}}</td>
                                <td style="text-align: center">
                                    @if($ct->trangthai == 'HT')
                                        <span class="badge badge-warning">Hoàn thành</span>
                                    @elseif($ct->trangthai == 'CHT')
                                        <span class="badge badge-danger">Chưa hoàn thành</span>
                                    @elseif($ct->trangthai == 'HHT')
                                        <span class="badge badge-danger">Hủy hoàn thành</span>
                                    @else
                                        <span class="badge badge-success">Công bố</span>
                                    @endif
                                </td>
                                <td>
{{--                                    <a href="{{url($inputs['url'].'/tonghop/chitiet?mahs'.$ct->mahs)}}" class="btn btn-default btn-xs mbs" target="_blank">--}}
{{--                                        <i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>--}}
                                    <a href="{{url($inputs['url'].'/tonghop/edit?mahs='.$ct->mahs)}}" class="btn btn-default btn-xs mbs">
                                        <i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                    <a href="{{url($inputs['url'].'/tonghop/exportXML?mahs='.$ct->mahs)}}" class="btn btn-default btn-xs mbs">
                                        <i class="fa fa-file-code-o"></i>&nbsp;Xuất file XML</a>
                                    <a href="{{url($inputs['url'].'/tonghop/exportEx?mahs='.$ct->mahs)}}" class="btn btn-default btn-xs mbs">
                                        <i class="fa fa-file-code-o"></i>&nbsp;Xuất file Excel</a>
                                    <button type="button" onclick="confirmDelete('{{$ct->mahs}}','{{$inputs['url'].'/tonghop/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                        <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>

                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>
    @include('includes.e.modal-attackfile')
    <!--Modal Create-->
{{--    <div id="create-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">--}}
{{--        {!! Form::open(['url'=>'/tonghopgiahhdvk/create','id' => 'frm_create','method'=>'post'])!!}--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header modal-header-primary">--}}
{{--                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>--}}
{{--                    <h4 id="modal-header-primary-label" class="modal-title">Tổng hợp giá hàng hóa dịch vụ--}}
{{--                        @if($inputs['phanloai'] == '15ngaydau') <b>15 ngày đầu tháng</b>--}}
{{--                        @else <b>15 ngày cuối tháng</b>--}}
{{--                        @endif--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="form-horizontal">--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label>Phân loại thông tư quyết định</label>--}}
{{--                                <select name="mattbc" id="mattbc" class="form-control">--}}
{{--                                    @foreach($m_nhom as $ct)--}}
{{--                                        <option value="{{$ct->matt}}">{{$ct->tentt}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label>Tháng</label>--}}
{{--                                {!! Form::select(--}}
{{--                                'thangbc',--}}
{{--                                getThang()--}}
{{--                                ,date('m'),--}}
{{--                                array('id' => 'thangbc', 'class' => 'form-control'))--}}
{{--                                !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label>Năm</label>--}}
{{--                                <select name="nambc" id="nambc" class="form-control">--}}
{{--                                    @if ($nam_start = intval(date('Y')) - 5 ) @endif--}}
{{--                                    @if ($nam_stop = intval(date('Y')) + 1) @endif--}}
{{--                                    @for($i = $nam_start; $i <= $nam_stop; $i++)--}}
{{--                                        <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>--}}
{{--                                    @endfor--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <label>Ngày chốt báo cáo</label>--}}
{{--                                {!!Form::text('ngaychotbc','31/12/'.date('Y'), array('id' => 'ngaychotbc','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <input type="hidden" id="phanloaibc" name="phanloaibc" value="{{$inputs['phanloai']}}">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="modal-footer">--}}
{{--                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>--}}
{{--                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickcreate()">Đồng ý</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        {!! Form::close() !!}--}}
{{--    </div>--}}
    <!--Modal Delete-->

    <div id="createthang-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">
        {!! Form::open(['url'=>$inputs['url'].'/tonghop/createthang','id' => 'frm_createthang','method'=>'post'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Tổng hợp giá hàng hóa dịch vụ tháng
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Theo thông tư quyết định</label>
                                {!! Form::select('matt', $a_tt, $inputs['matt'], array('class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label>Tháng</label>
                                {!! Form::select('thang',getThang(),date('m'),array('id' => 'thang', 'class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-6">
                                <label>Năm</label>
                                {!! Form::select('nam', getNam(true), date('Y'), array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    @include('manage.include.form.modal_del_hs')
@stop