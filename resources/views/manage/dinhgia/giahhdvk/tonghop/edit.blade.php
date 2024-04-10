@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            $(":input").inputmask();
        });
    </script>


    
@stop

@section('content')
    <h3 class="page-title">
        Tổn hợp giá hàng hóa dịch vụ<small> chỉnh sửa</small>
    </h3>
    <!-- END PAGE HEADER-->
<hr>
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/tonghop/store', 'class'=>'horizontal-form','id'=>'update_tonghopgiahhdvk', 'files'=>'true']) !!}
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Theo thông tư quyết định:</label>
                                    <label class="control-label" style="color: blue;font-weight: bold">{{$modelnhom->tentt}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tháng: </label>
                                    <label class="control-label" style="color: blue;font-weight: bold">{{$model->thang}}</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Năm: </label>
                                    <label class="control-label" style="color: blue;font-weight: bold">{{$model->nam}}</label>
                                </div>
                            </div>

                        </div>
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label">Thông tin báo cáo<span class="require">*</span></label>--}}
                                    {{--{!!Form::text('ttbc',null, array('id' => 'ttbc','class' => 'form-control required','autofocus'))!!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="control-label">Số báo cáo<span class="require">*</span></label>
                                {!!Form::text('sobc',null, array('id' => 'sobc','class' => 'form-control','autofocus','required'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngày báo cáo<span class="require">*</span></label>
                                    {!! Form::input('date', 'ngaybc', null, array('id' => 'ngaybc', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Thông tin hồ sơ</label>
                                    {!!Form::textarea('ttbc',null, array('id' => 'ttbc','class' => 'form-control', 'rows'=>'2'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm (Word)</label>
                                    @if($model->ipf_word != '')
                                        <a href="{{url('/data/giahhdvk/'.$model->ipf_word)}}" target="_blank">{{$model->ipf_word}}</a>
                                    @endif
                                    <input name="ipf_word" id="ipf_word" type="file" accept=".doc,.docx">
                                </div>
                            </div>
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm (PDF)</label>
                                    @if($model->ipf_pdf != '')
                                        <a href="{{url('/data/giahhdvk/'.$model->ipf_pdf)}}" target="_blank">{{$model->ipf_pdf}}</a>
                                    @endif
                                    <input name="ipf_pdf" id="ipf_pdf" type="file" accept=".pdf">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm (Excel)</label>
                                    @if($model->ipf_excel != '')
                                        <a href="{{url('/data/giahhdvk/'.$model->ipf_excel)}}" target="_blank">{{$model->ipf_excel}}</a>
                                    @endif
                                    <input name="ipf_excel" id="ipf_excel" type="file" accept=".xls,.xlsx">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                        <input type="hidden" name="matt" id="matt" value="{{$model->matt}}">
                        <input type="hidden" name="thang" id="thang" value="{{$model->thang}}">
                        <input type="hidden" name="nam" id="nam" value="{{$model->nam}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('/data/download/filemau/FileExcelGiaThiTruong116.xls')}}" target="_blank" class="btn btn-success btn-xs mbs"><i class="fa fa-file-excel-o"></i>&nbsp;Tải file mẫu</a> 
                                    &nbsp;
                                    <button type="button" onclick="setValExl()" class="btn btn-success btn-xs mbs" data-target="#modal-importexcel" data-toggle="modal">
                                        <i class="fa fa-file-excel-o"></i>&nbsp;Nhận dữ liệu</button>
                                
                                   
                                </div>
                            </div>                           
                        </div>
                        
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                    <tr>
                                        <th width="2%" style="text-align: center">STT</th>
                                        <th style="text-align: center">Mã <br> hàng hóa<br> dịch vụ</th>
                                        <th style="text-align: center">Tên hàng hóa dịch vụ</th>
                                        <th style="text-align: center" width="10%">Giá kỳ trước</th>
                                        <th style="text-align: center" width="10%">Giá kỳ này</th>
                                        <th style="text-align: center" width="15%">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="ttts">
                                        @foreach($modelct as $key=>$tt)
                                            <tr>
                                                <td style="text-align: center">{{$key+1}}</td>
                                                <td style="text-align: center">{{$tt->mahhdv}}</td>
                                                <td class="active" style="font-weight: bold">{{$a_dm[$tt->mahhdv] ?? ''}}</td>
                                                <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($tt->gialk,5)}}</td>
                                                <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($tt->gia,5)}}</td>
                                                <td>
                                                    <button type="button" onclick="editItem({{$tt->id}})" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs">
                                                        <i class="fa fa-edit"></i>&nbsp;Kê khai</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <a href="{{url($inputs['url'].'/tonghop')}}" class="btn btn-danger">
                        <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    <button type="reset" class="btn btn-default">
                        <i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                    <button type="submit" class="btn green" onclick="validateForm()">
                        <i class="fa fa-check"></i> Cập nhật</button>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create_tonghopgiahhdvk").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>



    <!--Modal Edit-->
    {{--<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>--}}
                    {{--<h4 class="modal-title">Tổng hợp giá hàng hóa dịch vụ khác </h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body" id="tttsedit">--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>--}}
                    {{--<button type="button" class="btn btn-primary" onclick="updatets()">Cập nhật</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
    @include('manage.dinhgia.giahhdvk.tonghop.modalct')
@stop