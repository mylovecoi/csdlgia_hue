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
            form.find("[name='dongia']").val(0);
            form.find("[name='dongiathue']").val(0);
            form.find("[name='id']").val(-1);
            form.find("[name='mahs']").val('{{$model->mahs}}');
            form.find("[name='tungay']").val();
            form.find("[name='denngay']").val();
            form.find("[name='dvthue']").val();
            form.find("[name='hdthue']").val();
            form.find("[name='ththue']").val();
            form.find("[name='diachi']").val();
            form.find("[name='soqdpd']").val();
            form.find("[name='thoigianpd']").val();
            form.find("[name='soqddg']").val($('#soqd').val());
            form.find("[name='thoigiandg']").val($('#thoidiem').val());
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
                    maso: form.find("[name='maso']").val(),
                    dvt: form.find("[name='dvt']").val(),
                    dongia: form.find("[name='dongia']").val(),
                    dongiathue: form.find("[name='dongiathue']").val(),
                    mahs: form.find("[name='mahs']").val(),
                    id: form.find("[name='id']").val(),
                    tungay: form.find("[name='tungay']").val(),
                    denngay: form.find("[name='denngay']").val(),
                    dvthue: form.find("[name='dvthue']").val(),
                    hdthue: form.find("[name='hdthue']").val(),
                    ththue: form.find("[name='ththue']").val(),
                    diachi: form.find("[name='diachi']").val(),
                    soqdpd: form.find("[name='soqdpd']").val(),
                    thoigianpd: form.find("[name='thoigianpd']").val(),
                    soqddg: form.find("[name='soqddg']").val(),
                    thoigiandg: form.find("[name='thoigiandg']").val(),
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
                    form.find("[name='maso']").val(data.maso).trigger('change');
                    form.find("[name='dvt']").val(data.dvt).trigger('change');
                    form.find("[name='dongia']").val(data.dongia);
                    form.find("[name='dongiathue']").val(data.dongiathue);
                    form.find("[name='mahs']").val(data.mahs);
                    form.find("[name='id']").val(data.id);
                    form.find("[name='tungay']").val(data.tungay),
                    form.find("[name='denngay']").val(data.denngay),
                    form.find("[name='dvthue']").val(data.dvthue),
                    form.find("[name='hdthue']").val(data.hdthue),
                    form.find("[name='ththue']").val(data.ththue),
                    form.find("[name='diachi']").val(data.diachi),
                    form.find("[name='soqdpd']").val(data.soqdpd),
                    form.find("[name='thoigianpd']").val(data.thoigianpd),
                    form.find("[name='soqddg']").val(data.soqddg),
                    form.find("[name='thoigiandg']").val(data.thoigiandg),
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
        HỒ SƠ {{session('admin')['a_chucnang']['giathuemuanhaxh'] ?? 'Giá bán, cho thuê, thuê mua nhà ở'}}
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
                                            <a href="{{url('/data/thuemuanhaxahoi/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                        @endif
                                        <input name="ipf1" id="ipf1" type="file">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">File đính kèm</label>
                                        @if($model->ipf2 != '')
                                            <a href="{{url('/data/thuemuanhaxahoi/'.$model->ipf2)}}" target="_blank">{{$model->ipf2}}</a>
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
                                            <a href="{{url('/data/thuemuanhaxahoi/'.$model->ipf3)}}" target="_blank">{{$model->ipf3}}</a>
                                        @endif
                                        <input name="ipf3" id="ipf3" type="file">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">File đính kèm</label>
                                        @if($model->ipf4 != '')
                                            <a href="{{url('/data/thuemuanhaxahoi/'.$model->ipf4)}}" target="_blank">{{$model->ipf4}}</a>
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
                                            <a href="{{url('/data/thuemuanhaxahoi/'.$model->ipf5)}}" target="_blank">{{$model->ipf5}}</a>
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
                                                <th style="text-align: center">Tên nhà</th>
                                                <th style="text-align: center">Đơn vị thuê</th>
                                                <th style="text-align: center">Đơn vị<br>tính</th>
                                                <th style="text-align: center" >Giá bán</th>
                                                <th style="text-align: center" >Giá thuê</th>
                                                <th style="text-align: center"> Thao tác</th>
                                            </tr>
                                        </thead>
                                        <?php $i = 1; ?>
                                        <tbody id="ttts">
                                        @foreach($modelct as $key=>$tt)
                                            <tr id={{$tt->id}}>
                                                <td style="text-align: center">{{($i++)}}</td>
                                                <td>{{$a_dm[$tt->maso] ?? ''}}</td>
                                                <td>{{$tt->dvthue}}</td>
                                                <td>{{$tt->dvt}}</td>
                                                <td style="text-align: right;">{{dinhdangso($tt->dongia)}}</td>
                                                <td style="text-align: right;">{{dinhdangso($tt->dongiathue)}}</td>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin chi tiết hồ sơ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên nhà</label>
                                {!!Form::select('maso', $a_dm, null, array('id' => 'maso','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Đơn vị thuê</label>
                                <input type="text" id="dvthue" name="dvthue" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Địa chỉ</label>
                                <input type="text" id="diachi" name="diachi" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Số QĐ phê duyệt chủ trương</label>
                                {!!Form::text('soqdpd',null, array('id' => 'soqdpd','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Thời điểm PD chủ trương</label>
                                {!! Form::input('date', 'thoigianpd', null, array('id' => 'thoigianpd', 'class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Số QĐ phê duyệt giá</label>
                                {!!Form::text('soqddg',null, array('id' => 'soqddg','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Thời điểm PD giá</label>
                                {!! Form::input('date', 'thoigiandg', null, array('id' => 'thoigiandg', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Hợp đồng số</label>
                                <input type="text" id="hdthue" name="hdthue"  class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Thời hạn</label>
                                <input type="text" id="ththue" name="ththue"  class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Từ ngày</label>
                                {!! Form::input('date', 'tungay', null, array('id' => 'tungay', 'class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Đến ngày</label>
                                {!! Form::input('date', 'denngay', null, array('id' => 'denngay', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                @include('manage.include.form.input_dvt')
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giá bán<span class="require">*</span></label>
                                <input type="text" name="dongia" id="dongia" class="form-control" data-mask="fdecimal" style="text-align: right" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giá thuê<span class="require">*</span></label>
                                <input type="text" name="dongiathue" id="dongiathue" class="form-control text-right" data-mask="fdecimal" required>
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

    @include('manage.include.form.modal_dvt')
    @include('manage.include.form.modal_del_hs')
    @include('includes.script.inputmask-ajax-scripts')
@stop