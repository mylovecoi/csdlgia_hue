{{--@if((chkPer('hethong', 'hethong_pq', 'api') && session('admin')->chucnang == 'QUANTRI') || session('admin')->level == 'SSA')--}}
@if(chkPer('thongke', 'thongkehethong'))
    <li class="heading">
        <h3 class="uppercase">{{session('admin')['a_chucnang']['thongke'] ?? 'Thống kê hệ thống'}}</h3>
    </li>
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Thống kê hệ thống">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['thongkehethong'] ?? 'Thống kê hệ thống'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('thongke', 'thongkehethong'))
                <li><a href="{{url('/thongke/hanhchinh')}}">{{session('admin')['a_chucnang']['nnnhaplieu'] ?? 'Nhập liệu đơn vị hành chính'}}</a></li>
            @endif
            {{-- @if(chkPer('thongke', 'thongkehethong'))
                <li><a href="{{url('/thongke/doanhnghiep')}}">{{session('admin')['a_chucnang']['dnnhaplieu'] ?? 'Nhập liệu các doanh nghiệp'}}</a></li>
            @endif --}}
        </ul>
    </li>
@endif