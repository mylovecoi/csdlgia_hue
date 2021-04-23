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
    <script>
        jQuery(document).ready(function() {
            //TableManaged.init();
            //InputMask();
            // $(":input").inputmask();
        });
    </script>
{{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}
@stop

@section('content')
    <h3 class="page-title">
        Hồ sơ giá đất<small> thêm mới</small>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::open(['url'=>'giadatphanloai/new', 'method'=>'post' , 'id' => 'create_thongtindaugiadat', 'class'=>'horizontal-form']) !!}
{{--            <input type="hidden" name="madv" value="{{$inputs['madv']}}">--}}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <h4 style="color: #0000ff">Thông tin hồ sơ</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn vị</label>
                                    <select class="form-control select2me" name="madv" id="madv">
                                        @foreach($m_diaban as $diaban)
                                            <optgroup label="{{$diaban->tendiaban}}">
                                                <?php $donvi = $m_donvi->where('madiaban',$diaban->madiaban); ?>
                                                @foreach($donvi as $ct)
                                                    <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Phân loại đất<span class="require">*</span></label>
                                    {!!Form::select('maloaidat', $a_loaidat, null, array('id' => 'maloaidat','class' => 'form-control', 'required','autofocus'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định phê duyệt<span class="require">*</span></label>
                                    {!!Form::text('soqd', null, array('id' => 'soqd','class' => 'form-control', 'required'))!!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Địa bàn</label>
                                    {!!Form::select('madiaban', array_column($m_diaban->where('level','H')->toarray(),'tendiaban', 'madiaban'),
                                        null, array('id' => 'madiaban','class' => 'form-control'))!!}
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label">Vị trí đất<span class="require">*</span></label>
                                    {!!Form::text('vitri', null, array('id' => 'vitri','class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @include('manage.include.form.input_dvt')
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Diện tích khu đất</label>
                                    {!!Form::text('dientich',null, array('id' => 'dientich','data-mask'=>'fdecimal','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Giá trị<span class="require">*</span></label>
                                    {!!Form::text('giatri',null, array('id' => 'giatri','data-mask'=>'fdecimal','class' => 'form-control','required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Ghi chú</label>
                                    {!!Form::textarea('ghichu',null, array('id' => 'ghichu','class' => 'form-control', 'rows'=>'2'))!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <a href="{{url('giadatphanloai/danhsach?madv='.$inputs['madv'])}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                    <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Hoàn thành</button>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    @include('manage.include.form.modal_dvt')
{{--    @include('includes.script.inputmask-ajax-scripts')--}}
    @include('includes.script.create-header-scripts')
@stop