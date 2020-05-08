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

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/?';
                var url = current_path_url + 'nam=' + $('#nam').val();
                window.location.href = url;
            }
            $('#nam').change(function() {
                changeUrl();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class=" col-sm-12">
        <h3 class="page-title">
            Thông tin giá thuê, mua nhà ở xã hội
        </h3>
            <!-- BEGIN PORTLET-->
            <!--div class="portlet light"-->
        <div class="portlet box">
            <div class="portlet-title"></div>

            <div class="portlet-body form-horizontal">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label style="font-weight: bold">Năm</label>
                            {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                        </div>
                    </div>
                </div>

                <table id="sample_4" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Thời điểm</th>
                            <th style="text-align: center" >Quyết định</th>
                            <th style="text-align: center">Địa bàn</th>
                            <th style="text-align: center">Tên nhà</th>
                            <th style="text-align: center" >Đơn giá</th>
                            <th style="text-align: center" >Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($model as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td><b>{{getDayVn($tt->thoidiem)}}</b></td>
                                <td style="text-align: center">{{$tt->soqd}}</td>
                                <td><b>{{$a_diaban[$tt->madiaban] ?? ''}}</b></td>
                                <td style="text-align: left;"><b>{{$a_nhaxh[$tt->maso] ?? ''}}</b></td>
                                <td style="text-align: center">{{dinhdangso($tt->dongia)}}</td>
                                <td style="text-align: center">{{$tt->ghichu}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <!--/div-->
            <!-- END PORTLET-->
            </div>
        </div>
    </div>
@stop
