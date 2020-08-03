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
    <div class="container">
        <div class="row margin-top-10">
            <div class="col-sm-12">
                <div class="portlet box">
                    <div class="portlet-title">
                        <div class="caption text-uppercase">
                            <span class="caption-subject theme-font bold uppercase">{{session('congbo')['chucnang']['giahhdvcn'] ?? 'Giá hàng hóa, dịch vụ khác theo quy định của pháp luật chuyên ngành'}}</span>
                        </div>
                    </div>

                    <div class="portlet-body form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <label style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                        <hr>

                        <table id="sample_3" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="2%" style="text-align: center">STT</th>
                                <th style="text-align: center">Đơn vị nhập</th>
                                <th style="text-align: center">Thời điểm</th>
                                <th style="text-align: center">Tên sản phẩm, dịch vụ</th>
                                <th style="text-align: center">Thông tin hồ sơ</th>
                                <th style="text-align: center">Đơn giá</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$a_donvi[$tt->madv] ?? ''}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td>{{$tt->tenspdv}}</td>
                                    <td>{{$tt->mota}}</td>
                                    <td style="text-align: center">{{dinhdangso($tt->dongia)}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
