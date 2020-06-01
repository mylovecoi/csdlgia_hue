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
    @yield('autoload')
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet')}}" type="text/css"/>
    <link href="{{url('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{url('assets/admin/pages/css/tasks.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}"/>
    @yield('custom-style')
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{url('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('/assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{url('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}"/>
    <!-- END THEME STYLES -->
    <!--link rel="shortcut icon" href="favicon.ico"/-->
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
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
    <script src="{{url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
    <script src="{{url('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/global/plugins/bootstrap-toastr/toastr.min.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/pages/scripts/index.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/admin/pages/scripts/tasks.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
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
    @yield('custom-script')
    <!-- END JAVASCRIPTS -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid" onload="time()">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <div class="page-logo">
                <a href="{{url('')}}">
                    <img src="{{url('images/logolife.png')}}" alt="logo" class="logo-default">

                </a>
                <div class="menu-toggler sidebar-toggler hide">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!--a href="{{url('')}}">{url('images/LIFESOFT.png')}}" width="100" alt
                <img src="{="logo" class="logo-default"/>
            </a-->
            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="{{url('/giahanghoadichvu')}}" class="dropdown-toggle" target="_blank">
                        <i class="fa fa-cloud"></i>
					<span class="badge badge-danger">
					View</span>
                    </a>
                    <ul>
                    </ul>
                </li>
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-folder-open-o"></i>
					<span class="badge badge-default">
					Help</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{url('/thongtinhotro')}}" target="_blank"> Thông tin hỗ trợ</a>
                        </li>
                        @if(session('admin')->ipf1 != '')
                            <li>
                                <a href="{{url('/data/huongdan/'.session('admin')->ipf1)}}" target="_blank">Tài liệu hướng dẫn</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="dropdown dropdown-user">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" >
                        <img alt="" class="img-circle" src="{{url('/images/avatar/default-user.png')}}"/>
					<span class="username">
					<b>{{session('admin')->name}}</b> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        @if(session('admin')->level != 'SSA')
                        <li>
                            <a href="{{url('user_setting')}}">
                                <i class="icon-settings"></i> Thông tin tài khoản</a>
                        </li>
                        @endif
                        @if(session('admin')->level =='X')
                        <li>
                            <a href="{{url('thongtindonvi')}}">
                                <i class="icon-settings"></i> Thông tin đơn vị</a>
                        </li>
                        @endif
                        {{--@if(session('admin')->level != 'SSA')--}}
                        <li>
                            <a href="{{url('change-password')}}">
                                <i class="icon-lock"></i> Đổi mật khẩu</a>
                        </li>
                        {{--@endif--}}
                        <li>
                            <a href="{{url('logout')}}">
                                <i class="icon-key"></i> Đăng xuất </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler">
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <!--Manager-->
                @if(chkPer('csdlmucgiahhdv'))
                    <li class="heading">
                        <h3 class="uppercase">{{session('admin')['a_chucnang']['csdlmucgiahhdv'] ?? 'CSDL về mức giá HH-DV'}}</h3>
                    </li>
                    @include('includes.main.maincsdlmucgiahhdv')
                @endif
                <!-- Tách riêng các phân hệ doanh nghiệp do ko có phân quyền ==>chkPer('csdlmucgiahhdv') ko kiểm tra dc DN  -->
                @if(chkPer('csdlmucgiahhdv','bog') && session('admin')->level == 'DN')
                    <li class="heading">
                        <h3 class="uppercase">{{session('admin')['a_chucnang']['csdlmucgiahhdv'] ?? 'CSDL về mức giá HH-DV'}}</h3>
                    </li>
                    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                        data-original-title="Tổ chức, cá nhân đăng ký theo yêu cầu của Sở Tài chính, Sở quản lý ngành">
                        <a href="javascript:;">
                            <i class="icon-folder"></i>
                            <span class="title">{{session('admin')['a_chucnang']['bog'] ?? 'Bình ổn giá'}}</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('/binhongia/danhsach?madv='.session('admin')->madv)}}">Thông tin hồ sơ</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if((chkPer('csdlmucgiahhdv','kknygia') && session('admin')->level == 'DN'))
                    <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                        <a href="javascript:;">
                            <i class="icon-folder"></i>
                            <span class="title">{{session('admin')['a_chucnang']['kknygia'] ?? 'Mức giá kê khai, đăng ký'}}</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <!-- chức năng thông tin doanh nghiệp: xây dựng tương tụ như hồ sơ: load thông tin nhưng đơn vị cấp dươi
                                    session('admin')->chucnang = NHAPLIEU && session('admin')->level == 'DN'
                                    session('admin')->level != 'DN' && session('admin')->chucnang = TONGHOP
                            -->
                        <!-- 10/05/2020 tạm khóa
                            @if(session('admin')->level == 'DN')
                            <li><a href="{{url('thongtindoanhnghiep')}}">Thông tin doanh nghiệp</a></li>
                            @else
                            @if(chkPer('csdlmucgiahhdv','kknygia', 'thongtinkknygia', 'hoso', 'index'))
                                <li><a href="{{url('xetduyettdttdn')}}"> Xét duyệt thay đổi thông tin doanh nghiệp</a></li>
                                @endif
                        @endif
                                -->
                            @if(canKkGiaGr('VLXD'))
                                @if(canKkGiaCt('VLXD','VLXD'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Vật liệu xây dựng</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('thongtinkekhaigiavatlieuxaydung')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'H' || session('admin')->level == 'T' )
                                                <li><a href="{{url('danhmucvatlieuxaydung')}}">Danh mục VLXD</a></li>
                                                <li><a href="{{url('thongtindnkkgiavlxd')}}">Giá kê khai</a></li>
                                                <li><a href="{{url('xetduyetkkgiavlxd')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemkkgiavlxd')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokekhaigiavlxd')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--Ok--}}
                            @endif
                            @if(canKkGiaGr('DVHDTMCK'))
                                @if(canKkGiaCt('DVHDTMCK','DVHDTMCK'))
                                    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                                        data-original-title="Giá dịch vụ hỗ trợ hoạt động thương mại tại cửa khẩu (kho,bến, bãi, bốc xếp hàng hóa tại cửa khẩu, dịch vụ khác">
                                        <a href="javascript:;">
                                            <span class="title">Giá dịch vụ hỗ trợ hoạt động thương mại tại cửa khẩu</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('thongtinkkdvhoatdongthuongmai')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'H' || session('admin')->level == 'T' )
                                                <li><a href="{{url('thongtindnkkgiadvhdtm')}}">Giá kê khai</a></li>
                                                <li><a href="{{url('xetduyetkkgiadvhdtm')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemgiadvhdtm')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokkgiadvhdtm')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--OK--}}
                            @endif
                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'xmtxd'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Xi măng, thép xây dựng</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="{{url('kekhaigiaxmtxd')}}">Giá kê khai</a> </li>
                                        </ul>
                                    </li>
                            @endif
                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'than'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Than</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="{{url('kekhaigiathan')}}">Giá kê khai than</a> </li>
                                        </ul>
                                    </li>
                            @endif
                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'tacn'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Thức ăn chăn nuôi</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="{{url('kekhaigiatacn')}}">Giá kê khai</a> </li>
                                        </ul>
                                    </li>
                            @endif
                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'giay'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="{{url('kekhaigiagiay')}}">Giá kê khai</a> </li>
                                        </ul>
                                    </li>
                            @endif
                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'sach'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Sách giáo khoa</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{url('kekhaigiasach')}}">Giá kê khai</a> </li>
                                    </ul>
                                </li>
                            @endif
                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'etanol'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Etanol nhiên liệu không biến tính, khí tự nhiên hóa lỏng(LNG); khí thiên nhiên nén (CNG)</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{url('kekhaigiaetanol')}}">Giá kê khai</a> </li>
                                    </ul>
                                </li>
                            @endif

                            @if(canKkGiaGr('DVCB'))
                                @if(canKkGiaCt('DVCB','DVCB'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Giá dịch vụ tại cảng biển, cảng hàng không</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('kekhaigiadvcang')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                                <li><a href="{{url('thongtindndvcang')}}">Giá kê khai </a> </li>
                                                <li><a href="{{url('xetduyetgiadvcang')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemgiadvcang')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokkgiadvcang')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--Ok--}}
                            @endif
                            @if(canKkGiaGr('OTO'))
                                @if(canKkGiaCt('OTO','OTO'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Giá ô tô nhập khẩu, sản xuất trong nước dưới 15 chỗ ngồi</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('kekhaigiaotonksx')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                                <li><a href="{{url('thongtindnotonksx')}}">Giá kê khai </a> </li>
                                                <li><a href="{{url('xetduyetgiaotonksx')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemgiaotonksx')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokkgiaotonksx')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--Ok--}}
                            @endif
                            @if(canKkGiaGr('XEMAY'))
                                @if(canKkGiaCt('XEMAY','XEMAY'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Giá xe gắn máy nhập khẩu, sản xuất trong nước</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('kekhaigiaxemaynksx')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                                <li><a href="{{url('thongtindnxemaynksx')}}">Giá kê khai </a> </li>
                                                <li><a href="{{url('xetduyetgiaxemaynksx')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemgiaxemaynksx')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokkgiaxemaynksx')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--OK--}}
                            @endif

                            @if(canKkGiaGr('KCBTN'))
                                @if(canKkGiaCt('KCBTN','KCBTN'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Dịch vụ khám chữa bệnh cho người tại cơ sở khám chữa bệnh tư nhân; khám chữa bệnh theo yêu cầu tại cơ sở khám chữa bệnh của nhà nước</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('kekhaigiakcbtn')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                                <li><a href="{{url('thongtindnkcbtn')}}">Giá kê khai </a> </li>
                                                <li><a href="{{url('xetduyetgiakcbtn')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemgiakcbtn')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaogiakcbtn')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                            @endif

                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'vtxk'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Cước vận tải hành khách bằng ôtô tuyến cố định</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{url('kekhaigiavantaixekhach')}}">Giá kê khai</a></li>
                                    </ul>
                                </li>
                            @endif

                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'vtxb'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Cước vận tải hành khách bằng xe bus tuyến cố định</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{url('kekhaivantaixebuyt')}}">Giá kê khai</a></li>
                                    </ul>
                                </li>
                            @endif

                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'vtxtx'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Cước vận tải hành khách bằng xe taxi tuyến cố định</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{url('kekhaigiavantaixetaxi')}}">Giá kê khai</a></li>
                                    </ul>
                                </li>
                            @endif

                            @if(canKkGiaCt('DVVTHK','VC'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Cước vận chuyển hành khách: xe buýt, xe điện, bè mảng</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @if(session('admin')->level == 'DN')
                                            <li><a href="{{url('kekhaicuocvchk')}}">Giá kê khai</a></li>
                                        @endif
                                        @if(session('admin')->level == 'X' || session('admin')->level == 'H' || session('admin')->level == 'T' )
                                            <li><a href="{{url('thongtindnvchk')}}">Giá kê khai</a></li>
                                            <li><a href="{{url('xetduyetkekhaicuocvchk')}}">Xét duyệt hồ sơ kê khai</a></li>
                                            <li><a href="{{url('timkiemcuocvchk')}}">Tìm kiếm hồ sơ kê khai</a></li>
                                            <li><a href="{{url('baocaogiacuocvchk')}}">Báo cáo thống kê</a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if(canKkGiaGr('TPCNTE6T'))
                                @if(canKkGiaCt('TPCNTE6T','TPCNTE6T'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Thực phẩm chức năng cho trẻ em dưới 6 tuổi</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('kekhaithucphamchucnangchote6t')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'H' || session('admin')->level == 'T' )
                                                <li><a href="{{url('thongtindntpcn6t')}}">Giá kê khai</a></li>
                                                <li><a href="{{url('xdkekhaigiatpcnte6t')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemkekhaigiatpcnte6t')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokekhaigiatpcnte6t')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--OK--}}
                            @endif

                            @if(chkPer('csdlmucgiahhdv', 'kknygia', 'dvlt'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Dịch vụ lưu trú</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{url('/thongtincskd')}}">Danh sách CSKD</a> </li>
                                        <li><a href="{{url('/kekhaigiadvlt')}}">Giá kê khai</a> </li>
                                    </ul>
                                </li>
                            @endif
                            @if(chkPer('csdlmucgiahhdv','kknygia', 'cahue'))
                                <li>
                                    <a href="javascript:;">
                                        <span class="title">Giá dịch vụ xem ca Huế trên sông Hương</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{url('kekhaigiadvcahue')}}">Giá kê khai</a> </li>
                                    </ul>
                                </li>
                            @endif

                            @if(canKkGiaGr('DLBB'))
                                @if(canKkGiaCt('DLBB','DLBB'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Giá dịch vụ du lịch tại bãi biển</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('kekhaigiadvdlbb')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                                <li><a href="{{url('thongtindndlbb')}}">Giá kê khai </a> </li>
                                                <li><a href="{{url('xetduyetgiadvdlbb')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemgiadvdlbb')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokekhaidvdlbb')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--OK--}}
                            @endif
                            @if(canKkGiaGr('TQKDL'))
                                @if(canKkGiaCt('TQKDL','TQKDL'))
                                    <li>
                                        <a href="javascript:;">
                                            <span class="title">Giá vé tham quan tại các khu du lịch</span>
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            @if(session('admin')->level == 'DN')
                                                <li><a href="{{url('kekhaigiavetqkdl')}}">Giá kê khai</a> </li>
                                            @endif
                                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                                <li><a href="{{url('thongtindntqkdl')}}">Giá kê khai </a> </li>
                                                <li><a href="{{url('xetduyetgiavetqkdl')}}">Thông tin hồ sơ xét duyệt</a></li>
                                                <li><a href="{{url('timkiemgiavetqkdl')}}">Tìm kiếm thông tin</a> </li>
                                                <li><a href="{{url('baocaokekhaigiavetqkdl')}}">Báo cáo thống kê</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                                {{--OK--}}
                            @endif


                        </ul>
                    </li>
                @endif


            @if(chkPer('csdlthamdinhgia'))
                    <li class="heading">
                        <h3 class="uppercase">{{session('admin')['a_chucnang']['csdlthamdinhgia'] ?? 'CSDL thẩm định giá'}}</h3>
                    </li>
                    @include('includes.main.mainthamdinhgia')
                @endif

                @if(chkPer('csdlvbqlnn'))
                    <li class="heading">
                        <h3 class="uppercase">{{session('admin')['a_chucnang']['csdlvbqlnn'] ?? 'Văn bản QLNN về giá - phí, lệ phí'}}</h3>
                    </li>
                    @include('includes.main.mainvbqlnn')
                @endif

                @if(chkPer('csdlttpvctqlnn'))
                    <li class="heading">
                        <h3 class="uppercase">{{session('admin')['a_chucnang']['csdlttpvctqlnn'] ?? 'TT phục vụ CT QLNN về giá'}}</h3>
                    </li>
                    @include('includes.main.mainttpvctqlnn')
                @endif

                <!--
                    1. Tài khoản SSA
                    2. Tài khoản quản trị hệ thống chucnang=QUANTRI
                -->
                @if((chkPer('hethong') && session('admin')->chucnang == 'QUANTRI') || session('admin')->level == 'SSA')
                    <li class="heading">
                        <h3 class="uppercase">{{session('admin')['a_chucnang']['hethong'] ?? 'Hệ thống'}}</h3>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-settings"></i>
                            <span class="title">Quản trị hệ thống</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                                <a href="javascript:;">
                                    <i class="icon-folder"></i>
                                    <span class="title">Quản trị người dùng</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if(chkPer('hethong', 'hethong_pq', 'nhomtaikhoan'))
                                        <li><a href="{{url('/nhomtaikhoan/danhsach')}}">{{session('admin')['a_chucnang']['nhomtaikhoan'] ?? 'Danh sách nhóm tài khoản'}}</a></li>
                                    @endif

                                    @if(chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan'))
                                        <li><a href="{{url('/taikhoan/danhsach')}}">{{session('admin')['a_chucnang']['danhsachtaikhoan'] ?? 'Danh sách tài khoản'}}</a></li>
                                    @endif

                                    @if(chkPer('hethong', 'hethong_pq', 'dangky'))
                                        <li><a href="{{url('dangky/danhsach')}}">{{session('admin')['a_chucnang']['dangky'] ?? 'Tài khoản đăng ký'}}</a></li>
                                        <li><a href="{{url('userscompany')}}">Tài khoản doanh nghiệp</a></li>
                                    @endif
                                </ul>
                            </li>

                            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                                <a href="javascript:;">
                                    <i class="icon-folder"></i>
                                    <span class="title">Quản trị hệ thống</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if(chkPer('hethong', 'hethong_pq', 'danhsachdiaban'))
                                        <li><a href="{{url('/diaban/danhsach')}}">{{session('admin')['a_chucnang']['danhsachdiaban'] ?? 'Danh sách địa bàn'}}</a></li>
                                    @endif

                                    @if(chkPer('hethong', 'hethong_pq', 'danhsachxaphuong'))
                                        <li><a href="{{url('/xaphuong/danhsach')}}">{{session('admin')['a_chucnang']['danhsachxaphuong'] ?? 'Danh sách xã, phường, thị trấn'}}</a></li>
                                    @endif

                                    @if(chkPer('hethong', 'hethong_pq', 'danhsachdonvi'))
                                        <li><a href="{{url('/donvi/danhsach')}}">{{session('admin')['a_chucnang']['danhsachdonvi'] ?? 'Danh sách đơn vị'}}</a></li>
                                    @endif

                                        @if(chkPer('hethong', 'hethong_pq', 'chucnang'))
                                            <li><a href="{{url('/chucnang/danhsach')}}">{{session('admin')['a_chucnang']['chucnang'] ?? 'Danh mục chức năng hệ thống'}}</a> </li>
                                        @endif
                                    <!-- chức năng này không có => chỉ có quyền SSA mới lên -->
                                        @if(chkPer('hethong', 'hethong_pq', 'vanphong'))
                                            <li><a href="{{url('/vanphonghotro/danhsach')}}">{{session('admin')['a_chucnang']['vanphong'] ?? 'Văn phòng hỗ trợ'}}</a> </li>
                                        @endif

                                        @if(chkPer('hethong', 'hethong_pq', 'thongtin'))
                                            <li><a href="{{url('/general')}}">{{session('admin')['a_chucnang']['thongtin'] ?? 'Cấu hình hệ thống'}}</a></li>
                                        @endif
                                </ul>
                            </li>

                            <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                                <a href="javascript:;">
                                    <i class="icon-folder"></i>
                                    <span class="title">Quản trị danh mục</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if(chkPer('hethong', 'hethong_pq', 'ngaynghile'))
                                        <li><a href="{{url('thongtinngaynghile')}}">Thông tin ngày nghỉ lễ</a></li>
                                        <li><a href="{{url('dmloaidat')}}">Danh mục loại đất</a></li>
                                    @endif

                                    @if(chkPer('hethong', 'hethong_pq', 'danhmucnganhkd'))
                                        <li><a href="{{url('/dmnganhnghe/danhsach')}}">Danh mục ngành nghề kinh doanh</a> </li>
                                    @endif
                                </ul>
                            </li>






                        </ul>
                    </li>
                    @endif
            </ul>

            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{url('/')}}">Trang chủ</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        {{$pageTitle}}
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="page-toolbar">
                        <b><div id="clock"></div></b>
                    </div>

                </div>
            </div>

            @yield('content')

        </div>
    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        Copyright &copy;  2016 - {{date('Y')}} LifeSoft <a>Tiện ích hơn - Hiệu quả hơn</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<script src="{{ url('js/main.js') }}" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
    });
</script>

</body>
<!-- END BODY -->
</html>