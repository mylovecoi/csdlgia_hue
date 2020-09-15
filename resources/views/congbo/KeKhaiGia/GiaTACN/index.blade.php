
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
        });

        $(function(){
            $('#nam').change(function() {
                changURL();
            });
            $('#ten').change(function() {
                changURL();
            });

        });
        function changURL() {
            var url = '{{$inputs['url']}}';
            var namhs = '&nam=' + $('#nam').val();
            var ten = '&madv=' + $('#madv').val();
            var url = url + '?' + namhs + ten;
            window.location.href = url;
        }
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light" style="min-height: 587px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="caption-subject theme-font bold uppercase">{{session('congbo')['chucnang']['tacn'] ?? 'Thức ăn chăn nuôi'}}</span>
                                </div>
                                <div class="tools">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Năm hồ sơ</label>
                                        <select name="nam" id="nam" class="form-control">
                                            @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                            @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                            @for($i = $nam_start; $i <= $nam_stop; $i++)
                                                <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tên doanh nghiệp kê khai</label>
                                        <select name="madv" id="madv" class="form-control select2me">
                                            @foreach($m_donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? 'selected' : ''}} value="{{$ct->madv}}">{{$ct->tendn}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="portlet-body">
                                <table id="sample_4" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center ; margin: auto" width="5%">STT</th>
                                        <th style="text-align: center">Ngày thực hiện<br>mức giá</th>
                                        <th style="text-align: center">Tên hàng hóa, dịch vụ</th>
                                        <th style="text-align: center" >Quy cách chất lượng</th>
                                        <th style="text-align: center" >Đơn vị tính</th>
                                        <th style="text-align: center" >Mức giá kê khai</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($model as $key=>$tt)
                                        <tr>
                                            <td style="text-align: center">{{$key+1}}</td>
                                            <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                            <td style="text-align: left">{{$tt->tendvcu}}</td>
                                            <td style="text-align: left">{{$tt->qccl}}</td>
                                            <td style="text-align: left">{{$tt->dvt}}</td>
                                            <td style="text-align: right;font-weight: bold">{{dinhdangso($tt->giakk)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop
