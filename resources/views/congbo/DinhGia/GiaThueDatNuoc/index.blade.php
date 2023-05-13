@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop

@section('custom-script-cb')
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
                var current_path_url = '{{$inputs['url']}}' + '?';
                var url = current_path_url + 'nam=' + $('#nam').val() + '&madiaban=' + $('#madiaban').val();
                window.location = validURL(url);
            }

            $('#nam').change(function() {
                changeUrl();
            });
            $('#madiaban').change(function () {
                changeUrl();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class=" col-sm-12">
        <h3 class="page-title">
            Thông tin giá thuê đất, nước
        </h3>
        <div class="portlet box">
            <div class="portlet-title">

            </div>

            <div class="portlet-body form-horizontal">
                <div class="row">
                    <div class="col-md-2">
                        <label style="font-weight: bold">Năm</label>
                        {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label style="font-weight: bold">Địa bàn</label>
                                {!!Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                </div>

                <table id="sample_4" class="table table-striped table-bordered table-hover" >
                <thead>
                <tr>
                    <th width="2%" style="text-align: center">STT</th>
                    <th style="text-align: center">Số quyết định</th>
                    <th style="text-align: center">Vị trí</th>
                    <th style="text-align: center">Ngày áp dụng</th>
                    <th style="text-align: center">Diện tích</th>
                    <th style="text-align: center">Đơn giá</th>
                    <th style="text-align: center">Ghi chú</th>
                </tr>
                </thead>

                    @foreach($model as $key=>$tt)
                        <tr>
                            <td style="text-align: center">{{$key + 1}}</td>
                            <td style="text-align: center">{{$tt->soqd}}</td>
                            <td style="text-align: left">{{$tt->vitri}}</td>
                            <td style="text-align: center">{{getDayVn($tt->ngayapdung)}}</td>
                            <td style="text-align: right">{{dinhdangso($tt->dientich)}}</td>
                            <td style="text-align: right">{{dinhdangso($tt->dongia)}}</td>
                            <td>{{$tt->ghichu}}</td>
                        </tr>
                    @endforeach
            </table>
            </div>
        </div>
    </div>

    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop
