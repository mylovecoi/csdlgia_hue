@if(canGeneral('thamdinhgia','index'))
    @if(canGeneral('dmhhthamdinhgia','index'))
        @if(can('dmhhthamdinhgia','index'))
            <li><a href="{{url('dmnhomhanghoa')}}">
                <i class="icon-folder"></i>
                <span class="title">Danh mục hàng hóa</span></a>
        </li>
        @endif
    @endif
    @if(can('thamdinhgia','index'))
        <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Thẩm định giá</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(can('kkthamdinhgia','index'))
            <li>
                <a href="{{url('thamdinhgia')}}">Hồ sơ thẩm định giá</a>
            </li>
            @endif
            @if(can('ththamdinhgia','timkiem'))
            <li>
                <a href="{{url('timkiemthamdinhgia')}}">Tìm kiếm thông tin</a>
            </li>
            @endif
            @if(can('ththamdinhgia','baocao'))
            <li>
                <a href="{{url('baocaoththamdinhgia')}}">Báo cáo tổng hợp</a>
            </li>
            @endif
        </ul>
    </li>
    @endif
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