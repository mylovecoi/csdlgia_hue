<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.9.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ url('assets/global/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/pages/css/login-soft-register.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{ url('assets/global/css/components.css') }}" id="style_components" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css" />
    <link id="style_color" href="{{ url('assets/admin/layout/css/themes/darkblue.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" />
    <!-- END THEME STYLES -->
    <!--link rel="shortcut icon" href="favicon.ico"/-->
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png') }}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <style>
        option:first {
            color: #999;
        }
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <!--a href="">
        <img src="{{ url('images/LIFESOFT.png') }}"  width="130" alt="Công ty TNHH phát triển phần mềm Cuộc Sống"/>
    </a-->
        <h2 style="text-transform: uppercase;"><b style="color: white">ĐĂNG KÝ TÀI KHOẢN ĐĂNG NHẬP <br><br>PHẦN MỀM CƠ
                SỞ DỮ LIỆU VỀ GIÁ
                {{ isset(getGeneralConfigs()['diadanh']) ?? '' }}</b></h2>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="menu-toggler sidebar-toggler">
    </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN REGISTER FORM -->
        {!! Form::open([
            'url' => $inputs['url'] . '/themdn',
            'method' => 'post',
            'id' => 'register_create',
            'class' => 'form control',
            'files' => true,
            'enctype' => 'multipart/form-data',
        ]) !!}
        <!--form class="register-form" action="index.html" method="post" novalidate="novalidate" style="display: block;"-->
        <div class="row">
            <div class="col-md-12">
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
                            <label class="control-label">Mã số thuế hoặc mã số đăng ký KD</label>
                            {!! Form::text('madv', null, ['id' => 'madv', 'class' => 'form-control required', 'data-mask' => 'username']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Số điện thoại trụ sở chính</label>
                            {!! Form::text('tel', null, ['id' => 'tel', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Số fax trụ sở chính</label>
                            {!! Form::text('fax', null, ['id' => 'fax', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Địa chỉ trụ sở</label>
                            {!! Form::text('diachi', null, ['id' => 'diachi', 'class' => 'form-control required']) !!}
                            @if ($errors->any())
                                <em class="invalid">{{ $errors->first('diachi') }}</em>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control required']) !!}
                            {{-- {!!Form::text('email', null, array('id' => 'email','class' => 'form-control required','data-mask'=>'email'))!!} --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Địa danh</label>
                            {!! Form::text('diadanh', null, ['id' => 'diadanh', 'class' => 'form-control required']) !!}
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
                            <label class="control-label">Giấy đăng ký kinh doanh</label>
                            <input name="tailieu" id="tailieu" type="file" accept="{{ getFileExtension() }}"
                                onchange="chkFile(this)" />
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

                <p style="color: #000000">Thông tin đăng nhập</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Tài khoản đăng nhập</label>
                            {!! Form::text('taikhoandn', null, ['id' => 'taikhoandn', 'class' => 'form-control required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mật khẩu</label>
                            {{ Form::password('password', ['id' => 'password', 'class' => 'form-control required']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Nhập lại mật khẩu</label>
                            {{ Form::password('rpassword', ['id' => 'rpassword', 'class' => 'form-control required']) }}
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn"><a href="{{ url('login') }}">
                            <i class="m-icon-swapleft"></i> Quay lại </a> </button>
                    <button type="submit" class="btn blue pull-right" onclick="validate()" id="submitform"
                        name="submitform">
                        Đăng ký <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <!--/form-->
    </div>
    <!-- END LOGIN -->
    <!-- BEGIN COPYRIGHT -->
    <div class="copyright">
        Copyright &copy; 2016 - {{ date('Y') }} LifeSoft <a href="">Tiện ích hơn - Hiệu quả hơn</a>
    </div>
    <script></script>

    <!-- END COPYRIGHT -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]-->
    <script src="{{ url('assets/global/plugins/respond.min.js') }}"></script>
    <script src="{{ url('assets/global/plugins/excanvas.min.js') }}"></script>
    <!--[endif]-->
    <script src="{{ url('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ url('assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/layout/scripts/layout.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/layout/scripts/demo.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/pages/scripts/login-soft.js') }}" type="text/javascript"></script>
    <!--Toastr-->
    <script src="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
    <!--End Toastr-->
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    {{-- <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"> --}}
    </script>
    <script type="text/javascript"
        {{-- src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script> --}}
    <!-- END PAGE LEVEL PLUGINS -->
    {{-- <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script> --}}
    // <script src="{{ url('minhtran/jquery.inputmask.bundle.min.js') }}"></script>

    @include('includes.crumbs.scrip_chkFileExtension')
    <script>
        jQuery(document).ready(function() {
            //Metronic.init(); // init metronic core components
            //Layout.init(); // init current layout
            //Login.init();
            //Demo.init();
            // init background slide images
            $.backstretch([
                "{{ url('assets/app/media/img/bg/bg-2.jpg') }}",
                "{{ url('assets/app/media/img/bg/bg-4.jpg') }}",
                "{{ url('assets/app/media/img/bg/bg-1.jpg') }}",
            ], {
                fade: 1000,
                duration: 8000
            });
            // TableManaged.init();
            $(":input").inputmask();
        });
    </script>

    <script type="text/javascript">
        function validate() {
            var chk = true;
            var str = '';
            var password = $("#password").val();
            var rpassword = $("#rpassword").val();
            var patte = new RegExp(
                "^(?=.*[A-Za-z@$!%*?&])(?=.*\\d)[A-Za-z@$!%*?&\\d]{6,}"); //6 ký tự, 1 số, 1 chữ cái hoặc 1 ký tự đặc biệt

            if (patte.test(password) == false) {
                str = str +
                    '\n - Mật khẩu mới cần thỏa mãn: độ dài tối thiểu 06 ký tự; ít nhất 01 chữ số; ít nhất 01 chữ cái hoặc ký tự đặc biệt. \n';
                chk = false;
            }

            if (password != rpassword) {
                str = str + '\n - Mật khẩu mới không trùng nhau \n';
                chk = false;
            }

            if (chk == false) {
                toastr.error(str, 'Thông báo lỗi!!!');
                $("#password").focus();
                $("#register_create").submit(function(e) {
                    e.preventDefault();
                });
            } else {
                $("#register_create").unbind('submit').submit();
            }
        }
    </script>
    @include('includes.script.create-header-scripts')
    @include('system.company.include.js-modal')
</body>
<!-- END BODY -->

</html>
