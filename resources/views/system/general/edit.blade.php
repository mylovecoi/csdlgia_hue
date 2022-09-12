@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop


@section('custom-script')
    {{-- <script type="text/javascript" src="{{ url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script> --}}
@stop

@section('content')
    <h3 class="page-title">
        Thông tin đơn vị quản lý<small> chỉnh sửa</small>
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
                    {!! Form::model($model, [
                        'method' => 'PATCH',
                        'url' => 'general/' . $model->id,
                        'class' => 'horizontal-form',
                        'id' => 'update_general',
                        'files' => true,
                    ]) !!}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Cấp bản quyền cho đơn vị<span
                                            class="require">*</span></label>
                                    {!! Form::text('tendonvi', null, ['id' => 'tendonvi', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mã quan hệ ngân sách<span class="require">*</span></label>
                                    {!! Form::text('maqhns', null, ['id' => 'maqhns', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ<span class="require">*</span></label>
                                    {!! Form::text('diachi', null, ['id' => 'diachi', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thông tin liên hệ<span class="require">*</span></label>
                                    {!! Form::text('tel', null, ['id' => 'tel', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-6"> --}}
                            {{-- <div class="form-group"> --}}
                            {{-- <label class="control-label">Thủ trưởng<span class="require">*</span></label> --}}
                            {{-- {!!Form::text('thutruong', null , array('id' => 'thutruong','class' => 'form-control required'))!!} --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- <!--/span--> --}}
                            {{-- <div class="col-md-6"> --}}
                            {{-- <div class="form-group"> --}}
                            {{-- <label class="control-label">Kế toán<span class="require">*</span></label> --}}
                            {{-- {!!Form::text('ketoan', null , array('id' => 'ketoan','class' => 'form-control required'))!!} --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- <!--/span--> --}}
                            {{-- </div> --}}
                            {{-- <div class="row"> --}}
                            {{-- <div class="col-md-6"> --}}
                            {{-- <div class="form-group"> --}}
                            {{-- <label class="control-label">Người lập biểu<span class="require">*</span></label> --}}
                            {{-- {!!Form::text('nguoilapbieu', null , array('id' => 'nguoilapbieu','class' => 'form-control required'))!!} --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Địa danh<span class="require">*</span></label>
                                    {!! Form::text('diadanh', null, ['id' => 'diadanh', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên đơn vị chủ quản hiển thị<span
                                            class="require">*</span></label>
                                    {!! Form::text('tendvcqhienthi', null, ['id' => 'tendvcqhienthi', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên đơn vị hiển thị<span class="require">*</span></label>
                                    {!! Form::text('tendvhienthi', null, ['id' => 'tendvhienthi', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Thông tin hợp đồng</label>
                                    <textarea id="thongtinhd" class="form-control" name="thongtinhd" cols="10" rows="3"
                                        placeholder="Thông tin, số điện thoại liên lạc với các bộ phận">{{ $model->thongtinhd }}</textarea>
                                </div>
                            </div>
                        </div>
                        @if (session('admin')->level == 'SSA')
                            <hr>
                            <h4>Thiết lập khác</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">File hướng dẫn sử dụng: </label>
                                        @if (isset($model->ipf1))
                                            <a href="{{ url('/data/huongdan/' . $model->ipf1) }}"
                                                target="_blank">{{ $model->ipf1 }}</a>
                                        @endif
                                        <input name="ipf1" id="ipf1" type="file">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">File hướng dẫn đăng ký tài khoản : </label>
                                        @if (isset($model->ipf1))
                                            <a href="{{ url('/data/huongdan/' . $model->ipf2) }}"
                                                target="_blank">{{ $model->ipf2 }}</a>
                                        @endif
                                        <input name="ipf2" id="ipf2" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="hienanhdau" name="hienanhdau"
                                            class="md-check">
                                        <label for="hienanhdau">
                                            <span></span><span class="check"></span><span class="box"></span>Hiện con dấu xác nhận:</label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label">Ảnh con dấu xác nhận: </label>
                                        @if (isset($model->ipf3))
                                            <a href="{{ url('/images/' . $model->ipf3) }}"
                                                target="_blank"><img src="{{ url('/images/' . $model->ipf3)}}" width="96"></a>                                               
                                        @endif
                                        <input name="ipf3" id="ipf3" type="file">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="hienthongbao" name="hienthongbao"
                                            class="md-check">
                                        <label for="hienthongbao">
                                            <span></span><span class="check"></span><span class="box"></span>Thông báo
                                            hệ thống</label>
                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label">Nội dung thông báo: </label>
                                        {!! Form::textarea('noidungthongbao', null, ['class' => 'form-control', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="hienchungchimang" name="hienchungchimang"
                                            class="md-check">
                                        <label for="hienchungchimang">
                                            <span></span><span class="check"></span><span class="box"></span>Chứng chỉ mạng</label>
                                    </div>
                                </div>

                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label">Thông tin chứng chỉ: </label>
                                        {!! Form::textarea('noidungchungchimang', null, ['class' => 'form-control', 'rows' => '2']) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Thời hạn trả hồ sơ lưu trú<span class="require">*</span></label>
                                            {!! Form::text('thoihanlt', null, [
                                                'id' => 'thoihanlt',
                                                'class' => 'form-control',
                                                'data-mask' => 'fdecimal',
                                                'style' => 'text-align: right',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Thời hạn trả hồ sơ vận tải<span class="require">*</span></label>
                                            {!! Form::text('thoihanvt', null, [
                                                'id' => 'thoihanvt',
                                                'class' => 'form-control',
                                                'data-mask' => 'fdecimal',
                                                'style' => 'text-align: right',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Thời hạn trả hồ sơ giá sữa<span class="require">*</span></label>
                                            {!! Form::text('thoihangs', null, [
                                                'id' => 'thoihangs',
                                                'class' => 'form-control',
                                                'data-mask' => 'fdecimal',
                                                'style' => 'text-align: right',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Thời hạn trả hồ sơ thức ăn chăn nuôi<span class="require">*</span></label>
                                            {!! Form::text('thoihantacn', null, [
                                                'id' => 'thoihantacn',
                                                'class' => 'form-control',
                                                'data-mask' => 'fdecimal',
                                                'style' => 'text-align: right',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div-->
                    </div>

                    <!-- END FORM-->
                </div>
            </div>

            <div style="text-align: center">
                <a href="{{ url('general') }}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập
                    nhật</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm() {

            var validator = $("#update_tttaikhoan").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Chưa nhập dữ liệu",
                }
            });
        }
    </script>
    @include('includes.script.create-header-scripts')
@stop
