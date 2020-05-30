@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            $(":input").inputmask();

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/xetduyet?';
                var url = current_path_url + 'madv=' + $('#madv').val() + '&nam=' + $('#nam').val() + '&madiaban=' + $('#madiaban').val()
                    + '&maxp=' + $('#maxp').val() + '&maloaidat=' + $('#maloaidat').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });
            $('#madiaban').change(function () {
                changeUrl();
            });
            $('#maxp').change(function () {
                changeUrl();
            });
            $('#maloaidat').change(function () {
                changeUrl();
            });
            $('#madv').change(function () {
                changeUrl();
            });
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin giá đất
    </h3>
    {{--<h3 class="page-title">
        <small> <b style="color: blue">{{$dvql->tendv}}</b><b style="color: blue"> - </b><b style="color: blue">{{$dv->tendv}}</b> - Người soạn thảo: <b style="color: blue">{{isset($model) ? $model->cvsoanthao : session('admin')->name}}</b> </small>
    </h3>--}}
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'approve'))
                            @if($inputs['level'] == 'ADMIN')
                                <button type="button" class="btn btn-default btn-xs mbs" data-target="#congbo-modal-confirm" data-toggle="modal">
                                    <i class="fa fa-send"></i>&nbsp;Công bố</button>
                            @else
                                <button type="button" class="btn btn-default btn-xs mbs" data-target="#check-modal-confirm" data-toggle="modal">
                                    <i class="fa fa-check"></i>&nbsp;Hoàn thành</button>
                            @endif
                        @endif
                        <a href="{{url($inputs['url'].'/prints?&nam='.$inputs['nam'].'&madiaban='.$inputs['madiaban'].'&maxp='.$inputs['maxp'].'&maloaidat='.$inputs['maloaidat'].'&madv='.$inputs['madv'])}}" class="btn btn-default btn-sm" target="_blank">
                            <i class="fa fa-print"></i> In</a>
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-4">
                                <label style="font-weight: bold">Địa bàn</label>
                                {!!Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban','class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-4">
                                <label style="font-weight: bold">Xã phường</label>
                                {!!Form::select('maxp', a_merge(['all'=>'--Tất cả--'], $a_xp), $inputs['maxp'], array('id' => 'maxp','class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label" style="font-weight: bold">Loại đất</label>
                                {!!Form::select('maloaidat', array_merge(['all'=>'--Tất cả--'], $a_loaidat), $inputs['maloaidat'], array('id' => 'maloaidat','class' => 'form-control select2me'))!!}
                            </div>

                            <div class="col-md-6">
                                <label style="font-weight: bold">Đơn vị</label>
                                <select class="form-control select2me" id="madv">
                                    @foreach($m_diaban as $diaban)
                                        <optgroup label="{{$diaban->tendiaban}}">
                                            <?php $donvi = $m_donvi->where('madiaban',$diaban->madiaban); ?>
                                            @foreach($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center" width="2%">STT</th>
                                <th rowspan="2" style="text-align: center">Năm</th>
                                <th rowspan="2" style="text-align: center">Địa bàn</th>
                                <th rowspan="2" style="text-align: center">Xã phường</th>
                                <th rowspan="2" style="text-align: center">Khu vực</br>Tên đường phố</th>
                                <th rowspan="2" style="text-align: center" >Địa giới</th>
                                <th colspan="3" style="text-align: center" >Giá đất</th>
                                <th rowspan="2" style="text-align: center"  width="5%"> Trạng thái</th>
                                <th rowspan="2" style="text-align: center"> Thao tác</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">VT1</th>
                                <th style="text-align: center">VT2</th>
                                <th style="text-align: center">VT3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $key => $tt)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td><b>{{$tt->nam}}</b></td>
                                    <td><b>{{$a_diaban[$tt->madiaban] ?? ''}}</b></td>
                                    <td style="text-align: left;"><b>{{$a_xp[$tt->maxp] ?? ''}}</b></td>
                                    <td style="text-align: left" class="active">{{$tt->khuvuc}}</td>
                                    <td style="text-align: left">{{'Từ: '.$tt->diemdau .'. Đến: '.$tt->diemdau}}</td>
                                    <td style="text-align: center">{{dinhdangsothapphan($tt->giavt1,2)}}</td>
                                    <td style="text-align: center">{{dinhdangsothapphan($tt->giavt2,2)}}</td>
                                    <td style="text-align: center">{{dinhdangsothapphan($tt->giavt3,2)}}</td>

                                    @include('manage.include.form.td_trangthai')
                                    <td>
                                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'approve'))
                                            @if($tt->level == 'ADMIN')
                                                @if($tt->trangthai == 'CB')
                                                    <button type="button" onclick="confirmCongbo('{{$tt->maso}}','{{$inputs['url'].'/congbo'}}', 'HCB')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal" data-toggle="modal">
                                                        <i class="fa fa-times"></i>&nbsp;Hủy công bố</button>
                                                @else
                                                    <button type="button" onclick="confirmCongbo('{{$tt->maso}}','{{$inputs['url'].'/congbo'}}', 'CB')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal" data-toggle="modal">
                                                        <i class="fa fa-send"></i>&nbsp;Công bố</button>

                                                    <button type="button" onclick="confirmTraLai('{{$tt->maso}}','{{$inputs['url'].'/tralai'}}', '{{$tt->madv}}')" class="btn btn-default btn-xs mbs" data-target="#tralai-modal-confirm" data-toggle="modal">
                                                        <i class="fa fa-times"></i> Trả lại</button>
                                                @endif
                                            @else
                                                @if(in_array($tt->trangthai, ['HHT', 'CHT']))
                                                    <button type="button" onclick="confirmChuyenXD('{{$tt->maso}}','{{$inputs['url'].'/chuyenxd'}}', '{{$tt->madv}}')" class="btn btn-default btn-xs mbs" data-target="#chuyenxd-modal-confirm" data-toggle="modal">
                                                        <i class="fa fa-check"></i> Hoàn thành</button>

                                                    <button type="button" onclick="confirmTraLai('{{$tt->maso}}','{{$inputs['url'].'/tralai'}}', '{{$tt->madv}}')" class="btn btn-default btn-xs mbs" data-target="#tralai-modal-confirm" data-toggle="modal">
                                                        <i class="fa fa-times"></i> Trả lại</button>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
        <!-- BEGIN DASHBOARD STATS -->
        <!-- END DASHBOARD STATS -->
    <!-- Hoàn thành nhiều hồ sơ -->
    <div id="check-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>$inputs['url'].'/chuyenxd_mul','id' => 'frm_checkmulti'])!!}
        <input type="hidden" name="madv" value="{{$inputs['madv']}}" />
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hoàn thành dữ liệu?</h4>
                </div>
                <div class="modal-body">
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="control-label">Trạng thái<span class="require">*</span></label>--}}
{{--                                <select class="form-control" name="trangthaicheck" id="trangthaicheck">--}}
{{--                                    <option value="CB">Công bố</option>--}}
{{--                                    <option value="HT">Hủy công bố</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cơ quan tiếp nhận<span class="require">*</span></label>
                                <select class="form-control select2me" name="macqcq">
                                    @foreach($a_diaban_th as $key=>$val)
                                        <optgroup label="{{$val}}">
                                            <?php $donvi = $m_donvi_th->where('madiaban',$key); ?>
                                            @foreach($donvi as $ct)
                                                <option value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Năm</label>
                                {!! Form::select('nam', getNam(true), date('Y'), array('class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-9">
                                <label class="control-label">Loại đất</label>
                                {!!Form::select('maloaidat', a_merge(['all'=>'--Tất cả--'], $a_loaidat), $inputs['maloaidat'], array('class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Địa bàn</label>
                                {!!Form::select('madiaban', [$inputs['madiaban']=> $a_diaban[$inputs['madiaban']] ?? ''], null, array('class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Xã, phường</label>
                                {!!Form::select('maxp', a_merge(['all'=>'--Tất cả--'], $a_xp), $inputs['maxp'], array('class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary" >Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!-- Công bố nhiều hồ sơ -->
    <div id="congbo-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>$inputs['url'].'/congbo_mul','id' => 'frm_checkmulti'])!!}
        <input type="hidden" name="madv" value="{{$inputs['madv']}}" />
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý công bố dữ liệu?</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Trạng thái<span class="require">*</span></label>
                                <select class="form-control" name="trangthai" id="trangthai">
                                    <option value="CB">Công bố</option>
                                    <option value="HT">Hủy công bố</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Năm</label>
                                {!! Form::select('nam', getNam(true), date('Y'), array('class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-9">
                                <label class="control-label">Loại đất</label>
                                {!!Form::select('maloaidat', a_merge(['all'=>'--Tất cả--'], $a_loaidat), $inputs['maloaidat'], array('class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Địa bàn</label>
                                {!!Form::select('madiaban', [$inputs['madiaban']=> $a_diaban[$inputs['madiaban']] ?? ''], null, array('class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Xã, phường</label>
                                {!!Form::select('maxp', a_merge(['all'=>'--Tất cả--'], $a_xp), $inputs['maxp'], array('class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary" >Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <script>
        function ClickUpdate(){
            $('#frm_modify').submit();
        }

        function ClickAdd(){
            $('#frm_add').submit();
        }
    </script>

    @include('manage.include.form.modal_congbo')
    @include('manage.include.form.modal_approve_xd')
    @include('manage.include.form.modal_unapprove_xd')

    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop