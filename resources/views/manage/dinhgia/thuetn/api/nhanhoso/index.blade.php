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
                var url = current_path_url + '?nam=' + $('#nam').val() + '&madv=' + $('#madv').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });

            $('#madv').change(function() {
                changeUrl();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="col-sm-12">
        <h3 class="page-title">
            Nhận hồ sơ giá thuế tài nguyên từ CSDL Quốc gia
        </h3>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">
                </div>
                <div class="actions">
                    @if (count($a_dv) > 0)
                        <!-- Địa bàn có đơn vị có chức năng nhập liệu -->
                        <a href="{{ url($inputs['url'] . '/innhanhosocsdlqg') . '?nam=' . $inputs['nam'] . '&madv=' . $inputs['madv']}}" 
                            class="btn btn-default btn-xs mbs" target="_blank"><i class="fa fa-print"></i>&nbsp;In dữ liệu
                        </a>

                        <button type="button" class="btn btn-default btn-sm" data-target="#create-modal-confirm"
                            data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Nhận dữ liệu
                        </button>
                    @endif
                </div>

            </div>
            <hr>
            <div class="portlet-body form-horizontal">

                <div class="row">
                    <div class="col-md-2">
                        <label style="font-weight: bold">Năm</label>
                        {!! Form::select('nam', getNam(true), $inputs['nam'], ['id' => 'nam', 'class' => 'form-control']) !!}
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label style="font-weight: bold">Địa bàn</label>
                                <select class="form-control select2me" id="madv" name="madv">
                                    @foreach ($m_diaban as $diaban)
                                        <optgroup label="{{ $diaban->tendiaban }}">
                                            <?php $donvi = $m_donvi->where('madiaban', $diaban->madiaban); ?>
                                            @foreach ($donvi as $ct)
                                                <option {{ $ct->madv == $inputs['madv'] ? 'selected' : '' }}
                                                    value="{{ $ct->madv }}">{{ $ct->tendv }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-bordered table-hover" id="sample_4">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">STT</th>
                            <th>Ngày báo cáo</th>
                            <th>Số quyết định</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Cơ quan tiếp nhận</th>
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ getDayVn($tt->thoidiem) }}</td>
                                <td class="text-center">{{ $tt->soqd }}</td>
                                <td>{{ $tt->cqbh }}</td>
                                @include('manage.include.form.td_trangthai')
                                <td style="text-align: left">{{ $a_donvi_th[$tt->macqcq] ?? '' }}</td>
                                <td>
                                    @if (in_array($tt->trangthai, ['CHT', 'HHT']))
                                        <button type="button"
                                            onclick="confirmChuyen('{{ $tt->mahs }}','{{ $inputs['url'] . '/chuyenhs' }}')"
                                            class="btn btn-default btn-xs mbs" data-target="#chuyen-modal-confirm"
                                            data-toggle="modal">
                                            <i class="fa fa-check"></i> Nhận vào phần mềm</button>
                                    @endif
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
    <div class="clearfix">
    </div>
    @include('includes.e.modal-attackfile')

    <!--Modal Create-->
    <div id="create-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">
        {!! Form::open(['url' => $inputs['url'] . '/new', 'id' => 'frm_create', 'method' => 'get']) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Nhận hồ sơ từ CSDL Quốc gia</h4>
                </div>

                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Loại giá</label>
                                {!! Form::select('matt', ['1'=>'Giá đăng ký giá', '2'=>'Giá kê khai giá', '3'=>'Giá thị trường hàng hoá, dịch vụ','4'>'Giá thuế tài nguyên'], null, ['id' => 'matt', 'class' => 'form-control select2me']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Từ ngày<span class="require">*</span></label>
                                {!! Form::input('date', 'thoidiem', null, ['id' => 'thoidiem', 'class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Đến ngày<span class="require">*</span></label>
                                {!! Form::input('date', 'thoidiem', null, ['id' => 'thoidiem', 'class' => 'form-control', 'required']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Link API kết nối <span class="require">*</span></label>
                                {!! Form::text('linkTruyenPost', null, ['class' => 'form-control', 'required']) !!}
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

    <!--Modal File mẫu-->
    <div id="modal-filemau" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">
        {!! Form::open(['url' => $inputs['url'] . '/danhmucmau', 'id' => 'frm_filemau', 'method' => 'post']) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Xuất danh mục hàng hóa, dịch vụ</h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lấy danh mục hàng hóa từ</label>
                                    <div class="radio-list">
                                        <label>
                                            <span><input type="radio" name="phanloai" value="DM"></span>Danh mục
                                            hàng hóa
                                        </label>
                                        <label>
                                            <span><input type="radio" name="phanloai" value="HS"
                                                    checked=""></span>Hồ sơ đã hoàn thành gần nhất
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Thông tư quyết định</label>
                                {!! Form::select('matt', $a_nhom, null, ['id' => 'matt', 'class' => 'form-control select2me']) !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickfilemau()">Đồng
                        ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
