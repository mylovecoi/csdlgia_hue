@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    @stop

@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/baocao?';
                var url = current_path_url + 'matt=' + $('#matt').val();
                window.location.href = url;
            }

            $('#matt').change(function() {
                changeUrl();
            });
        });
    </script>

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
                        <div class="col-md-6">
                            <label>Nhóm hàng hóa, dịch vụ</label>
                            {!! Form::select('matt', $a_nhomhhdv, $inputs['matt'], array('id' => 'matt', 'class' => 'form-control select2me'))!!}
                        </div>
                        {{--<div class="col-md-2">--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Năm báo cáo</label>--}}
                                {{--{!! Form::select('nam', getNam(true), null, array('id' => 'nam', 'class' => 'form-control select2me'))!!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <ol>
                                <li>
                                    <a data-target="#pl1-thoai-confirm" data-toggle="modal" data-href="">Báo cáo giá bán lẻ hàng hóa thị trường</a>
                                </li>
                                @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'khac','baocao'))
                                    <li>
                                        <a data-target="#pl2-thoai-confirm" data-toggle="modal" data-href="">Báo cáo giá hàng hóa thị trường theo tháng</a>
                                    </li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.dinhgia.giahhdvk.reports.modal-thoai')
@stop