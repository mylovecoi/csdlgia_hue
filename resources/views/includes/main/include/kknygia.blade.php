
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Giá kê khai của hàng hóa, dịch vụ thuộc danh mục Giá kê khai">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">Mức giá kê khai - đăng ký</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(session('admin')->level == 'DN')
                    @if(can('ttdn','index'))
                        <li><a href="{{url('thongtindoanhnghiep')}}">Thông tin doanh nghiệp</a></li>
                    @endif
                @elseif(session('admin')->level == 'T')
                    @if(can('ttdn','approve'))
                        <li><a href="{{url('xetduyettdttdn')}}"> Xét duyệt thay đổi thông tin doanh nghiệp</a></li>
                    @endif
                @endif
                    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                        data-original-title="Tổ chức, cá nhận Giá đăng ký theo yêu cầu của Sở Tài chính, sở quản lý ngành">
                        <a href="javascript:;">
                            <i class="icon-folder"></i>
                            <span class="title">Etanol nhiên liệu không biến tính,khí tự nhiên hóa lỏng(LNG),khí thiên nhiên nén(CNG)</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li><a href="{{url('/giaetanol/danhsach')}}">Thông tin hồ sơ</a></li>
                                <li><a href="{{url('/giaetanol/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                                <li><a href="{{url('/giaetanol/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                                <li><a href="{{url('/giaetanol/baocao')}}">Báo cáo tổng hợp</a></li>
                            @endif
                        </ul>
                    </li>
                @include('includes.main.include.kkdkg')
            </ul>
        </li>

