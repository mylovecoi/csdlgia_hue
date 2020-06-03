@extends('main')

@section('content')
    <h3 class="page-title">
       Báo cáo tổng hợp<small> giá hàng hóa dịch vụ khác</small>
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
                        <div class="col-lg-12">
                            <ol>
                                <li>
                                    <a data-target="#pl1-thoai-confirm" data-toggle="modal" data-href="">Báo cáo giá vàng, ngoại tệ theo ngày</a>
                                </li>

                                <li>
                                    <a data-target="#pl2-thoai-confirm" data-toggle="modal" data-href="">Tổng hợp giá vàng, ngoại tệ</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="pl1-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            {!! Form::open(['url'=>'','target'=>'_blank' , 'id' => 'frm_bc1', 'class'=>'form-horizontal form-validate']) !!}
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Báo cáo giá vàng, ngoại tệ</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Từ ngày</label>
                                <input type="date" id="ngaytu" name="ngaytu" class="form-control"  style="text-align: center" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Đến ngày</label>
                                <input type="date" id="ngayden" name="ngayden" class="form-control"  style="text-align: center" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC1('/giavangngoaite/bc1')">Đồng ý</button>
                    <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBCExcel('/reports/thuetn/bcgiathuetnexcel')">Xuất Excel</button-->
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!--Modal Thoại PL1-->
    <div id="pl2-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            {!! Form::open(['url'=>'','target'=>'_blank' , 'id' => 'frm_bc2', 'class'=>'form-horizontal form-validate']) !!}
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Báo cáo giá vàng, ngoại tệ</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label><b>Tháng</b></label>
                                {!! Form::select('thang',getThang(),date('m'),array('id' => 'thang', 'class' => 'form-control'))!!}
                            </div>
                            <div class="col-md-6">
                                <label><b>Năm</b></label>
                                {!! Form::select('nam',getNam(),date('Y'),array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC2('/giavangngoaite/bc2')">Đồng ý</button>
                    {{--<button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBc2Word('/reportshanghoadichvukhac/exWordBc2')">Xuất Word</button>--}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        function ClickBC1(url){
            if($('#ngaytu').val() == '' || $('#ngayden').val() == '' || $('#ngaytu').val() > $('#ngayden').val()){
                toastr.error('Ngày tháng kết xuất báo cáo không hợp lệ.','Thông báo lỗi')
            }else{
                $('#frm_bc1').attr('action',url);
                $('#frm_bc1').submit();
            }
        }
        function ClickBC2(url) {
            $('#frm_bc2').attr('action', url);
            $('#frm_bc2').submit();
        }

    </script>
@stop