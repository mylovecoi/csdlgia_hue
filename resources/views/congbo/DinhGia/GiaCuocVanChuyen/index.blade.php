@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <!-- END THEME STYLES -->
@stop

@section('custom-script-cb')
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
            
            $('#nam').change(function() {
                changeUrl();
            });
        });

        function changeUrl() {
                var current_path_url = '{{ $inputs['url'] }}' + '/?';
                var url = current_path_url + 'nam=' + escapeHtml($('#nam').val());
                window.location = validURL(url);
            }
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <div class="col-sm-12">
                <div class="portlet box">
                    <div class="portlet-title">
                        <div class="caption text-uppercase">
                            <span
                                class="caption-subject theme-font bold uppercase">{{ session('congbo')['chucnang']['giacuocvanchuyen'] ?? 'Giá cước vận chuyển' }}</span>
                        </div>
                    </div>

                    <div class="portlet-body form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <label style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], ['id' => 'nam', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <hr>

                        <table id="sample_4" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="2%" style="text-align: center">STT</th>
                                    <th rowspan="2" style="text-align: center">Đơn vị<br>nhập</th>
                                    <th rowspan="2" style="text-align: center">Địa bàn<br>áp dụng</th>
                                    <th rowspan="2" style="text-align: center">Thời điểm</th>
                                    <th rowspan="2" style="text-align: center">Số quyết<br>định</th>
                                    <th rowspan="2" style="text-align: center">Loại hình<br>vận chuyển</th>
                                    <th rowspan="2" style="text-align: center">Tên<br>hàng hóa</th>
                                    <th rowspan="2" style="text-align: center">Bậc<br>hàng hóa</th>
                                    <th rowspan="2" style="text-align: center">Từ<br>km</th>
                                    <th rowspan="2" style="text-align: center">Đến<br>km</th>
                                    <th colspan="5" style="text-align: center">Giá cước</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">Loại 1</th>
                                    <th style="text-align: center">Loại 2</th>
                                    <th style="text-align: center">Loại 3</th>
                                    <th style="text-align: center">Loại 4</th>
                                    <th style="text-align: center">Loại 5</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($model as $key => $tt)
                                    <tr>
                                        <td style="text-align: center">{{ $key + 1 }}</td>
                                        <td>{{ $a_donvi[$tt->madv] ?? '' }}</td>
                                        <td style="text-align: center">{{ $a_diaban[$tt->madiaban] ?? '' }}</td>
                                        <td style="text-align: center">{{ getDayVn($tt->thoidiem) }}</td>
                                        <td style="text-align: center">{{ $tt->soqd }}</td>
                                        <td style="text-align: left;">{{ $tt->phanloai }}</td>
                                        <td style="text-align: left" class="active">{{ $tt->tencuoc }}</td>
                                        <td style="text-align: left">{{ $tt->bachh }}</td>
                                        <td style="text-align: left">{{ $tt->tukm }}</td>
                                        <td style="text-align: left">{{ $tt->denkm }}</td>
                                        <td style="text-align: right">{{ dinhdangsothapphan($tt->giavc1, 2) }}</td>
                                        <td style="text-align: right">{{ dinhdangsothapphan($tt->giavc2, 2) }}</td>
                                        <td style="text-align: right">{{ dinhdangsothapphan($tt->giavc3, 2) }}</td>
                                        <td style="text-align: right">{{ dinhdangsothapphan($tt->giavc4, 2) }}</td>
                                        <td style="text-align: right">{{ dinhdangsothapphan($tt->giavc5, 2) }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
