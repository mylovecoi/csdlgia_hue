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


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption text-uppercase">Nhận dữ liệu từ file Excel</div>
                    <div class="actions">
                        <a href="{{url($inputs['url'].'/file/excel')}}" class="btn btn-default btn-sm text-info">
                            <i class="fa fa-cloud-download"></i> Tải file mẫu</a>
                    </div>
                </div>

                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12 center">
                            <!-- BEGIN FORM -->
                        {!! Form::open(['url'=>$inputs['url'].'/create_excel', 'method'=>'post' , 'files'=>true, 'id' => 'create_hscb','enctype'=>'multipart/form-data']) !!}
                            <input type="hidden" name="madv" value="{{$inputs['madv']}}">
                            <div class="form-body">
                                @yield('thongtin')

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
                                            {!!Form::text('dendong', '111', array('id' => 'dendong','class' => 'form-control','required','data-mask'=>'fdecimal'))!!}
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
                            <!-- END FORM-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <a href="{{url($inputs['url'].'/danhsach')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                            <button type="submit" class="btn green" onclick="ClickCreate()" id="submitform" name="submitform"><i class="fa fa-plus"></i> Nhận dữ liệu</button>
                        </div>
                    </div>
                        {!! Form::close() !!}
                        <!-- END VALIDATION STATES-->

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
            <!-- BEGIN DASHBOARD STATS -->
            <!-- END DASHBOARD STATS -->
        </div>
    </div>


    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <script>
        function ClickCreate(){
            // var str = '';
            // var ok = true;
            // $("form").unbind('submit').submit();
            var btn = document.getElementById('submitform');
            btn.visible = false;
            //btn.innerText = 'Loading...'
        }

    </script>
    @include('includes.script.create-header-scripts')
    @include('includes.script.inputmask-ajax-scripts')
@stop