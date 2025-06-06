<!DOCTYPE html>
<html lang="en">
<head><title>Thông báo lỗi</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Loading bootstrap css-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700&subset=vietnamese' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">
    {{-- <link type="text/css" rel="stylesheet" href="{{ url('vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css')}}"> --}}
    <link rel="stylesheet" href="{{ url('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('vendors/bootstrap/css/bootstrap.min.css')}}">
    <!--Loading style vendors-->
    <link rel="stylesheet" href="{{ url('vendors/animate.css/animate.css')}}">
    <!--Loading style-->
    <link rel="stylesheet" href="{{ url('css/themes/style1/zvinhtq.css') }}">
    <link rel="stylesheet" href="{{ url('css/style-responsive.css') }}">
</head>
<body id="error-page" class="animated bounceInLeft">
<div id="error-page-content">
    <h1>Lỗi!</h1>
    <h3>{{isset($message) ? $message : 'Thông tin này không thuộc phạm vi quản lý của bạn!'}} </h3>
    <p><a href='{{isset($url) ? url($url) : url('/') }}'>Bấm vào đây</a> để quay lại.</p></div>
</div>
{{-- <script src="{{ url('js/jquery-1.9.1.js') }}"></script> --}}
{{-- <script src="{{ url('js/jquery-migrate-1.2.1.min.js') }}"></script> --}}
{{-- <script src="{{ url('js/jquery-ui.js') }}"></script> --}}
<!--loading bootstrap js-->
{{-- <script src="{{ url('vendors/bootstrap/js/bootstrap.min.js') }}"></script> --}}
{{-- <script src="{{ url('vendors/bootstrap-hover-dropdown.js') }}"></script> --}}
<script src="{{ url('js/html5shiv.js') }}"></script>
<script src="{{ url('js/respond.min.js') }}"></script>
</body>
</html>