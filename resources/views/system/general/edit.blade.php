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
                                    <label class="control-label">Thông tin liên lạc</label>
                                    <textarea id="thongtinhd" class="form-control" name="thongtinhd" cols="10" rows="3"
                                        placeholder="Thông tin, số điện thoại liên lạc với các bộ phận">{{ $model->thongtinhd }}</textarea>
                                </div>
                            </div>
                        </div>

                        <h4>Thiết lập kết nối CSDL của Bộ</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Phân loại kết nối</label>
                                    {!! Form::select('phanloaiketnoi', getPhanLoaiKetNoi(), null, [
                                        'id' => 'phanloaiketnoi',
                                        'class' => 'form-control',
                                        'onchange' => 'setPhanLoaiKetNoi(this)',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Link API xác thực : </label>
                                    {!! Form::text('linkAPIXacthuc', null, ['id' => 'linkAPIXacthuc', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tài khoản đăng nhập : </label>
                                    {!! Form::text('taikhoanketnoi', null, ['id' => 'taikhoanketnoi', 'class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <label class="control-label">Mật khẩu : </label>
                                    <input id="matkhauketnoi" value="{{ $model->matkhauketnoi }}" class="form-control"
                                        name="matkhauketnoi" type="password" />
                                    <span class="input-group-btn">
                                        <button style="margin-top: 25px" onclick="AnHienMatKhau('matkhauketnoi')"
                                            class="btn blue" type="button"><i class="fa fa-eye"></i></button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mã AccessKey: </label>
                                    {!! Form::text('accesskey', null, ['id' => 'accesskey', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mã SecretKey: </label>
                                    {!! Form::text('secretkey', null, ['id' => 'secretkey', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mật khẩu : </label>
                                    {!! Form::text('matkhauketnoi', null, ['id' => 'matkhauketnoi', 'class' => 'form-control']) !!}
                                </div>
                            </div> --}}
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tự động truyền dữ liệu </label>
                                    {!! Form::select('linkAPIXacthuc',['1'=>'Truyền số liệu thủ công','2'=>'Tự động truyền số liệu theo tháng','3'=>'Tự động truyền số liệu theo quý','4'=>'Tự động truyền số liệu khi công bố',], null, ['id' => 'linkAPIXacthuc', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div> --}}
                        <hr>
                        <h4>Thiết lập khác</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File quy chế sử dụng phần mềm: </label>
                                    @if (isset($model->ipf4))
                                        <a href="{{ url('/data/huongdan/' . $model->ipf4) }}"
                                            target="_blank">{{ $model->ipf4 }}</a>
                                    @endif
                                    <input name="ipf4" id="ipf4" type="file">
                                </div>
                            </div>
                        </div>
                        @if (session('admin')->level == 'SSA')
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
                                        <input type="checkbox" id="hienanhdau" name="hienanhdau" class="md-check">
                                        <label for="hienanhdau">
                                            <span></span><span class="check"></span><span class="box"></span>Hiện con
                                            dấu xác nhận:</label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="control-label">Ảnh con dấu xác nhận: </label>
                                        @if (isset($model->ipf3))
                                            <a href="{{ url('/images/' . $model->ipf3) }}" target="_blank"><img
                                                    src="{{ url('/images/' . $model->ipf3) }}" width="96"></a>
                                        @endif
                                        <input name="ipf3" id="ipf3" type="file">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="hienthongbao" name="hienthongbao" class="md-check">
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
                                            <span></span><span class="check"></span><span class="box"></span>Chứng chỉ
                                            mạng</label>
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
        function AnHienMatKhau(name) {
            const elem = document.getElementById(name);
            var type = elem.type;
            if (elem.type == 'password')
                elem.type = 'text';
            else
                elem.type = 'password';
        }

        function setPhanLoaiKetNoi(obj) {

            if (obj.value == 'TAIKHOAN') {
                $('#taikhoanketnoi').prop('disabled', false);
                $('#matkhauketnoi').prop('disabled', false);

                $('#accesskey').prop('disabled', true);
                $('#secretkey').prop('disabled', true);
            } else {
                $('#taikhoanketnoi').prop('disabled', true);
                $('#matkhauketnoi').prop('disabled', true);

                $('#accesskey').prop('disabled', false);
                $('#secretkey').prop('disabled', false);
            }
        }

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

        jQuery(document).ready(function() {
            var phanloaiketnoi = "{{ $model->phanloaiketnoi }}";
            if (phanloaiketnoi == 'TAIKHOAN') {
                $('#taikhoanketnoi').prop('disabled', false);
                $('#matkhauketnoi').prop('disabled', false);
                $('#accesskey').prop('disabled', true);
                $('#secretkey').prop('disabled', true);
            } else {
                $('#taikhoanketnoi').prop('disabled', true);
                $('#matkhauketnoi').prop('disabled', true);
                $('#accesskey').prop('disabled', false);
                $('#secretkey').prop('disabled', false);
            }
        });
    </script>
    @include('includes.script.create-header-scripts')
@stop
