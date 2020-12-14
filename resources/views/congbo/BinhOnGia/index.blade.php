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
                var url = current_path_url + 'nam=' + $('#nam').val() + '&manghe=' + $('#manghe').val();
                window.location.href = url;
            }
            $('#nam').change(function() {
                changeUrl();
            });
            $('#manghe').change(function() {
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
                            <span class="caption-subject theme-font bold uppercase">{{session('congbo')['chucnang']['bog'] ?? 'Bình ổn giá'}}</span>
                        </div>
                    </div>

                    <div class="portlet-body form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <label style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-6">
                                    <label style="font-weight: bold">Ngành nghề kê khai</label>
                                    <select class="form-control select2me" name="manghe" id="manghe">
                                        <option value="all">-- Tất cả ngành nghề --</option>
                                        @foreach($a_bog as $key=>$val)
                                            <option {{$key == $inputs['manghe'] ? 'selected':''}} value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <hr>

                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th style="text-align: center ; margin: auto" width="2%">STT</th>
                                <th style="text-align: center" width="20%">Doanh nghiệp</th>
                                <th style="text-align: center" width="8%">Ngày thực hiện<br>mức giá</th>
                                <th style="text-align: center" >Tên hàng hóa dịch vụ</th>
                                <th style="text-align: center" >Quy cách chất lượng</th>
                                <th style="text-align: center" >Đơn vị tính</th>
                                <th style="text-align: center" >Mức giá kê khai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td class="active"><b>Tên DN: </b> {{$a_donvi[$tt->madv] ?? ''}}
                                        <br><b>Mã số thuế:</b> {{$tt->madv}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                    <td style="text-align: left">{{$tt->tenhh}}</td>
                                    <td style="text-align: left">{{$tt->quycach}}</td>
                                    <td style="text-align: left">{{$tt->dvt}}</td>
                                    <td style="text-align: right;font-weight: bold">{{number_format($tt->giakk)}}</td>
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
