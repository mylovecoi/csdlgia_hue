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
                var url = current_path_url + '?truyendulieu=' + $('#truyendulieu').val();
                window.location.href = url;
            }

            $('#truyendulieu').change(function() {
                changeUrl();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="col-sm-12">
        <h3 class="page-title">
            Danh mục giá thuế tài nguyên
        </h3>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">
                </div>
                {{-- <div class="actions">
                    <a href="{{ url($inputs['url'] . '/indanhmuccsdlqg')}}"
                        class="btn btn-default btn-xs mbs" target="_blank">
                        <i class="fa fa-print"></i>&nbsp;In dữ liệu
                    </a>
                </div> --}}

            </div>
            <hr>
            <div class="portlet-body form-horizontal">
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
                            <th style="text-align: center">Mã số</th>
                            <th style="text-align: center">Mô tả</th>
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model->where('theodoi', 'TD') as $key => $tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{ $key + 1 }}</td>
                                <td class="active">{{ $tt->manhom }}</td>
                                <td class="active">{{ $tt->tennhom }}</td>
                                <td>
                                    @if ($tt->theodoi == 'TD')
                                        <a href="{{ url('/KetNoiAPI/XemHoSo?maso=dmgiathuetn&mahs=' . $tt->manhom) }}"
                                            class="btn btn-default btn-xs mbs" target="_blank">
                                            <i class="fa fa-eye"></i>&nbsp;Xem trước thông điệp
                                        </a>
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
    <div class="clearfix"></div>
@stop
