@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    {{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script> --}}
    <script>
        $(document).ready(function() {
            TableManaged.init();
            $(":input").inputmask();
        });

        function clearForm() {
            var form = $('#frm_modify');
            form.find("[name='mota']").val('');
            form.find("[name='solo']").val('');
            form.find("[name='sothua']").val('');
            form.find("[name='sotobando']").val('');
            form.find("[name='dientich']").val(0);
            form.find("[name='giakhoidiem']").val(0);
            form.find("[name='giadaugia']").val(0);
            form.find("[name='idct']").val(0);
            InputMask();
            {{-- var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); --}}
            {{-- $.ajax({ --}}
            {{--    url: '{{$inputs['url']}}' + '/get_khuvuc', --}}
            {{--    type: 'GET', --}}
            {{--    data: { --}}
            {{--        _token: CSRF_TOKEN, --}}
            {{--        madiaban: $('#madiaban').val(), --}}
            {{--        maxp: $('#maxp').val(), --}}
            {{--    }, --}}
            {{--    dataType: 'JSON', --}}
            {{--    success: function (data) { --}}
            {{--        if (data.status == 'success') { --}}
            {{--            $('#sel_khuvuc').replaceWith(data.message); --}}
            {{--        } else --}}
            {{--            toastr.error("Không có khu vực nào được chọn!", "Lỗi!"); --}}
            {{--    } --}}
            {{-- }) --}}
        }

        function createmhbog() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ $inputs['url'] }}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    solo: $('#solo').val(),
                    sothua: $('#sothua').val(),
                    sotobando: $('#sotobando').val(),
                    khuvuc: $('#khuvuc').val(),
                    vitri: $('#vitri').val(),
                    diagioitu: $('#diagioitu').val(),
                    diagioiden: $('#diagioiden').val(),
                    dvt: $('#dvt').val(),
                    mota: $('#mota').val(),
                    dientich: $('#dientich').val(),
                    giakhoidiem: $('#giakhoidiem').val(),
                    giadaugia: $('#giadaugia').val(),
                    mahs: $('#mahs').val(),
                    id: $('#idct').val(),
                },
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success("Cập nhật thông tin phí lệ phí", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");

                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })

        }

        function editmhbog(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{ $inputs['url'] }}' + '/show_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function(data) {
                    var form = $('#frm_modify');
                    form.find("[name='khuvuc']").val(data.khuvuc).trigger('change');
                    form.find("[name='vitri']").val(data.vitri);
                    form.find("[name='diagioitu']").val(data.diagioitu);
                    form.find("[name='diagioiden']").val(data.diagioiden);
                    form.find("[name='dvt']").val(data.dvt);
                    form.find("[name='solo']").val(data.solo);
                    form.find("[name='sothua']").val(data.sothua);
                    form.find("[name='sotobando']").val(data.sotobando);
                    form.find("[name='giakhoidiem']").val(data.giakhoidiem);
                    form.find("[name='giadaugia']").val(data.giadaugia);
                    form.find("[name='dientich']").val(data.dientich);
                    form.find("[name='idct']").val(data.id);
                }
            })
        }

        function getid(id) {
            document.getElementById("iddelete").value = id;
        }

        function delmhbog() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ $inputs['url'] }}' + '/del_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs: $('#mahs').val()
                },
                dataType: 'JSON',
                success: function(data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin phí lệ phí!", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });

                    $('#modal-delete').modal("hide");

                    //}
                }
            })
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin hồ sơ đấu giá đất
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, [
                'method' => 'post',
                'url' => 'giadaugiadat/modify',
                'class' => 'horizontal-form',
                'id' => 'update_thongtindaugiadat',
                'files' => true,
            ]) !!}
            {!! Form::hidden('madv', null, ['id' => 'madv']) !!}
            {!! Form::hidden('mahs', null, ['id' => 'mahs']) !!}
            {!! Form::hidden('madiaban', null, ['id' => 'madiaban']) !!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <div class="form-body">
                        <h4 style="color: #0000ff">Thông tin hồ sơ</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Quận/ huyện</label>
                                    {!! Form::select('madiaban', $a_diaban, null, [
                                        'id' => 'madiaban',
                                        'class' => 'form-control required',
                                        'disabled',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Xã/phường</label>
                                    {!! Form::select('maxp', $a_xp, null, ['id' => 'maxp', 'class' => 'form-control required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tên dự án<span class="require">*</span></label>
                                    {!! Form::text('tenduan', null, ['id' => 'tenduan', 'class' => 'form-control', 'required', 'autofocus']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, ['id' => 'thoidiem', 'class' => 'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định phương án đấu giá</label>
                                    {!! Form::text('soqdpagia', null, ['id' => 'soqdpagia', 'class' => 'form-control', 'autofocus']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định đấu giá</label>
                                    {!! Form::text('soqddaugia', null, ['id' => 'soqddaugia', 'class' => 'form-control', 'autofocus']) !!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định phê duyệt giá khởi điểm</label>
                                    {!! Form::text('soqdgiakhoidiem', null, ['id' => 'soqdgiakhoidiem', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định công nhận kết quả trúng đấu giá</label>
                                    {!! Form::text('soqdkqdaugia', null, ['id' => 'soqdkqdaugia', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Phân loại</label>
                                    {!! Form::select(
                                        'phanloai',
                                        [
                                            'Theo dự án' => 'Theo dự án',
                                            'Theo lô' => 'Theo lô',
                                            'Đất ở' => 'Đất ở',
                                            'Đất công ích' => 'Đất công ích',
                                            'Đất khác' => 'Đất khác',
                                        ],
                                        null,
                                        ['id' => 'phanloai', 'class' => 'form-control'],
                                    ) !!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">File đính kèm</label>
                                @if ($model->ipf1 != '')
                                    <a href="{{ url('/data/giadaugiadat/' . $model->ipf1) }}"
                                        target="_blank">{{ $model->ipf1 }}</a>
                                @endif
                                <input name="ipf1" id="ipf1" type="file">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Ghi chú</label>
                                    {!! Form::text('ghichu', null, ['id' => 'ghichu', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        @if (!isset($inputs['act']) || $inputs['act'] == 'true')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" onclick="clearForm()" data-target="#modal-create"
                                            data-toggle="modal" class="btn btn-success btn-xs">
                                            <i class="fa fa-plus"></i>&nbsp;Thêm mới thông tin</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center" width="5%">STT</th>
                                            <th style="text-align: center">Số lô</th>
                                            <th style="text-align: center">Số thửa</th>
                                            <th style="text-align: center">Tờ bản đồ</th>
                                            <th style="text-align: center">Vị trí</th>
                                            <th style="text-align: center">Địa giới - Từ</th>
                                            <th style="text-align: center">Địa giới - Đến</th>
                                            <th style="text-align: center">Mô tả</th>
                                            <th style="text-align: center">Diện tích</th>
                                            <th style="text-align: center">DVT</th>
                                            <th style="text-align: center">Giá khởi</br>điểm</th>
                                            <th style="text-align: center">Giá đấu</br>giá</th>
                                            <th style="text-align: center" width="20%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($model_ct as $key => $tt)
                                            <tr class="odd gradeX">
                                                <td style="text-align: center">{{ $key + 1 }}</td>
                                                <td>{{ $tt->solo }}</td>
                                                <td>{{ $tt->sothua }}</td>
                                                <td>{{ $tt->sotobando }}</td>
                                                <td class="active">{{ $tt->vitri }}</td>
                                                <td class="active">{{ $tt->diagioitu }}</td>
                                                <td class="active">{{ $tt->diagioiden }}</td>
                                                <td class="active">{{ $tt->mota }}</td>
                                                <td>{{ dinhdangso($tt->dientich) }}</td>
                                                <td>{{ $tt->dvt }}</td>
                                                <td>{{ dinhdangso($tt->giakhoidiem) }}</td>
                                                <td>{{ dinhdangso($tt->giadaugia) }}</td>
                                                <td>
                                                    @if (in_array($model->trangthai, ['CHT', 'HHT']))
                                                        <button type="button" onclick="editmhbog('{{ $tt->id }}')"
                                                            class="btn btn-default btn-xs mbs" data-target="#modal-create"
                                                            data-toggle="modal">
                                                            <i class="fa fa-edit"></i>&nbsp;Sửa</button>

                                                        <button type="button" onclick="getid('{{ $tt->id }}')"
                                                            data-target="#modal-delete" data-toggle="modal"
                                                            class="btn btn-default btn-xs mbs">
                                                            <i class="fa fa-trash-o"></i> Xóa</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <a href="{{ url('giadaugiadat/danhsach') }}" class="btn btn-danger"><i
                            class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    @if (!isset($inputs['act']) || $inputs['act'] == 'true')
                        <button type="submit" class="btn green" onclick="validateForm()">
                            <i class="fa fa-check"></i> Cập nhật</button>
                    @endif
                    {{--                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button> --}}
                    {{--                    <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button> --}}
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    {!! Form::open(['url' => '', 'class' => 'horizontal-form', 'id' => 'frm_modify']) !!}
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin vị trí đất đấu giá</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    {{--                    <div class="row" id="sel_khuvuc"> --}}
                    {{--                        <div class="col-md-12"> --}}
                    {{--                            <div class="form-group"> --}}
                    {{--                                <label class="control-label">Khu vực</label> --}}

                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Số lô</label>
                                <input type="text" id="solo" name="solo" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Số thửa</label>
                                <input type="text" id="sothua" name="sothua" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tờ bản đồ</label>
                                <input type="text" id="sotobando" name="sotobando" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Vị trí</label>
                                {!! Form::text('vitri', null, ['id' => 'vitri', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Địa giới - Từ</label>
                                {!! Form::text('diagioitu', null, ['id' => 'diagioitu', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Địa giới - Đến</label>
                                {!! Form::text('diagioiden', null, ['id' => 'diagioiden', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mô tả</label>
                                {!! Form::textarea('mota', null, ['id' => 'mota', 'class' => 'form-control', 'rows' => '3']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Diện tích</label>
                                <input type="text" id="dientich" name="dientich" class="form-control"
                                    data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Đơn vị tính</label>
                                <input type="text" id="dvt" name="dvt" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá khởi điểm</label>
                                <input type="text" id="giakhoidiem" name="giakhoidiem" class="form-control"
                                    data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá đấu giá</label>
                                <input type="text" id="giadaugia" name="giadaugia" class="form-control"
                                    data-mask="fdecimal">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="idct" id="idct" />
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="createmhbog()">Hoàn thành</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! Form::close() !!}

    <!--Model Delete-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa thông tin?</h4>
                </div>
                <input type="hidden" id="iddelete" name="iddelete">
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="delmhbog()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        function validateForm() {

            var validator = $("#update_thongtindaugiadat").validate({
                rules: {
                    ten: "required"
                },
                messages: {
                    ten: "Chưa nhập dữ liệu"
                }
            });
        }
    </script>
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop
