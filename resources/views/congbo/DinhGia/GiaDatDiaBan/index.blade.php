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
            $(":input").inputmask();

            function changeUrl() {
                var current_path_url = '{{ $inputs['url'] }}' + '?';
                var url = current_path_url + 'nam=' + $('#nam').val() + '&madiaban=' + $('#madiaban').val() +
                    '&maxp=' + $('#maxp').val() + '&maloaidat=' + $('#maloaidat').val();
                window.location = validURL(url);
            }

            $('#nam').change(function() {
                changeUrl();
            });
            $('#madiaban').change(function() {
                changeUrl();
            });
            $('#maxp').change(function() {
                changeUrl();
            });
            $('#maloaidat').change(function() {
                changeUrl();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <!-- BEGIN PORTLET-->
                <!--div class="portlet light"-->
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label class="control-label" style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], ['id' => 'nam', 'class' => 'form-control select2me']) !!}
                            </div>

                            <div class="col-md-2">
                                <label class="control-label" style="font-weight: bold">Địa bàn</label>
                                {!! Form::select('madiaban', $a_diaban, $inputs['madiaban'], [
                                    'id' => 'madiaban',
                                    'class' => 'form-control select2me',
                                ]) !!}
                            </div>

                            <div class="col-md-2">
                                <label class="control-label" style="font-weight: bold">Xã phường</label>
                                {!! Form::select('maxp', a_merge(['all' => '--Tất cả--'], $a_xp), $inputs['maxp'], [
                                    'id' => 'maxp',
                                    'class' => 'form-control select2me',
                                ]) !!}
                            </div>

                            <div class="col-md-6">
                                <label class="control-label" style="font-weight: bold">Loại đất</label>
                                {!! Form::select('maloaidat', array_merge(['all' => '--Tất cả--'], $a_loaidat), $inputs['maloaidat'], [
                                    'id' => 'maloaidat',
                                    'class' => 'form-control select2me',
                                ]) !!}
                            </div>
                        </div>
                    </div>

                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center" width="2%">STT</th>
                                <th rowspan="2" style="text-align: center">Thời điểm</th>
                                <th rowspan="2" style="text-align: center">Loại đất</th>
                                <th rowspan="2" style="text-align: center">Xã phường</th>
                                <th rowspan="2" style="text-align: center">Khu vực</br>Tên đường phố</th>
                                <th rowspan="2" style="text-align: center">Địa giới</th>
                                <th colspan="4" style="text-align: center">Giá đất</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">VT1</th>
                                <th style="text-align: center">VT2</th>
                                <th style="text-align: center">VT3</th>
                                <th style="text-align: center">VT4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tt)
                                <tr>
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td><b>{{ getDayVn($tt->thoidiem) }}</b></td>
                                    <td style="text-align: left;"><b>{{ $a_loaidat[$tt->maloaidat] ?? '' }}</b></td>
                                    <td style="text-align: left;"><b>{{ $a_xp[$tt->maxp] ?? '' }}</b></td>
                                    <td style="text-align: left" class="active">{{ $tt->khuvuc }}</td>
                                    <td style="text-align: left">{{ 'Từ: ' . $tt->diemdau . '. Đến: ' . $tt->diemcuoi }}</td>
                                    <td style="text-align: center">{{ dinhdangsothapphan($tt->giavt1, 2) }}</td>
                                    <td style="text-align: center">{{ dinhdangsothapphan($tt->giavt2, 2) }}</td>
                                    <td style="text-align: center">{{ dinhdangsothapphan($tt->giavt3, 2) }}</td>
                                    <td style="text-align: center">{{ dinhdangsothapphan($tt->giavt4, 2) }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!--/div-->
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div>
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop
