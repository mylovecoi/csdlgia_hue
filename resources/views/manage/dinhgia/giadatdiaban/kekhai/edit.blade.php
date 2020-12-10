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
@stop

@section('content')
    <h3 class="page-title">
        Hồ sơ giá đất theo công bố
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/modify', 'class'=>'horizontal-form','id'=>'update_dichvukcb']) !!}
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Theo thông tư quyết định</label>
                                    {!!Form::select('soqd', $a_qd, null, array('id' => 'soqd','class' => 'form-control select2me'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Đia bàn:</label>
                                    {!!Form::select('madiaban', $a_diaban, null, array('id' => 'madiaban','class' => 'form-control'))!!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngày áp dụng<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                        <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">

                        @if(in_array($model->trangthai, ['CHT', 'HHT']))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" data-target="#modal-modify" data-toggle="modal" class="btn btn-success btn-xs mbs" onclick="clearForm()">
                                            <i class="fa fa-plus"></i>&nbsp;Thêm vị trí</button>
                                        &nbsp;<button type="button" class="btn btn-success btn-xs mbs" data-target="#modal-importexcel" data-toggle="modal">
                                            <i class="fa fa-file-excel-o"></i>&nbsp;Nhận dữ liệu</button>
                                        <button type="button" class="btn btn-danger btn-xs mbs" data-target="#delete-mul-modal" data-toggle="modal">
                                            <i class="fa fa-file-excel-o"></i>&nbsp;Xóa chi tiết</button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <table id="sample_4" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center" width="2%">STT</th>
                                <th rowspan="2" style="text-align: center">Xã phường</th>
                                <th rowspan="2" style="text-align: center">Loại đất</th>
                                <th rowspan="2" style="text-align: center">Khu vực</br>Tên đường phố</th>
                                <th rowspan="2" style="text-align: center">Địa giới</th>
                                <th colspan="4" style="text-align: center">Giá đất</th>
                                <th rowspan="2" style="text-align: center" width="10%">Thao tác</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">VT1</th>
                                <th style="text-align: center">VT2</th>
                                <th style="text-align: center">VT3</th>
                                <th style="text-align: center">VT4</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($modelct as $tt)
                                <tr>
                                    <td style="text-align: center">{{$i++}}</td>
                                    <td style="text-align: left;"><b>{{$a_xp[$tt->maxp] ?? ''}}</b></td>
                                    <td style="text-align: left">{{$a_loaidat[$tt->maloaidat] ?? ''}}</td>
                                    <td style="text-align: left" class="active">{{$tt->khuvuc}}</td>
                                    <td style="text-align: left">{{'Từ: '.$tt->diemdau .'. Đến: '.$tt->diemdau}}</td>
                                    <td style="text-align: center">{{dinhdangsothapphan($tt->giavt1,2)}}</td>
                                    <td style="text-align: center">{{dinhdangsothapphan($tt->giavt2,2)}}</td>
                                    <td style="text-align: center">{{dinhdangsothapphan($tt->giavt3,2)}}</td>
                                    <td style="text-align: center">{{dinhdangsothapphan($tt->giavt4,2)}}</td>
                                    <td>
                                        @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                            <button type="button" data-target="#modal-modify" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</button>

                                            <button type="button" onclick="delItem({{$tt->id}})" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal">
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
                    <a href="{{url($inputs['url'].'/danhsach?&madiaban='.$model->madiaban)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    @if($inputs['act'] == 'true')
                        <button type="submit" class="btn green" onclick="validateForm()">
                            <i class="fa fa-check"></i> Hoàn thành</button>
                   @endif
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->

            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <script type="text/javascript">
        function validateForm(){

            var validator = $("#update_dichvukcb").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>


    @include('manage.dinhgia.giadatdiaban.kekhai.modal')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop