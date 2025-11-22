@if (chkPer('csdlkkgia', ''))
    <li class="tooltips" data-container="body" data-placement="right" data-html="true"
        data-original-title="Giá kê khai của hàng hóa, dịch vụ thuộc danh mục Giá kê khai">
        <a href="javascript:;">
            <i class="icon-folder"></i>
            <span class="title">{{ session('admin')['a_chucnang']['csdlkkgia'] ?? 'Mức giá kê khai, đăng ký' }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @if (session('admin')->level == 'SSA')
                <li><a href="{{ url('doanhnghiep/danhsach') }}">Thông tin doanh nghiệp</a></li>
            @endif
            @if (
                (chkPer('csdlkkgia', 'csdlkkgia', 'thongtinkknygia', 'hoso', 'index') &&
                    in_array('TONGHOP', session('admin')->chucnang)) ||
                    session('admin')->level == 'SSA')
                <li><a href="{{ url('doanhnghiep/xetduyet') }}"> Xét duyệt thay đổi thông tin doanh nghiệp</a></li>
            @endif
            @if (session('admin')->level != 'DN')
                <li><a href="{{ url('kkgiand85/danhsach') }}"> Xét duyệt hồ sơ</a></li>
            @endif
            @if (chkPer('csdlkkgia', 'bog'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV thuộc danh mục bình ổn giá</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlkkgia', 'kknygia', 'tacn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'xangdau', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'kdm', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'sted6t', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'tgtt', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'pdurenpk', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vxgxgc', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'tbvtv', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'tpcb', 'hoso', 'index'))
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

            @if (chkPer('csdlkkgia', 'cp'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV do Chính phủ ban hành</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlkkgia', 'kknygia', 'xmtxd', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'nhao', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'congtrinh', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'than', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'etanol', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'khi', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'thuy', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'duong', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'muoi', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'dvcangbien', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'duongsat', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'duongbo', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'tpcn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'tbyt', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'kcbtn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vienthong', 'hoso', 'index'))
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

            @if (chkPer('csdlkkgia', 'kknygia'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV thuộc danh mục kê khai giá</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlkkgia', 'kknygia', 'dvlt', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'trongxe', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'tqbien', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vtxtx', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vttqdl', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vthh', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vlxd', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'giongnn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'chonndg', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'nuockhoang', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'cahue', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'hocphilx', 'hoso', 'index'))
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
    <ul class="sub-menu">
            @if (session('admin')->level == 'SSA')
                <li><a href="{{ url('doanhnghiep/danhsach') }}">Thông tin doanh nghiệp</a></li>
            @endif
            @if ((chkPer('csdlkkgia', 'thongtinkknygia', 'hoso', 'index') &&
                    in_array('TONGHOP', session('admin')->chucnang)) ||
                    session('admin')->level == 'SSA')
                <li><a href="{{ url('doanhnghiep/xetduyet') }}"> Xét duyệt thay đổi thông tin doanh nghiệp</a></li>
            @endif
            @if (session('admin')->level != 'DN')
                <li><a href="{{ url('kkgiand85/danhsach') }}"> Xét duyệt hồ sơ</a></li>
            @endif
            @if (chkPer('csdlkkgia', 'bog'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV thuộc danh mục bình ổn giá</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlkkgia', 'bog', 'tacn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'xangdau', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'kdm', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'sted6t', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'tgtt', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'pdurenpk', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'vxgxgc', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'tbvtv', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'bog', 'tpcb', 'hoso', 'index'))
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

            @if (chkPer('csdlkkgia', 'cp'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV do Chính phủ ban hành</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlkkgia', 'cp', 'xmtxd', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'nhao', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'congtrinh', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'than', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'etanol', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'khi', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'thuy', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'duong', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'muoi', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'dvcangbien', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'duongsat', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'duongbo', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'tpcn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'tbyt', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'kcbtn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'cp', 'vienthong', 'hoso', 'index'))
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

            @if (chkPer('csdlkkgia', 'kknygia'))
                <li>
                    <a href="javascript:;">
                        <span class="title">HH-DV thuộc danh mục kê khai giá</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (chkPer('csdlkkgia', 'kknygia', 'dvlt', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'trongxe', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'tqbien', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vtxtx', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vttqdl', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vthh', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'vlxd', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'giongnn', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'chonndg', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'nuockhoang', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'cahue', 'hoso', 'index'))
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
                        @if (chkPer('csdlkkgia', 'kknygia', 'hocphilx', 'hoso', 'index'))
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

            {{-- @if (chkPer('csdlkkgia', 'kknygia', 'giay', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiagiay')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetgiagiay')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiagiay')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiagiay')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'sach', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Sách giáo khoa</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiasach')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetgiasach')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiasach')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiasach')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'xemay', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Giá xe gắn máy nhập khẩu, sản xuất trong nước</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiaxemaynksx')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetgiaxemaynksx')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiaxemaynksx')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiaxemaynksx')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'oto', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Giá ô tô nhập khẩu, sản xuất trong nước dưới 15 chỗ ngồi</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiaotonksx')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetgiaotonksx')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiaotonksx')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiaotonksx')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'dvvtxk', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Cước vận tải hành khách bằng ôtô tuyến cố định</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiavantaixekhach')}}">Giá kê khai</a></li>
                        <li><a href="{{url('xetduyetkekhaigiavtxk')}}">Xét duyệt hồ sơ kê khai</a></li>
                        <li><a href="{{url('timkiemgiavantaixekhach')}}">Tìm kiếm hồ sơ kê khai</a></li>
                        <li><a href="{{url('baocaogiavantaixekhach')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'dvvtxb', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Cước vận tải hành khách bằng xe buýt theo tuyến cố định</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaivantaixebuyt')}}">Giá kê khai</a></li>
                        <li><a href="{{url('xetduyetkekhaigiavtxb')}}">Xét duyệt hồ sơ kê khai</a></li>
                        <li><a href="{{url('timkiemgiavantaixebuyt')}}">Tìm kiếm hồ sơ kê khai</a></li>
                        <li><a href="{{url('baocaogiavantaixebuyt')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'catsan', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Vật liệu xây dựng: cát, sạn</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiacatsan')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetkkgiacatsan')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiacatsan')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaicatsan')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'datsanlap', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Vật liệu xây dựng: đất san lấp</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiadatsanlap')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetkkgiadatsanlap')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiadatsanlap')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaidatsanlap')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'daxaydung', 'hoso', 'index'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Vật liệu xây dựng: đá xây dựng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiadaxaydung')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetkkgiadaxaydung')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemkkgiadaxaydung')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokekhaidaxaydung')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (chkPer('csdlkkgia', 'kknygia', 'dvhdtmck', 'hoso', 'index'))
                <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="Giá dịch vụ hỗ trợ hoạt động thương mại tại cửa khẩu (kho,bến, bãi, bốc xếp hàng hóa tại cửa khẩu, dịch vụ khác">
                    <a href="javascript:;">
                        <span class="title">Giá dịch vụ hỗ trợ hoạt động thương mại tại cửa khẩu</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaigiadvhdtm')}}">Giá kê khai</a> </li>
                        <li><a href="{{url('xetduyetkkgiadvhdtm')}}">Thông tin hồ sơ xét duyệt</a></li>
                        <li><a href="{{url('timkiemgiadvhdtm')}}">Tìm kiếm thông tin</a> </li>
                        <li><a href="{{url('baocaokkgiadvhdtm')}}">Báo cáo thống kê</a></li>
                    </ul>
                </li>
            @endif
            @if (canKkGiaCt('DVVTHK', 'VC'))
                <li>
                    <a href="javascript:;">
                        <span class="title">Cước vận chuyển hành khách: xe buýt, xe điện, bè mảng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('kekhaicuocvchk')}}">Giá kê khai</a></li>
                        @if (session('admin')->level == 'X' || session('admin')->level == 'H' || session('admin')->level == 'T')
                            <li><a href="{{url('thongtindnvchk')}}">Giá kê khai</a></li>
                            <li><a href="{{url('xetduyetkekhaicuocvchk')}}">Xét duyệt hồ sơ kê khai</a></li>
                            <li><a href="{{url('timkiemcuocvchk')}}">Tìm kiếm hồ sơ kê khai</a></li>
                            <li><a href="{{url('baocaogiacuocvchk')}}">Báo cáo thống kê</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (canKkGiaGr('DLBB'))
                @if (canKkGiaCt('DLBB', 'DLBB'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">Giá dịch vụ du lịch tại bãi biển</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if (session('admin')->level == 'SSA')
                                <li><a href="{{url('kekhaigiadvdlbb')}}">Giá kê khai</a> </li>
                            @endif
                            @if (session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                <li><a href="{{url('thongtindndlbb')}}">Giá kê khai </a> </li>
                                <li><a href="{{url('xetduyetgiadvdlbb')}}">Thông tin hồ sơ xét duyệt</a></li>
                                <li><a href="{{url('timkiemgiadvdlbb')}}">Tìm kiếm thông tin</a> </li>
                                <li><a href="{{url('baocaokekhaidvdlbb')}}">Báo cáo thống kê</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
            @if (canKkGiaGr('TQKDL'))
                @if (canKkGiaCt('TQKDL', 'TQKDL'))
                    <li>
                        <a href="javascript:;">
                            <span class="title">Giá vé tham quan tại các khu du lịch</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if (session('admin')->level == 'DN')
                                <li><a href="{{url('kekhaigiavetqkdl')}}">Giá kê khai</a> </li>
                            @endif
                            @if (session('admin')->level == 'X' || session('admin')->level == 'T' || session('admin')->level == 'H')
                                <li><a href="{{url('thongtindntqkdl')}}">Giá kê khai </a> </li>
                                <li><a href="{{url('xetduyetgiavetqkdl')}}">Thông tin hồ sơ xét duyệt</a></li>
                                <li><a href="{{url('timkiemgiavetqkdl')}}">Tìm kiếm thông tin</a> </li>
                                <li><a href="{{url('baocaokekhaigiavetqkdl')}}">Báo cáo thống kê</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif --}}
        </ul>
@endif