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
                <li class="tooltips" data-container="body" data-placement="right" data-html="true">
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

            @if (chkPer('csdlquocgia', 'qg_giathitruong'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                    <a href="javascript:;">
                        <span class="title">{{ session('admin')['a_chucnang']['qg_giathitruong'] ?? 'Giá hàng hoá thị trường' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{ url('/csdlquocgia/qg_giathitruong/danhmuc') }}">Danh mục</a> </li>
                        <li><a href="{{ url('/csdlquocgia/qg_giathitruong/hoso') }}">Hồ sơ</a> </li>
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlquocgia', 'qg_thuetainguyen'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                    <a href="javascript:;">
                        <span class="title">{{ session('admin')['a_chucnang']['qg_thuetainguyen'] ?? 'Giá thuế tài nguyên' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{ url('/csdlquocgia/qg_thuetainguyen/danhmuc') }}">Danh mục</a> </li>
                        <li><a href="{{ url('/csdlquocgia/qg_thuetainguyen/hoso') }}">Hồ sơ</a> </li>
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@endif
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
        <li class="tooltips" data-container="body" data-placement="right" data-html="true">
            <a href="javascript:;">
                <span class="title">Giá thuế tài nguyên</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giathuetn/nhandanhmuc') }}">Nhận danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giathuetn/nhanhoso') }}">Nhận hồ sơ</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giathuetn/danhmuc') }}">Truyền danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giathuetn/hoso') }}">Truyền hồ sơ kê khai</a>
                </li>
            </ul>
        </li>
        <li class="tooltips" data-container="body" data-placement="right" data-html="true">
            <a href="javascript:;">
                <span class="title">Giá hàng hóa, dịch vụ khác theo quy định của pháp luật chuyên ngành</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giahhdvcn/nhandanhmuc') }}">Nhận danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giahhdvcn/nhanhoso') }}">Nhận hồ sơ</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giahhdvcn/danhmuc') }}">Truyền danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giahhdvcn/hoso') }}">Truyền hồ sơ kê khai</a>
                </li>
            </ul>
        </li>
        <li class="tooltips" data-container="body" data-placement="right" data-html="true">
            <a href="javascript:;">
                <span class="title">Giá dịch vụ Giáo dục Mầm non và Giáo dục phổ thông công lập</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giadvgddt/nhandanhmuc') }}">Nhận danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giadvgddt/nhanhoso') }}">Nhận hồ sơ</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giadvgddt/danhmuc') }}">Truyền danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giadvgddt/hoso') }}">Truyền hồ sơ kê khai</a>
                </li>
            </ul>
        </li>
        <li class="tooltips" data-container="body" data-placement="right" data-html="true">
            <a href="javascript:;">
                <span class="title">Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt </span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giaspdvci/nhandanhmuc') }}">Nhận danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giaspdvci/nhanhoso') }}">Nhận hồ sơ</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giaspdvci/danhmuc') }}">Truyền danh mục</a>
                </li>
                <li>
                    <a href="{{ url('/csdlquocgia/qg_giaspdvci/hoso') }}">Truyền hồ sơ kê khai</a>
                </li>
            </ul>
        </li>
    </ul>
</li>