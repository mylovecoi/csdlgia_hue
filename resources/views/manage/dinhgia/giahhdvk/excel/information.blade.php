@extends('main')

@section('custom-style')
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
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
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">Nhận dữ liệu hàng hóa dịch vụ<small> từ file Excel</small> </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM -->
                    {!! Form::open(['url'=>'/giahhdvk/import_excel', 'method'=>'post' , 'files'=>true, 'id' => 'create_hscb','enctype'=>'multipart/form-data']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <input type="hidden" name="madiaban" value="{{$inputs['madiaban']}}" />
                        <div class="form-body">
                            <!-- Thông tin chung-->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN PORTLET-->
                                        <div class="portlet-body" style="display: block;">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Đơn vị báo cáo</label>
                                                            {!!Form::select('madv', $a_dv, null, array('id' => 'madv','class' => 'form-control select2me'))!!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tháng báo cáo<span class="require">*</span></label>
                                                            {!! Form::select(
                                                            'thang',
                                                            getThang()
                                                            ,date('m'),
                                                            array('id' => 'thang', 'class' => 'form-control'))
                                                            !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Năm báo cáo<span class="require">*</span></label>
                                                            <select name="nam" id="nam" class="form-control">
                                                                @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                                                @if ($nam_stop = intval(date('Y')) + 1) @endif
                                                                @for($i = $nam_start; $i <= $nam_stop; $i++)
                                                                    <option value="{{$i}}" {{$i == date('Y') ? 'selected' : ''}}>Năm {{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Mã hàng hóa<span class="require">*</span></label>
                                                            {!!Form::text('mahhdv', 'B', array('id' => 'mahhdv','class' => 'form-control required'))!!}
                                                        </div>
                                                    </div>
                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Loại giá<span class="require">*</span></label>
                                                            {!!Form::text('loaigia', 'F', array('id' => 'loaigia','class' => 'form-control required'))!!}
                                                        </div>
                                                    </div>
                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Giá liền kề<span class="require">*</span></label>
                                                            {!!Form::text('gialk', 'G', array('id' => 'gialk','class' => 'form-control required'))!!}
                                                        </div>
                                                    </div>
                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Giá kê khai<span class="require">*</span></label>
                                                            {!!Form::text('gia', 'H', array('id' => 'gia','class' => 'form-control required'))!!}
                                                        </div>
                                                    </div>
                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Nguồn thông tin<span class="require">*</span></label>
                                                            {!!Form::text('nguontt', 'K', array('id' => 'nguontt','class' => 'form-control required'))!!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Theo thông tư quyết định</label>
                                                        {!!Form::select('matt', $a_nhom, null, array('id' => 'matt','class' => 'form-control select2me'))!!}
                                                    </div>                                                

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Nhận từ dòng<span class="require">*</span></label>
                                                            {!!Form::text('tudong', '4', array('id' => 'tudong','class' => 'form-control required','data-mask'=>'fdecimal'))!!}
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Nhận đến dòng</label>
                                                            {!!Form::text('sodong', '111', array('id' => 'sodong','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!--/span-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label">File dữ liệu<span class="require">*</span></label>
                                                            <input id="fexcel" name="fexcel" type="file"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
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
                <a href="{{url('giahhdvkhac')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn default"><i class="fa fa-refresh"></i> Tải lại</button>
                <button type="submit" class="btn green" onclick="ClickCreate()"><i class="fa fa-plus"></i> Nhận dữ liệu</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <script>
        function ClickCreate(){
            var str = '';
            var ok = true;
            if (!$('#mahhdv').val()) {
                str += '  - Mã hàng hóa \n';
                $('#mahhdv').parent().addClass('has-error');
                ok = false;
            }

            if (!$('#loaigia').val()) {
                str += '  - Loại giá \n';
                $('#loaigia').parent().addClass('has-error');
                ok = false;
            }

            if (!$('#gialk').val()) {
                str += '  - Giá kỳ trước \n';
                $('#gialk').parent().addClass('has-error');
                ok = false;
            }

            if (!$('#gia').val()) {
                str += '  - Giá kỳ này \n';
                $('#gia').parent().addClass('has-error');
                ok = false;
            }
            if (!$('#nguontt').val()) {
                str += '  - Nguồn thông tin \n';
                $('#nguontt').parent().addClass('has-error');
                ok = false;
            }

            if (!$('#tudong').val()) {
                str += '  - Dòng bắt đầu nhận dữ liệu \n';
                $('#tudong').parent().addClass('has-error');
                ok = false;
            }

            if (!$('#sodong').val()) {
                str += '  - Số dòng dữ liệu \n';
                $('#sodong').parent().addClass('has-error');
                ok = false;
            }

            if (!$('#fexcel').val()) {
                str += '  - File Excel \n';
                $('#fexcel').parent().addClass('has-error');
                ok = false;
            }

            if (ok == false) {
                //alert('Các trường: \n' + str + 'Không được để trống');
                toastr.error('Thông tin: \n' + str + 'Không được để trống','Lỗi!.');
                $("form").submit(function (e) {
                    e.preventDefault();
                });
            }
            else {
                $("form").unbind('submit').submit();
            }
        }

    </script>
@stop