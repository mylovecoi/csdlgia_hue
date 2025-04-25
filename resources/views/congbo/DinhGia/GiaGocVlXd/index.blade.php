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

            $('#nam, #madiaban').change(function() {
                changeUrl();
            });
        });

        function changeUrl() {
            var current_path_url = '{{ $inputs['url'] }}' + '?';
            var url = current_path_url + 'nam=' + escapeHtml($('#nam').val());
            window.location = validURL(url);
        }
    </script>
@stop

@section('content-cb')
    <div class=" col-sm-12">
        <h3 class="page-title">
            Thông tin giá gốc vật liệu xây dựng
        </h3>
        <div class="portlet box">
            <div class="portlet-title"></div>

            <div class="portlet-body form-horizontal">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label style="font-weight: bold">Năm</label>
                            {!! Form::select('nam', getNam(true), $inputs['nam'], ['id' => 'nam', 'class' => 'form-control']) !!}
                        </div>

                        {{--                        <div class="col-md-4"> --}}
                        {{--                            <label style="font-weight: bold">Địa bàn</label> --}}
                        {{--                            {!!Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban','class' => 'form-control'))!!} --}}
                        {{--                        </div> --}}
                    </div>
                </div>

                <table id="sample_4" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center" width="5%">Thời điểm</th>
                            {{--                        <th style="text-align: center">Địa bàn</th> --}}
                            <th style="text-align: center">Tên hàng hóa dịch vụ	</th>
                            <th style="text-align: center">Quy cách chất lượng</th>
                            <th style="text-align: center">Đơn vị tính</th>
                            <th style="text-align: center">Giá gốc</th>
                            {{-- <th style="text-align: center">Loại giá</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($model_dk as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{ $i++ }}</td>
                                <td><b>{{ $tt->thang .'/'.$tt->nam }}</b></td>
                                <td></td>
                                <td>
                                    <button type="button" onclick="get_attack('{{ $tt->mahs }}','giadvkcb')"
                                        class="btn btn-default btn-xs mbs" data-target="#dinhkem-modal-confirm"
                                        data-toggle="modal">
                                        <i class="fa fa-cloud-download"></i>&nbsp;Tải tệp đính kèm</button>
                                </td>
                                <td></td>
                                <td style="text-align: center">{{ dinhdangsothapphan($tt->gia, 2) }}</td>
                                {{-- <td style="text-align: left">{{$tt->loaigia}}</td> --}}
                            </tr>
                        @endforeach
                        @foreach ($model as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{ $i++ }}</td>
                                <td><b>{{ $tt->thang .'/'.$tt->nam }}</b></td>
                                <td class="active" style="font-weight: bold">{{$tt->tenhhdv}}</td>
                                <td style="text-align: left">{{$tt->qccl}}</td>
                                <td style="text-align: center">{{ $tt->dvt }}</td>
                                <td style="text-align: center">{{ dinhdangsothapphan($tt->giagoc, 2) }}</td>
                                {{-- <td style="text-align: left">{{$tt->loaigia}}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('manage.include.form.modal_attackfile_congbo')
@stop
