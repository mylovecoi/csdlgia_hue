
@if(chkPer('csdlmucgiahhdv','dinhgia'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Giá hàng hóa, dịch vụ do UBND định giá">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['dinhgia'] ?? 'Định giá'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadatpl'))
                <li>
                    <a href="javascript:;">
                        <span class="title">{{session('admin')['a_chucnang']['giadatpl'] ?? 'Giá đất phân loại'}}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadatpl', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giadatphanloai/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giadatphanloai/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giadatphanloai/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuedatnuoc'))
                <li>
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giathuedatnuoc'] ?? 'Giá thuê đất, nước'}}<span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuedatnuoc', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giathuematdatmatnuoc/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giathuematdatmatnuoc/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giathuematdatmatnuoc/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giarung'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="Giá rừng bao gồm rừng sản xuất, rừng phòng hộ và rừng đặc dụng thuộc sở hữu toàn dân do Nhà nước làm đại diện chủ sở hữu">
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giarung'] ?? 'Giá rừng'}}
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giarung', 'danhmuc','index'))
                            <li>
                                <a href="{{url('giarung/danhmuc')}}">Danh mục loại rừng</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giarung', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giarung/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giarung/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giarung/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuemuanhaxh'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giathuemuanhaxh'] ?? 'Giá thuê mua nhà xã hội'}}
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuemuanhaxh', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/thuemuanhaxahoi/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuemuanhaxh', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/thuemuanhaxahoi/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/thuemuanhaxahoi/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/thuemuanhaxahoi/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'gianuocsh'))
                <li>
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['gianuocsh'] ?? 'Giá nước sạch sinh hoạt'}}
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'gianuocsh', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/gianuocsachsinhhoat/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'gianuocsh', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/gianuocsachsinhhoat/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/gianuocsachsinhhoat/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/gianuocsachsinhhoat/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'gianuocsh', 'khac','baocao'))
                            <li>
                                <a href="{{url('/gianuocsachsinhhoat/baocao')}}">Báo cáo tổng hợp</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetscong'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="Giá cho thuê tài sản Nhà nước là công trình kết cấu hạ tầng đầu tư từ nguồn ngân sách địa phương">
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giathuetscong'] ?? 'Giá thuê tài sản công'}}<span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetscong', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/giathuetscong/danhmuc?phanloai=giathuetscong')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetscong', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giathuetscong/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giathuetscong/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giathuetscong/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giaspdvci'))
                <li>
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giaspdvci'] ?? 'Giá sản phẩm, dịch vụ công ích,... đặt hàng'}}<span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giaspdvci', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/giaspdvci/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giaspdvci', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giaspdvci/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giaspdvci/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giaspdvci/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvgddt'))
                <li>
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giadvgddt'] ?? 'Giá dịch vụ đào tạo'}}<span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvgddt', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/giadvgddt/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvgddt', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giadvgddt/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giadvgddt/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giadvgddt/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvkcb'))
                <li>
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giadvkcb'] ?? 'Giá dịch vụ khám chữa bệnh'}}<span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvkcb', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/giadvkcb/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvkcb', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giadvkcb/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giadvkcb/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giadvkcb/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'trogiatrocuoc'))
                <li>
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['trogiatrocuoc'] ?? 'Mức trợ giá, trợ cước'}}<span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'trogiatrocuoc', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/trogiatrocuoc/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'trogiatrocuoc', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/trogiatrocuoc/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/trogiatrocuoc/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/trogiatrocuoc/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giahhdvcn'))
                <li>
                    <a href="javascript:;">
                        {{session('admin')['a_chucnang']['giahhdvcn'] ?? 'Giá hàng hóa, dịch vụ khác theo quy định của pháp luật chuyên ngành'}}<span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giahhdvcn', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/giahhdvcn/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giahhdvcn', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giahhdvcn/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giahhdvcn/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giahhdvcn/timkiem')}}">
                                    Tìm kiếm hồ sơ
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(canGeneral('giadatduan','index'))
                @if(can('giadatduan','index'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">{{session('admin')['a_chucnang']['giadatduan'] ?? 'Giá đất cụ thể dự án'}}</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(can('kkgiadatduan','index'))
                                <li>
                                    <a href="{{url('thongtingiadatduan')}}">Thông tin giá đất</a>
                                </li>
                            @endif
                            @if(can('thgiadatduan','baocao'))
                                <li>
                                    <a href="{{url('baocaogiadatduan')}}">Báo cáo giá đất dự án</a>
                                </li>
                            @endif
                            @if(can('thgiadatduan','timkiem'))
                                <li>
                                    <a href="{{url('timkiemgiadatduan')}}">Tìm kiếm thông tin</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            @if(canGeneral('daugiadatts','index'))
                @if(can('daugiadatts','index'))
                    <li>
                        <a href="javascript:;">
                            {{session('admin')['a_chucnang']['daugiadatts'] ?? 'Giá đấu giá đất và tài sản gắn liền đất'}}<span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(can('kkdaugiadatts','index'))
                                <li>
                                    <a href="{{url('thongtindaugiadatts')}}">Thông tin đấu giá đất và tài sản gắn liền đất</a>
                                </li>
                            @endif
                            {{--@if(can('thgiadaugiadat','timkiem'))--}}
                            {{--<li>--}}
                            {{--<a href="{{url('timkiemthongtindaugiadat')}}">Tìm kiếm thông tin</a>--}}
                            {{--</li>--}}
                            {{--@endif--}}
                        </ul>
                    </li>
                @endif
            @endif

            @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetn'))
                <li>
                    <a href="javascript:;">
                        <span class="title">{{session('admin')['a_chucnang']['giathuetn'] ?? 'Giá thuế tài nguyên'}}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetn', 'danhmuc','index'))
                            <li>
                                <a href="{{url('/giathuetn/danhmuc')}}">Danh mục</a>
                            </li>
                        @endif
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetn', 'hoso','index'))
                            @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giathuetn/danhsach')}}">
                                        Thông tin hồ sơ
                                    </a>
                                </li>
                            @endif

                            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                                <li>
                                    <a href="{{url('/giathuetn/xetduyet')}}">
                                        Xét duyệt hồ sơ
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{url('/giathuetn/timkiem')}}">Tìm kiếm hồ sơ</a>
                            </li>

                            <li>
                                <a href="{{url('/giathuetn/baocao')}}">Báo cáo tổng hợp</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(canGeneral('giathuenhacongvu','index'))
                @if(can('giathuenhacongvu','index'))
                    <li class="tooltips" data-container="body" data-placement="right" data-html="true">
                        @if(can('kkgiathuenhacongvu','index'))
                            <a href="{{url('giathuenhacongvu')}}">
                                {{session('admin')['a_chucnang']['giathuenhacongvu'] ?? 'Giá thuê nhà công vụ'}}
                            </a>
                        @endif
                    </li>
                @endif
            @endif

            @if(canGeneral('bannhataidinhcu','index'))
                @if(can('bannhataidinhcu','index'))
                    <li>
                        @if(can('kkbannhataidinhcu','index'))
                            <a href="{{url('bannhataidinhcu')}}">
                                {{session('admin')['a_chucnang']['bannhataidinhcu'] ?? 'Giá bán nhà tái định cư'}}
                            </a>
                        @endif
                    </li>
                @endif
            @endif
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','bog'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Tổ chức, cá nhận Giá đăng ký theo yêu cầu của Sở Tài chính, sở quản lý ngành">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['bog'] ?? 'Bình ổn giá'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <!--
                - Chỉ có 1 phần nhập liệu sau đó vào hồ sơ chọn danh mục hàng để kê khai
                1. Tài khoản các sở
                    1.1 Danh mục: thay đổi đăng ký / kê khai
                    1.2 Thông tin doanh nghiêp
                    1.3 Xét duyệt
                    1.4 Tìm kiếm
                    1.5 Báo cáo (nếu có)
                2. Tài khoản doanh nghiệp
                    2.1 Thông tin doanh nghiệp
                    2.2 Thông tin mặt hàng theo từng nhóm nghề (có thể bỏ nếu chọn copy mặt hàng của hồ sơ trước)
                    2.3 Kê khai hồ sơ: chọn nghề -> load danh mục (phân loại hồ sơ: đăng ký/ kê khai theo danh mục)

            -->

            @if(chkPer('csdlmucgiahhdv','bog', 'bog', 'danhmuc','index'))
                <li>
                    <a href="{{url('/binhongia/mathang')}}">Phân loại mặt hàng</a>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','bog', 'bog', 'hoso', 'index'))
                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                <!-- chức năng nhập liệu cho đơn vị -->
                    @if(session('admin')->level == 'SSA')
                        <li><a href="{{url('/binhongia/danhsach')}}">Thông tin hồ sơ</a></li>
                    @endif
                    <li><a href="{{url('/binhongia/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                    <li><a href="{{url('/binhongia/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                    <li><a href="{{url('/binhongia/baocao')}}">Báo cáo tổng hợp</a></li>
                @endif
            @endif

        </ul>
    </li>

    <!--li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Tổ chức, cá nhận Giá đăng ký theo yêu cầu của Sở Tài chính, sở quản lý ngành">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">Etanol nhiên liệu không biến tính,khí tự nhiên hóa lỏng(LNG),khí thiên nhiên nén(CNG)</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{url('/giaetanol/mathang')}}">Phân loại mặt hàng</a>
            </li>

            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
        <li><a href="{{url('/giaetanol/danhsach')}}">Thông tin hồ sơ</a></li>
                <li><a href="{{url('/giaetanol/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                <li><a href="{{url('/giaetanol/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                <li><a href="{{url('/giaetanol/baocao')}}">Báo cáo tổng hợp</a></li>
            @endif
            </ul>
        </li>

        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Tổ chức, cá nhận Giá đăng ký theo yêu cầu của Sở Tài chính, sở quản lý ngành">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">Sách giáo khoa</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{url('/giasach/mathang')}}">Phân loại mặt hàng</a>
            </li>

            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
        <li><a href="{{url('/giasach/danhsach')}}">Thông tin hồ sơ</a></li>
                <li><a href="{{url('/giasach/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                <li><a href="{{url('/giasach/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                <li><a href="{{url('/giasach/baocao')}}">Báo cáo tổng hợp</a></li>
            @endif
            </ul>
        </li>

        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Tổ chức, cá nhận Giá đăng ký theo yêu cầu của Sở Tài chính, sở quản lý ngành">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">Than</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{url('/giathan/mathang')}}">Phân loại mặt hàng</a>
            </li>

            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
        <li><a href="{{url('/giathan/danhsach')}}">Thông tin hồ sơ</a></li>
                <li><a href="{{url('/giathan/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                <li><a href="{{url('/giathan/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                <li><a href="{{url('/giathan/baocao')}}">Báo cáo tổng hợp</a></li>
            @endif
            </ul>
        </li>

        <li-- class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Tổ chức, cá nhận Giá đăng ký theo yêu cầu của Sở Tài chính, sở quản lý ngành">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">Giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{url('/giayin/mathang')}}">Phân loại mặt hàng</a>
            </li>

            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
        <li><a href="{{url('/giayin/danhsach')}}">Thông tin hồ sơ</a></li>
                <li><a href="{{url('/giayin/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                <li><a href="{{url('/giayin/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                <li><a href="{{url('/giayin/baocao')}}">Báo cáo tổng hợp</a></li>
            @endif
            </ul>
        </li-->
@endif

@if(chkPer('csdlmucgiahhdv','kknygia'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Giá kê khai của hàng hóa, dịch vụ thuộc danh mục Giá kê khai">
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
            @if(canKkGiaGr('XMTXD'))
                @if(canKkGiaCt('XMTXD','XMTXD'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">Xi măng, thép xây dựng</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(session('admin')->level == 'DN')
                                <li><a href="{{url('thongtinkekhaiximangthepxaydung')}}">Giá kê khai</a> </li>
                            @endif
                            @if(session('admin')->level == 'X' || session('admin')->level == 'H' || session('admin')->level == 'T' )
                                <li><a href="{{url('thongtindnkkgiaxmtxd')}}">Giá kê khai</a></li>
                                <li><a href="{{url('xetduyetkkgiaxmtxd')}}">Thông tin hồ sơ xét duyệt</a></li>
                                <li><a href="{{url('timkiemgiaxmtxd')}}">Tìm kiếm thông tin</a> </li>
                                <li><a href="{{url('baocaokekhaigiaxmtxd')}}">Báo cáo thống kê</a></li>
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
            @if(canKkGiaGr('THAN'))
                @if(canKkGiaCt('THAN','THAN'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">Than</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(session('admin')->level == 'DN')
                                <li><a href="{{url('kekhaigiathan')}}">Giá kê khai than</a> </li>
                            @endif
                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                <li><a href="{{url('thongtindnthan')}}">Giá kê khai</a> </li>
                                <li><a href="{{url('xetduyetgiathan')}}">Thông tin hồ sơ xét duyệt</a></li>
                                <li><a href="{{url('timkiemgiathan')}}">Tìm kiếm thông tin</a> </li>
                                <li><a href="{{url('baocaokkgiathan')}}">Báo cáo thống kê</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{--OK--}}
            @endif
            @if(canKkGiaGr('TACN'))
                @if(canKkGiaCt('TACN','TACN'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">Thức ăn chăn nuôi</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(session('admin')->level == 'DN')
                                <li><a href="{{url('kekhaigiathucanchannuoi')}}">Giá kê khai</a> </li>
                            @endif
                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                <li><a href="{{url('thontindntacn')}}">Giá kê khai</a> </li>
                                <li><a href="{{url('xetduyetkekhaigiatacn')}}">Thông tin hồ sơ xét duyệt</a></li>
                                <li><a href="{{url('timkiemkekhaigiatacn')}}">Tìm kiếm thông tin</a> </li>
                                <li><a href="{{url('baocaokekhaitacn')}}">Báo cáo thống kê</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{--OK--}}
            @endif
            @if(canKkGiaGr('GIAY'))
                @if(canKkGiaCt('GIAY','GIAY'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">Giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(session('admin')->level == 'DN')
                                <li><a href="{{url('kekhaigiagiay')}}">Giá kê khai</a> </li>
                            @endif
                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                <li><a href="{{url('thongtindngiay')}}">Giá kê khai </a> </li>
                                <li><a href="{{url('xetduyetgiagiay')}}">Thông tin hồ sơ xét duyệt</a></li>
                                <li><a href="{{url('timkiemgiagiay')}}">Tìm kiếm thông tin</a> </li>
                                <li><a href="{{url('baocaokkgiagiay')}}">Báo cáo thống kê</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
            @if(canKkGiaGr('SACH'))
                @if(canKkGiaCt('SACH','SACH'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">Sách giáo khoa</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if(session('admin')->level == 'DN')
                                <li><a href="{{url('kekhaigiasach')}}">Giá kê khai</a> </li>
                            @endif
                            @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                <li><a href="{{url('thongtindnsach')}}">Giá kê khai </a> </li>
                                <li><a href="{{url('xetduyetgiasach')}}">Thông tin hồ sơ xét duyệt</a></li>
                                <li><a href="{{url('timkiemgiasach')}}">Tìm kiếm thông tin</a> </li>
                                <li><a href="{{url('baocaokkgiasach')}}">Báo cáo thống kê</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{--OK--}}
            @endif


            @if(canKkGiaGr('csdlmucgiahhdv','kknygia','etanol12344643643'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Etanol nhiên liệu không biến tính, khí tự nhiên hóa lỏng(LNG); khí thiên nhiên nén (CNG) 123</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'DN')
                            <li><a href="{{url('kekhaigiaetanol')}}">Giá kê khai</a> </li>
                        @endif
                        @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                            <li><a href="{{url('/giaetanol/danhsach')}}">Thông tin hồ sơ</a></li>
                            <li><a href="{{url('/giaetanol/xetduyet')}}">Xét duyệt hồ sơ</a></li>
                            <li><a href="{{url('/giaetanol/timkiem')}}">Tìm kiếm hồ sơ</a></li>
                            <li><a href="{{url('/giaetanol/baocao')}}">Báo cáo tổng hợp</a></li>
                        @endif
                        @if(session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                            <li><a href="{{url('thongtindnetanol')}}">Giá kê khai </a> </li>
                            <li><a href="{{url('xetduyetgiaetanol')}}">Thông tin hồ sơ xét duyệt</a></li>
                            <li><a href="{{url('timkiemgiaetanol')}}">Tìm kiếm thông tin</a> </li>
                            <li><a href="{{url('baocaokkgiaetanol')}}">Báo cáo thống kê</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','kknygia', 'xmtxd', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Xi măng, thép xây dựng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiaxmtxd')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetgiaxmtxd')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiaxmtxd')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiaxmtxd')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'than', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Than</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiathan')}}">Giá kê khai than</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetgiathan')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiathan')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiathan')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'tacn', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Thức ăn chăn nuôi</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiatacn')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetgiatacn')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiatacn')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiatacn')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'giay', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiagiay')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetgiagiay')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiagiay')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiagiay')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'sach', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Sách giáo khoa</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiasach')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetgiasach')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiasach')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiasach')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'etanol', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Etanol nhiên liệu không biến tính, khí tự nhiên hóa lỏng(LNG); khí thiên nhiên nén (CNG) 123</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiaetanol')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetgiaetanol')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiaetanol')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiaetanol')}}">Báo cáo thống kê</a></li>
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

            @if(chkPer('csdlmucgiahhdv','kknygia', 'dvvtxk', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Cước vận tải hành khách bằng ôtô tuyến cố định</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiavantaixekhach')}}">Giá kê khai</a></li>
                        @endif

{{--                        <li><a href="{{url('thongtindnvtxk')}}">Giá kê khai</a></li>--}}
                        <li><a href="{{url('xetduyetkekhaigiavtxk')}}">Xét duyệt hồ sơ kê khai</a></li>
                        <li><a href="{{url('timkiemgiavantaixekhach')}}">Tìm kiếm hồ sơ kê khai</a></li>
                        <li><a href="{{url('baocaogiavantaixekhach')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','kknygia', 'dvvtxb', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Cước vận tải hành khách bằng xe buýt theo tuyến cố định</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaivantaixebuyt')}}">Giá kê khai</a></li>
                        @endif
                        <li><a href="{{url('xetduyetkekhaigiavtxb')}}">Xét duyệt hồ sơ kê khai</a></li>
                        <li><a href="{{url('timkiemgiavantaixebuyt')}}">Tìm kiếm hồ sơ kê khai</a></li>
                        <li><a href="{{url('baocaogiavantaixebuyt')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','kknygia', 'dvvtxtx', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Cước vận tải hành khách bằng xe taxi</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level == 'SSA')
                            <li><a href="{{url('kekhaigiavantaixetaxi')}}">Giá kê khai</a></li>
                        @endif
                        <li><a href="{{url('xetduyetkekhaigiavtxtx')}}">Xét duyệt hồ sơ kê khai</a></li>
                        <li><a href="{{url('timkiemgiavantaixetaxi')}}">Tìm kiếm hồ sơ kê khai</a></li>
                        <li><a href="{{url('baocaogiavantaixetaxi')}}">Báo cáo thống kê</a></li>
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

            @if(chkPer('csdlmucgiahhdv','kknygia', 'dvlt', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Dịch vụ lưu trú</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level=='SSA')
                            <li><a href="{{url('thongtincskd')}}">Danh sách CSKD</a> </li>
                            <li><a href="{{url('kekhaigiadvlt')}}">Giá kê khai</a> </li>
                        @endif

                        <li><a href="{{url('xetduyetkkgiadvlt')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiadvlt')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaidvlt')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'cahue', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Giá dịch vụ xem ca Huế trên sông Hương</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level=='SSA')
                            <li><a href="{{url('kekhaigiadvcahue')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetkkgiadvcahue')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiadvcahue')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaidvcahue')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'hocphilx', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Mức thu học phí đào tạo lái xe cơ giới đường bộ</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level=='SSA')
                            <li><a href="{{url('kekhaigiahplx')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetkkgiahplx')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiahplx')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaihplx')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'catsan', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Vật liệu xây dựng: cát, sạn</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level=='SSA')
                            <li><a href="{{url('kekhaigiacatsan')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetkkgiacatsan')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiacatsan')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaicatsan')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'datsanlap', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Vật liệu xây dựng: đất san lấp</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level=='SSA')
                            <li><a href="{{url('kekhaigiadatsanlap')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetkkgiadatsanlap')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiadatsanlap')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaidatsanlap')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','kknygia', 'daxaydung', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Vật liệu xây dựng: đá xây dựng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if(session('admin')->level=='SSA')
                            <li><a href="{{url('kekhaigiadaxaydung')}}">Giá kê khai</a> </li>
                        @endif
                        <li><a href="{{url('xetduyetkkgiadaxaydung')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiadaxaydung')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaidaxaydung')}}">Báo cáo thống kê</a></li>
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
                            @if(session('admin')->level == 'SSA')
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

@if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Giá thị trường hàng hóa dịch vụ khác do UBND tỉnh, thành phố trực thuộc trung ương và các Bộ quản lý ngành, lĩnh vực tự quy định thuộc nội dung CSDL giá của mình">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['giahhdvk'] ?? 'Hàng hóa, dịch vụ khác'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'danhmuc','index'))
                <li>
                    <a href="{{url('/giahhdvk/danhmuc')}}">Danh mục</a>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'hoso','index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giahhdvk/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giahhdvk/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>

                    @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'khac','tonghop'))
                        <li>
                            <a href="{{url('/giahhdvk/tonghop')}}">Tổng hợp giá hàng hóa, dịch vụ</a>
                        </li>
                    @endif
                @endif

                <li>
                    <a href="{{url('/giahhdvk/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif

            <li>
                <a href="{{url('/giahhdvk/baocao')}}">Báo cáo tổng hợp</a>
            </li>
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','hhdv', 'giavangngoaite'))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true" >
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['giavangngoaite'] ?? 'Giá vàng, ngoại tệ'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','hhdv', 'giavangngoaite', 'danhmuc','index'))
                <li>
                    <a href="{{url('/giavangngoaite/danhmuc')}}">Danh mục</a>
                </li>
            @endif

            @if(chkPer('csdlmucgiahhdv','hhdv', 'giavangngoaite', 'hoso','index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giavangngoaite/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giavangngoaite/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>

{{--                    @if(chkPer('csdlmucgiahhdv','hhdv', 'giavangngoaite', 'khac','tonghop'))--}}
{{--                        <li>--}}
{{--                            <a href="{{url('/giavangngoaite/tonghop')}}">Tổng hợp giá</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                @endif

{{--                <li>--}}
{{--                    <a href="{{url('/giavangngoaite/timkiem')}}">--}}
{{--                        Tìm kiếm hồ sơ--}}
{{--                    </a>--}}
{{--                </li>--}}
            @endif

            <li>
                <a href="{{url('/giavangngoaite/baocao')}}">Báo cáo tổng hợp</a>
            </li>
        </ul>
    </li>
@endif

@if(canGeneral('giathitruong','index'))
    @if(can('giathitruong','index'))
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Giá thị trường hàng hóa dịch vụ khác do UBND tỉnh, thành phố trực thuộc trung ương và các Bộ quản lý ngành, lĩnh vực tự quy định thuộc nội dung CSDL giá của mình">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">{{session('admin')['a_chucnang']['giathitruong'] ?? 'Giá thị trường'}} </span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(can('dmgiathitruong','index'))
                    <li>
                        <a href="{{url('thongtugiathitruong')}}">Thông tư giá thị trường</a>
                    </li>
                @endif
                @if(can('kkgiathitruong','index'))
                    <li>
                        <a href="{{url('kekhaigiathitruong')}}">Thông tin hồ sơ</a>
                    </li>
                @endif
                @if(can('thgiathitruong','timkiem'))
                    <li>
                        <a href="{{url('tkgiatrhitruong')}}">Tìm kiếm thông tin</a>
                    </li>
                @endif
                @if(can('thgiathitruong','baocao'))
                    <li>
                        <a href="{{url('baocaogiathitruong')}}">Báo cáo tổng hợp</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
@endif

@if(canGeneral('gialephitruocba','index'))
    @if(can('gialephitruocba','index'))
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Giá tính lệ phí trước bạ do UBND tỉnh, thành phố trực thuộc trung ương ban hành">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">{{session('admin')['a_chucnang']['gialephitruocba'] ?? 'Giá lệ phí trước bạ'}}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(can('dmgialephitruocba','index'))
                    <li>
                        <a href="{{url('nhomlephitruocba')}}">Danh mục nhóm xe </a>
                    </li>
                @endif
                @if(can('kkgialephitruocba','index'))
                    <li>
                        <a href="{{url('lephitruocba')}}">Thông tin giá LPTB</a>
                    </li>
                @endif
                @if(can('thgialephitruocba','timkiem'))
                    <li>
                        <a href="{{url('timkiemlephitruocba')}}">Tìm kiếm thông tin</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
@endif

@if(canGeneral('gialephitruocbanha','index'))
    @if(can('gialephitruocbanha','index'))
        <li class="tooltips" data-container="body" data-placement="right" data-html="true"
            data-original-title="Giá tính lệ phí trước bạ do UBND tỉnh, thành phố trực thuộc trung ương ban hành">
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">{{session('admin')['a_chucnang']['gialephitruocbanha'] ?? 'Giá lệ phí trước bạ đối với nhà'}}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(can('kkgialephitruocbanha','index'))
                    <li>
                        <a href="{{url('lephitruocbanha')}}">Thông tin hồ sơ</a>
                    </li>
                @endif
                {{--@if(can('thgialephitruocbanha','timkiem'))--}}
                    {{--<li>--}}
                        {{--<a href="{{url('tklephitruocbanha')}}">Tìm kiếm thông tin</a>--}}
                    {{--</li>--}}
                {{--@endif--}}
            </ul>
        </li>
    @endif
@endif

@if(chkPer('csdlmucgiahhdv','taisan', 'taisancong'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['taisancong'] ?? 'Giá tài sản công'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
{{--            @if(chkPer('csdlmucgiahhdv','taisan', 'taisancong', 'danhmuc','index'))--}}
{{--                <li>--}}
{{--                    <a href="{{url('/taisancong/danhmuc?phanloai=taisancong')}}">Danh mục</a>--}}
{{--                </li>--}}
{{--            @endif--}}

            @if(chkPer('csdlmucgiahhdv','taisan', 'taisancong', 'hoso', 'index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/taisancong/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/taisancong/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('/taisancong/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','philephi', 'giaphilephi'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['giaphilephi'] ?? 'Phí, lệ phí'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','philephi', 'giaphilephi','danhmuc','index'))
                <li>
                    <a href="{{url('/giaphilephi/danhmuc')}}">Danh mục</a>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','philephi', 'giaphilephi', 'hoso','index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giaphilephi/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giaphilephi/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('/giaphilephi/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','dinhgia', 'khunggiadat'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['khunggiadat'] ?? 'Khung giá đất'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','dinhgia', 'khunggiadat', 'hoso', 'index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/khunggiadat/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/khunggiadat/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('/khunggiadat/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','dinhgia','giacldat'))
    {{--Bảng giá đất--}}
    <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['giacldat'] ?? 'Giá đất theo địa bàn'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','dinhgia','giacldat','danhmuc','index'))
                <li>
                    <a href="{{url('giacldat/danhmuc')}}">Thông tư giá đất địa bàn</a>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','dinhgia','giacldat','hoso','index'))
                <li>
                    <a href="{{url('giacldat/danhsach')}}">
                        Giá đất theo địa bàn
                    </a>
                </li>
            @endif
            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                <li>
                    <a href="{{url('/giacldat/xetduyet')}}">
                        Xét duyệt hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','dinhgia','giadaugiadat'))
    <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['giadaugiadat'] ?? 'Giá đấu giá đất'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','dinhgia','giadaugiadat','hoso','index'))
                <li>
                    <a href="{{url('giadaugiadat/danhsach')}}">
                        Thông tin hồ sơ
                    </a>
                </li>
            @endif
            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                <li>
                    <a href="{{url('/giadaugiadat/xetduyet')}}">
                        Xét duyệt hồ sơ
                    </a>
                </li>
            @endif
            <li>
                <a href="{{url('/giadaugiadat/timkiem')}}">
                    Tìm kiếm hồ sơ
                </a>
            </li>
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','dinhgia','giadatthitruong'))
    <li>
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['giadatthitruong'] ?? 'Giá đất giao dịch thực tế'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','dinhgia','giadatthitruong','hoso','index'))
                <li>
                    <a href="{{url('giadatthitruong/danhsach')}}">
                        Thông tin hồ sơ
                    </a>
                </li>
            @endif
            @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                <li>
                    <a href="{{url('/giadatthitruong/xetduyet')}}">
                        Xét duyệt hồ sơ
                    </a>
                </li>
            @endif
            <li>
                <a href="{{url('/giadatthitruong/timkiem')}}">
                    Tìm kiếm hồ sơ
                </a>
            </li>
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','taisan', 'giabatdongsan'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['giabatdongsan'] ?? 'Giao dịch bất động sản'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','taisan', 'giabatdongsan', 'hoso', 'index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giabatdongsan/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/giabatdongsan/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('/giabatdongsan/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(canGeneral('thanhlytaisan','index'))
    @if(can('thanhlytaisan','index'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['thanhlytaisan'] ?? 'Giá đấu thầu bán TS'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(can('kkthanhlytaisan','index'))
                <li>
                    <a href="{{url('thongtingiabantaisan')}}">Thông tin đấu thầu bán TS</a>
                </li>
            @endif
            @if(can('ththanhlytaisan','timkiem'))
                <li>
                    <a href="{{url('timkiemttgiabantaisan')}}">Tìm kiếm thông tin</a>
                </li>
            @endif
        </ul>
    </li>
    @endif
@endif

@if(chkPer('csdlmucgiahhdv','taisan', 'muataisan'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['muataisan'] ?? 'Giá trúng thầu của HH-DV được mua sắm theo QĐ của PL về đấu thầu'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','taisan', 'muataisan', 'hoso', 'index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/muataisan/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/muataisan/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('/muataisan/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if(chkPer('csdlmucgiahhdv','philephi', 'phichuyengia'))
    <li class="javascript:;">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{session('admin')['a_chucnang']['phichuyengia'] ?? 'Hàng hóa chuyển từ phí sang giá'}}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if(chkPer('csdlmucgiahhdv','philephi', 'phichuyengia','danhmuc','index'))
                <li>
                    <a href="{{url('/phichuyengia/danhmuc')}}">Danh mục</a>
                </li>
            @endif
            @if(chkPer('csdlmucgiahhdv','philephi', 'phichuyengia', 'hoso','index'))
                @if(session('admin')->chucnang == 'NHAPLIEU' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/phichuyengia/danhsach')}}">
                            Thông tin hồ sơ
                        </a>
                    </li>
                @endif

                @if(session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA')
                    <li>
                        <a href="{{url('/phichuyengia/xetduyet')}}">
                            Xét duyệt hồ sơ
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{url('/phichuyengia/timkiem')}}">
                        Tìm kiếm hồ sơ
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif



@if(chkPer('csdlmucgiahhdv','taisan', 'giagocvlxd'))
        <li>
            <a href="javascript:;">
                <i class="icon-folder"></i>
                <span class="title">{{session('admin')['a_chucnang']['giagocvlxd'] ?? 'Giá gốc vật liệu xây dựng'}}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                @if(chkPer('csdlmucgiahhdv','taisan', 'giagocvlxd','hoso','index'))
                    <!-- tạm thời chưa kích hoạt do chưa tách quyền và chưa xây dựng
                    để đơn vị nhập liệu vào, chức năng tổng hợp sẽ tổng hợp thành hồ so toàn Tỉnh
                    <li>
                        <a href="{{url('/giagocvlxd/danhsach')}}">Thông tin hồ sơ</a>
                    </li>
                    -->
                    <li>
                        <a href="{{url('/giagocvlxd/tonghop')}}">Tổng hợp hồ sơ</a>
                    </li>
                @endif
            </ul>
        </li>

@endif
