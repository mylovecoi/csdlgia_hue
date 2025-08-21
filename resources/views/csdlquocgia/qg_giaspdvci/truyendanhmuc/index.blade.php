@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
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

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}';
                var url = current_path_url + '?truyendulieu=' + $('#truyendulieu').val();
                window.location.href = url;
            }

            $('#truyendulieu').change(function() {
                changeUrl();
            });
        });

        function ClickEdit(maspdv) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/csdlquocgia/qg_giaspdvci/show_nhomdm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maspdv: maspdv
                },
                dataType: 'JSON',
                success: function(data) {
                    var form = $('#frm_update');
                    form.find("[name='maspdv']").val(data.maspdv);
                    form.find("[name='truyendulieu']").val(data.truyendulieu).trigger('change');
                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Truyền danh mục Giá dịch vụ thu gom, vận chuyển rác thải sinh hoạt 
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>

                </div>
                <hr>
                <div class="portlet-body form-horizontal">

                    <div class="row">
                        <div class="col-md-6">
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
                                <th style="text-align: center">Tên dịch vụ</th>
                                <th style="text-align: center" width="10%">Trạng thái kết nối</th>
                                <th style="text-align: center" width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td class="success">{{$tt->tenspdv}}</td>
                                    <td style="text-align: center">
                                        @if ($tt->truyendulieu == '0' || $tt->truyendulieu == null || $tt->truyendulieu == '')
                                            <span class="badge badge-active">Chưa truyền dữ liệu</span>
                                        @else
                                            <span class="badge badge-success">Đã truyền dữ liệu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" onclick="ClickEdit('{{ $tt->maspdv }}')"
                                            class="btn btn-default btn-xs mbs" data-target="#modal-create"
                                            data-toggle="modal">
                                            <i class="fa fa-edit"></i>&nbsp;Cập nhật trạng thái
                                        </button>
                                        <div class="btn-group btn-group-solid">
                                            <button type="button" class="btn btn-default dropdown-toggle btn-xs"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-cog"></i> Truyền lên CSDLQG <i
                                                            class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu" style="position: static">
                                                <li>
                                                    <a href="{{ url('/KetNoiAPI/HoSo?maso=giaspdvcidm') }}"
                                                        style="border: none;" target="_blank"
                                                        class="btn btn-default">
                                                        <i class="fa fa-caret-right"></i> Thiết lập thông điệp</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/KetNoiAPI/XemHoSo?maso=giaspdvcidm&mahs=' . $tt->maspdv) }}"
                                                        style="border: none;" target="_blank"
                                                        class="btn btn-default">
                                                        <i class="fa fa-caret-right"></i> Xem trước thông điệp</a>
                                                </li>
                                                <li>
                                                    <button type="button" style="border: none;"
                                                        onclick="ketnoiapi('{{ $tt->maspdv }}','giaspdvcidm', '{{ $inputs['url'] . '/xetduyet/' }}')"
                                                        class="btn btn-default" data-target="#ketnoiapi-modal"
                                                        data-toggle="modal">
                                                        <i class="fa fa-caret-right"></i>&nbsp;Truyền dữ liệu
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
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

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => '/csdlquocgia/qg_giaspdvci/capnhatdanhmuc', 'method' => 'post', 'id' => 'frm_update']) !!}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Nhóm dịch vụ giáo dục</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Truyền dữ liệu</label>
                                <select name="truyendulieu" id="truyendulieu" class="form-control">
                                    <option value="1">Đã truyền dữ liệu</option>
                                    <option value="0">Chưa truyền dữ liệu</option>
                                </select>
                            </div>
                        </div>
                        <input name="maspdv" type="hidden" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('manage.include.form.modal_ketnoi_api')
@stop
