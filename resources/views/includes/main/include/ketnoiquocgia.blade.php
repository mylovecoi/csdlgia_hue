@if (chkPer('csdlquocgia'))
    <li class="heading">
        <h3 class="uppercase">{{ session('admin')['a_chucnang']['csdlquocgia'] ?? 'Kết nối CSDL quốc gia' }}</h3>
    </li>
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Thống kê hệ thống">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['csdlquocgia'] ?? 'Kết nối CSDL quốc gia' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlquocgia', 'qg_racthai'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="Giá dịch vụ vận chuyển thu gom rác thải sinh hoạt">
                    <a href="javascript:;">
                        <span class="title">{{ session('admin')['a_chucnang']['qg_racthai'] ?? 'Giá dịch vụ vận chuyển thu gom rác thải sinh hoạt' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{ url('/csdlquocgia/qg_racthai/danhmuc') }}">Danh mục</a> </li>
                        <li><a href="{{ url('/csdlquocgia/qg_racthai/hoso') }}">Hồ sơ</a> </li>
                    </ul>
                </li>
            @endif

        </ul>
    </li>
@endif
