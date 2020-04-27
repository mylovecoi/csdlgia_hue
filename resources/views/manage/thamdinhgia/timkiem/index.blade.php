@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop

@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    @include('includes.script.create-header-scripts')
@stop

@section('content')
    <h3 class="page-title">
        Tìm kiếm thông tin hồ sơ thẩm định giá
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::open(['url'=>'thamdinhgia/timkiem', 'method'=>'post' , 'id' => 'create_timkiem', 'class'=>'horizontal-form']) !!}
            {{--            <input type="hidden" name="madv" value="{{$inputs['madv']}}">--}}
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
                                                    <option value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên sản phẩm, dịch vụ</label>
                                    {!!Form::text('tents', null, array('tents' => 'giatri_tu','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời gian nhập - Từ</label>
                                    {!! Form::input('date', 'thoidiem_tu', null, array('id' => 'thoidiem_tu', 'class' => 'form-control'))!!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời gian nhập - Đến</label>
                                    {!! Form::input('date', 'thoidiem_den', null, array('id' => 'thoidiem_den', 'class' => 'form-control'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá đề nghị - Từ</label>
                                    {!!Form::text('nguyengiadenghi_tu', null, array('id' => 'nguyengiadenghi_tu','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá đề nghị - Đến</label>
                                    {!!Form::text('nguyengiadenghi_den', null, array('id' => 'nguyengiadenghi_den','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá thẩm định - Từ</label>
                                    {!!Form::text('nguyengiathamdinh_tu', null, array('id' => 'nguyengiathamdinh_tu','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá thẩm định - Đến</label>
                                    {!!Form::text('nguyengiathamdinh_den', null, array('id' => 'nguyengiathamdinh_den','class' => 'form-control','data-mask'=>'fdecimal'))!!}
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
    <!-- BEGIN DASHBOARD STATS -->
    <!-- END DASHBOARD STATS -->
@stop