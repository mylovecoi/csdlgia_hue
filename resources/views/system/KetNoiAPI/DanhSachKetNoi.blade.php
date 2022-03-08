@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
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
    <h3 class="page-title text-uppercase">
        Danh sách kết kết nối API - {{session('admin')['a_chucnang'][$inputs['maso']] ?? 'hồ sơ'}}
    </h3>
    <hr>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">

                    </div>
                </div>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <table id="sample_4" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th width="25%">Tên tài khoản</th>
                                    <th>Link kết nối</th>
                                    <th width="7%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                                @foreach($model as $val)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->linkAPI}}</td>
                                        <td class="text-center">
{{--                                            <button type="button" onclick="copylink('{{$val->linkAPI}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">--}}
{{--                                                <i class="fa fa-copy"></i></button>--}}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <a href="{{url('/KetNoiAPI/ThietLapChiTiet')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copylink(link) {
            navigatortor.clipboard.writeText(link);
            toastr.success("Đã sao chép link kết nối vào bộ nhớ.");
        }
    </script>
@stop