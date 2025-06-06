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
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' 'unsafe-eval' www.googletagmanager.com connect.facebook.net www.googleadservices.com www.google-analytics.com googleads.g.doubleclick.net onesignal.com tpc.googlesyndication.com;">
    
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
    <link href="{{ url('assets/admin/pages/css/login-soft.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{ url('assets/global/css/components.css') }}" id="style_components" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css" />
    <link id="style_color" href="{{ url('assets/admin/layout/css/themes/darkblue.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->
    <!--link rel="shortcut icon" href="favicon.ico"/-->
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png') }}" type="image/x-icon">
    <script>
        $(function() {
            // Input Mask
            if ($.isFunction($.fn.inputmask)) {
                $("[data-mask]").each(function(i, el) {
                    var $this = $(el),
                        mask = $this.data('mask').toString(),
                        opts = {
                            numericInput: attrDefault($this, 'numeric', false),
                            radixPoint: attrDefault($this, 'radixPoint', ''),
                            rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
                        },
                        placeholder = attrDefault($this, 'placeholder', ''),
                        is_regex = attrDefault($this, 'isRegex', '');


                    if (placeholder.length) {
                        opts[placeholder] = placeholder;
                    }

                    switch (mask.toLowerCase()) {
                        case "phone":
                            mask = "(999) 999-9999";
                            break;

                        case "currency":
                        case "rcurrency":

                            var sign = attrDefault($this, 'sign', '$');;

                            mask = "999,999,999.99";

                            if ($this.data('mask').toLowerCase() == 'rcurrency') {
                                mask += ' ' + sign;
                            } else {
                                mask = sign + ' ' + mask;
                            }

                            opts.numericInput = true;
                            opts.rightAlignNumerics = false;
                            opts.radixPoint = '.';
                            break;

                        case "password":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._%-]{8,30}";
                            break;

                        case "email":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
                            break;

                        case "user":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,15}";
                            break;

                        case "username":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._-]{1,15}";
                            break;

                        case "inputText":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._-]";
                            break;

                        case "fdecimal":
                            mask = 'decimal';
                            $.extend(opts, {
                                autoGroup: true,
                                groupSize: 3,
                                radixPoint: attrDefault($this, 'rad', '.'),
                                groupSeparator: attrDefault($this, 'dec', ',')
                            });
                    }

                    if (is_regex) {
                        opts.regex = mask;
                        mask = 'Regex';
                    }

                    $this.inputmask(mask, opts);
                });
            }
        });
    </script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <!--a href="">
  <img src="{{ url('images/LIFESOFT.png') }}"  width="250" alt="Công ty TNHH phát triển phần mềm Cuộc Sống"/>
 </a-->
        <h2 style="text-transform: uppercase;"><b style="color: #000000">PHẦN MỀM CƠ SỞ DỮ LIỆU VỀ GIÁ
                {{ isset(getGeneralConfigs()['diadanh']) ? getGeneralConfigs()['diadanh'] : '' }}</b></h2>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="menu-toggler sidebar-toggler">
    </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        {!! Form::open([
            'url' => '/searchtkdangky',
            'id' => 'form-seachregister',
            'class' => 'form-horizontal form-validate',
        ]) !!}
        <div class="form-body">
            <h3>Kiểm tra tài khoản</h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Mã số thuế của doanh nghiệp</label>
                        {!! Form::text('madv', null, ['id' => 'madv', 'class' => 'form-control', 'data-mask'=>'inputText','required']) !!}
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ url('') }}" class="btn default">
                    <i class="m-icon-swapleft"></i> Quay lại </a>
                <button type="submit" class="btn blue pull-right">
                    Đồng ý <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
    <!-- END LOGIN -->
    <!-- BEGIN COPYRIGHT -->
    <div class="copyright">
        2016 - {{ date('Y') }}&copy; LifeSoft <a href="">Tiện ích hơn - Hiệu quả hơn</a>
    </div>




    <!-- END COPYRIGHT -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
<script src="{{ url('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ url('assets/global/plugins/excanvas.min.js') }}"></script>
<![endif]-->
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
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            Login.init();
            Demo.init();
            // init background slide images
            $.backstretch([
                "{{ url('assets/admin/pages/media/bg/3.jpg') }}",
                "{{ url('assets/admin/pages/media/bg/2.jpg') }}",
                "{{ url('assets/admin/pages/media/bg/1.jpg') }}",
                "{{ url('assets/admin/pages/media/bg/4.jpg') }}"
            ], {
                fade: 1000,
                duration: 8000
            });
        });
    </script>
</body>
<!-- END BODY -->

</html>
