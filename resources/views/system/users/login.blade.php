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
	<meta charset="utf-8"/>
	<title>{{$pageTitle}}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' 'unsafe-eval' www.googletagmanager.com connect.facebook.net www.googleadservices.com www.google-analytics.com googleads.g.doubleclick.net onesignal.com tpc.googlesyndication.com;">
    
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{url('assets/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/admin/pages/css/login-soft.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES -->
	<link href="{{url('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
	<link id="style_color" href="{{url('assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{url('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<!--link rel="shortcut icon" href="favicon.ico"/-->
	<link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="">
		<img src="{{ url('images/LIFESOFT.png')}}"  width="180" alt="Công ty TNHH phát triển phần mềm Cuộc Sống"/>
	</a>
	<h2 style="text-transform: uppercase;"><b style="color: #32c5d2">PHẦN MỀM CƠ SỞ DỮ LIỆU VỀ GIÁ
			{{isset(getGeneralConfigs()['diadanh']) ? getGeneralConfigs()['diadanh'] : ''}}</b></h2>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
		{!! Form::open(['url'=>'/signin','id' => 'form-login', 'class'=>'form-horizontal form-validate']) !!}
		<p class="form-title"><span style="font-size: 19px">Đăng nhập hệ thống</span></p>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Nhập thông tin username và password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Tài khoản</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control required" type="text" autocomplete="off" placeholder="Tài khoản" name="username" id="username" autofocus
						value="{{$inputs['username'] ?? ''}}">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control required" type="password" autocomplete="off" placeholder="Mật khẩu" name="password" id="password"/>
			</div>
		</div>
		<div class="form-actions">
			{{--<button type="submit" class="btn red pull-left" id="login_button" onclick="validatePassword();">--}}
				{{--Đăng nhập <i class="m-icon-swapright m-icon-white"></i>--}}
			{{--</button>--}}
			<button type="submit" class="btn red pull-right" id="login_button" onclick="validatePassword();">
				Đăng nhập <i class="m-icon-swapright m-icon-white"></i>
			</button>
			<br>
		</div>
		{!! Form::close() !!}
		<div class="forget-password">
			{{--<p>--}}
				{{--Bạn quên mật khẩu truy cập? Click <a href="{{url('forgot_password')}}">--}}
					{{--here </a>--}}
			{{--</p>--}}
		</div>
		<div class="create-account">
			<div class="row">
				<p>
					Bạn chưa có tài khoản?&nbsp;  <b><a href="{{url('/doanhnghiep/dangky')}}">Đăng ký tài khoản</a></b>
				</p>
			</div>

			<div class="row">
				<p>
					<a href="{{url('/data/huongdan/')}}" target="_blank"><b>Tìm lại mật khẩu</b></a>
					<a class="pull-right"  href="{{url('thongtinhotro')}}" target="_blank"><b>Thông tin hỗ trợ</b></a>
				</p>
			</div>
			@if($inputs['ipf2'] != '')
				<div class="row">
					<p>
						<a href="{{url('/data/huongdan/'.$inputs['ipf2'])}}" target="_blank"><b>Tài liệu hướng dẫn đăng ký tài khoản</b></a>
					</p>
				</div>
			@endif
		</div>
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	Copyright &copy;  2016 - {{date('Y')}} LifeSoft <a href="" >Tiện ích hơn - Hiệu quả hơn</a>
</div>


<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{url('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{url('assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{url('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/global/plugins/backstretch/jquery.backstretch.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{url('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{url('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
<script src="{{url('assets/admin/pages/scripts/login-soft.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Login.init();
		Demo.init();
		// init background slide images
		$.backstretch([
					"{{url('assets/app/media/img/bg/bg-2.jpg')}}",
					"{{url('assets/app/media/img/bg/bg-4.jpg')}}",
					"{{url('assets/app/media/img/bg/bg-1.jpg')}}",
				], {
					fade: 1000,
					duration: 8000
				}
		);
	});
</script>
{{-- <script>
	$("#password").keydown(function(event){
		if(event.keyCode == 13){
			$("#login_button").click();
		}
	});
</script> --}}
<script type="text/javascript">
	function validatePassword(){

		var validator = $("#form-login").validate({
			rules: {
				username :"required",
				password :"required"

			},
			messages: {
				username :" Nhập username truy cập",
				password :" Nhập mật khẩu truy cập"
			}
		});
	}
</script>
</body>
<!-- END BODY -->
</html>