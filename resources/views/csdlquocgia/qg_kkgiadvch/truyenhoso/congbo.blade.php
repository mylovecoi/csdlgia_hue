@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop


@section('custom-script-cb')
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

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}';
                var url = current_path_url + '?nam=' + $('#nam').val() + '&madv=' + $('#madv').val() + '&truyendulieu=' + $('#truyendulieu').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });

            $('#madv').change(function() {
                changeUrl();
            });

            $('#truyendulieu').change(function() {
                changeUrl();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="col-sm-12">
            <h3 class="page-title">
                Hồ sơ kê khai Giá dịch vụ ca huế
            </h3>
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>

                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="col-md-2">
                        <label style="font-weight: bold">Năm</label>
                        {!! Form::select('nam', getNam(true), $inputs['nam'], ['id' => 'nam', 'class' => 'form-control']) !!}
                    </div>
                    
                    <div class="col-md-5">
                        <label style="font-weight: bold">Đơn vị</label>
                        <select class="form-control select2me" id="madv">
                            @foreach ($m_donvi as $ct)
                                <option {{ $ct->madv == $inputs['madv'] ? 'selected' : '' }}
                                    value="{{ $ct->madv }}">{{ $ct->tendv }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label style="font-weight: bold">Trạng thái kết nối</label>
                                    <select class="form-control select2me" id="truyendulieu" name="truyendulieu">
                                        <option value="all" {{ $inputs['truyendulieu'] == 'all' ? 'selected' : '' }}>--Tất cả--</option>
                                        <option value="1" {{ $inputs['truyendulieu'] == '1' ? 'selected' : '' }}>Đã truyền dữ liệu</option>
                                        <option value="0" {{ $inputs['truyendulieu'] == '0' ? 'selected' : '' }}>Chưa truyền dữ liệu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr>
                                <th style="text-align: center" width="5%">STT</th>
                                <th style="text-align: center" width="20%">Doanh nghiệp</th>
                                <th style="text-align: center" width="8%">Ngày<br> kê khai</th>
                                <th style="text-align: center" width="8%">Ngày thực hiện<br>mức giá</th>
                                <th style="text-align: center" width="8%">Số công văn</th>
                                <th style="text-align: center" width="15%">Người chuyển</th>
                                <th style="text-align: center" width="10%">Trạng thái kết nối</th>
                                <th style="text-align: center" width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td class="active">{{ $tt->tendv_ch }}
                                        <br><b>Mã số thuế:</b> {{ $tt->madv }}
                                    <td style="text-align: center">{{ getDayVn($tt->ngaynhap) }}</td>
                                    <td style="text-align: center">{{ getDayVn($tt->ngayhieuluc) }}</td>
                                    <td style="text-align: center" class="danger">{{ $tt->socv }}</td>
                                    <td style="text-align: left">
                                        @if ($tt->ttnguoinop != '')
                                            Họ và tên: {{ $tt->ttnguoinop }}
                                            <br>Số điện thoại liên hệ: {{ $tt->dtll }}<br>Số Fax:
                                            {{ $tt->fax }}
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if ($tt->truyendulieu == '0' || $tt->truyendulieu == null || $tt->truyendulieu == '')
                                            <span class="badge badge-active">Chưa truyền dữ liệu</span>
                                        @else
                                            <span class="badge badge-success">Đã truyền dữ liệu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/KetNoiAPI/XemHoSo?maso=kkgiadvch&mahs=' . $tt->mahs) }}"
                                            class="btn btn-default btn-xs mbs" target="_blank">
                                            <i class="fa fa-eye"></i>&nbsp;Xem trước thông điệp
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>
@stop
