@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop


@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>

@stop

@section('content')


    <h3 class="page-title">
        Thông tin tài khoản<small> chỉnh sửa</small>
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
                    {!! Form::open([
                        'url' => '/doanhnghiep/dstaikhoan/store',
                        'method' => 'post',
                        'id' => 'create_tttaikhoan',
                        'class' => 'form control',
                        'files' => true,
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="form-body">
                        <input type="hidden" id="mahs" name="mahs" value="{{ $inputs['mahs'] }}">
                        <p style="color: #000000">Thông tin doanh nghiệp</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên doanh nghiệp<span class="require">*</span></label>
                                    {!! Form::text('tendn', null, ['id' => 'tendn', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mã số thuế hoặc mã số đăng ký KD<span
                                            class="require">*</span></label>
                                    {!! Form::text('madv', null, ['id' => 'madv', 'class' => 'form-control required', 'data-mask' => 'username']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Cơ quan quản lý xét duyệt đăng ký tài khoản</label>
                                    {!! Form::select('madiaban', array_column($m_diaban->toarray(), 'tendiaban', 'madiaban'), null, [
                                        'id' => 'madiaban',
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tài khoản truy cập<span class="require">*</span></label>
                                    {!! Form::text('username', null, ['id' => 'username', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mật khẩu<span class="require">*</span></label>
                                    {!! Form::text('password', null, ['id' => 'password', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                        </div>

                        <p style="color: #000000">Thông tin dịch vụ kê khai</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" onclick="add_lvkd()" data-toggle="modal" class="btn btn-default">
                                        <i class="fa fa-plus"></i>&nbsp;Thêm lĩnh vực kinh doanh</button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                        <tr>
                                            <th width="5%" style="text-align: center">STT</th>
                                            <th style="text-align: center">Tên ngành nghề kinh doanh</th>
                                            <th style="text-align: center">Đơn vị quản lý</th>
                                            <th style="text-align: center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ttts">
                                        @foreach ($modelct as $key => $ct)
                                            <tr>
                                                <td style="text-align: center">{{ $key + 1 }}</td>
                                                <td>{{ $ct->tennghe }}</td>
                                                <td>{{ $ct->tendv }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-default btn-xs mbs"
                                                        onclick="getidedit({{ $ct->manghe }});">
                                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                    <button type="button" data-target="#modal-delete" data-toggle="modal"
                                                        class="btn btn-default btn-xs mbs"
                                                        onclick="getid({{ $ct->id }});">
                                                        <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <a href="{{ url('doanhnghiep/dstaikhoan') }}" class="btn btn-danger"><i
                                class="fa fa-reply"></i>&nbsp;Quay
                            lại</a>
                        <button type="submit" class="btn green" onclick="validate()"><i class="fa fa-check"></i>Thêm
                            mới</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm() {

            var validator = $("#create_tttaikhoan").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Chưa nhập dữ liệu",
                }
            });
        }
    </script>
    <script type="text/javascript">
        function validate() {
            var chk = true;
            var str = '';
            var password = $("#password").val();
            var patte = new RegExp(
                "^(?=.*[A-Za-z@$!%*?&])(?=.*\\d)[A-Za-z@$!%*?&\\d]{6,}"); //6 ký tự, 1 số, 1 chữ cái hoặc 1 ký tự đặc biệt

            if (patte.test(password) == false) {
                str = str +
                    '\n - Mật khẩu mới cần thỏa mãn: độ dài tối thiểu 06 ký tự; ít nhất 01 chữ số; ít nhất 01 chữ cái hoặc ký tự đặc biệt. \n';
                chk = false;
            }

            if (chk == false) {
                toastr.error(str, 'Thông báo lỗi!!!');
                $("#password").focus();
                $("#create_tttaikhoan").submit(function(e) {
                    e.preventDefault();
                });
            } else {
                $("#create_tttaikhoan").unbind('submit').submit();
            }
        }
    </script>
    @include('includes.script.create-header-scripts')
    @include('system.company.include.js-modal')
@stop
