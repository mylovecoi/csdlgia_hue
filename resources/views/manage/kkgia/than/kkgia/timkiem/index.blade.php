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

        $(function(){
            $('#nam').change(function() {
                var namhs = $('#nam').val();
                var url = '/timkiemgiathan?'+namhs;
                window.location.href = url;
            });
            $('#mota').change(function() {
                var namhs = '&nam='+ $('#nam').val();
                var mota = '&mota=' + $('#mota').val();
                var url = '/timkiemgiathan?'+namhs + mota;
                window.location.href = url;
            });

        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Tìm kiếm thông tin kê khai giá<small>&nbsp;than</small>
    </h3>
    <hr>
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
                <label>Mô tả</label>
                <input type="text" class="form-control" id="mota" name="mota" value="{{$inputs['mota']}}">
            </div>
        </div>

    </div>


    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{url('timkiemgiathan/printf?&nam='.$inputs['nam'].'&mota='.$inputs['mota'])}}" class="btn btn-default btn-sm" target="_blank">
                            <i class="fa fa-print"></i> In trang </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_4">
                            <thead>
                            <tr>
                                <th style="text-align: center ; margin: auto" width="2%">STT</th>
                                <th style="text-align: center" width="20%">Doanh nghiệp</th>
                                <th style="text-align: center" width="8%">Ngày thực hiện<br>mức giá</th>
                                {{--<th style="text-align: center" >Thông tin hàng hóa dịch vụ</th>--}}
                                <th style="text-align: center" >Mô tả</th>
                                <th style="text-align: center" >Quy cách chất lượng</th>
                                <th style="text-align: center" >Đơn vị tính</th>
                                <th style="text-align: center" >Mức giá kê khai</th>
                                <th style="text-align: center" >Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td class="active"><b>Tên DN: </b> {{$tt->tendn}}
                                        <br><b>Mã số thuế:</b> {{$tt->madv}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                    {{--<td style="text-align: left">{{$tt->tthhdv}}</td>--}}
                                    <td style="text-align: left">{{$tt->tendvcu}}</td>
                                    <td style="text-align: left">{{$tt->qccl}}</td>
                                    <td style="text-align: left">{{$tt->dvt}}</td>
                                    <td style="text-align: right;font-weight: bold">{{number_format($tt->giakk)}}</td>
                                    <td style="text-align: left">{{$tt->ghichu}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

        <!-- BEGIN DASHBOARD STATS -->

        <!-- END DASHBOARD STATS -->
        <div class="clearfix"></div>

        @include('includes.script.create-header-scripts')
@stop