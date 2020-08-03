@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
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
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>

@stop

@section('content')
    <h3 class="page-title">
        Thông tin doanh nghiệp<small> chỉnh sửa</small>
    </h3>
    <!-- END PAGE HEADER-->
<hr>
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title"></div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <table id="user" class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center;color: #5b9bd1"><b>Thông tin hiện tại</b></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"> <b>Tên doanh nghiệp</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->tendn}}</span> </td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Mã số thuế</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->madv}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa chỉ trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->diachi}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Điện thoại trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->tel}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Số fax trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->fax}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Email quản lý</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->email}}</span></td>
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<td style="width:15%"><b>Nơi đăng ký nộp thuế</b></td>--}}
                                    {{--<td style="width:35%"><span class="text-muted">{{$model->noidknopthue}}</span></td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<td style="width:15%"><b>Giấy phép kinh doanh</b></td>--}}
                                    {{--<td style="width:35%"><span class="text-muted">{{$model->giayphepkd}}</span></td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<td style="width:15%"><b>Giấy phép đăng ký kinh doanh</b></td>--}}
                                    {{--<td style="width:35%"><span class="text-muted"><a href="{{url('data/doanhnghiep/'.$model->tailieu)}}" target="_blank">Xem chi tiết</a></span></td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td style="width:15%"><b>Chức danh người ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->chucdanh}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Họ và tên người ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->nguoiky}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa bàn bàn đăng ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$a_diaban[$model->madiaban] ?? ''}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa danh</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->diadanh}}</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <tr>
                                        <th>STT</th>
                                        <th>Ngành nghề kinh doanh</th>
                                    </tr>
                                    @foreach($modellvcc as $key=> $lvcc)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>{{$a_nghe[$lvcc->manghe] ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @if(isset($modeltttd))
                                <div class="col-md-6">
                                    <table id="user" class="table table-bordered table-striped">
                                        <tbody>
                                        <tr><td colspan="2" style="text-align: center;color: #5b9bd1"><b>Thông tin thay đổi</b></td></tr>
                                        <tr>
                                            <td style="width:15%"><b>Tên doanh nghiệp</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->tendn}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Mã số thuế</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->madv}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Địa chỉ trụ sở chính</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->diachi}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Điện thoại trụ sở chính</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->tel}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Số fax trụ sở chính</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->fax}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Email quản lý</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->email}}</span></td>
                                        </tr>
                                        {{--                                    <tr>--}}
                                        {{--                                        <td style="width:15%"><b>Nơi đăng ký nộp thuế</b></td>--}}
                                        {{--                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->noidknopthue}}</span></td>--}}
                                        {{--                                    </tr>--}}
                                        {{--                                    <tr>--}}
                                        {{--                                        <td style="width:15%"><b>Giấy phép kinh doanh</b></td>--}}
                                        {{--                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->giayphepkd}}</span></td>--}}
                                        {{--                                    </tr>--}}
                                        {{--                                    <tr>--}}
                                        {{--                                        <td style="width:15%"><b>Giấy phép đăng ký kinh doanh</b></td>--}}
                                        {{--                                        <td style="width:35%">--}}
                                        {{--                                            @if($modeltttd->tailieu !='')--}}
                                        {{--                                                <span class="text-muted"><a href="{{url('data/doanhnghiep/'.$modeltttd->tailieu)}}" target="_blank">Xem chi tiết</a></span>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </td>--}}
                                        {{--                                    </tr>--}}
                                        <tr>
                                            <td style="width:15%"><b>Chức danh người ký</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->chucdanh}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Họ và tên người ký</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->nguoiky}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Địa bàn bàn đăng ký</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$a_diaban[$model->madiaban] ?? ''}}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="width:15%"><b>Địa danh</b></td>
                                            <td style="width:35%"><span class="text-muted">{{$modeltttd->diadanh}}</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                                        <tr>
                                            <th>STT</th>
                                            <th>Ngành nghề kinh doanh</th>
                                        </tr>
                                        @foreach($modeltttdct as $key=> $ttdncttd)
                                            <tr>
                                                <td class="text-center">{{$key+1}}</td>
                                                <td>{{$a_nghe[$ttdncttd->manghe] ?? ''}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="text-align: center">
        <div class="col-md-12">
            <a href="{{url('/doanhnghiep/xetduyet')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
            <a href="{{url('/doanhnghiep/thaydoi?madv='.$model->madv)}}" class="btn green"><i class="fa fa-check"></i>&nbsp;Thay đổi</a>
        </div>
    </div>
@stop