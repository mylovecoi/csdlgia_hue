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

            function changeUrl() {
                var current_path_url = '{{ $inputs['url'] }}' + '/?';
                var url = current_path_url + 'nam=' + $('#nam').val();                
                window.location = validURL(url);
            }

            $('#nam').change(function() {
                changeUrl();
            });
        });
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
                                class="caption-subject theme-font bold uppercase">{{ session('congbo')['chucnang']['giadaugiadat'] ?? 'Giá đấu giá đất' }}</span>
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
                                    <th width="2%" style="text-align: center">STT</th>
                                    {{-- <th style="text-align: center">Đơn vị nhập</th> --}}
                                    <th style="text-align: center">Thời điểm</th>
                                    <th style="text-align: center">Số lô</th>
                                    <th style="text-align: center">Số thửa</th>
                                    <th style="text-align: center">Tờ bản đồ</th>
                                    <th style="text-align: center">Khu vực</th>
                                    <th style="text-align: center">Mô tả</th>
                                    <th style="text-align: center">Diện tích</th>
                                    <th style="text-align: center">DVT</th>
                                    <th style="text-align: center">Giá khởi</br>điểm</th>
                                    <th style="text-align: center">Giá đấu</br>giá</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($model_dk as $key => $tt)
                                    <tr>
                                        <td style="text-align: center">{{ $i++ }}</td>
                                        <td style="text-align: center">{{ getDayVn($tt->thoidiem) }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="button"
                                                onclick="get_attack('{{ $tt->mahs }}','/giadaugiadat')"
                                                class="btn btn-default btn-xs mbs" data-target="#dinhkem-modal-confirm"
                                                data-toggle="modal">
                                                <i class="fa fa-cloud-download"></i>&nbsp;Tải tệp đính kèm</button>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach

                                @foreach ($model as $key => $tt)
                                    <tr>
                                        <td style="text-align: center">{{ $i++ }}</td>
                                        <td style="text-align: center">{{ getDayVn($tt->thoidiem) }}</td>
                                        <td>{{ $tt->solo }}</td>
                                        <td>{{ $tt->sothua }}</td>
                                        <td>{{ $tt->sotobando }}</td>
                                        <td class="active">{{ $tt->khuvuc }}</td>
                                        <td>{{ $tt->mota }}</td>
                                        <td>{{ dinhdangso($tt->dientich) }}</td>
                                        <td>{{ $tt->dvt }}</td>
                                        <td>{{ dinhdangso($tt->giakhoidiem) }}</td>
                                        <td>{{ dinhdangso($tt->giadaugia) }}</td>
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
    </div>

    @include('manage.include.form.modal_attackfile_congbo')
@stop
