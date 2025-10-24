@extends('main')

@section('custom-style')
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--Date-->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <!--End Date-->
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{url('assets/admin/pages/scripts/form-wizard.js')}}"></script>

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            FormWizard.init();
            //TableManaged.init();
            $(":input").inputmask();
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">Nhận dữ liệu từ file Excel</h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM -->
                    {!! Form::open(['url'=>$inputs['url'].'/create_excel', 'method'=>'post' , 'files'=>true, 'id' => 'create_hscb','enctype'=>'multipart/form-data']) !!}
                        {{-- <input type="hidden" name="madv" value="{{$inputs['madv']}}"> --}}
                        <div class="form-body">
                            <!-- Thông tin chung-->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet-body" style="display: block;">
                                        <div class="form-body">
                                            <div class="row">                                               

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Tên tài khoản<span class="require">*</span></label>
                                                        {!!Form::text('name', 'B', array('id' => 'name','class' => 'form-control','required'))!!}
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Tên tài khoản truy cập<span class="require">*</span></label>
                                                        {!!Form::text('username', 'C', array('id' => 'username','class' => 'form-control','required'))!!}
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Mật khẩu truy cập<span class="require">*</span></label>
                                                        {!!Form::text('password', 'D', array('id' => 'password','class' => 'form-control','required'))!!}
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Mã đơn vị<span class="require">*</span></label>
                                                        {!!Form::text('madv', 'E', array('id' => 'madv','class' => 'form-control','required'))!!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Nhận từ dòng<span class="require">*</span></label>
                                                        {!!Form::text('tudong', '4', array('id' => 'tudong','class' => 'form-control','required','data-mask'=>'fdecimal'))!!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Nhận đến dòng</label>
                                                        {!!Form::text('dendong', '200', array('id' => 'dendong','class' => 'form-control','required','data-mask'=>'fdecimal'))!!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">File dữ liệu<span class="require">*</span></label>
                                                        <input id="fexcel" required name="fexcel" type="file"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                            </div>
                        </div>
                    <!-- END FORM-->
                </div>
            </div>
            <div class="col-md-12" style="text-align: center">
                <a href="{{url($inputs['url'])}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn default"><i class="fa fa-refresh"></i> Tải lại</button>
                <button type="submit" class="btn green" onclick="ClickCreate()" id="submitform" name="submitform"><i class="fa fa-plus"></i> Nhận dữ liệu</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <script>
        function ClickCreate(){
            btn.disabled = true;
            btn.innerText = 'Loading...'

        }

    </script>
    @include('includes.script.create-header-scripts')
    @include('includes.script.inputmask-ajax-scripts')
@stop