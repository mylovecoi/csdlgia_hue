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
                var current_path_url = '{{$inputs['url']}}' + '/danhsach?';
                var url = current_path_url + 'nam=' + $('#nam').val() + '&madiaban=' + $('#madiaban').val()
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
        });

        function new_hs() {
            var form = $('#frm_modify');
            form.find("[name='mahs']").val('NEW');
        }

        function edittt(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' +'/get_hs',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='nam']").val(data.nam);
                    form.find("[name='madiaban']").val(data.madiaban).trigger('change');
                    form.find("[name='maxp']").val(data.maxp).trigger('change');
                    form.find("[name='madv']").val(data.madv).trigger('change');
                    form.find("[name='maloaidat']").val(data.maloaidat).trigger('change');
                    form.find("[name='khuvuc']").val(data.khuvuc);
                    form.find("[name='diemdau']").val(data.diemdau);
                    form.find("[name='diemcuoi']").val(data.diemcuoi);
                    form.find("[name='giavt1']").val(data.giavt1);
                    form.find("[name='giavt2']").val(data.giavt2);
                    form.find("[name='giavt3']").val(data.giavt3);
                    form.find("[name='giavt4']").val(data.giavt4);
                    form.find("[name='ghichu']").val(data.ghichu);
                    form.find("[name='loaiduong']").val(data.loaiduong);
                    form.find("[name='hesok']").val(data.hesok);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
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
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'modify'))
                            <button type="button" onclick="new_hs('{{$inputs['madv']}}')" class="btn btn-default btn-xs mbs" data-target="#modal-modify" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                            <a href="{{url($inputs['url'].'/nhandulieutuexcel?madv='.$inputs['madv'])}}" class="btn btn-default btn-sm">
                                <i class="fa fa-file-excel-o"></i> Nhận dữ liệu</a>
                        @endif

                        <a href="{{url($inputs['url'].'/prints?&nam='.$inputs['nam'].'&madv='.$inputs['madv'])}}" class="btn btn-default btn-sm" target="_blank">
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
                                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'modify') && in_array($tt->trangthai,['CHT', 'HHT']))
                                            <button type="button" onclick="edittt('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#modal-modify" data-toggle="modal" style="margin: 2px">
                                                <i class="fa fa-edit"></i>&nbsp;Chi tiết</button>
                                            <button type="button" onclick="confirmDelete('{{$tt->maso}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        @endif

                                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'approve')&& in_array($tt->trangthai,['CHT', 'HHT']))
                                            <button type="button" onclick="confirmChuyen('{{$tt->maso}}','{{$inputs['url'].'/chuyenhs'}}')" class="btn btn-default btn-xs mbs" data-target="#chuyen-modal-confirm" data-toggle="modal">
                                                <i class="fa fa-check"></i> Hoàn thành</button>
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

    <!--Modal edit-->
    <div id="modal-modify" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>$inputs['url'].'/modify', 'id' => 'frm_modify', 'class'=>'horizontal-form']) !!}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin giá đất theo địa bàn</h4>
                </div>
                <div class="modal-body" id="edit_node">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Đơn vị nhập liệu</label>
                                <select class="form-control select2me" name="madv">
                                    @foreach($a_diaban as $key=>$val)
                                        <optgroup label="{{$val}}">
                                            <?php $donvi = $m_donvi->where('madiaban',$key); ?>
                                            @foreach($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Năm</label>
                                {!! Form::select('nam', getNam(true), date('Y'), array('class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-4">
                                <label class="control-label">Số quyết định</label>
                                {!! Form::select('soqd', $a_qd, null, array('class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Loại đất</label>
                                {!!Form::select('maloaidat', $a_loaidat, null, array('class' => 'form-control select2me'))!!}
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Địa bàn</label>
                                {!!Form::select('madiaban', [$inputs['madiaban']=> $a_diaban[$inputs['madiaban']] ?? ''], null, array('class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-3">
                                <label class="control-label">Xã, phường</label>
                                {!!Form::select('maxp', $a_xp, null, array('class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Khu vực (Tên đường, tên phố)<span class="require">*</span></label>
                                {!!Form::textarea('khuvuc',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">

                                <label class="control-label">Điểm đầu</label>
                                {!!Form::textarea('diemdau',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Điểm cuối</label>
                                {!!Form::textarea('diemcuoi',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Loại đường</label>
                            {!!Form::text('loaiduong', null, array('class' => 'form-control'))!!}
                        </div>

                        <div class="form-group">
                            <div class="col-md-2">
                                <label class="control-label">Hệ số K</label>
                                <input type="text" name="hesok" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Giá vị trị I</label>
                                <input type="text" name="giavt1" id="giavt1" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Giá vị trị II</label>
                                <input type="text" name="giavt2" id="giavt2" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Giá vị trị III</label>
                                <input type="text" name="giavt3" id="giavt3" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">Giá vị trị IV</label>
                                <input type="text" name="giavt4" id="giavt4" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                            </div>
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
                    <input type="hidden" name="maso">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" onclick="ClickUpdate()">Đồng ý</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        function ClickUpdate(){
            $('#frm_modify').submit();
        }

        function ClickAdd(){
            $('#frm_add').submit();
        }
    </script>

    @include('manage.include.form.modal_approve_hs')
    @include('manage.include.form.modal_del_hs')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop