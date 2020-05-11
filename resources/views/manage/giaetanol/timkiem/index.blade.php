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
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Tìm kiếm thông tin đăng ký giá etanol
    </h3>
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::open(['url'=>$inputs['url'].'/timkiem', 'method'=>'post' , 'id' => 'create_timkiem', 'class'=>'horizontal-form']) !!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn vị</label>
                                    <select class="form-control select2me" name="madv" id="madv">
                                        <option value="all">-- Tất cả các đơn vị --</option>
                                        @foreach($m_diaban as $diaban)
                                            <optgroup label="{{$diaban->tendiaban}}">
                                                <?php $donvi = $m_donvi->where('madiaban',$diaban->madiaban); ?>
                                                @foreach($donvi as $ct)
                                                    <option value="{{$ct->madv}}">{{$ct->tendn}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngành nghề kê khai</label>
                                    <select class="form-control select2me" name="manghe" id="manghe">
                                        <option value="all">-- Tất cả ngành nghề --</option>
                                        @foreach($a_dm as $key=>$val)
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tên sản phẩm dịch vụ</label>
                                    {!!Form::text('tenhh', null, array('id' => 'tenhh','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời gian áp dụng từ</label>
                                    {!! Form::input('date', 'ngayapdung_tu', null, array('id' => 'ngayapdung_tu', 'class' => 'form-control'))!!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời gian áp dụng đến</label>
                                    {!! Form::input('date', 'ngayapdung_den', null, array('id' => 'ngayapdung_den', 'class' => 'form-control'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá từ</label>
                                    {!!Form::text('giakk_tu', null, array('id' => 'giakk_tu','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá đến</label>
                                    {!!Form::text('giakk_den', null, array('id' => 'giakk_den','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                    <button type="submit" class="btn green"><i class="fa fa-check"></i> Tìm kiếm</button>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <!-- END PAGE HEADER-->

    @include('includes.script.create-header-scripts')
@stop