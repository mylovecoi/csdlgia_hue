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
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{$pageTitle}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <!--link href="{{url('assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css"-->
    <link href="{{url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet')}}" type="text/css"/>
    <link href="{{url('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{url('assets/admin/pages/css/tasks.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}"/>


    @yield('custom-style-cb')
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{url('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/css/plugins-md.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/admin/layout3/css/layout.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/admin/layout3/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color">
    <link href="{{url('assets/admin/layout3/css/custom.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}"/>
    <!-- END THEME STYLES -->
    <!--link rel="shortcut icon" href="favicon.ico"/-->
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
    <script src="{{url('assets/global/plugins/respond.min.js')}}"></script>
    <script src="{{url('assets/global/plugins/excanvas.min.js')}}"></script>
    <![endif]-->
    <script src="{{url('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{url('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
    <!--script src="{{url('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script-->
    <script src="{{url('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/layout3/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/layout3/scripts/demo.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/pages/scripts/index3.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/pages/scripts/tasks.js')}}" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core componets
            Layout.init(); // init layout
            Demo.init(); // init demo(theme settings page)
            //Index.init(); // init index page
            //Tasks.initDashboardWidget(); // init tash dashboard widget
        });
    </script>
    <!-- END JAVASCRIPTS -->

    <script type="text/javascript">
        function time() {
            var today = new Date();
            var weekday=new Array(7);
            weekday[0]="Chủ nhật";
            weekday[1]="Thứ hai";
            weekday[2]="Thứ ba";
            weekday[3]="Thứ tư";
            weekday[4]="Thứ năm";
            weekday[5]="Thứ sáu";
            weekday[6]="Thứ bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            m=checkTime(m);
            s=checkTime(s);
            nowTime = h+":"+m+":"+s;
            if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = day+', '+ dd+'/'+mm+'/'+yyyy;

            tmp='<span class="date"> '+today+' | '+nowTime+'</span>';

            document.getElementById("clock").innerHTML=tmp;

            clocktime=setTimeout("time()","1000","JavaScript");
            function checkTime(i)
            {
                if(i<10){
                    i="0" + i;
                }
                return i;
            }
        }
    </script>
    <?php
        $a_setting = [];
        $m_gen = \App\GeneralConfigs::first();
        if($m_gen != null){
            $a_setting = json_decode($m_gen->setting, true);
        }
        $a_congbo = [];
        $a_congbo['setting'] = $a_setting;
        $a_congbo['chucnang'] = array_column(\App\Model\system\danhmucchucnang::all()->toArray(), 'menu', 'maso');

        if (Illuminate\Support\Facades\Session::has('congbo')) {
            Illuminate\Support\Facades\Session::forget('congbo');
        }
        Illuminate\Support\Facades\Session::put('congbo', $a_congbo);
    ?>
    @yield('custom-script-cb')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body style="" class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid" onload="time()">
<!-- BEGIN HEADER -->
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top" style="">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{url('giahanghoadichvu')}}">
                <h3 style="text-transform: uppercase;"><b style="color: #25aae2">CƠ SỞ DỮ LIỆU VỀ GIÁ {{isset(getGeneralConfigs()['diadanh']) ? getGeneralConfigs()['diadanh'] : ''}}</b></h3>
{{--                <h3 style="text-transform: uppercase;"><b style="color: #25aae2">CƠ SỞ DỮ LIỆU VỀ GIÁ</b>&nbsp;<b style="color: #454545">{{isset(getGeneralConfigs()['diadanh']) ? getGeneralConfigs()['diadanh'] : ''}}</b></h3>--}}
{{--                </a>--}}
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <b style="color: #25aae2"><div id="clock"></div></b>
                @if(Illuminate\Support\Facades\Session::has('admin'))
                    <a class="text-bold text-white no-underline" href="{{url('')}}" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Vào chương trình</a>
                @else
                   <b><a class="text-bold text-white no-underline" href="{{url('login')}}" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Đăng nhập</a></b>
                    hoặc <b><a class="text-bold text-white no-underline" href="{{url('searchtkdangky')}}" data-ga-click="(Logged out) Header, clicked Sign in, text:sign-in">Kiểm tra tài khoản đăng ký</a></b>
                @endif
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>

    </div>

    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu ">

                <ul class="nav navbar-nav">
                    @if(chkCongBo('csdlmucgiahhdv'))
                    <li class="menu-dropdown classic-menu-dropdown ">
                    <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">Hàng hóa, dịch vụ<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu pull-left">
                            <li class=" dropdown-submenu">
                                <a href="javascript:;">
                                    <i class="icon-folder"></i>
                                    &nbsp;Định giá (Phần I)</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('cbgiadatpl')}}">{{session('congbo')['chucnang']['giadatpl'] ?? 'Giá đất phân loại'}} </a></li>
                                    <li><a href="{{url('cbgiathuedatnuoc')}}">{{session('congbo')['chucnang']['giathuedatnuoc'] ?? 'Giá thuê mặt đất-nước'}}</a></li>
                                    <li><a href="{{url('cbgiarung')}}">{{session('congbo')['chucnang']['giarung'] ?? 'Giá rừng'}}</a></li>
                                    <li><a href="{{url('cbthuemuanhaxh')}}">{{session('congbo')['chucnang']['giathuemuanhaxh'] ?? 'Giá thuê mua nhà XH'}}</a></li>
                                    <li><a href="{{url('cbgianuocsachsinhhoat')}}">{{session('congbo')['chucnang']['gianuocsh'] ?? 'Giá nước sạch sinh hoạt'}}</a></li>
                                    <li><a href="{{url('cbgiathuetscong')}}">{{session('congbo')['chucnang']['giathuetscong'] ?? 'Giá thuê tài sản công'}} </a></li>
                                    <li><a href="{{url('cbgiaspdvci')}}">{{session('congbo')['chucnang']['giaspdvci'] ?? 'Giá sản phẩm, dịch vụ công ích,... đặt hàng'}} </a></li>
                                    <li><a href="{{url('cbgiadvgiaoducdaotao')}}">{{session('congbo')['chucnang']['giadvgddt'] ?? 'Giá dịch vụ GD-ĐT'}}</a></li>
                                    <li><a href="{{url('cbdichvukcb')}}">{{session('congbo')['chucnang']['giadvkcb'] ?? 'Giá dịch vụ KCB'}}</a></li>
                                </ul>
                            </li>

                            <li class=" dropdown-submenu">
                                <a href="javascript:;">
                                    <i class="icon-folder"></i>
                                    &nbsp;Định giá (Phần II)</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('cbtrogiatrocuoc')}}">{{session('congbo')['chucnang']['trogiatrocuoc'] ?? 'Mức trợ giá, trợ cước'}} </a></li>
                                    <li><a href="{{url('cbgiahhdvcn')}}">{{session('congbo')['chucnang']['giahhdvcn'] ?? 'Giá hàng hóa, dịch vụ khác theo quy định của pháp luật chuyên ngành'}} </a></li>
                                    {{--                                    <li><a class="text-uppercase" href="{{url('cbgiadatduan')}}">{{session('congbo')['chucnang']['giadatduan'] ?? 'Giá đất cụ thể dự án'}} </a></li>--}}
                                    {{--                                    <li><a class="text-uppercase" href="{{url('cbdaugiadatts')}}">{{session('congbo')['chucnang']['daugiadatts'] ?? 'Giá đấu giá đất và tài sản gắn liền đất'}} </a></li>--}}
                                    <li><a href="{{url('cbgiathuetainguyen')}}">&nbsp;{{session('congbo')['chucnang']['giathuetn'] ?? 'Giá thuế tài nguyên'}}</a></li>
                                    <li><a href="{{url('cbgiacuocvanchuyen')}}">{{session('congbo')['chucnang']['giacuocvanchuyen'] ?? 'Giá cước vận chuyển'}} </a></li>
                                    <li><a href="{{url('cbgiathuenhacongvu')}}">{{session('congbo')['chucnang']['giathuenhacongvu'] ?? 'Giá thuê nhà công vụ'}}</a></li>
                                    {{--                                    <li><a class="text-uppercase" href="{{url('cbbannhataidinhcu')}}">{{session('congbo')['chucnang']['bannhataidinhcu'] ?? 'Giá bán nhà tái định cư'}} </a></li>--}}
                                    <li><a href="{{url('cbgiadatdiaban')}}">{{session('congbo')['chucnang']['giacldat'] ?? 'Giá đất theo địa bàn'}} </a></li>
                                    <li><a href="{{url('cbgiadaugiadat')}}">{{session('congbo')['chucnang']['giadaugiadat'] ?? 'Giá đấu giá đất'}}</a></li>
                                </ul>
                            </li>
                            <!-- Chon năm; chon phân loại mặt hàng -->
                            <li><a href="{{url('cbbinhongia')}}"><i class="icon-folder"></i>&nbsp;{{session('congbo')['chucnang']['bog'] ?? 'Bình ổn giá'}}</a></li>
{{--                            <li><a href="{{url('coming')}}"><i class="icon-folder"></i>&nbsp;Giá HH-DV khác</a></li>--}}

                            <li><a href="{{url('cbgialephitruocba')}}"><i class="icon-folder"></i>&nbsp;{{session('congbo')['chucnang']['gialephitruocba'] ?? 'Giá lệ phí trước bạ'}}</a></li>
                            <li><a href="{{url('cbphilephi')}}"><i class="icon-folder"></i>&nbsp;{{session('congbo')['chucnang']['giaphilephi'] ?? 'Phí, lệ phí'}}</a></li>
                        </ul>
                    </li>
                    @endif

                    <li class="menu-dropdown classic-menu-dropdown">
                        <a data-hover="megamenu-dropdown" data-close-others="true" href="javascript:;">Kê khai, niêm yết giá<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu pull-left">
                            <li><a href="{{url('cbkekhaigia')}}">Doanh nghiệp kê khai, niêm yết giá</a></li>
                            <li><a href="{{url('cblinhvuckk')}}">Lĩnh vực hoạt động kinh doanh</a></li>
                            {{--<li><a href="{{url('timkiemkekhai')}}">Tìm kiếm giá kê khai, niêm yết</a></li>--}}
                        </ul>
                    </li>

                    {{--<li class="menu-dropdown classic-menu-dropdown">--}}
                        {{--<a data-hover="megamenu-dropdown" data-close-others="true" href="javascript:;">Kê khai, niêm yết giá I<i class="fa fa-angle-down"></i></a>--}}
                        {{--<ul class="dropdown-menu pull-left">--}}
                        {{--<li><a class="text-uppercase" href="{{url('cbvlxd')}}">{{session('congbo')['chucnang']['vlxd'] ?? 'Vật liệu xây dựng'}} </a></li>--}}
                        {{--<li><a class="text-uppercase" href="{{url('cbdvhdtmck')}}">{{session('congbo')['chucnang']['dvhdtmck'] ?? 'Giá dịch vụ hỗ trợ hoạt động thương mại tại cửa khẩu'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbxmtxd')}}">{{session('congbo')['chucnang']['xmtxd'] ?? 'Xi măng, thép xây dựng'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbthan')}}">{{session('congbo')['chucnang']['than'] ?? 'Giá than'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbtacn')}}">{{session('congbo')['chucnang']['tacn'] ?? 'Thức ăn chăn nuôi'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbgiay')}}">{{session('congbo')['chucnang']['giay'] ?? 'Giấy in, viết (dạng cuộn), giấy in báo'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbsach')}}">{{session('congbo')['chucnang']['sach'] ?? 'Sách giáo khoa'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbetanol')}}">{{session('congbo')['chucnang']['etanol'] ?? 'Etanol, khí tự nhiên hóa lỏng(LNG); khí thiên nhiên nén (CNG)'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbtpcnte6t')}}">{{session('congbo')['chucnang']['tpcnte6t'] ?? 'Thực phẩm chức năng cho trẻ em dưới 6 tuổi'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbxemay')}}">{{session('congbo')['chucnang']['xemay'] ?? 'Giá xe máy'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cboto')}}">{{session('congbo')['chucnang']['oto'] ?? 'Giá ô tô'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbdvcb')}}">{{session('congbo')['chucnang']['dvcb'] ?? 'Giá dịch vụ tại cảng biển, cảng hàng không'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbkcbtn')}}">{{session('congbo')['chucnang']['kcbtn'] ?? 'Dịch vụ khám chữa bệnh cho người tại cơ sở khám chữa bệnh tư nhân; khám chữa bệnh theo yêu cầu tại cơ sở khám chữa bệnh của nhà nước'}} </a></li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}

                    {{--<li class="menu-dropdown classic-menu-dropdown">--}}
                        {{--<a data-hover="megamenu-dropdown" data-close-others="true" href="javascript:;">Kê khai, niêm yết giá II<i class="fa fa-angle-down"></i></a>--}}
                        {{--<ul class="dropdown-menu pull-left">--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbdvlt')}}">{{session('congbo')['chucnang']['dvlt'] ?? 'Dịch vụ lưu trú'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbcahue')}}">{{session('congbo')['chucnang']['cahue'] ?? 'Giá dịch vụ xem ca Huế trên sông Hương'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbhocphilx')}}">{{session('congbo')['chucnang']['hocphilx'] ?? 'Mức thu học phí đào tạo lái xe cơ giới đường bộ'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbcatsan')}}">{{session('congbo')['chucnang']['catsan'] ?? 'Vật liệu xây dựng: cát, sạn'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbdatsanlap')}}">{{session('congbo')['chucnang']['datsanlap'] ?? 'Vật liệu xây dựng: đất san lấp'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbdaxaydung')}}">{{session('congbo')['chucnang']['daxaydung'] ?? 'Vật liệu xây dựng: đá xây dựng'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbdlbb')}}">{{session('congbo')['chucnang']['dlbb'] ?? 'Giá dịch vụ du lịch tại bãi biển'}} </a></li>--}}
                            {{--<li><a class="text-uppercase" href="{{url('cbtqkdl')}}">{{session('congbo')['chucnang']['tqkdl'] ?? 'Giá vé tham quan tại các khu du lịch'}} </a></li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}

                    {{--@if(chkCongBo('csdlthamdinhgia'))--}}
                    <li class="menu-dropdown classic-menu-dropdown">
                        <a data-hover="megamenu-dropdown" data-close-others="true" href="{{url('cbthamdinhgia')}}">Thẩm định giá</a>
                    </li>
                    {{--@endif--}}

                    <li class="menu-dropdown classic-menu-dropdown ">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">Văn bản QLNN<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu pull-left">
                            <li class=" dropdown-submenu">
                                <a href="javascript:;">
                                    <i class="icon-folder"></i>
                                    &nbsp;Văn bản QLNN về giá, phí lệ phí</a>
                                <ul class="dropdown-menu">
                                    <?php $modelbcthvegia = \App\Model\manage\vanbanplvegia\baocaoth\BcThVeGiaDm::all(); ?>
                                    @foreach($modelbcthvegia as $bcthvegia)
                                        <li><a href="{{url('/cbvbqlnn')}}"><i class="icon-folder"></i> &nbsp;{{$bcthvegia->mota}}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class=" dropdown-submenu">
                                <a href="javascript:;">
                                    <i class="icon-folder"></i>
                                    &nbsp;Thông tin QLNN về giá</a>
                                <ul class="dropdown-menu">
                                    <?php $ttpvctqlnn = \App\Model\manage\ttpvctqlnn\TtPvCtQlNnDm::all(); ?>
                                    @foreach($ttpvctqlnn as $ttpv)
                                        <li>
                                            <a href="{{url('/cbttqlnn')}}"><i class="icon-folder"></i> {{$ttpv->mota}}</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-dropdown classic-menu-dropdown ">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">&nbsp;Hỗ trợ<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu pull-left">
                            <li><a href="{{url('/danhsachusertaphuan')}}"><i class="icon-folder"></i>&nbsp;Danh sách tài khoản tập huấn</a></li>
                            <li><a href="{{url('/thongtinhotro')}}" target="_blank"><i class="icon-folder"></i> &nbsp;Thông tin hỗ trợ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content" style="">
        <br>
        @yield('content-cb')
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<!-- BEGIN PRE-FOOTER -->
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div class="page-prefooter">
    <div class="container">
        <div class="row">
            <div class="col-md-12 footer-block" style="text-align: center">
                <h2><strong>Giá hàng hóa dịch vụ {{isset(getGeneralConfigs()['diadanh']) ? getGeneralConfigs()['diadanh'] : ''}}</strong></h2>
                <p>Bản quyền thuộc về &nbsp;<b style="color: #25aae2">{{isset(getGeneralConfigs()['tendonvi']) ? getGeneralConfigs()['tendonvi'] : ''}}</b></p>
                <p>Địa chỉ: &nbsp;<b style="color: #25aae2">{{isset(getGeneralConfigs()['diachi']) ? getGeneralConfigs()['diachi'] : ''}}</b></p>
                <p>Thông tin liên hệ: &nbsp;<b style="color: #25aae2">{{isset(getGeneralConfigs()['tel']) ? getGeneralConfigs()['tel'] : ''}}</b></p>
            </div>
        </div>
    </div>
</div>

<div class="page-footer">
    <div class="container">
        <div class="col-md-12">
            Copyright &copy;  2016 - {{date('Y')}} LifeSoft <a href="" >Tiện ích hơn - Hiệu quả hơn</a>
        </div>
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]-->
</body>
<!-- END BODY -->
</html>