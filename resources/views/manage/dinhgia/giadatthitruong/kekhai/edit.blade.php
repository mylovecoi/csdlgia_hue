@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
{{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}
    <script>
        $(document).ready(function(){
            TableManaged.init();
            // $(":input").inputmask();
            $(".gttsdat").change(function() {
                var dientichts = getdl($('#dientichts').val());
                var dongiats = getdl($('#dongiats').val());
                $('#giatrits').val(dientichts * dongiats);
                setGiaTri()
            });

            $(".gtdat").change(function() {
                var dientichdat = getdl($('#dientichdat').val());
                var dongiadat = getdl($('#dongiadat').val());
                $('#giatridat').val(dientichdat * dongiadat);
                setGiaTri();
            });

            function setGiaTri() {
                var giatridat = getdl($('#giatridat').val());
                var giatrits = getdl($('#giatrits').val());
                $('#tonggiatri').val(giatridat + giatrits);
            }
        });

        function clearForm(){
            var form = $('#frm_modify');
            form.find("[name='idct']").val(0);
            form.find("[name='hdban']").val();
            form.find("[name='tenkhudat']").val();
            form.find("[name='diachi']").val();
            form.find("[name='soqdban']").val();
            form.find("[name='thoigianban']").val();
            form.find("[name='soqdgiakd']").val($('#soqdgiakhoidiem').val());
            form.find("[name='thoigiangiakd']").val($('#thoidiem').val());
            form.find("[name='dientichdat']").val(0);
            form.find("[name='dongiadat']").val(0);
            form.find("[name='giatridat']").val(0);
            form.find("[name='dientichts']").val(0);
            form.find("[name='dongiats']").val(0);
            form.find("[name='giatrits']").val(0);
            form.find("[name='tonggiatri']").val(0);
            form.find("[name='giadaugia']").val(0);
            form.find("[name='giathitruong']").val(0);
            InputMask();
            {{--var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}
            {{--$.ajax({--}}
            {{--    url: '{{$inputs['url']}}' + '/get_khuvuc',--}}
            {{--    type: 'GET',--}}
            {{--    data: {--}}
            {{--        _token: CSRF_TOKEN,--}}
            {{--        madiaban: $('#madiaban').val(),--}}
            {{--        maxp: $('#maxp').val(),--}}
            {{--    },--}}
            {{--    dataType: 'JSON',--}}
            {{--    success: function (data) {--}}
            {{--        if (data.status == 'success') {--}}
            {{--            $('#sel_khuvuc').replaceWith(data.message);--}}
            {{--        } else--}}
            {{--            toastr.error("Không có khu vực nào được chọn!", "Lỗi!");--}}
            {{--    }--}}
            {{--})--}}
        }

        function createmhbog(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var form = $('#frm_modify');
            $.ajax({
                url: '{{$inputs['url']}}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    tenkhudat: form.find("[name='tenkhudat']").val(),
                    diachi: form.find("[name='diachi']").val(),
                    soqdban: form.find("[name='soqdban']").val(),
                    thoigianban: form.find("[name='thoigianban']").val(),
                    soqdgiakd: form.find("[name='soqdgiakd']").val(),
                    thoigiangiakd: form.find("[name='thoigiangiakd']").val(),
                    dientichdat: form.find("[name='dientichdat']").val(),
                    dongiadat: form.find("[name='dongiadat']").val(),
                    giatridat: form.find("[name='giatridat']").val(),
                    dientichts: form.find("[name='dientichts']").val(),
                    dongiats: form.find("[name='dongiats']").val(),
                    giatrits: form.find("[name='giatrits']").val(),
                    tonggiatri: form.find("[name='tonggiatri']").val(),
                    giadaugia: form.find("[name='giadaugia']").val(),
                    giathitruong: form.find("[name='giathitruong']").val(),
                    hdban: form.find("[name='hdban']").val(),
                    mahs: $('#mahs').val(),
                    id: $('#idct').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Cập nhật thông tin thành công.", "Thành công!");
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
                url: '{{$inputs['url']}}' + '/show_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    //form.find("[name='khuvuc']").val(data.khuvuc).trigger('change');
                    // form.find("[name='mota']").val(data.mota);
                    // form.find("[name='giathitruong']").val(data.giathitruong);
                    // form.find("[name='giaquydinh']").val(data.giaquydinh);
                    // form.find("[name='dientich']").val(data.dientich);
                    form.find("[name='idct']").val(data.id);
                    form.find("[name='tenkhudat']").val(data.tenkhudat);
                    form.find("[name='diachi']").val(data.diachi);
                    form.find("[name='soqdban']").val(data.soqdban);
                    form.find("[name='thoigianban']").val(data.thoigianban);
                    form.find("[name='soqdgiakd']").val(data.soqdgiakd);
                    form.find("[name='thoigiangiakd']").val(data.thoigiangiakd);
                    form.find("[name='dientichdat']").val(data.dientichdat);
                    form.find("[name='dongiadat']").val(data.dongiadat);
                    form.find("[name='giatridat']").val(data.giatridat);
                    form.find("[name='dientichts']").val(data.dientichts);
                    form.find("[name='dongiats']").val(data.dongiats);
                    form.find("[name='giatrits']").val(data.giatrits);
                    form.find("[name='tonggiatri']").val(data.tonggiatri);
                    form.find("[name='giadaugia']").val(data.giadaugia);
                    form.find("[name='giathitruong']").val(data.giathitruong);
                    form.find("[name='hdban']").val(data.hdban);
                    InputMask();
                }
            })
        }

        function getid(id){
            document.getElementById("iddelete").value=id;
        }

        function delmhbog() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/del_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs: $('#mahs').val()
                },
                dataType: 'JSON',
                success: function (data) {
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
    <h3 class="page-title text-uppercase">
        hồ sơ {{session('admin')['a_chucnang']['giadatthitruong'] ?? 'giá đất giao dịch thực tế trên thị trường'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/modify', 'class'=>'horizontal-form','id'=>'update_thongtindaugiadat']) !!}
            {!!Form::hidden('madv',null,['id'=>'madv'])!!}
            {!!Form::hidden('mahs',null,['id'=>'mahs'])!!}
            {!!Form::hidden('madiaban',null,['id'=>'madiaban'])!!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <div class="form-body">
                        <h4 style="color: #0000ff">Thông tin hồ sơ</h4>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label">Quận/ huyện</label>--}}
{{--                                    {!!Form::select('madiaban', $a_diaban,null, array('id' => 'madiaban','class' => 'form-control required','disabled'))!!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label">Xã/phường</label>--}}
{{--                                    {!! Form::select('maxp',$a_xp,null,array('id' => 'maxp', 'class' => 'form-control required')) !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định <span class="require">*</span></label>
                                    {!!Form::text('soqdgiakhoidiem',null, array('id' => 'soqdgiakhoidiem','class' => 'form-control required','autofocus'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    {!!Form::text('tenduan',null, array('id' => 'tenduan','class' => 'form-control', 'autofocus'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Ghi chú</label>
                                    {!!Form::text('ghichu',null, array('id' => 'ghichu','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>
                        @if(!isset($inputs['act']) || $inputs['act'] == 'true')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" onclick="clearForm()" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs">
                                            <i class="fa fa-plus"></i>&nbsp;Thêm mới thông tin</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2" width="5%">STT</th>
    {{--                                        <th style="text-align: center">Khu vực</th>--}}
                                            <th rowspan="2" style="text-align: center">Tên khu đất</th>
                                            <th colspan="3">Giá đất</th>
                                            <th colspan="3">Giá tài sản trên đất</th>
                                            <th rowspan="2" style="text-align: center">Tổng giá trị </th>
                                            <th rowspan="2" style="text-align: center">Kết quả đấu giá </th>
                                            <th rowspan="2" style="text-align: center" width="10%">Thao tác</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>Diện<br>tích</th>
                                            <th>Đơn<br>giá</th>
                                            <th>Thành<br>tiền</th>
                                            <th>Diện<br>tích</th>
                                            <th>Đơn<br>giá</th>
                                            <th>Thành<br>tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($model_ct as $key=>$tt)
                                        <tr class="odd gradeX">
                                            <td style="text-align: center">{{$i++}}</td>
                                            <td class="active">{{$tt->tenkhudat}}</td>
                                            <td>{{dinhdangsothapphan($tt->dientichdat)}}</td>
                                            <td>{{dinhdangsothapphan($tt->dongiadat)}}</td>
                                            <td>{{dinhdangsothapphan($tt->giatridat)}}</td>
                                            <td>{{dinhdangsothapphan($tt->dientichts)}}</td>
                                            <td>{{dinhdangsothapphan($tt->dongiats)}}</td>
                                            <td>{{dinhdangsothapphan($tt->giatrits)}}</td>
                                            <td>{{dinhdangsothapphan($tt->tonggiatri)}}</td>
                                            <td>{{dinhdangsothapphan($tt->giadaugia)}}</td>
                                            <td>
                                                @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                    <button type="button" onclick="editmhbog('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>

                                                    <button type="button" onclick="getid('{{$tt->id}}')" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs">
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
                    <a href="{{url('giadaugiadat/danhsach')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    @if(!isset($inputs['act']) || $inputs['act'] == 'true')
                        <button type="submit" class="btn green" onclick="validateForm()">
                            <i class="fa fa-check"></i> Hoàn thành</button>
                    @endif
{{--                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>--}}
{{--                    <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button>--}}
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    {!! Form::open(['url'=>'', 'class'=>'horizontal-form','id'=>'frm_modify']) !!}
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết hồ sơ</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
{{--                    <div class="row" id="sel_khuvuc">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="control-label">Khu vực</label>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên khu đất</label>
                                {!!Form::textarea('tenkhudat',null, array('id' => 'tenkhudat','class' => 'form-control','rows'=>'2'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Địa chỉ</label>
                                {!!Form::text('diachi',null, array('id' => 'diachi','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Số QĐ bán</label>
                                {!!Form::text('soqdban',null, array('id' => 'soqdban','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Thời điểm bán</label>
                                {!! Form::input('date', 'thoigianban', null, array('id' => 'thoigianban', 'class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Số QĐ phê duyệt giá</label>
                                {!!Form::text('soqdgiakd',null, array('id' => 'soqdgiakd','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Thời điểm PD giá</label>
                                {!! Form::input('date', 'thoigiangiakd', null, array('id' => 'thoigiangiakd', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Diện tích</label>
                                <input type="text" id="dientichdat" name="dientichdat" class="form-control gtdat" data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Đơn giá</label>
                                <input type="text" id="dongiadat" name="dongiadat" class="form-control gtdat" data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giá trị đất</label>
                                <input type="text" id="giatridat" name="giatridat" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Diện tích TS trên đất</label>
                                <input type="text" id="dientichts" name="dientichts" class="form-control gttsdat" data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Đơn giá TS trên đất</label>
                                <input type="text" id="dongiats" name="dongiats" class="form-control gttsdat" data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giá trị TS trên đất</label>
                                <input type="text" id="giatrits" name="giatrits" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tổng giá trị chuyển nhượng</label>
                                <input type="text" id="tonggiatri" name="tonggiatri" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá đấu giá</label>
                                <input type="text" id="giadaugia" name="giadaugia" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Giá thị trường</label>
                                <input type="text" id="giathitruong" name="giathitruong" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Hợp đồng số</label>
                                <input type="text" id="hdban" name="hdban" class="form-control" />
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
        function validateForm(){

            var validator = $("#update_thongtindaugiadat").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop