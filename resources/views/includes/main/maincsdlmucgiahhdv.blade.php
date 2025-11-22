@if (chkPer('csdlmucgiahhdv', 'dinhgia'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Giá hàng hóa, dịch vụ do UBND định giá">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['dinhgia'] ?? 'Định giá' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadatpl'))
                <li>
                    <a href="javascript:;">
                        {{-- <span class="title">{{session('admin')['a_chucnang']['giadatpl'] ?? 'Giá đất phân loại'}}</span> --}}
                        <span class="title">{{ 'Giá đất phân loại' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadatpl', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giadatphanloai/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giadatphanloai/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giadatphanloai/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuedatnuoc'))
                <li>
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giathuedatnuoc'] ?? 'Giá thuê đất, nước' }}<span
                            class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuedatnuoc', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giathuematdatmatnuoc/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giathuematdatmatnuoc/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giathuematdatmatnuoc/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giarung'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="Giá rừng bao gồm rừng sản xuất, rừng phòng hộ và rừng đặc dụng thuộc sở hữu toàn dân do Nhà nước làm đại diện chủ sở hữu">
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giarung'] ?? 'Giá rừng' }}
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giarung', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('giarung/danhmuc') }}">Danh mục loại rừng</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giarung', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giarung/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giarung/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giarung/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giarung', 'khac', 'baocao'))
                            <li>
                                <a href="{{ url('/giarung/baocao') }}">Báo cáo tổng hợp</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuemuanhaxh'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giathuemuanhaxh'] ?? 'Giá thuê mua nhà xã hội' }}
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuemuanhaxh', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/thuemuanhaxahoi/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuemuanhaxh', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/thuemuanhaxahoi/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/thuemuanhaxahoi/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/thuemuanhaxahoi/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuemuanhaxh', 'khac', 'baocao'))
                            <li>
                                <a href="{{ url('/thuemuanhaxahoi/baocao') }}">Báo cáo tổng hợp</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'gianuocsh'))
                <li>
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['gianuocsh'] ?? 'Giá nước sạch sinh hoạt' }}
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'gianuocsh', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/gianuocsachsinhhoat/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'gianuocsh', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/gianuocsachsinhhoat/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/gianuocsachsinhhoat/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/gianuocsachsinhhoat/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'gianuocsh', 'khac', 'baocao'))
                            <li>
                                <a href="{{ url('/gianuocsachsinhhoat/baocao') }}">Báo cáo tổng hợp</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuetscong'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="Giá cho thuê tài sản Nhà nước là công trình kết cấu hạ tầng đầu tư từ nguồn ngân sách địa phương">
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giathuetscong'] ?? 'Giá thuê tài sản công' }}<span
                            class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuetscong', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/giathuetscong/danhmuc?phanloai=giathuetscong') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuetscong', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giathuetscong/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giathuetscong/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giathuetscong/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuetscong', 'khac', 'baocao'))
                            <li>
                                <a href="{{ url('/giathuetscong/baocao') }}">Báo cáo tổng hợp</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvci'))
                <li>
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giaspdvci'] ?? 'Giá sản phẩm, dịch vụ công ích,... đặt hàng' }}<span
                            class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvci', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/giaspdvci/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvci', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvci/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvci/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giaspdvci/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadvgddt'))
                <li>
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giadvgddt'] ?? 'Giá dịch vụ đào tạo' }}<span
                            class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadvgddt', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/giadvgddt/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadvgddt', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giadvgddt/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giadvgddt/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giadvgddt/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadvkcb'))
                <li>
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giadvkcb'] ?? 'Giá dịch vụ khám chữa bệnh' }}<span
                            class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadvkcb', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/giadvkcb/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadvkcb', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giadvkcb/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giadvkcb/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giadvkcb/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'trogiatrocuoc'))
                <li>
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['trogiatrocuoc'] ?? 'Mức trợ giá, trợ cước' }}<span
                            class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'trogiatrocuoc', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/trogiatrocuoc/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'trogiatrocuoc', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/trogiatrocuoc/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/trogiatrocuoc/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/trogiatrocuoc/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giahhdvcn'))
                <li>
                    <a href="javascript:;">
                        {{ session('admin')['a_chucnang']['giahhdvcn'] ?? 'Giá hàng hóa, dịch vụ khác theo quy định của pháp luật chuyên ngành' }}<span
                            class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giahhdvcn', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/giahhdvcn/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giahhdvcn', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giahhdvcn/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giahhdvcn/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giahhdvcn/timkiem') }}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (canGeneral('giadatduan', 'index'))
                @if (can('giadatduan', 'index'))
                    <li>
                        <a href="javascript:;">
                            <span
                                class="title">{{ session('admin')['a_chucnang']['giadatduan'] ?? 'Giá đất cụ thể dự án' }}</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if (can('kkgiadatduan', 'index'))
                                <li>
                                    <a href="{{ url('thongtingiadatduan') }}">Thông tin giá đất</a>
                                </li>
                            @endif
                            @if (can('thgiadatduan', 'baocao'))
                                <li>
                                    <a href="{{ url('baocaogiadatduan') }}">Báo cáo giá đất dự án</a>
                                </li>
                            @endif
                            @if (can('thgiadatduan', 'timkiem'))
                                <li>
                                    <a href="{{ url('timkiemgiadatduan') }}">Tìm kiếm thông tin</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            @if (canGeneral('daugiadatts', 'index'))
                @if (can('daugiadatts', 'index'))
                    <li>
                        <a href="javascript:;">
                            {{ session('admin')['a_chucnang']['daugiadatts'] ?? 'Giá đấu giá đất và tài sản gắn liền đất' }}<span
                                class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if (can('kkdaugiadatts', 'index'))
                                <li>
                                    <a href="{{ url('thongtindaugiadatts') }}">Thông tin đấu giá đất và tài sản gắn
                                        liền đất</a>
                                </li>
                            @endif
                            {{-- @if (can('thgiadaugiadat', 'timkiem')) --}}
                            {{-- <li> --}}
                            {{-- <a href="{{url('timkiemthongtindaugiadat')}}">Tìm kiếm thông tin</a> --}}
                            {{-- </li> --}}
                            {{-- @endif --}}
                        </ul>
                    </li>
                @endif
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuetn'))
                <li>
                    <a href="javascript:;">
                        <span
                            class="title">{{ session('admin')['a_chucnang']['giathuetn'] ?? 'Giá thuế tài nguyên' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuetn', 'danhmuc', 'index'))
                            <li>
                                <a href="{{ url('/giathuetn/danhmuc') }}">Danh mục</a>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giathuetn', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giathuetn/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <!-- 30.08.2023 Làm hồ sơ thầu -->
                                <li>
                                    <a href="{{ url('/giathuetn/nhanhosocsdlqg') }}">
                                        Nhận hồ sơ từ CSDL quốc gia
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/giathuetn/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giathuetn/timkiem') }}">Tìm kiếm hồ sơ</a>
                            </li>

                            <li>
                                <a href="{{ url('/giathuetn/baocao') }}">Báo cáo tổng hợp</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giacuocvanchuyen'))
                <li>
                    <a href="javascript:;">
                        <span
                            class="title">{{ session('admin')['a_chucnang']['giacuocvanchuyen'] ?? 'Giá cước vận chuyển' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giacuocvanchuyen', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giacuocvanchuyen/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giacuocvanchuyen/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giacuocvanchuyen/timkiem') }}">Tìm kiếm hồ sơ</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvcuthe'))
                <li>
                    <a href="javascript:;">
                        <span
                            class="title">{{ session('admin')['a_chucnang']['giaspdvcuthe'] ?? 'Giá sản phẩm, dịch vụ cụ thể' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvcuthe', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvcuthe/danhmuc') }}">Danh mục</a>
                                </li>
                                <li>
                                    <a href="{{ url('/giaspdvcuthe/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvcuthe/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giaspdvcuthe/timkiem') }}">Tìm kiếm hồ sơ</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvtoida'))
                <li>
                    <a href="javascript:;">
                        <span
                            class="title">{{ session('admin')['a_chucnang']['giaspdvtoida'] ?? 'Giá sản phẩm, dịch vụ tối đa' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        {{-- @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvtoida', 'danhmuc', 'index')) --}}
                        {{-- <li> --}}
                        {{-- <a href="{{url('/giaspdvtoida/danhmuc')}}">Danh mục</a> --}}
                        {{-- </li> --}}
                        {{-- @endif --}}
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvtoida', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvtoida/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvtoida/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giaspdvtoida/timkiem') }}">Tìm kiếm hồ sơ</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvkhunggia'))
                <li>
                    <a href="javascript:;">
                        <span
                            class="title">{{ session('admin')['a_chucnang']['giaspdvkhunggia'] ?? 'Khung giá sản phẩm, dịch vụ' }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        {{-- @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvkhunggia', 'danhmuc', 'index')) --}}
                        {{-- <li> --}}
                        {{-- <a href="{{url('/giaspdvkhunggia/danhmuc')}}">Danh mục</a> --}}
                        {{-- </li> --}}
                        {{-- @endif --}}
                        @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giaspdvkhunggia', 'hoso', 'index'))
                            @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvkhunggia/danhsach') }}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{ url('/giaspdvkhunggia/xetduyet') }}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ url('/giaspdvkhunggia/timkiem') }}">Tìm kiếm hồ sơ</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (canGeneral('giathuenhacongvu', 'index'))
                @if (can('giathuenhacongvu', 'index'))
                    <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                        @if (can('kkgiathuenhacongvu', 'index'))
                            <a href="{{ url('giathuenhacongvu') }}">
                                {{ session('admin')['a_chucnang']['giathuenhacongvu'] ?? 'Giá thuê nhà công vụ' }}
                            </a>
                        @endif
                    </li>
                @endif
            @endif

            @if (canGeneral('bannhataidinhcu', 'index'))
                @if (can('bannhataidinhcu', 'index'))
                    <li>
                        @if (can('kkbannhataidinhcu', 'index'))
                            <a href="{{ url('bannhataidinhcu') }}">
                                {{ session('admin')['a_chucnang']['bannhataidinhcu'] ?? 'Giá bán nhà tái định cư' }}
                            </a>
                        @endif
                    </li>
                @endif
            @endif
        </ul>
    </li>
@endif

{{-- @if (chkPer('csdlmucgiahhdv', 'bog'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Tổ chức, cá nhận Giá đăng ký theo yêu cầu của Sở Tài chính, sở quản lý ngành">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['bog'] ?? 'Bình ổn giá'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (session('admin')->level == 'SSA')
                <li><a href="{{url('doanhnghiep/danhsach')}}">Thông tin doanh nghiệp</a></li>
            @endif
            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                <li><a href="{{url('doanhnghiep/xetduyet')}}"> Xét duyệt thay đổi thông tin doanh nghiệp</a></li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'bog', 'bog', 'danhmuc', 'index'))
                <li>
                    <a href="{{url('/binhongia/mathang')}}">Phân loại mặt hàng</a>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'bog', 'bog', 'hoso', 'index'))
                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    @if (session('admin')->level == 'SSA')
                        <li><a href="{{url('/binhongia/danhsach')}}">Thông tin hồ sơ</a></li>
                    @endif
                    <li><a href="{{url('/binhongia/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                    <li><a href="{{url('/binhongia/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                    <li><a href="{{url('/binhongia/baocao')}}">Báo cáo tổng hợp</a></li>
                @endif
            @endif

        </ul>
    </li>
@endif --}}

{{-- @if (chkPer('csdlmucgiahhdv', 'kknygia'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Giá kê khai của hàng hóa, dịch vụ thuộc danh mục Giá kê khai">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['kknygia'] ?? 'Mức giá kê khai, đăng ký' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (session('admin')->level == 'SSA')
                <li><a href="{{ url('doanhnghiep/danhsach') }}">Thông tin doanh nghiệp</a></li>
            @endif
            @if (
                (chkPer('csdlmucgiahhdv', 'kknygia', 'thongtinkknygia', 'hoso', 'index') &&
                    in_array('TONGHOP', session('admin')->chucnang)) ||
                    session('admin')->level == 'SSA')
                <li><a href="{{ url('doanhnghiep/xetduyet') }}"> Xét duyệt thay đổi thông tin doanh nghiệp</a></li>
            @endif
            @if (session('admin')->level != 'DN')
                <li><a href="{{ url('kkgiand85/danhsach') }}"> Xét duyệt hồ sơ theo NĐ-85</a></li>
            @endif
            @if (chkPer('csdlmucgiahhdv', 'kknygia'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV thuộc danh mục bình ổn giá</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'tacn', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Thức ăn chăn nuôi</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiatacn') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetgiatacn') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemgiatacn') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokkgiatacn') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'xangdau', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Xăng, dầu thành phẩm</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'kdm', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Khí dầu mỏ hóa lỏng (LPG)</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'sted6t', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Sữa dành cho trẻ em dưới 06 tuổi</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'tgtt', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Thóc tẻ, gạo tẻ</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'pdurenpk', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Phân đạm; phân DAP; phân NPK</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'vxgxgc', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Vắc-xin phòng bệnh cho gia súc, gia cầm</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'tbvtv', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Thuốc bảo vệ thực vật</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'tpcb', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Thuốc thuộc danh mục thuốc thiết yếu được sử dụng tại cơ sở
                                        khám bệnh, chữa bệnh</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                                        @if (session('admin')->level == 'SSA')
                                            <li><a href="{{ url('/binhongia/danhsach') }}">Thông tin hồ sơ</a></li>
                                        @endif
                                        <li><a href="{{ url('/binhongia/xetduyet') }}">Xét duyệt hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/timkiem') }}">Tìm kiếm hồ sơ</a></li>
                                        <li><a href="{{ url('/binhongia/baocao') }}">Báo cáo tổng hợp</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'kknygia'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV do Chính phủ ban hành</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'xmtxd', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Xi măng, thép xây dựng</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiaxmtxd') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetgiaxmtxd') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemgiaxmtxd') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokkgiaxmtxd') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'nhao', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Nhà ở, nhà chung cư</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'congtrinh', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Công trình hạ tầng kỹ thuật</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'than', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Than</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiathan') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetgiathan') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemgiathan') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokkgiathan') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'etanol', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Etanol nhiên liệu không biến tính, khí tự nhiên hóa lỏng(LNG);
                                        khí thiên nhiên nén (CNG)</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiaetanol') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetgiaetanol') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemgiaetanol') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokkgiaetanol') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'khi', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Khí tự nhiên hóa lỏng</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'thuy', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Thuốc thú y</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'duong', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Đường ăn</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'muoi', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Muối ăn</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'dvcangbien', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Giá dịch vụ tại cảng biển</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiadvcang') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetgiadvcang') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemgiadvcang') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaogiadvcang') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'duongsat', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ vận chuyển hành khách bằng đường sắt</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'duongbo', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ vận chuyển hành khách bằng đường bộ</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'tpcn', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Thực phẩm chức năng cho trẻ em dưới 6 tuổi</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiatpcnte6t') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetkkgiatpcnte6t') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemkkkgiatpcnte6t') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokkgiatpcnte6t') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'tbyt', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Thiết bị y tế</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'kcbtn', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ khám chữa bệnh cho người tại cơ sở khám chữa bệnh tư
                                        nhân; khám chữa bệnh theo yêu cầu tại cơ sở khám chữa bệnh của nhà nước</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiakcbtn') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetgiakcbtn') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemgiakcbtn') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaogiakcbtn') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'vienthong', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ viễn thông</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'kknygia'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV thuộc danh mục kê khai giá</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'dvlt', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ lưu trú</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('thongtincskd') }}">Danh sách CSKD</a> </li>
                                    <li><a href="{{ url('kekhaigiadvlt') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetkkgiadvlt') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemkkgiadvlt') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokekhaidvlt') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'trongxe', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ trông giữ xe</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'tqbien', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ tham quan tại khu du lịch trên địa bàn</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'vtxtx', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Cước vận tải hành khách bằng xe taxi</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiavantaixetaxi') }}">Giá kê khai</a></li>
                                    <li><a href="{{ url('xetduyetkekhaigiavtxtx') }}">Xét duyệt hồ sơ kê khai</a></li>
                                    <li><a href="{{ url('timkiemgiavantaixetaxi') }}">Tìm kiếm hồ sơ kê khai</a></li>
                                    <li><a href="{{ url('baocaogiavantaixetaxi') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'vttqdl', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ vận tải hành khách tham quan du lịch</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'vthh', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ vận tải hàng hóa và hành khách tuyến cố định bằng
                                        đường thủy nội địa - đường biển</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'vlxd', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Vật liệu xây dựng</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiavlxd') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetkkgiavlxd') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemkkgiavlxd') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokkgiavlxd') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'giongnn', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Giống phục vụ sản xuất nông nghiệp</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'chonndg', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ chủ yếu tại chợ ngoài dịch vụ do Nhà nước định
                                        giá</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'nuockhoang', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Dịch vụ kinh doanh nước khoáng nóng</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'cahue', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Giá dịch vụ xem ca Huế trên sông Hương</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiadvcahue') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetkkgiadvcahue') }}">Thông tin hồ sơ xét duyệt</a>
                                    </li>
                                    <li><a href="{{ url('timkiemkkgiadvcahue') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokekhaidvcahue') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        @if (chkPer('csdlmucgiahhdv', 'kknygia', 'hocphilx', 'hoso', 'index'))
                            <li>
                                <a href="javascript:;">
                                    <span class="title">Mức thu học phí đào tạo lái xe cơ giới đường bộ</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('kekhaigiahplx') }}">Giá kê khai</a> </li>
                                    <li><a href="{{ url('xetduyetkkgiahplx') }}">Thông tin hồ sơ xét duyệt</a></li>
                                    <li><a href="{{ url('timkiemkkgiahplx') }}">Tìm kiếm thông tin</a> </li>
                                    <li><a href="{{ url('baocaokekhaihplx') }}">Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
    </li>
@endif --}}

@if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Giá thị trường hàng hóa dịch vụ khác do UBND tỉnh, thành phố trực thuộc trung ương và các Bộ quản lý ngành, lĩnh vực tự quy định thuộc nội dung CSDL giá của mình">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['giahhdvk'] ?? 'Hàng hóa, dịch vụ khác' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'danhmuc', 'index'))
                <!-- Ko dùng if else do quyền SSA sẽ lên cả 2 -->
                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giahhdvk/danhmuc') }}">Danh mục hàng hóa, dịch vụ</a>
                    </li>
                @endif
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giahhdvk/dmdonvi') }}">Danh mục hàng hóa, dịch vụ (đơn vị)</a>
                    </li>
                @endif

            @endif

            @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giahhdvk/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giahhdvk/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'baocao'))
                    <li>
                        <a href="{{ url('/giahhdvk/tonghop') }}">Tổng hợp giá hàng hóa, dịch vụ</a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/giahhdvk/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ url('/giahhdvk/baocao') }}">Báo cáo tổng hợp</a>
            </li>
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'hhdv', 'giavangngoaite'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span
                class="title">{{ session('admin')['a_chucnang']['giavangngoaite'] ?? 'Giá vàng, ngoại tệ' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giavangngoaite', 'danhmuc', 'index'))
                <li>
                    <a href="{{ url('/giavangngoaite/danhmuc') }}">Danh mục</a>
                </li>
            @endif

            @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giavangngoaite', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giavangngoaite/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giavangngoaite/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>

                    {{--                    @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giavangngoaite', 'khac', 'tonghop')) --}}
                    {{--                        <li> --}}
                    {{--                            <a href="{{url('/giavangngoaite/tonghop')}}">Tổng hợp giá</a> --}}
                    {{--                        </li> --}}
                    {{--                    @endif --}}
                @endif

                {{--                <li> --}}
                {{--                    <a href="{{url('/giavangngoaite/timkiem')}}"> --}}
                {{--                        Tìm kiếm hồ sơ --}}
                {{--                    </a> --}}
                {{--                </li> --}}
            @endif

            <li>
                <a href="{{ url('/giavangngoaite/baocao') }}">Báo cáo tổng hợp</a>
            </li>
        </ul>
    </li>
@endif

@if (canGeneral('giathitruong', 'index'))
    @if (can('giathitruong', 'index'))
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Giá thị trường hàng hóa dịch vụ khác do UBND tỉnh, thành phố trực thuộc trung ương và các Bộ quản lý ngành, lĩnh vực tự quy định thuộc nội dung CSDL giá của mình">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">{{ session('admin')['a_chucnang']['giathitruong'] ?? 'Giá thị trường' }} </span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if (can('dmgiathitruong', 'index'))
                    <li>
                        <a href="{{ url('thongtugiathitruong') }}">Thông tư giá thị trường</a>
                    </li>
                @endif
                @if (can('kkgiathitruong', 'index'))
                    <li>
                        <a href="{{ url('kekhaigiathitruong') }}">Thông tin hồ sơ</a>
                    </li>
                @endif
                @if (can('thgiathitruong', 'timkiem'))
                    <li>
                        <a href="{{ url('tkgiatrhitruong') }}">Tìm kiếm thông tin</a>
                    </li>
                @endif
                @if (can('thgiathitruong', 'baocao'))
                    <li>
                        <a href="{{ url('baocaogiathitruong') }}">Báo cáo tổng hợp</a>
                    </li>
                @endif
                @if (can())
                    <li>
                        <a href=""></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
@endif

@if (canGeneral('gialephitruocba', 'index'))
    @if (can('gialephitruocba', 'index'))
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Giá tính lệ phí trước bạ do UBND tỉnh, thành phố trực thuộc trung ương ban hành">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span
                    class="title">{{ session('admin')['a_chucnang']['gialephitruocba'] ?? 'Giá lệ phí trước bạ' }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if (can('dmgialephitruocba', 'index'))
                    <li>
                        <a href="{{ url('nhomlephitruocba') }}">Danh mục nhóm xe </a>
                    </li>
                @endif
                @if (can('kkgialephitruocba', 'index'))
                    <li>
                        <a href="{{ url('lephitruocba') }}">Thông tin giá LPTB</a>
                    </li>
                @endif
                @if (can('thgialephitruocba', 'timkiem'))
                    <li>
                        <a href="{{ url('timkiemlephitruocba') }}">Tìm kiếm thông tin</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
@endif

@if (canGeneral('gialephitruocbanha', 'index'))
    @if (can('gialephitruocbanha', 'index'))
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Giá tính lệ phí trước bạ do UBND tỉnh, thành phố trực thuộc trung ương ban hành">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span
                    class="title">{{ session('admin')['a_chucnang']['gialephitruocbanha'] ?? 'Giá lệ phí trước bạ đối với nhà' }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if (can('kkgialephitruocbanha', 'index'))
                    <li>
                        <a href="{{ url('lephitruocbanha') }}">Thông tin hồ sơ</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
@endif

@if (chkPer('csdlmucgiahhdv', 'taisan', 'taisancong'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['taisancong'] ?? 'Giá tài sản công' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            {{--            @if (chkPer('csdlmucgiahhdv', 'taisan', 'taisancong', 'danhmuc', 'index')) --}}
            {{--                <li> --}}
            {{--                    <a href="{{url('/taisancong/danhmuc?phanloai=taisancong')}}">Danh mục</a> --}}
            {{--                </li> --}}
            {{--            @endif --}}

            @if (chkPer('csdlmucgiahhdv', 'taisan', 'taisancong', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/taisancong/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/taisancong/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/taisancong/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'philephi', 'giaphilephi'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['giaphilephi'] ?? 'Phí, lệ phí' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'philephi', 'giaphilephi', 'danhmuc', 'index'))
                <li>
                    <a href="{{ url('/giaphilephi/danhmuc') }}">Danh mục</a>
                </li>
            @endif
            @if (chkPer('csdlmucgiahhdv', 'philephi', 'giaphilephi', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giaphilephi/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giaphilephi/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/giaphilephi/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'dinhgia', 'khunggiadat'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['khunggiadat'] ?? 'Khung giá đất' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'khunggiadat', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/khunggiadat/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/khunggiadat/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/khunggiadat/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giacldat'))
    {{-- Bảng giá đất --}}
    <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['giacldat'] ?? 'Giá đất theo địa bàn' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giacldat', 'danhmuc', 'index'))
                <li>
                    <a href="{{ url('giacldat/danhmuc') }}">Thông tư giá đất địa bàn</a>
                </li>
            @endif
            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giacldat', 'hoso', 'index'))
                <li>
                    <a href="{{ url('giacldat/danhsach') }}">
                        Giá đất theo địa bàn
                    </a>
                </li>
            @endif
            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                <li>
                    <a href="{{ url('/giacldat/xetduyet') }}">
                        Xét duyệt hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadaugiadat'))
    <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['giadaugiadat'] ?? 'Giá đấu giá đất' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadaugiadat', 'hoso', 'index'))
                <li>
                    <a href="{{ url('giadaugiadat/danhsach') }}">
                        Thông tin hồ sơ
                    </a>
                </li>
            @endif
            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                <li>
                    <a href="{{ url('/giadaugiadat/xetduyet') }}">
                        Xét duyệt hồ sơ
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ url('/giadaugiadat/timkiem') }}">
                    Tìm kiếm hồ sơ
                </a>
            </li>
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadatthitruong'))
    <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span
                class="title">{{ session('admin')['a_chucnang']['giadatthitruong'] ?? 'Giá đất giao dịch thực tế' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadatthitruong', 'hoso', 'index'))
                <li>
                    <a href="{{ url('giadatthitruong/danhsach') }}">
                        Thông tin hồ sơ
                    </a>
                </li>
            @endif
            @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                <li>
                    <a href="{{ url('/giadatthitruong/xetduyet') }}">
                        Xét duyệt hồ sơ
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ url('/giadatthitruong/timkiem') }}">
                    Tìm kiếm hồ sơ
                </a>
            </li>
            @if (chkPer('csdlmucgiahhdv', 'dinhgia', 'giadatthitruong', 'khac', 'baocao'))
                <li>
                    <a href="{{ url('/giadatthitruong/baocao') }}">Báo cáo tổng hợp</a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'taisan', 'giabatdongsan'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span
                class="title">{{ session('admin')['a_chucnang']['giabatdongsan'] ?? 'Giao dịch bất động sản' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'taisan', 'giabatdongsan', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giabatdongsan/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/giabatdongsan/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/giabatdongsan/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (canGeneral('thanhlytaisan', 'index'))
    @if (can('thanhlytaisan', 'index'))
        <li class="javascript:;">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span
                    class="title">{{ session('admin')['a_chucnang']['thanhlytaisan'] ?? 'Giá đấu thầu bán TS' }}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if (can('kkthanhlytaisan', 'index'))
                    <li>
                        <a href="{{ url('thongtingiabantaisan') }}">Thông tin đấu thầu bán TS</a>
                    </li>
                @endif
                @if (can('ththanhlytaisan', 'timkiem'))
                    <li>
                        <a href="{{ url('timkiemttgiabantaisan') }}">Tìm kiếm thông tin</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
@endif

@if (chkPer('csdlmucgiahhdv', 'taisan', 'muataisan'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span
                class="title">{{ session('admin')['a_chucnang']['muataisan'] ?? 'Giá trúng thầu của HH-DV được mua sắm theo QĐ của PL về đấu thầu' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'taisan', 'muataisan', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/muataisan/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/muataisan/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/muataisan/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'philephi', 'phichuyengia'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span
                class="title">{{ session('admin')['a_chucnang']['phichuyengia'] ?? 'Hàng hóa chuyển từ phí sang giá' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'philephi', 'phichuyengia', 'danhmuc', 'index'))
                <li>
                    <a href="{{ url('/phichuyengia/danhmuc') }}">Danh mục</a>
                </li>
            @endif
            @if (chkPer('csdlmucgiahhdv', 'philephi', 'phichuyengia', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/phichuyengia/danhsach') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/phichuyengia/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/phichuyengia/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'philephi', 'gialephitruocbanha'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span
                class="title">{{ session('admin')['a_chucnang']['gialephitruocbanha'] ?? 'Giá lệ phí trước bạ đối với nhà' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'philephi', 'gialephitruocbanha', 'hoso', 'index'))
                @if (in_array('NHAPLIEU', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/lephitruocbanha') }}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if (in_array('TONGHOP', session('admin')->chucnang) || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{ url('/gialephitruocbanha/xetduyet') }}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('/gialephitruocbanha/timkiem') }}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (chkPer('csdlmucgiahhdv', 'taisan', 'giagocvlxd'))
    <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span
                class="title">{{ session('admin')['a_chucnang']['giagocvlxd'] ?? 'Giá gốc vật liệu xây dựng' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (chkPer('csdlmucgiahhdv', 'taisan', 'giagocvlxd', 'hoso', 'index'))
                <!-- tạm thời chưa kích hoạt do chưa tách quyền và chưa xây dựng
                    để đơn vị nhập liệu vào, chức năng tổng hợp sẽ tổng hợp thành hồ so toàn Tỉnh
                    <li>
                        <a href="{{ url('/giagocvlxd/danhsach') }}">Thông tin hồ sơ</a>
                    </li>
                    -->
                <li>
                    <a href="{{ url('/giagocvlxd/tonghop') }}">Tổng hợp hồ sơ</a>
                </li>
            @endif
        </ul>
    </li>

@endif
