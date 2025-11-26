@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();

            $('#manghe').change(function() {
                changeUrl();
            });
        });

        function changeUrl() {
            var url = $('#manghe').val();
            window.location.href = url;
        }

        function getId(id) {
            document.getElementById("iddelete").value = id;
        }

        function ClickDelete() {
            $('#frm_delete').submit();
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        <p>
        </p>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                    </div>

                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label style="font-weight: bold">Danh mục hàng hóa-dịch vụ</label>
                                <select class="form-control select2me" id="manghe">
                                    <option value="">--Chọn danh mục--</option>
                                    <optgroup label="HH-DV thuộc danh mục bình ổn giá">
                                        <option value="/xetduyetgiatacn">Thức ăn chăn nuôi</option>
                                        <option value="">Xăng, dầu thành phẩm</option>
                                        <option value="">Khí dầu mỏ hóa lỏng (LPG)</option>
                                        <option value="">Sữa dành cho trẻ em dưới 06 tuổi</option>
                                        <option value="">Thóc tẻ, gạo tẻ</option>
                                        <option value="">Phân đạm; phân DAP; phân NPK</option>
                                        <option value="">Vắc-xin phòng bệnh cho gia súc, gia cầm</option>
                                        <option value="">Thuốc bảo vệ thực vật</option>
                                        <option value="">Thuốc thuộc danh mục thuốc thiết yếu được sử dụng tại cơ sở
                                        khám bệnh, chữa bệnh</option>
                                    </optgroup>
                                    <optgroup label="HH-DV do Chính phủ ban hành">
                                        <option value="/xetduyetgiaxmtxd">Xi măng, thép xây dựng</option>
                                        <option value="">Nhà ở, nhà chung cư</option>
                                        <option value="">Công trình hạ tầng kỹ thuật</option>
                                        <option value="/xetduyetgiathan">Than</option>
                                        <option value="/xetduyetgiaetanol">Etanol nhiên liệu không biến tính, khí tự nhiên hóa lỏng(LNG);
                                        khí thiên nhiên nén (CNG)</option>
                                        <option value="">Khí tự nhiên hóa lỏng</option>
                                        <option value="">Thuốc thú y</option>
                                        <option value="">Đường ăn</option>
                                        <option value="">Muối ăn</option>
                                        <option value="/xetduyetgiadvcang">Giá dịch vụ tại cảng biển</option>
                                        <option value="/">Dịch vụ vận chuyển hành khách bằng đường sắt</option>
                                        <option value="/">Dịch vụ vận chuyển hành khách bằng đường bộ</option>
                                        <option value="/xetduyetkkgiatpcnte6t">Thực phẩm chức năng cho trẻ em dưới 6 tuổi</option>
                                        <option value="">Thiết bị y tế</option>
                                        <option value="/xetduyetgiakcbtn">Dịch vụ khám chữa bệnh cho người tại cơ sở khám chữa bệnh tư
                                        nhân; khám chữa bệnh theo yêu cầu tại cơ sở khám chữa bệnh của nhà nước</option>
                                        <option value="">Dịch vụ viễn thông</option>
                                    </optgroup>
                                    <optgroup label="HH-DV thuộc danh mục kê khai giá">
                                        <option value="/xetduyetkkgiadvlt">Dịch vụ lưu trú</option>
                                        <option value="/">Dịch vụ trông giữ xe</option>
                                        <option value="/">Dịch vụ tham quan tại khu du lịch trên địa bàn</option>
                                        <option value="/xetduyetkekhaigiavtxtx">Cước vận tải hành khách bằng xe taxi</option>
                                        <option value="/">Dịch vụ vận tải hành khách tham quan du lịch</option>
                                        <option value="/">Dịch vụ vận tải hàng hóa và hành khách tuyến cố định bằngđường thủy nội địa - đường biển</option>
                                        <option value="/xetduyetkkgiavlxd">Vật liệu xây dựng</option>
                                        <option value="">Giống phục vụ sản xuất nông nghiệp</option>
                                        <option value="">Dịch vụ chủ yếu tại chợ ngoài dịch vụ do Nhà nước địnhgiá</option>
                                        <option value="">Dịch vụ kinh doanh nước khoáng nóng</option>
                                        <option value="/xetduyetkkgiadvcahue">Giá dịch vụ xem ca Huế trên sông Hương</option>
                                        <option value="/xetduyetkkgiahplx">Mức thu học phí đào tạo lái xe cơ giới đường bộ</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr>
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Ngày kê khai</th>
                                <th style="text-align: center">Ngày thực hiện<br>mức giá kê khai</th>
                                <th style="text-align: center">Số công văn</th>
                                <th style="text-align: center">Số công văn<br> liền kề</th>
                                <th style="text-align: center">Cơ quan tiếp nhận</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center" width="25%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>
@stop
