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
    <div class=" col-sm-12">
        <h3 class="page-title">
            Thông tin giá nước sạch sinh hoạt
        </h3>
        <!-- BEGIN PORTLET-->
        <!--div class="portlet light"-->
        <div class="portlet box">
            <div class="portlet-title"></div>

            <div class="portlet-body form-horizontal">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label style="font-weight: bold">Năm</label>
                            {!! Form::select('nam', getNam(true), $inputs['nam'], ['id' => 'nam', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <table id="sample_4" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center" width="2%">STT</th>
                            <th rowspan="2" style="text-align: center">Địa bàn</th>
                            <th rowspan="2" style="text-align: center">Ngày áp dụng</th>
                            <th rowspan="2" style="text-align: center">Mô tả</th>
                            <th rowspan="2" style="text-align: center">Đối tượng áp dụng</th>
                            <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                            <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                            <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                            <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                            <th colspan="2" width="10%" style="text-align: center">Đơn giá</th>
                        </tr>
                        <tr>
                            @for ($i = 0; $i < 5; $i++)
                                <th style="text-align: center">Năm<br>áp<br>dụng</th>
                                <th width="7%" style="text-align: center">Giá<br>tiền</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model_dk as $key => $tt)
                            <?php $i = 1; ?>
                            <tr>
                                <td style="text-align: center">{{ $i++ }}</td>
                                <td><b>{{ $a_diaban[$tt->madiaban] ?? '' }}</b></td>
                                <td style="text-align: center;"><b>{{ getDayVn($tt->ngayapdung) }}</b></td>
                                <td style="text-align: center">{{ $tt->mota }}</td>
                                <td style="text-align: center">
                                    <button type="button"
                                        onclick="get_attack('{{ $tt->mahs }}','gianuocsachsinhhoat')"
                                        class="btn btn-default btn-xs mbs" data-target="#dinhkem-modal-confirm"
                                        data-toggle="modal">
                                        <i class="fa fa-cloud-download"></i>&nbsp;Tải tệp đính kèm</button>
                                </td>
                                @for ($i = 0; $i < 10; $i++)
                                    <td></td>
                                @endfor
                            </tr>
                        @endforeach
                        @foreach ($model as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{ $key + 1 }}</td>
                                <td><b>{{ $a_diaban[$tt->madiaban] ?? '' }}</b></td>
                                <td style="text-align: center;"><b>{{ getDayVn($tt->ngayapdung) }}</b></td>
                                <td style="text-align: center">{{ $tt->mota }}</td>
                                <td style="text-align: left">{{ $tt->doituongsd }}</td>
                                <td class="text-center">{{ $tt->namchuathue }}</td>
                                <td class="text-right">{{ dinhdangsothapphan($tt->giachuathue) }}</td>
                                <td class="text-center">{{ $tt->namchuathue1 }}</td>
                                <td class="text-right">{{ dinhdangsothapphan($tt->giachuathue1) }}</td>
                                <td class="text-center">{{ $tt->namchuathue2 }}</td>
                                <td class="text-right">{{ dinhdangsothapphan($tt->giachuathue2) }}</td>
                                <td class="text-center">{{ $tt->namchuathue3 }}</td>
                                <td class="text-right">{{ dinhdangsothapphan($tt->giachuathue3) }}</td>
                                <td class="text-center">{{ $tt->namchuathue4 }}</td>
                                <td class="text-right">{{ dinhdangsothapphan($tt->giachuathue4) }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!--/div-->
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
    @include('manage.include.form.modal_attackfile_congbo')
@stop
