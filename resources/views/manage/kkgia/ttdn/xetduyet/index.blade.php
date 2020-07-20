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

            function changeUrl() {
                var current_path_url = '/doanhnghiep/xetduyet?';
                var url = current_path_url + 'madiaban=' + $('#madiaban').val();
                window.location.href = url;
            }

            $('#madiaban').change(function () {
                changeUrl();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        Xét duyệt {{session('admin')['a_chucnang']['thongtinkknygia'] ?? 'Thông tin doanh nghiệp'}}
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
{{--                        <a href="{{url('doanhnghiep/print?madv='.$inputs['madv'].'&nam='. $inputs['nam'])}}" class="btn btn-default btn-sm" target="_blank">--}}
{{--                            <i class="fa fa-print"></i> In danh sách</a>--}}
                    </div>
                </div>

                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-4">
                                <label style="font-weight: bold">Địa bàn</label>
                                {!!Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban','class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center">STT</th>
                                <th style="text-align: center">Tên doanh nghiệp</th>
                                <th style="text-align: center" width="20%">Ngày chuyển</th>
                                <th style="text-align: center" width="15%">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td style="text-align: left">{{$tt->tendn}}</td>
                                    <td class="text-center">{{getDateTime($tt->ngaychuyen)}}</td>
                                    <td>
                                        <a href="{{url('doanhnghiep/chitiet?madv='.$tt->madv)}}" class="btn btn-default btn-xs mbs" >
                                            <i class="fa fa-eye"></i>&nbsp;Chi tiết</a>
                                    </td>
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
{{--    @include('manage.include.form.modal_congbo')--}}
{{--    @include('manage.include.form.modal_approve_xd')--}}
{{--    @include('manage.include.form.modal_unapprove_xd')--}}
{{--    @include('manage.include.form.modal_del_hs')--}}
@stop