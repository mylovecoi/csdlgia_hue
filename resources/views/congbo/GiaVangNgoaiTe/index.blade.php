@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <!-- END THEME STYLES -->
@stop

@section('custom-script-cb')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            TableManaged.init();

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}';
                var url = current_path_url + '?nam=' + $('#nam').val() + '&thang=' + $('#thang').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });

            $('#thang').change(function() {
                changeUrl();
            });
        })

        
    </script>
@stop

@section('content-cb')

    <div class="container">
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <!-- BEGIN PORTLET-->
                <!--div class="portlet light"-->
                <div class="portlet-title">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light" style="min-height: 587px">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs font-green-sharp"></i>
                                        <span class="caption-subject theme-font bold uppercase">Giá vàng,ngoại tệ</span>
                                    </div>
                                    <div class="tools">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tháng báo cáo</label>
                                            {!! Form::select('thang', getThang(), $inputs['thang'], array('id' => 'thang', 'class' => 'form-control'))!!}
                                        </div>
                                    </div>
            
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Năm báo cáo</label>
                                            {!! Form::select('nam', getNam(), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                                        </div>
                                    </div>
                                </div>
                                <br>                               
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center">Ngày báo cáo</th>
                                                    <th style="text-align: center" width="15%">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($model) != 0)
                                                    @foreach ($model as $key => $tt)
                                                        <tr>
                                                            <td style="text-align: center">{{ getDayVn($tt->thoidiem) }}
                                                            </td>
                                                            <td>
                                                                <a href="{{url('/giavangngoaite/show?mahs='.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs">
                                                                    <i class="fa fa-eye"></i>&nbsp;Chi tiết</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td style="text-align: center" colspan="9">Không tìm thấy thông
                                                            tin. Bạn cần kiểm tra lại điều kiện tìm kiếm!!!</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>

                    <!--/div-->
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div>
    @include('includes.e.modal-attackfile')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop
