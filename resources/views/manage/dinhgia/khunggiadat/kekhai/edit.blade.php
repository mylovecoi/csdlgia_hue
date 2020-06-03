@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--Date-->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <!--End Date-->
@stop

@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>

    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(":input").inputmask();
        });
    </script>
    <!--End date new-->

    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
    </script>

@stop

@section('content')
    <h3 class="page-title">
        Thông tin hồ sơ khung giá đất
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <!--div class="portlet-title">
                </div-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/modify', 'class'=>'horizontal-form','id'=>'update_philephi', 'files'=>true]) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                        <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa bàn</label>
                                        {!!Form::select('madiaban', $a_diaban, null, array('id' => 'madiaban','class' => 'form-control select2me'))!!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Xã phường</label>
                                        {!!Form::select('maxp', $a_xp, null, array('id' => 'maxp','class' => 'form-control select2me'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Đơn vị ban hành<span class="require">*</span></label>
                                        {!!Form::text('dvbanhanh',null, array('id' => 'dvbanhanh','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ký hiệu văn bản<span class="require">*</span></label>
                                        {!!Form::text('kyhieuvb',null, array('id' => 'kyhieuvb','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ngày ban hành<span class="require">*</span></label>
                                        {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ngày áp dụng</label>
                                        {!! Form::input('date', 'ngayapdung', null, array('id' => 'ngayapdung', 'class' => 'form-control'))!!}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Tiêu đề</label>
                                        {!!Form::text('tieude',null, array('id' => 'tieude','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Ghi chú</label>
                                        {!!Form::text('ghichu',null, array('id' => 'ghichu','class' => 'form-control'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            {!!Form::hidden('mahs',null, array('id' => 'mahs','class' => 'form-control'))!!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">File đính kèm</label>
                                        @if($model->ipf1 != '')
                                            <a href="{{url('/data/khunggiadat/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                        @endif
                                        <input name="ipf1" id="ipf1" type="file">
                                    </div>
                                </div>
                            </div>

                        </div>
                    <!-- END FORM-->
                </div>
            </div>
            <div style="text-align: center">
                <a href="{{url($inputs['url'].'/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                    <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                @if(!isset($inputs['act']) || $inputs['act'] == 'true')
                    <button type="submit" class="btn green" onclick="validateForm()">
                        <i class="fa fa-check"></i> Cập nhật</button>
                @endif
            </div>

            <!-- END VALIDATION STATES-->
        </div>
        {!! Form::close() !!}
    </div>
    <script type="text/javascript">
        function validateForm(){
            var validator = $("#update_philephi").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>

    @include('includes.script.create-header-scripts')
    @include('includes.script.inputmask-ajax-scripts')
@stop