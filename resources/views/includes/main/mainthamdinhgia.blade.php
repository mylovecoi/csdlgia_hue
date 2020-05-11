    @if(chkPer('csdlthamdinhgia','thamdinhgia'))
        <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Thẩm định giá</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlthamdinhgia','thamdinhgia', 'dmdonvi', 'danhmuc', 'index'))
                <li>
                    <a href="{{url('/thamdinhgia/donvi')}}">Danh mục đơn vị</a>
                </li>
            @endif

            @if(chkPer('csdlthamdinhgia','thamdinhgia', 'dmhhthamdinhgia', 'danhmuc', 'index'))
                <li>
                    <a href="{{url('/thamdinhgia/danhmuc')}}">Danh mục hàng hóa</a>
                </li>
            @endif

            @if(chkPer('csdlthamdinhgia','thamdinhgia', 'thamdinh', 'hoso','index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/thamdinhgia/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/thamdinhgia/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('/thamdinhgia/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
                <li>
                    <a href="{{url('/thamdinhgia/baocao')}}">Báo cáo tổng hợp</a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(canGeneral('cungcapgia','index'))
    @if(can('cungcapgia','index'))
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
    data-original-title="">
    <a href="javascript:;">
        <i class="icon-folder"></i>
        <span class="title">DN cung cấp giá</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        @if(session('admin')->level == 'CCG')
            @if(can('kkcungcapgia','index'))
            <li>
                <a href="{{url('hosocungcapgia')}}">Hồ sơ cung cấp giá</a>
            </li>
            @endif
        @endif
        @if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X')
            @if(can('kkcungcapgia','index'))
            <li>
                <a href="{{url('dsdncungcapgia')}}">Thông tin DN cung cấp giá</a>
            </li>
            @endif
            @if(can('kkcungcapgia','approve'))
            <li>
                <a href="{{url('thongtingiahanghoa')}}">Thông tin hồ sơ giá hàng hóa</a>
            </li>
            @endif
            @if(can('thcungcapgia','timkiem'))
            <li>
                <a href="{{url('timkiemgiahanghoacungcap')}}">Tìm kiếm thông tin</a>
            </li>
            @endif
            @if(can('thcungcapgia','baocao'))
            <li>
                <a href="javascript:;">Báo cáo tổng hợp</a>
            </li>
            @endif
        @endif

    </ul>
</li>
    @endif
@endif