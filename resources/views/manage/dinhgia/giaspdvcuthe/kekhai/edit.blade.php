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
    <h3 class="page-title text-uppercase">
        Hồ sơ {{session('admin')['a_chucnang']['giaspdvcuthe'] ?? 'Giá sản phẩm, dịch vụ cụ thể'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            {!! Form::model($model, ['method' => 'post', 'url'=>$inputs['url'].'/modify', 'class'=>'horizontal-form','id'=>'update_dichvukcb', 'files'=>true]) !!}
            <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
            <input type="hidden" name="madv" id="madv" value="{{$model->madv}}">
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Số quyết định</label>
                                    {!!Form::text('soqd',null, array('id' => 'soqd','class' => 'form-control', 'autofocus'))!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Ngày áp dụng<span class="require">*</span></label>
                                    {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Đia bàn</label>
                                    {!!Form::select('madiaban', $a_diabanapdung, null, array('id' => 'madiaban','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    {!!Form::textarea('ttqd',null, array('id' => 'ttqd','class' => 'form-control', 'rows'=>2))!!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File đính kèm</label>
                                    @if($model->ipf1 != '')
                                        <a href="{{url('/data/giaspdvcuthe/'.$model->ipf1)}}" target="_blank">{{$model->ipf1}}</a>
                                    @endif
                                    <input name="ipf1" id="ipf1" type="file">
                                </div>
                            </div>
                        </div>

                        @if(in_array($model->trangthai, ['CHT', 'HHT']))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" data-target="#modal-modify" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()">
                                            <i class="fa fa-plus"></i>&nbsp;Thêm sản phẩm, dịch vụ</button>
{{--                                        <button type="button" class="btn btn-success btn-xs mbs" data-target="#modal-importexcel" data-toggle="modal">--}}
{{--                                            <i class="fa fa-file-excel-o"></i>&nbsp;Nhận dữ liệu</button>--}}
{{--                                        <button type="button" class="btn btn-danger btn-xs mbs" data-target="#delete-mul-modal" data-toggle="modal">--}}
{{--                                            <i class="fa fa-file-excel-o"></i>&nbsp;Xóa chi tiết</button>--}}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row" id="dsts">
                            <div class="col-md-12">
                                <table id="sample_3" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center" width="5%">STT</th>
                                            <th style="text-align: center">Phân loại sản phẩm, dịch vụ</th>
                                            <th style="text-align: center">Tên sản phẩm, dịch vụ</th>
                                            <th style="text-align: center">Đơn vị<br>tính</th>
                                            <th style="text-align: center">Mức giá</th>
                                            <th style="text-align: center" width="10%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                        @foreach($modelct as $tt)
                                            <tr>
                                                <td style="text-align: center">{{$i++}}</td>
                                                <td style="text-align: left">{{$tt->phanloaidv}}</td>
                                                <td style="text-align: left" class="active">{{$tt->mota}}</td>
                                                <td style="text-align: left">{{$tt->dvt}}</td>
                                                <td style="text-align: right">{{dinhdangsothapphan($tt->mucgia,2)}}</td>
                                                <td>
                                                    @if(in_array($model->trangthai, ['CHT', 'HHT']))
                                                        <button type="button" data-target="#modal-modify" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem({{$tt->id}})">
                                                            <i class="fa fa-edit"></i>&nbsp;Sửa</button>

                                                        <button type="button" onclick="getid({{$tt->id}})" class="btn btn-default btn-xs mbs" data-target="#modal-delete" data-toggle="modal">
                                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label">Ghi chú</label>
                                    {!!Form::textarea('ghichu',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                                </div>
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

    @include('manage.dinhgia.giaspdvcuthe.kekhai.modal')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
    @include('manage.include.form.modal_dvt')
    @include('manage.include.form.phanloaidv.modal_phanloaidv')
@stop