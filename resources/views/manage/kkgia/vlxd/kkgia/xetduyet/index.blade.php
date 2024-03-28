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
        });

        $(function() {
            $('#nam').change(function() {
                var namhs = '&nam=' + $('#nam').val();
                var madv = '&madv=' + $('#madv').val();
                var url = '/xetduyetkkgiavlxd?' + namhs + madv + '&trangthai=' + $('#trangthai').val();
                window.location.href = url;
            });

            $('#madv, #trangthai').change(function() {
                var namhs = '&nam=' + $('#nam').val();
                var madv = '&madv=' + $('#madv').val();
                var url = '/xetduyetkkgiavlxd?' + namhs + madv + '&trangthai=' + $('#trangthai').val();
                window.location.href = url;
            });

        });

        function confirmNhanHs(mahs) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/xetduyetkkgiavlxd/ttnhanhs',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahs: mahs
                },
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == 'success') {
                        $('#ttnhanhs').replaceWith(data.message);
                        //InputMask();
                    } else
                        toastr.error("Không thể chỉnh sửa thông tin nhận hồ sơ giá !", "Lỗi!");
                }
            })
        }

        function ClickNhanHs() {
            $('#frm_nhanhs').submit();
            var btn = document.getElementById('submitNhanHs');
            btn.disabled = true;
            btn.innerText = 'Loading...';
        }

        // function ClickTraLai(maso, madv) {
        //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //     //            alert(id);
        //     //            alert(madv);
        //     $.ajax({
        //         url: '/ttdnvlxd',
        //         type: 'GET',
        //         data: {
        //             _token: CSRF_TOKEN,
        //             id: maso,
        //         },
        //         dataType: 'JSON',
        //         success: function(data) {
        //             $('#ttdnkkdvgs').find("[id='idtralai']").val(maso);
        //             $('#ttdnkkdvgs').find("[id='madvtralai']").val(madv);
        //             if (data.status == 'success') {
        //                 $('#ttdnkkdvgs').replaceWith(data.message);
        //                 // document.getElementById("idtralai").value = id;
        //                 // document.getElementById("madvtralai").value = madv;
        //             }
        //         }
        //     })
        // }

        function ClickTraLai(maso, url, madv) {
            $('#frm_tralai').attr('action', url);
            $('#frm_tralai').find("[id='idtralai']").val(maso);
            $('#frm_tralai').find("[id='madvtralai']").val(madv);
        }

        function confirmTraLai(id, madv) {
            if ($('#lydo').val() != '') {
                var btn = document.getElementById('submitTraLai');
                btn.disabled = true;
                btn.innerText = 'Loading...';
                toastr.success("Hồ sơ đã được trả lại!", "Thành công!");
                // $('#frm_tralai').find("[id='mahs']").val(mahs);
                // $('#frm_tralai').find("[id='madv']").val(madv);
                $("#frm_tralai").unbind('submit').submit();
            } else {
                toastr.error("Bạn cần nhập lý do trả lại hồ sơ", "Lỗi!!!");
                $("#frm_tralai").submit(function(e) {
                    e.preventDefault();
                });
            }

        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin xét duyệt kê khai giá<small>&nbsp;vật liệu xây dựng</small>
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Năm hồ sơ</label>
                <select name="nam" id="nam" class="form-control">
                    @if ($nam_start = intval(date('Y')) - 5)
                    @endif
                    @if ($nam_stop = intval(date('Y')) + 1)
                    @endif
                    @for ($i = $nam_start; $i <= $nam_stop; $i++)
                        <option value="{{ $i }}" {{ $i == $inputs['nam'] ? 'selected' : '' }}>Năm
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <label style="font-weight: bold">Đơn vị</label>
            <select class="form-control select2me" id="madv">
                @foreach ($m_diaban as $diaban)
                    <optgroup label="{{ $diaban->tendiaban }}">
                        <?php $donvi = $m_donvi->where('madiaban', $diaban->madiaban); ?>
                        @foreach ($donvi as $ct)
                            <option {{ $ct->madv == $inputs['madv'] ? 'selected' : '' }} value="{{ $ct->madv }}">
                                {{ $ct->tendv }}</option>
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

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                                <tr>
                                    <th style="text-align: center ; margin: auto" width="2%">STT</th>
                                    <th style="text-align: center" width="20%">Doanh nghiệp</th>
                                    <th style="text-align: center" width="8%">Ngày<br> kê khai</th>
                                    <th style="text-align: center" width="8%">Ngày thực hiện<br>mức giá</th>
                                    <th style="text-align: center" width="8%">Số công văn</th>
                                    <th style="text-align: center" width="15%">Người chuyển</th>
                                    <th style="text-align: center" width="15%">Trạng thái</th>
                                    <th style="text-align: center" width="25%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model as $key => $tt)
                                    <tr>
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
                                        @include('manage.kkgia._include.td_trangthai')
                                        <td>
                                            <a href="{{ url('kekhaigiavlxd/prints?&mahs=' . $tt->mahs) }}" target="_blank"
                                                class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi
                                                tiết</a>
                                            @if ($tt->level == 'ADMIN')
                                                @if ($tt->trangthai == 'CB')
                                                    <button type="button"
                                                        onclick="confirmCongbo('{{ $tt->mahs }}','{{ $inputs['url'] . '/congbo' }}', 'HCB')"
                                                        class="btn btn-default btn-xs mbs" data-target="#congbo-modal"
                                                        data-toggle="modal">
                                                        <i class="fa fa-times"></i>&nbsp;Hủy công bố</button>
                                                @else
                                                    <button type="button"
                                                        onclick="confirmCongbo('{{ $tt->mahs }}','{{ $inputs['url'] . '/congbo' }}', 'CB')"
                                                        class="btn btn-default btn-xs mbs" data-target="#congbo-modal"
                                                        data-toggle="modal">
                                                        <i class="fa fa-send"></i>&nbsp;Công bố</button>

                                                    <button type="button"
                                                        onclick="ClickTraLai('{{ $tt->id }}','{{$inputs['url'].'/tralai'}}','{{ $tt->madv }}')"
                                                        class="btn btn-default btn-xs mbs" data-target="#tralai-modal"
                                                        data-toggle="modal">
                                                        <i class="fa fa-reply"></i>&nbsp;Trả lại</button>
                                                @endif
                                            @else
                                                @if ($tt->trangthai == 'CD')
                                                    <button type="button" onclick="confirmNhanHs('{{ $tt->mahs }}')"
                                                        class="btn btn-default btn-xs mbs" data-target="#nhanhs-modal"
                                                        data-toggle="modal"><i class="fa fa-share"></i>&nbsp;
                                                        Nhận hồ sơ</button>
                                                @endif

                                                @if (in_array($tt->trangthai, ['CD', 'DD', 'BTL']))
                                                    <button type="button"
                                                        onclick="ClickTraLai('{{ $tt->id }}','{{$inputs['url'].'/tralai'}}','{{ $tt->madv }}')"
                                                        class="btn btn-default btn-xs mbs" data-target="#tralai-modal"
                                                        data-toggle="modal"><i class="fa fa-reply"></i>&nbsp;
                                                        Trả lại</button>
                                                @endif

                                                @if (in_array($tt->trangthai, ['DD', 'BTL']))
                                                    <button type="button"
                                                        onclick="confirmChuyenXD('{{ $tt->mahs }}','{{ $inputs['url'] . '/chuyenxd' }}', '{{ $tt->madv }}')"
                                                        class="btn btn-default btn-xs mbs"
                                                        data-target="#chuyenxd-modal-confirm" data-toggle="modal">
                                                        <i class="fa fa-check"></i> Chuyển công bố</button>
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
        <!--Model trả lại-->
        <div class="modal fade" id="tralai-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url' => '', 'id' => 'frm_tralai']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý trả lại hồ sơ?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="ttdnkkdvgs">
                        </div>
                        <div class="form-group">
                            <label><b>Lý do trả lại</b></label>
                            <textarea id="lydo" class="form-control" name="lydo" cols="30" rows="8"></textarea>
                        </div>
                        <input type="hidden" name="idtralai" id="idtralai">
                        <input type="hidden" name="madvtralai" id="madvtralai">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="confirmTraLai()" id="submitTraLai">Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!--Model nhận hs-->
        <div class="modal fade" id="nhanhs-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url' => 'xetduyetkkgiavlxd/nhanhs', 'id' => 'frm_nhanhs']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý nhận hồ sơ?</h4>
                    </div>
                    <div class="modal-body" id="ttnhanhs">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickNhanHs()" id="submitNhanHs">Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!--Model nhận hs edit-->
        <div class="modal fade" id="nhanhsedit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url' => 'xetduyetkkgiavlxd/nhanhsedit', 'id' => 'frm_nhanhsedit']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Chỉnh sửa thông tin nhận hồ sơ?</h4>
                    </div>
                    <div class="modal-body" id="ttnhanhsedit">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickNhanHsedit()">Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!--Model huỷ duyệt-->
        <div class="modal fade" id="huyduyet-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url' => 'xetduyetkkgiavlxd/huyduyet', 'id' => 'frm_huyduyet']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý huỷ duyệt hồ sơ?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="color: blue"><b>Hồ sơ sẽ chuyển về trạng thái chờ xét duyệt, hồ sơ lưu bên trang
                                    công bố sẽ bị xoá bỏ. Đồng thời trong lịch sử hồ sơ sẽ lưu lại vết hồ sơ bị huỷ
                                    duyệt</b></label>
                        </div>
                        <div class="form-group" id="tthuyduyet">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn blue" onclick="ClickHuyDuyet()">Đồng ý</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>

        <!--Model lý do-->
        <div class="modal fade" id="lydo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
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

        @include('manage.include.form.modal_congbo')
        @include('manage.include.form.modal_approve_xd')
        @include('includes.script.create-header-scripts')
    @stop
