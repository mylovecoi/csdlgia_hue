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

            $('#namhs').change(function() {
                changeUrl();
            });

            $('#madv, #trangthai').change(function() {
                changeUrl();
            });
        });

        function changeUrl() {
            var nam = $('#namhs').val();
            var url = '/kekhaigiahplx?&madv=' + $('#madv').val() + '&nam=' + nam + '&trangthai=' + $('#trangthai').val();
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
        Thông tin kê khai giá<small>&nbsp;học phí lái xe</small>
        <p>
        <h5 style="color: blue">{{ $modeldn->tendn }}&nbsp;- Mã số thuế: {{ $modeldn->madv }}</h5>
        </p>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{ url('kekhaigiahplx/create?&madv=' . $inputs['madv']) }}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Kê khai mới </a>
                    </div>

                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label>Năm hồ sơ</label>
                                <select name="namhs" id="namhs" class="form-control">
                                    @if ($nam_start = intval(date('Y')) - 5)
                                    @endif
                                    @if ($nam_stop = intval(date('Y')) + 1)
                                    @endif
                                    @for ($i = $nam_start; $i <= $nam_stop; $i++)
                                        <option value="{{ $i }}" {{ $i == $inputs['nam'] ? 'selected' : '' }}>
                                            Năm {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label style="font-weight: bold">Đơn vị</label>
                                <select class="form-control select2me" id="madv">
                                    @foreach ($a_diaban as $key => $val)
                                        <optgroup label="{{ $val }}">
                                            <?php $donvi = $m_donvi->where('madiaban', $key); ?>
                                            @foreach ($donvi as $ct)
                                                <option {{ $ct->madv == $inputs['madv'] ? 'selected' : '' }}
                                                    value="{{ $ct->madv }}">{{ $ct->tendn }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label style="font-weight: bold">Trạng thái</label>
                                {!! Form::select('trangthai', getTenTrangThaiHoSoDN(true), $inputs['trangthai'], [
                                    'id' => 'trangthai',
                                    'class' => 'form-control select2me',
                                ]) !!}
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
                            @foreach ($model as $key => $tt)
                                <tr>
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td style="text-align: center">{{ getDayVn($tt->ngaynhap) }}</td>
                                    <td style="text-align: center">{{ getDayVn($tt->ngayhieuluc) }}</td>
                                    <td style="text-align: center" class="active">{{ $tt->socv }}</td>
                                    <td style="text-align: center">{{ $tt->socvlk }}</td>
                                    <td style="text-align: left">{{ $a_donvi_th[$tt->macqcq] ?? '' }}</td>
                                    @include('manage.kkgia._include.td_trangthai')
                                    <td>
                                        <a href="{{ url('kekhaigiahplx/prints?&mahs=' . $tt->mahs) }}" target="_blank"
                                            class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi
                                            tiết</a>
                                        @if (canEdit($tt->trangthai))
                                            <a href="{{ url('kekhaigiahplx/edit?mahs=' . $tt->mahs) }}"
                                                class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                            @if (canChuyenXoa($tt->trangthai))
                                                @if ($tt->trangthai == 'CC')
                                                    <button type="button" onclick="getId('{{ $tt->id }}')"
                                                        class="btn btn-default btn-xs mbs" data-target="#delete-modal"
                                                        data-toggle="modal">
                                                        <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                                @endif
                                                @if ($tt->trangthai == 'CC' || $tt->trangthai == 'BTL')
                                                    <button type="button"
                                                        onclick="confirmChuyen('{{ $tt->mahs }}','{{ $inputs['url'] . '/chuyen' }}')"
                                                        class="btn btn-default btn-xs mbs" data-target="#chuyen-modal"
                                                        data-toggle="modal">
                                                        <i class="fa fa-share-square-o"></i>&nbsp;Chuyển</button>
                                                @endif
                                            @endif
                                            @if (canShowLyDo($tt->trangthai))
                                                <button type="button" data-target="#tralai-modal-confirm"
                                                    onclick="viewLyDo('{{ $tt->mahs }}','{{ $tt->madv }}')"
                                                    data-toggle="modal" class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-search"></i>&nbsp;Lý do trả lại</button>
                                            @endif
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
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>

    <!--Model lý do-->
    <div class="modal fade" id="lydo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><b>Lý do trả lại hồ sơ?</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="showlydo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Modal delete-->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => 'kekhaigiahplx/delete', 'id' => 'frm_delete']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="iddelete" id="iddelete">
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @include('manage.include.form.modal_approve_hsdn')
    @include('manage.include.form.modal_unapprove_dn')
@stop
