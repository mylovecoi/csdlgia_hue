@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
    </script>

@stop

@section('content')

    <h3 class="page-title">
        Danh sách&nbsp;chức năng của chương trình
    </h3>
    <hr>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="7%">STT</th>
                                <th width="10%">Mã số</th>
                                <th>Chức năng</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($setting as $k_csdl=>$v_csdl)
                                <tr style="font-weight: bold;" class="success">
                                    <td class="text-left" style="text-transform: uppercase;">{{toAlpha($i++)}}</td>
                                    <td>{{$k_csdl}}</td>
                                    <td>{{$a_chucnang[$k_csdl] ?? $k_csdl}}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="change('{{$k_csdl}}','' ,'0')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                            <i class="fa fa-refresh"></i></button>
                                    </td>
                                </tr>
                                <!-- Duyệt các group chức năng: Định giá; Kê khai; Phí, lệ phí; ... -->
                                <?php $j = 1; ?>
                                @foreach($v_csdl as $k_gr=>$v_gr)
                                    @if(is_array($v_gr))
                                        <tr  style="font-style: italic;font-weight: bold;" class="info">
                                            <td class="text-center">{{romanNumerals($j++)}}</td>
                                            <td>{{$k_gr}}</td>
                                            <td>{{$a_chucnang[$k_gr] ?? $k_gr}}</td>
                                            <td class="text-center">
                                                <button type="button" onclick="change('{{$k_gr}}','{{$k_csdl}}' ,'1')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                                    <i class="fa fa-refresh"></i></button>
                                            </td>
                                        </tr>

                                        <?php $m = 1; ?>
                                        @foreach($v_gr as $k=>$v)
                                            @if(is_array($v))
                                                <tr>
                                                    <td class="text-right">{{$m++}}</td>
                                                    <td>{{$k}}</td>
                                                    <td>{{$a_chucnang[$k] ?? $k}}</td>
                                                    <td class="text-center">
                                                        <button type="button" onclick="change('{{$k}}', '{{$k_gr}}','2')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                                            <i class="fa fa-refresh"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/chucnang/store','id' => 'frm_modify','method'=>'POST'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chức năng</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Mã số</label>
                            {!!Form::text('maso', null, array('id' => 'maso','class' => 'form-control'))!!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Tên chức năng</label>
                            {!!Form::textarea('menu', null, array('id' => 'menu','class' => 'form-control', 'rows' => '2'))!!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Mô tả</label>
                            {!!Form::textarea('mota', null, array('id' => 'mota','class' => 'form-control', 'rows' => '2'))!!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Cấp độ</label>
                            {!!Form::text('capdo', null, array('id' => 'capdo','class' => 'form-control', 'readonly'))!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Mã số gốc</label>
                            {!!Form::text('maso_goc', null, array('id' => 'maso_goc','class' => 'form-control', 'readonly'))!!}
                        </div>
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

    <script>
        function change(maso, magoc, capdo) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/chucnang/get_chucnang',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso: maso,
                    capdo: capdo,
                    maso_goc: magoc,
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#maso').val(data.maso);
                    $('#capdo').val(data.capdo);
                    $('#maso_goc').val(data.maso_goc);
                    $('#menu').val(data.menu);
                    $('#mota').val(data.mota);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
    </script>
@stop