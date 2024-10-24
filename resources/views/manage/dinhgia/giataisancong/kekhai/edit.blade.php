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
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
    </script>
    {{--    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function(){--}}
    {{--            $(":input").inputmask();--}}
    {{--        });--}}
    {{--    </script>--}}
    <script>
        function clearForm(){
            var form = $('#frm_modify');
            form.find("[name='giathue']").val(0);
            form.find("[name='giaban']").val(0);
            form.find("[name='giapheduyet']").val(0);
            form.find("[name='giaconlai']").val(0);
            form.find("[name='id']").val(-1);
            form.find("[name='mahs']").val('{{$model->mahs}}');
            InputMask();
        }

        function capnhatts(){
            var form = $('#frm_modify');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    tentaisan: form.find("[name='tentaisan']").val(),
                    dacdiem: form.find("[name='dacdiem']").val(),
                    giathue: form.find("[name='giathue']").val(),
                    giaban: form.find("[name='giaban']").val(),
                    giapheduyet: form.find("[name='giapheduyet']").val(),
                    giaconlai: form.find("[name='giaconlai']").val(),
                    mahs: form.find("[name='mahs']").val(),
                    id: form.find("[name='id']").val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Cập nhật thông tin thuê tài sản công thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");
                    }
                    else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })
        }

        function editItem(maso) {
            var form = $('#frm_modify');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{$inputs['url']}}' + '/get_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    form.find("[name='tentaisan']").val(data.tentaisan);
                    form.find("[name='dacdiem']").val(data.dacdiem);
                    form.find("[name='giathue']").val(data.giathue);
                    form.find("[name='giaban']").val(data.giaban);
                    form.find("[name='giapheduyet']").val(data.giapheduyet);
                    form.find("[name='giaconlai']").val(data.giaconlai);
                    form.find("[name='mahs']").val(data.mahs);
                    form.find("[name='id']").val(data.id);
                    InputMask();
                },
            })
        }

        function getid(id){
            document.getElementById("iddelete").value=id;
        }

        function delrow(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/del_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs:$('#mahs').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin thành công!", "Thành công!");
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
        HỒ SƠ {{session('admin')['a_chucnang']['taisancong'] ?? 'Giá tài sản công'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/modify', 'class'=>'horizontal-form','id'=>'update_thongtinthuetaisancong','files'=>true]) !!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {!!Form::hidden('mahs', null, array('id' => 'mahs'))!!}
                    {!!Form::hidden('madv', null, array('id' => 'madv'))!!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Địa bàn</label>
                                    {!!Form::select('madiaban', $a_diaban, null, array('id' => 'madiaban','class' => 'form-control'))!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định</label>
                                    {!!Form::text('soqd',null, array('id' => 'soqd','class' => 'form-control', 'autofocus'))!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nội dung hồ sơ</label>
                                    {!!Form::text('mota',null, array('id' => 'mota','class' => 'form-control'))!!}
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf1 != '')
                                        <a href="{{url('/data/taisancong/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                    @endif
                                    <input name="ipf1" id="ipf1" type="file">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf2 != '')
                                        <a href="{{url('/data/taisancong/'.$model->ipf2)}}" target="_blank">{{$model->ipf2}}</a>
                                    @endif
                                    <input name="ipf2" id="ipf2" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf3 != '')
                                        <a href="{{url('/data/taisancong/'.$model->ipf3)}}" target="_blank">{{$model->ipf3}}</a>
                                    @endif
                                    <input name="ipf3" id="ipf3" type="file">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf4 != '')
                                        <a href="{{url('/data/taisancong/'.$model->ipf4)}}" target="_blank">{{$model->ipf4}}</a>
                                    @endif
                                    <input name="ipf4" id="ipf4" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf5 != '')
                                        <a href="{{url('/data/taisancong/'.$model->ipf5)}}" target="_blank">{{$model->ipf5}}</a>
                                    @endif
                                    <input name="ipf5" id="ipf5" type="file">
                                </div>
                            </div>
                        </div>

                        @if(in_array($model->trangthai, ['CHT', 'HHT']))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()">
                                            <i class="fa fa-plus"></i>&nbsp;Thêm mới chi tiết</button>                                    &nbsp;
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center" width="2%">STT</th>
                                        <th style="text-align: center">Tên tài sản</th>
                                        <th style="text-align: center">Đặc điểm</th>
                                        <th style="text-align: center" >Nguyên giá</th>
                                        <th style="text-align: center" >Giá còn lại</th>
                                        <th style="text-align: center" >Giá phê duyệt</th>
                                        <th style="text-align: center" >Giá bán<br>(thanh lý)</th>
                                        <th style="text-align: center"> Thao tác</th>
                                    </tr>
                                    </thead>
                                    <?php $i = 1; ?>
                                    <tbody id="ttts">
                                    @foreach($modelct as $key=>$tt)
                                        <tr id={{$tt->id}}>
                                            <td style="text-align: center">{{$i++}}</td>
                                            <td>{{$tt->tentaisan}}</td>
                                            <td>{{$tt->dacdiem}}</td>
                                            <td style="text-align: right;">{{dinhdangso($tt->giathue)}}</td>
                                            <td style="text-align: right;">{{dinhdangso($tt->giaban)}}</td>
                                            <td style="text-align: right;">{{dinhdangso($tt->giapheduyet)}}</td>
                                            <td style="text-align: right;">{{dinhdangso($tt->giaconlai)}}</td>
                                            <td>
                                                @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                    <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
                                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
                                                    <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$tt->id}})" >
                                                        <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
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
                    <a href="{{url($inputs['url'].'/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                        <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    @if($inputs['act'] == 'true')
                        <button type="submit" class="btn green"><i class="fa fa-check"></i> Hoàn thành</button>
                    @endif
                </div>
            </div>

        {!! Form::close() !!}
        <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

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
                    <button type="button" class="btn btn-primary" onclick="delrow()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="modal-create" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'', 'id' => 'frm_modify', 'class'=>'horizontal-form']) !!}
        {!! Form::hidden('id', null) !!}
        {!! Form::hidden('mahs', null) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin chi tiết hồ sơ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên tài sản<span class="require">*</span></label>
                                {!!Form::text('tentaisan', null, array('id' => 'tentaisan','class' => 'form-control', 'required'=>'required'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Đặc điểm</label>
                                {!!Form::text('dacdiem', null, array('id' => 'dacdiem','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nguyên giá</label>
                                <input type="text" name="giathue" id="giathue" class="form-control" data-mask="fdecimal" style="text-align: right">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Giá còn lại</label>
                                <input type="text" name="giaban" id="giaban" class="form-control text-right" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Giá phê duyệt</label>
                                <input type="text" name="giapheduyet" id="giapheduyet" class="form-control" data-mask="fdecimal" style="text-align: right">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Giá bán (thanh lý)</label>
                                <input type="text" name="giaconlai" id="giaconlai" class="form-control text-right" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-md-12">--}}
                    {{--                            <div class="form-group">--}}
                    {{--                                <label class="control-label">Ghi chú</label>--}}
                    {{--                                {!!Form::textarea('ghichu',null, array('id' => 'ghichu','class' => 'form-control', 'rows'=>'2'))!!}--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="button" class="btn btn-primary" onclick="capnhatts()">Đồng ý</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('manage.include.form.modal_del_hs')
    @include('includes.script.inputmask-ajax-scripts')
@stop