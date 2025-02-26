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
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục hàng hóa, dịch vụ thị trường</small>
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
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr>
                                <th style="text-align: center" width="5%">STT</th>
                                <th style="text-align: center">Tên thông tư</th>
                                <th style="text-align: center" width="10%">Trạng thái</th>
                                <th style="text-align: center" width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td class="active">{{ $tt->tentt }}</td>
                                    <td class="text-center">{{ $tt->truyendulieu == '1' ? 'Đã truyền dữ liệu' : 'Chưa truyền dữ liệu' }}
                                        </br> {{ getDayVn($tt->thoigiantruyen) }}</td>
                                    <td>

                                        <div class="btn-group btn-group-solid">
                                            <button type="button" class="btn btn-default dropdown-toggle btn-xs"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-cog"></i> Truyền lên CSDLQG <i class="fa fa-angle-down"></i>
                                            </button>

                                            <ul class="dropdown-menu" style="position: static">
                                                <li>
                                                    <a href="{{ url('/KetNoiAPI/HoSo?maso=dmgiahhdvk') }}"
                                                        style="border: none;" target="_blank" class="btn btn-default">
                                                        <i class="fa fa-caret-right"></i> Thiết lập thông điệp</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/KetNoiAPI/XemHoSo?maso=dmgiahhdvk&mahs=' . $tt->matt) }}"
                                                        style="border: none;" target="_blank" class="btn btn-default">
                                                        <i class="fa fa-caret-right"></i> Xem trước thông điệp</a>
                                                </li>

                                                <li>
                                                    <button type="button" style="border: none;"
                                                        onclick="ketnoiapi('{{ $tt->matt }}','dmgiahhdvk', '/csdlquocgia/qg_giathitruong/danhmuc')"
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

    @include('manage.include.form.modal_ketnoi_api')
@stop
