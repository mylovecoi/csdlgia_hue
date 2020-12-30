@extends('main')

@section('custom-style')
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{url('assets/admin/pages/scripts/form-wizard.js')}}"></script>
    <script src="{{url('js/jquery.inputmask.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            $(":input").inputmask();
            TableManaged.init();
        });

        function edittt(id){

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/edit_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#doituongsd').val(data.doituongsd);
                    $('#giachuathue').val(data.giachuathue);
                    $('#giachuathue1').val(data.giachuathue1);
                    $('#giachuathue2').val(data.giachuathue2);
                    $('#giachuathue3').val(data.giachuathue3);
                    $('#giachuathue4').val(data.giachuathue4);
                    $('#id').val(data.id);
                    InputMask();
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });

            if($('#tunam').val()=='' || $('#dennam').val()==''){
                toastr.error('Năm lộ trình không được bỏ trống.', 'Lỗi!');
                $('#tunam').focus();
            }else{
                $('#edit-modal').modal('show');
            }
        }

        function ClickUpdate(){
            if($('#tunam').val()=='' || $('#dennam').val()==''){
                toastr.error('Năm lộ trình không được bỏ trống.', 'Lỗi!');
                return
            }
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/update_ct',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('#id').val(),
                    giachuathue: $('#giachuathue').val(),
                    giachuathue1: $('#giachuathue1').val(),
                    giachuathue2: $('#giachuathue2').val(),
                    giachuathue3: $('#giachuathue3').val(),
                    giachuathue4: $('#giachuathue4').val(),
                    mahs: $('#mahs').val(),
                    tunam: $('#tunam').val(),
                    dennam: $('#dennam').val(),
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Chỉnh sửa thông tin thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#edit-modal').modal("hide");

                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })
        }
    </script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        {{session('admin')['a_chucnang']['gianuocsh'] ?? 'hồ sơ giá nước sạch sinh hoạt'}}<small> chỉnh sửa</small>
    </h3>
    <div class="row">
        {!! Form::model($model,['url'=>$inputs['url']. '/modify', 'method'=>'post'  , 'files'=>true, 'id' => 'update_gnsh','class'=>'form-horizontal','enctype'=>'multipart/form-data', 'files'=>true]) !!}
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <input type="hidden" value="{{$model->mahs}}" name="mahs" id="mahs" class="form-control">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <div class="form-body">
                        <b style="color: blue">Thông tin hồ sơ</b>
                        <div class="row">
                            <div class="col-md-4" >
                                <label class="control-label">Số quyết định<span class="require">*</span></label>
                                {!!Form::text('soqd', null, array('id' => 'soqd','class' => 'form-control'))!!}
                            </div>
                            <div class="col-md-4" >
                                <label class="control-label">Ngày áp dụng<span class="require">*</span></label>
                                {!!Form::text('ngayapdung',isset($model->ngayapdung) ? date('d/m/Y',strtotime($model->ngayapdung)) : date('d/m/Y',strtotime(date('Y-m-d'))), array('id' => 'ngayapdung','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Địa bàn</label>
                                {!!Form::select('madiaban', $a_diaban, null, array('id' => 'madiaban','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4" >
                                <label class="control-label">Lộ trình từ năm<span class="require">*</span></label>
                                {!!Form::text('tunam', null, array('id' => 'tunam','class' => 'form-control required'))!!}
                            </div>
                            <div class="col-md-4" >
                                <label class="control-label">Lộ trình đến năm<span class="require">*</span></label>
                                {!!Form::text('dennam', null, array('id' => 'dennam','class' => 'form-control required'))!!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Nội dung<span class="require">*</span></label>
                                {!! Form::textarea('mota', null, ['id' => 'mota', 'rows' => 2, 'class' => 'form-control']) !!}
                            </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="control-label">File đính kèm</label>--}}
{{--                                @if($model->ipf1 != '')--}}
{{--                                    <a href="{{url('/data/gianuocsachsinhhoat/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>--}}
{{--                                @endif--}}
{{--                                <input name="ipf1" id="ipf1" type="file">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">File đính kèm</label>
                                @if($model->ipf1 != '')
                                    <a href="{{url('/data/gianuocsachsinhhoat/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                @endif
                                <input name="ipf1" id="ipf1" type="file">
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">File đính kèm</label>
                                @if($model->ipf2 != '')
                                    <a href="{{url('/data/gianuocsachsinhhoat/'.$model->ipf2)}}" target="_blank">{{$model->ipf2}}</a>
                                @endif
                                <input name="ipf2" id="ipf2" type="file">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">File đính kèm</label>
                                @if($model->ipf3 != '')
                                    <a href="{{url('/data/gianuocsachsinhhoat/'.$model->ipf3)}}" target="_blank">{{$model->ipf3}}</a>
                                @endif
                                <input name="ipf3" id="ipf3" type="file">
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">File đính kèm</label>
                                @if($model->ipf4 != '')
                                    <a href="{{url('/data/gianuocsachsinhhoat/'.$model->ipf4)}}" target="_blank">{{$model->ipf4}}</a>
                                @endif
                                <input name="ipf4" id="ipf4" type="file">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">File đính kèm</label>
                                @if($model->ipf5 != '')
                                    <a href="{{url('/data/gianuocsachsinhhoat/'.$model->ipf5)}}" target="_blank">{{$model->ipf5}}</a>
                                @endif
                                <input name="ipf5" id="ipf5" type="file">
                            </div>
                        </div>

                        <hr>
                        <b style="color: blue">Giá nước sinh hoạt</b>

                        <!-- END PAGE HEADER-->
                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover" id="sample_4">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="text-align: center" width="2%">STT</th>
                                            <th rowspan="2" style="text-align: center">Mục đích sử dụng</th>
                                            <th colspan="{{$model->dennam - $model->tunam > 0 ? ($model->dennam - $model->tunam) + 1 : 1}}" style="text-align: center">Đơn giá</th>
                                            <th rowspan="2" style="text-align: center" width="10%">Thao tác</th>
                                        </tr>
                                        <tr>
                                            @for($i=0; $i< ($model->dennam - $model->tunam > 0 ? ($model->dennam - $model->tunam) + 1 : 1); $i++)
                                                <th width="7%" style="text-align: center">{{$model->tunam + $i}}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($modelct as $key=>$tt)
                                            <tr class="odd gradeX">
                                                <td style="text-align: center">{{$key + 1}}</td>
                                                <td class="active">{{$tt->doituongsd}}</td>
                                                @for($i=0; $i< ($model->dennam - $model->tunam > 0 ? ($model->dennam - $model->tunam) + 1 : 1); $i++)
                                                    <?php $col= $i > 0 ?'giachuathue'.$i : 'giachuathue'; ?>
                                                    <td class="active">{{number_format($tt->$col)}}</td>
                                                @endfor

                                                <td>
                                                    @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                        <button type="button" onclick="edittt('{{$tt->id}}')" class="btn btn-default btn-xs mbs">
                                                            <i class="fa fa-trash-o"></i>&nbsp;Sửa</button>
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
                <div style="text-align: center">
                    <a href="{{url($inputs['url'].'/danhsach?madv='.$model->madv)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i>Cập nhật</button>
                </div>
            @endif
        </div>
        {!! Form::close() !!}
    </div>
        <!-- BEGIN DASHBOARD STATS -->

        <!-- END DASHBOARD STATS -->
        <div class="clearfix"></div>
        <div id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title">Chỉnh sửa thông tin giá nước sạch sinh hoạt</h4>
                    </div>
                    <div class="modal-body" id="edit_node">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Đối tượng</label>
                                    <input name="doituongsd" id="doituongsd" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá 1</label>
                                    {!!Form::text('giachuathue',null, array('id' => 'giachuathue','data-mask'=>'fdecimal','class' => 'form-control','style'=>'text-align: right;font-weight: bold'))!!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá 2</label>
                                    {!!Form::text('giachuathue1',null, array('id' => 'giachuathue1','data-mask'=>'fdecimal','class' => 'form-control','style'=>'text-align: right;font-weight: bold'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá 3</label>
                                    {!!Form::text('giachuathue2',null, array('id' => 'giachuathue2','data-mask'=>'fdecimal','class' => 'form-control','style'=>'text-align: right;font-weight: bold'))!!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá 4</label>
                                    {!!Form::text('giachuathue3',null, array('id' => 'giachuathue3','data-mask'=>'fdecimal','class' => 'form-control','style'=>'text-align: right;font-weight: bold'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đơn giá 5</label>
                                    {!!Form::text('giachuathue4',null, array('id' => 'giachuathue4','data-mask'=>'fdecimal','class' => 'form-control','style'=>'text-align: right;font-weight: bold'))!!}
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" onclick="ClickUpdate()">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- @include('manage.dinhgia.gianuocsh.include.modal_dialog')--}}
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
    @include('includes.script.create-header-scripts')
    <script>
        function validateForm(){
            var str = '',strb1='';
            var ok = true;

            if($('#tunam').val()=='' || $('#dennam').val()==''){
                strb1 += '  - Năm lộ trình <br>';
                ok = false;
            }

            if($('#soqd').val()==''){
                strb1 += '  - Số quyết định <br>';
                ok = false;
            }

            if($('#ngayapdung').val()==''){
                strb1 += '  - Ngày áp dụng <br>';
                ok = false;
            }

            if($('#mota').val()==''){
                strb1 += '  - Nội dung <br>';
                ok = false;
            }

            if($('#ghichu').val()==''){
                strb1 += '  - Ghi chú <br>';
                ok = false;
            }


            //Kết quả
            if ( ok == false){
                if(strb1!='')
                    str+=''+strb1 ;

                toastr.error('Thông tin không được để trống <br>' + str );
                $("form").submit(function (e) {
                    e.preventDefault();
                });
            }
            else{
                $("form").unbind('submit').submit();
            }
        }
    </script>
@stop