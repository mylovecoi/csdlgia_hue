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
            $('#dongia').val('0');
            InputMask();
        }

        function capnhatts(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/store_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maspdv: $('#maspdv').val(),
                    namapdung1: $('#namapdung1').val(),
                    giathanhthi1: $('#giathanhthi1').val(),
                    gianongthon1: $('#gianongthon1').val(),
                    giamiennui1: $('#giamiennui1').val(),
                    namapdung2: $('#namapdung2').val(),
                    giathanhthi2: $('#giathanhthi2').val(),
                    gianongthon2: $('#gianongthon2').val(),
                    giamiennui2: $('#giamiennui2').val(),
                    namapdung3: $('#namapdung3').val(),
                    giathanhthi3: $('#giathanhthi3').val(),
                    gianongthon3: $('#gianongthon3').val(),
                    giamiennui3: $('#giamiennui3').val(),
                    mahs:$('#mahs').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Cập nhật thông tin thuê thành công", "Thành công!");
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
        function editItem(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '{{$inputs['url']}}' + '/get_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='maspdv']").val(data.maspdv).trigger('change');
                    form.find("[name='namapdung1']").val(data.namapdung1).val();
                    form.find("[name='giathanhthi1']").val(data.giathanhthi1).val();
                    form.find("[name='gianongthon1']").val(data.gianongthon1).val();
                    form.find("[name='giamiennui1']").val(data.giamiennui1).val();
                    form.find("[name='namapdung2']").val(data.namapdung2).val();
                    form.find("[name='giathanhthi2']").val(data.giathanhthi2).val();
                    form.find("[name='gianongthon2']").val(data.gianongthon2).val();
                    form.find("[name='giamiennui2']").val(data.giamiennui2).val();
                    form.find("[name='namapdung3']").val(data.namapdung3).val();
                    form.find("[name='giathanhthi3']").val(data.giathanhthi3).val();
                    form.find("[name='gianongthon3']").val(data.gianongthon3).val();
                    form.find("[name='giamiennui3']").val(data.giamiennui3).val();

                    if(data.namapdung1 == '' || data.namapdung1 == null ){
                        if($('#tunam').val()!='' || $('#dennam').val()!=''){
                            var i=1;
                            var tunam = $('#tunam').val();
                            var dennam = $('#dennam').val();
                            for(j=tunam; j<=dennam; j++) {
                                var k = parseInt(j)+1;
                                switch (i) {
                                    case(1):{
                                        $('#namapdung1').val(j+'-'+k);
                                        break;
                                    }
                                    case(2):{
                                        $('#namapdung2').val(j+'-'+k);
                                        break;
                                    }
                                    case(3):{
                                        $('#namapdung3').val(j+'-'+k);
                                        break;
                                    }
                                }
                                i++;
                            }
                        }
                    }else{
                        $('#namapdung1').val(data.namapdung1);
                        $('#namapdung2').val(data.namapdung2);
                        $('#namapdung3').val(data.namapdung3);

                    }
                    InputMask();
                },
            });

            if($('#tunam').val()=='' || $('#dennam').val()==''){
                toastr.error('Năm lộ trình không được bỏ trống.', 'Lỗi!');
                //$('#modal-create').modal('hide');
                $('#tunam').focus();
            }else{
                $('#modal-create').modal('show');
            }
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
        Hồ sơ {{session('admin')['a_chucnang']['giadvgddt'] ?? 'giá dịch vụ giáo dục và đào tạo'}}
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
                    {!!Form::hidden('mahs',null, array('id' => 'mahs'))!!}
                    {!!Form::hidden('madv',null, array('id' => 'madv'))!!}
                    <div class="form-body">
                        <div class="row">
{{--                            <div class="col-md-4">--}}
{{--                                <label class="control-label">Địa bàn</label>--}}
{{--                                {!!Form::select('madiaban', $a_diaban, null, array('id' => 'madiaban','class' => 'form-control'))!!}--}}
{{--                            </div>--}}

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Số công văn<span class="require">*</span></label>
                                    {!!Form::text('soqd',null, array('id' => 'soqd','class' => 'form-control', 'autofocus', 'required'))!!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời điểm<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>

{{--                            <div class="col-md-4">--}}
{{--                                <label style="font-weight: bold">Năm học</label>--}}
{{--                                <select class="form-control" name="nam">--}}
{{--                                    @for($i = date('Y') - 2; $i <= date('Y'); $i++)--}}
{{--                                        <option value="{{$i.'-'.($i+1)}}" {{($i.'-'.($i+1)) == $model->nam ? 'selected' : ''}}>{{$i.'-'.($i+1)}}</option>--}}
{{--                                    @endfor--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <div class="col-md-3" >
                                <label class="control-label">Lộ trình từ năm<span class="require">*</span></label>
                                {!!Form::text('tunam', null, array('id' => 'tunam','class' => 'form-control', 'required'))!!}
                            </div>
                            <div class="col-md-3" >
                                <label class="control-label">Lộ trình đến năm<span class="require">*</span></label>
                                {!!Form::text('dennam', null, array('id' => 'dennam','class' => 'form-control', 'required'))!!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
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
                                        <a href="{{url('/data/giadvgddt/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                    @endif
                                    <input name="ipf1" id="ipf1" type="file">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf2 != '')
                                        <a href="{{url('/data/giadvgddt/'.$model->ipf2)}}" target="_blank">{{$model->ipf2}}</a>
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
                                        <a href="{{url('/data/giadvgddt/'.$model->ipf3)}}" target="_blank">{{$model->ipf3}}</a>
                                    @endif
                                    <input name="ipf3" id="ipf3" type="file">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf4 != '')
                                        <a href="{{url('/data/giadvgddt/'.$model->ipf4)}}" target="_blank">{{$model->ipf4}}</a>
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
                                        <a href="{{url('/data/giadvgddt/'.$model->ipf5)}}" target="_blank">{{$model->ipf5}}</a>
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
                                            <i class="fa fa-plus"></i>&nbsp;Thêm mới sản phẩm</button>                                    &nbsp;
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" width="3%" style="text-align: center">STT</th>
                                            <th rowspan="2" style="text-align: center">Tên sản phẩm<br>dịch vụ</th>
                                            <th colspan="4" style="text-align: center">Mức thu học phí</th>
                                            <th colspan="4" style="text-align: center">Mức thu học phí</th>
                                            <th colspan="4" style="text-align: center">Mức thu học phí</th>
                                            <th rowspan="2" style="text-align: center" width="5%">Thao<br>tác</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center">Năm<br>học</th>
                                            <th style="text-align: center">Thành<br>thị</th>
                                            <th style="text-align: center">Nông<br>thôn</th>
                                            <th style="text-align: center">Miền<br>núi</th>

                                            <th style="text-align: center">Năm<br>học</th>
                                            <th style="text-align: center">Thành<br>thị</th>
                                            <th style="text-align: center">Nông<br>thôn</th>
                                            <th style="text-align: center">Miền<br>núi</th>

                                            <th style="text-align: center">Năm<br>học</th>
                                            <th style="text-align: center">Thành<br>thị</th>
                                            <th style="text-align: center">Nông<br>thôn</th>
                                            <th style="text-align: center">Miền<br>núi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ttts">
                                    <?php $i=1; ?>
                                    @foreach($modelct as $key=>$tt)
                                        <tr class="text-right">
                                            <td style="text-align: center">{{$i++}}</td>
                                            <td class="active text-left">{{$a_dm[$tt->maspdv] ?? ''}}</td>
                                            <td class="text-center">{{$tt->namapdung1}}</td>
                                            <td>{{dinhdangso($tt->giathanhthi1)}}</td>
                                            <td>{{dinhdangso($tt->gianongthon1)}}</td>
                                            <td>{{dinhdangso($tt->giamiennui1)}}</td>

                                            <td class="text-center">{{$tt->namapdung2}}</td>
                                            <td>{{dinhdangso($tt->giathanhthi2)}}</td>
                                            <td>{{dinhdangso($tt->gianongthon2)}}</td>
                                            <td>{{dinhdangso($tt->giamiennui2)}}</td>

                                            <td class="text-center">{{$tt->namapdung3}}</td>
                                            <td>{{dinhdangso($tt->giathanhthi3)}}</td>
                                            <td>{{dinhdangso($tt->gianongthon3)}}</td>
                                            <td>{{dinhdangso($tt->giamiennui3)}}</td>
                                            <td>
                                                @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                    <button type="button" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
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
            @if($inputs['act'] == 'true')
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <a href="{{url($inputs['url'].'/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                            <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        @if(in_array($model->trangthai, ['CHT', 'HHT']))
                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Hoàn thành</button>
                        @endif
                    </div>
                </div>
            @endif
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <script type="text/javascript">
        function validateForm(){

            var validator = $("#update_thongtinthuetaisancong").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>

    <!--Model frm_modify-->
    {!! Form::open(['method' => 'post', 'url'=>'', 'class'=>'horizontal-form','id'=>'frm_modify']) !!}
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin sản phẩm, dịch vụ</h4>
                </div>
                <div class="modal-body" id="ttmhbog">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên sản phẩm, dịch vụ<span class="require">*</span></label>
                                {!!Form::select('maspdv', $a_dm, null, array('id' => 'maspdv','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Năm áp dụng 1</label>
                                {!!Form::text('namapdung1',null, array('id' => 'namapdung1','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực thành thị</label>
                                <input type="text" id="giathanhthi1" name="giathanhthi1" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực nông thôn</label>
                                <input type="text" id="gianongthon1" name="gianongthon1" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực miền núi</label>
                                <input type="text" id="giamiennui1" name="giamiennui1" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Năm áp dụng 2</label>
                                {!!Form::text('namapdung2',null, array('id' => 'namapdung2','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực thành thị</label>
                                <input type="text" id="giathanhthi2" name="giathanhthi2" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực nông thôn</label>
                                <input type="text" id="gianongthon2" name="gianongthon2" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực miền núi</label>
                                <input type="text" id="giamiennui2" name="giamiennui2" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Năm áp dụng 3</label>
                                {!!Form::text('namapdung3',null, array('id' => 'namapdung3','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực thành thị</label>
                                <input type="text" id="giathanhthi3" name="giathanhthi3" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực nông thôn</label>
                                <input type="text" id="gianongthon3" name="gianongthon3" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Khu vực miền núi</label>
                                <input type="text" id="giamiennui3" name="giamiennui3" data-mask="fdecimal" class="form-control" style="font-weight: bold;text-align: right">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="capnhatts()">Hoàn thành</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
    @include('includes.script.set_date_thoihanthamdinh')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop