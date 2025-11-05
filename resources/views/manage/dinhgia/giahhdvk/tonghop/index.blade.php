@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
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
            $(":input").inputmask();

            function changeUrl() {
                var current_path_url = '{{ $inputs['url'] }}' + '/tonghop?';
                var url = current_path_url + 'thang=' + $('#thang').val() + '&nam=' + $('#nam').val() + '&matt=' +
                    $('#matt').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });

            $('#thang').change(function() {
                changeUrl();
            });

            $('#matt').change(function() {
                changeUrl();
            });
        });

        function confirmDelete(id) {
            document.getElementById("iddelete").value = id;
        }

        function clickcreate() {
            $('#frm_create').submit();
        }

        function clickcreatethang() {
            $('#frm_createthang').submit();
        }
    </script>
    <script src="{{ url('minhtran/jquery.inputmask.bundle.min.js') }}"></script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        Tổng hợp {{ session('admin')['a_chucnang']['giahhdvk'] ?? 'giá hàng hóa, dịch vụ' }}
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        @if(($inputs['thang'] != 'all' && $inputs['nam'] != 'all'))
                            <button type="button" class="btn btn-default btn-sm" data-target="#createthang-modal-confirm"
                            data-toggle="modal">
                            <i class="fa fa-plus"></i>&nbsp;Tổng hợp tháng</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tháng hồ sơ</label>
                                {!! Form::select('thang', getThang(true), $inputs['thang'], ['id' => 'thang', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Năm hồ sơ</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], ['id' => 'nam', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nhóm hàng hóa</label>
                                {!! Form::select('matt', $a_tt, $inputs['matt'], ['id' => 'matt', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center">STT</th>
                                <th style="text-align: center">Thông tư, quyết định</th>
                                <th style="text-align: center">Thông tin báo cáo</th>
                                <th style="text-align: center">Ngày báo cáo</th>
                                <th style="text-align: center">Số báo cáo</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $ct)
                                <tr>
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td style="font-weight: bold">{{ $a_tt[$ct->matt] }}</td>
                                    <td>{{ $ct->ttbc }}</td>
                                    <td style="text-align: center">{{ getDayVn($ct->ngaybc) }}</td>
                                    <td style="text-align: center">{{ $ct->sobc }}</td>
                                    <td style="text-align: center">
                                        @if ($ct->trangthai == 'HT')
                                            <span class="badge badge-primary">Hoàn thành</span>
                                        @elseif($ct->trangthai == 'CHT')
                                            <span class="badge badge-danger">Chưa hoàn thành</span>
                                        @elseif($ct->trangthai == 'HHT')
                                            <span class="badge badge-danger">Hủy hoàn thành</span>
                                        @else
                                            <span class="badge badge-success">Công bố</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url($inputs['url'] . '/tonghop/chitiet?mahs=' . $ct->mahs) }}"
                                            class="btn btn-default btn-xs mbs" target="_blank">
                                            <i class="fa fa-eye"></i>&nbsp;Chi tiết</a>
                                        @if ($ct->trangthai != 'HT')
                                            <a href="{{ url($inputs['url'] . '/tonghop/edit?mahs=' . $ct->mahs) }}"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                            <a href="{{ url($inputs['url'] . '/tonghop/exportXML?mahs=' . $ct->mahs) }}"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-file-code-o"></i>&nbsp;Xuất file XML</a>
                                            <a href="{{ url($inputs['url'] . '/tonghop/exportEx?mahs=' . $ct->mahs) }}"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-file-code-o"></i>&nbsp;Xuất file Excel</a>
                                            <button type="button" onclick="setHoSo('{{ $ct->mahs }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#taohoso-modal-confirm"
                                                data-toggle="modal">
                                                <i class="fa glyphicon glyphicon-floppy-open"></i>&nbsp;Tạo hồ sơ</button>
                                            <button type="button"
                                                onclick="confirmDelete('{{ $ct->mahs }}','{{ $inputs['url'] . '/tonghop/delete' }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm"
                                                data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        @endif
                                        {{-- @if (chkPer('csdlmucgiahhdv', 'hhdv', 'giahhdvk', 'khac', 'api') && session('admin')->phanloaiketnoi != 'KHONGKETNOI')
                                            <div class="btn-group btn-group-solid">
                                                <button type="button" class="btn btn-default dropdown-toggle btn-xs"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-cog"></i> Truyền lên CSDLQG <i
                                                        class="fa fa-angle-down"></i>
                                                </button>

                                                <ul class="dropdown-menu" style="position: static">
                                                    <li>
                                                        <a href="{{ url('/KetNoiAPI/HoSo?maso=giahhdvk') }}"
                                                            style="border: none;" target="_blank" class="btn btn-default">
                                                            <i class="fa fa-caret-right"></i> Thiết lập thông điệp</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/KetNoiAPI/XemHoSo?maso=giahhdvk&mahs=' . $ct->mahs) }}"
                                                            style="border: none;" target="_blank" class="btn btn-default">
                                                            <i class="fa fa-caret-right"></i> Xem trước thông điệp</a>
                                                    </li>

                                                    <li>
                                                        <button type="button" style="border: none;"
                                                            onclick="ketnoiapi('{{ $ct->mahs }}','giahhdvk', '{{ $inputs['url'] . '/tonghop/' }}')"
                                                            class="btn btn-default" data-target="#ketnoiapi-modal"
                                                            data-toggle="modal">
                                                            <i class="fa fa-caret-right"></i>&nbsp;Truyền dữ liệu
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                        @if ($ct->trangthai == 'HT')
                                            <button type="button"
                                                onclick="confirmHuyHoanThanh('{{ $ct->id }}','{{ $inputs['url'] . '/tonghop/huyhoanthanh' }}')"
                                                class="btn btn-default btn-xs mbs" data-target="#huyhoanthanh-modal-confirm"
                                                data-toggle="modal">
                                                <i class="fa fa-refresh"></i>&nbsp;Hủy hoàn thành</button>
                                        @endif --}}
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>
    @include('includes.e.modal-attackfile')
    <!--Modal Create-->

    <div id="createthang-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">
        {!! Form::open([
            'url' => $inputs['url'] . '/tonghop/createthang',
            'id' => 'frm_createthang',
            'method' => 'post',
        ]) !!}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Tổng hợp giá hàng hóa dịch vụ tháng
                    </h4>
                </div>
                <div class="modal-body">
                    {{--                    <p style="color: #0000FF">Phần mềm sẽ lấy các báo cáo giá hàng hóa, dịch vụ của các Thành phố, Huyện theo thời gian tương ứng để chia trung bình.</p> --}}
                    @if ($inputs['baocao'])
                        <p style="color: #0000FF">
                            Đã có báo cáo tổng hợp trong tháng. Bạn cần kiểm tra dữ liệu trước khi tổng hợp để tránh trùng
                            số liệu.
                        </p>
                    @endif

                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Theo thông tư quyết định</label>
                                {{-- {!! Form::select('matt', $a_tt, $inputs['matt'], ['class' => 'form-control']) !!} --}}
                                {!! Form::select('matt', $a_tt, $inputs['matt'], [
                                    'id' => 'matt',
                                    'class' => 'form-control',
                                    'disabled' => 'disabled',
                                ]) !!}
                                {!! Form::hidden('matt', $inputs['matt']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label>Tháng</label>
                                {!! Form::select('thang', getThang(true), $inputs['thang'], [
                                    'id' => 'thang',
                                    'class' => 'form-control',
                                    'disabled' => 'disabled',
                                ]) !!}
                                {!! Form::hidden('thang', $inputs['thang']) !!}
                            </div>

                            <div class="col-md-6">
                                <label>Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], [
                                    'id' => 'nam',
                                    'class' => 'form-control',
                                    'disabled' => 'disabled',
                                ]) !!}
                                {!! Form::hidden('nam', $inputs['nam']) !!}
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                                <tr>
                                    <th style="text-align: center" width="5%">STT</th>
                                    <th style="text-align: center">Số quyết định</th>
                                    <th style="text-align: center">Ngày nhập</th>
                                    <th style="text-align: center">Tên đơn vị<br>cập nhật</th>
                                    <th style="text-align: center">Tên đơn vị<br>tiếp nhận hồ sơ</th>
                                    <th style="text-align: center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($m_hoso as $key => $tt)
                                    <tr>
                                        <td style="text-align: center">{{ $i++ }}</td>
                                        <td style="text-align: center">{{ $tt->soqd }}<br>Tháng:
                                            {{ $tt->thang . '/' . $tt->nam }}</td>
                                        <td style="text-align: center">{{ getDayVn($tt->thoidiem) }}</td>
                                        <td>{{ $a_donvi[$tt->madv] ?? '' }}</td>
                                        <td>{{ $a_donvi[$tt->macqcq] ?? '' }}</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="{{ 'hoso[' . $tt->mahs . ']' }}" checked />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div id="taohoso-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url' => $inputs['url'] . '/tonghop/taohoso', 'id' => 'frm_taohoso']) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Tạo hồ sơ kê khai giá</h4>
                    <input type="hidden" name="mahs" id="mahs">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Đơn vị nhập liệu</label>
                                {!! Form::select('madv', $a_nhaplieu, null, ['class' => 'form-control select2me']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div id="huyhoanthanh-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url' => $inputs['url'] . '/tonghop/huyhoanthanh', 'id' => 'frm_huyhoanthanh']) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Hủy hoàn thành hồ sơ</h4>
                </div>
                <div class="modal-body">
                    <input type="" name="idhuyhoanthanh" id="idhuyhoanthanh">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary" onclick="clickHuyHoanThanh()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <script>
        function setHoSo(mahs, url) {
            $('#frm_taohoso').find("[id='mahs']").val(mahs);
        }

        // function clickdelete(){
        //     $('#frm_delete').submit();
        // }

        function confirmHuyHoanThanh(id, url) {
            $('#frm_huyhoanthanh').attr('action', url);
            $('#frm_huyhoanthanh').find("[id='idhuyhoanthanh']").val(id);
        }

        function clickHuyHoanThanh() {
            $('#frm_huyhoanthanh').submit();
        }
    </script>

    @include('manage.include.form.modal_del_hs')
    @include('manage.include.form.modal_ketnoi_api')

@stop
