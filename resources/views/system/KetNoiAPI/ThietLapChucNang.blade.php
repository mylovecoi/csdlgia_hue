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

        function change(chucnang, maso) {
            document.getElementById("chucnang").innerHTML = 'Chức năng: ' + chucnang;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#maso').val(maso);
            $.ajax({
                url: '/taikhoan/get_perm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    username: $('#username').val(),
                    maso: maso
                },
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == 'success') {
                        $('#chitiet').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            // Metronic.init(); // init metronic core componets
                            // Layout.init(); // init layout
                            // QuickSidebar.init(); // init quick sidebar
                            //Demo.init(); // init demo features
                        });
                    }
                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
    </script>

@stop

@section('content')

    <h3 class="page-title text-uppercase">
        Thiết lập hồ sơ chức năng kết nối API
    </h3>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                {{--                <div class="portlet-title"> --}}
                {{--                    <div class="caption"> --}}

                {{--                    </div> --}}
                {{--                    <div class="actions"> --}}
                {{--                    </div> --}}
                {{--                </div> --}}
                <hr>
                <div class="portlet-body">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" width="3%">STT</th>
                                <th rowspan="2">Nội dung CSDL địa phương</th>
                                <th colspan="3">Kết nối CSDL quốc gia</th>
                                <th rowspan="2" width="10%">Thao tác</th>
                            </tr>
                            <tr>
                                <th width="20%">Link GET</th>
                                <th width="20%">Link POST</th>
                                <th width="20%">Link PUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($setting as $k1 => $v1)
                                <tr style="font-weight: bold;" class="success">
                                    <td class="text-left" style="text-transform: uppercase;">{{ toAlpha($i++) }}</td>
                                    <td>{{ $a_chucnang[$k1] ?? $k1 }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <!-- Duyệt các group chức năng: Định giá; Kê khai; Phí, lệ phí; ... -->
                                <?php $j = 1; ?>
                                @foreach ($v1 as $k2 => $v2)
                                    <tr style="font-style: italic;font-weight: bold;" class="info">
                                        <td class="text-center">{{ romanNumerals($j++) }}</td>
                                        <td>{{ $a_chucnang[$k2] ?? $k2 }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <?php $m = 1; ?>
                                    @foreach ($v2 as $k3 => $v3)
                                        <tr>
                                            <td class="text-right">{{ $m++ }}</td>
                                            @if (!isset($v3['API']) || $v3['API'] == '0')
                                                <td class="text-line-through">{{ $a_chucnang[$k3] ?? $k3 }}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @else
                                                <td>{{ $a_chucnang[$k3] ?? $k3 }}</td>

                                                {{-- <td class="text-center">
                                                    <a href="{{ $inputs['url'] . '/DanhSachKetNoi?maso=' . $k3 }}"
                                                        class="btn btn-default btn-xs mbs">
                                                        <i class="fa fa-gear"></i></a>
                                                </td> --}}
                                                <?php $chucnang = $model_danhsach->where('maso', $k3)->first(); ?>
                                                <td>{{ $chucnang->linkTruyenGet ?? '' }}</td>
                                                <td>{{ $chucnang->linkTruyenPost ?? '' }}</td>
                                                <td>{{ $chucnang->linkTruyenPut ?? '' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ $inputs['url'] . '/HoSo?maso=' . $k3 }}"
                                                        class="btn btn-default btn-xs mbs">
                                                        <i class="fa fa-gear"></i> Trường dữ liệu</a>

                                                    <button type="button" onclick="getDanhSach('{{ $k3 }}')"
                                                        class="btn btn-default btn-xs mbs" data-target="#edit-modal"
                                                        data-toggle="modal">
                                                        <i class="fa fa-refresh"></i> Link kết nối</button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal thông tin chi tiết -->
    {!! Form::open(['url' => '/KetNoiAPI/LinkKetNoi', 'id' => 'frm_modify']) !!}
    <input type="hidden" name="maso" />
    <div id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thiết lập link kết nối</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Link GET</label>
                                {!! Form::text('linkTruyenGet', null, ['id' => 'linkTruyenGet', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Link POST</label>
                                {!! Form::text('linkTruyenPost', null, ['id' => 'linkTruyenPost', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Link PUT</label>
                                {!! Form::text('linkTruyenPut', null, ['id' => 'linkTruyenPut', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                        ý</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <script>
        function getDanhSach(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/KetNoiAPI/getLink',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso: maso
                },
                dataType: 'JSON',
                success: function(data) {
                    var form = $('#frm_modify');
                    form.find("[name='maso']").val(data.maso);
                    form.find("[name^='link_get']").val(data.link_get);
                    form.find("[name^='link_post']").val(data.link_post);
                    form.find("[name^='link_put']").val(data.link_put);
                }
            });
        }
    </script>
@stop
