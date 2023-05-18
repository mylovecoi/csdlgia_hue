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
        });
        $(function() {
            $('.changeval').change(function() {
                var url = '/cblinhvuckk?phanloai=' + escapeHtml($('#phanloai').val()) + '&madiaban=' +
                    escapeHtml($('#madiaban').val()) + '&madv=' + escapeHtml($('#madv').val());
                window.location.href = url;
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <!-- BEGIN PORTLET-->
            <!--div class="portlet light"-->
            <div class="portlet-title">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light" style="min-height: 587px">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="theme-font bold uppercase">Thông tin công bố giá theo lĩnh vực hoạt động
                                        kinh doanh</span>
                                </div>
                                <div class="tools">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Lĩnh vực kê khai, niêm yết giá</label>
                                        {{ Form::select('', $a_phanloai, $inputs['phanloai'], ['id' => 'phanloai', 'class' => 'form-control select2me changeval']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Địa bàn kê khai, niêm yết</label>
                                        {{ Form::select('', $a_diaban, $inputs['madiaban'], ['id' => 'madiaban', 'class' => 'form-control select2me changeval']) }}
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Đơn vị kê khai, niêm yết giá</label>
                                        {{ Form::select('', $a_doanhnghiep, $inputs['madv'], ['id' => 'madv', 'class' => 'form-control select2me changeval']) }}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center" width="2%">STT</th>
                                            <th style="text-align: center">Tên hàng hóa, dịch vụ</th>
                                            <th style="text-align: center">Quy cách<br>chất lượng</th>
                                            <th style="text-align: center">Đơn vị<br>tính</th>
                                            <th style="text-align: center">Mức giá<br>liền kề</th>
                                            <th style="text-align: center">Mức giá<br>kê khai</th>
                                            <th style="text-align: center">Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($model as $key => $tt)
                                            <tr>
                                                <td style="text-align: center">{{ $key + 1 }}</td>
                                                <td class="active">{{ $tt->tendvcu }}</td>
                                                <td style="text-align: left">{{ $tt->qccl }}</td>
                                                <td style="text-align: center">{{ $tt->dvt }}</td>
                                                <td style="text-align: right">{{ dinhdangso($tt->gialk) }}</td>
                                                <td style="text-align: right">{{ dinhdangso($tt->giakk) }}</td>
                                                <td style="text-align: left">{{ $tt->ghichu }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                </div>

                <!--/div-->
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop
