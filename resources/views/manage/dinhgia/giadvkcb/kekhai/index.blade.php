@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop

@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/danhsach?';
                var url = current_path_url + 'nam=' + $('#nam').val() + '&madv=' + $('#madv').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });
            $('#madv').change(function () {
                changeUrl();
            });
        });
        function new_hs(madv) {
            var form = $('#frm_modify');
            $("#btnsubmit").show();
            form.find("[name='madv']").val(madv);
            form.find("[name='mahs']").val('NEW');
            form.find("[name='tenbv']").val('');
            form.find("[name='dongia']").val(0);
            form.find("[name='soqd']").val('');
        }

        function edittt(mahs, act) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            if(act == false){
                $("#btnsubmit").hide();
            }else{
                $("#btnsubmit").show();
            }

            $.ajax({
                url: '{{$inputs['url']}}' + '/get_hs',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahs: mahs
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='thoidiem']").val(data.thoidiem);
                    form.find("[name='madiaban']").val(data.madiaban).trigger('change');
                    form.find("[name='maspdv']").val(data.maspdv).trigger('change');
                    form.find("[name='tenbv']").val(data.tenbv);
                    form.find("[name='dongia']").val(data.dongia);
                    form.find("[name='soqd']").val(data.soqd);
                    form.find("[name='mahs']").val(data.mahs);
                    form.find("[name='madv']").val(data.madv);
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
        Thông tin hồ sơ <small>&nbsp;giá dịch vụ khám chữa bệnh</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvkcb', 'hoso', 'modify'))
                            <button type="button" onclick="new_hs('{{$inputs['madv']}}')" class="btn btn-default btn-xs mbs" data-target="#modal-modify" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
{{--                            <a href="{{url($inputs['url'].'/nhandulieutuexcel?madv='.$inputs['madv'])}}" class="btn btn-default btn-sm">--}}
{{--                                <i class="fa fa-file-excel-o"></i> Nhận dữ liệu</a>--}}
                        @endif

                        <a href="{{url($inputs['url'].'/prints?&nam='.$inputs['nam'].'&madv='.$inputs['madv'])}}" class="btn btn-default btn-sm" target="_blank">
                            <i class="fa fa-print"></i> In</a>
                    </div>
                </div>

                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-4">
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

                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr>
                                <th width="2%" style="text-align: center">STT</th>
                                <th style="text-align: center">Số QĐ</th>
                                <th style="text-align: center">Thời điểm</th>
                                <th style="text-align: center">Tên bệnh viện</th>
                                <th style="text-align: center">Tên dịch vụ</th>
                                <th style="text-align: center">Đơn giá</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Cơ quan tiếp nhận</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$tt->soqd}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td>{{$tt->tenbv}}</td>
                                    <td class="success" style="font-weight: bold">{{$a_dm[$tt->maspdv] ?? ''}}</td>
                                    <td>{{dinhdangso($tt->dongia)}}</td>
                                    @include('manage.include.form.td_trangthai')
                                    <td style="text-align: left">{{$a_donvi_th[$tt->macqcq]?? ''}}</td>
                                    <td>
                                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvkcb', 'hoso', 'modify') && in_array($tt->trangthai,['CHT', 'HHT']))
                                            <button type="button" onclick="edittt('{{$tt->mahs}}',true)" class="btn btn-default btn-xs mbs" data-target="#modal-modify" data-toggle="modal" style="margin: 2px">
                                                <i class="fa fa-edit"></i>&nbsp;Chi tiết</button>
                                            <button type="button" onclick="confirmDelete('{{$tt->mahs}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        @else
                                            <button type="button" onclick="edittt('{{$tt->mahs}}',false)" class="btn btn-default btn-xs mbs" data-target="#modal-modify" data-toggle="modal" style="margin: 2px">
                                                <i class="fa fa-edit"></i>&nbsp;Chi tiết</button>
                                        @endif

                                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadvkcb', 'hoso', 'approve')&& in_array($tt->trangthai,['CHT', 'HHT']))
                                            <button type="button" onclick="confirmChuyen('{{$tt->mahs}}','{{$inputs['url'].'/chuyenhs'}}')" class="btn btn-default btn-xs mbs" data-target="#chuyen-modal-confirm" data-toggle="modal">
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

    <!--Modal edit-->
    <div id="modal-modify" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>$inputs['url'].'/modify', 'method'=>'post', 'id' => 'frm_modify', 'class'=>'horizontal-form']) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin hồ sơ</h4>
                </div>
                <div class="modal-body" id="edit_node">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Thời điểm<span class="require">*</span></label>
                                {!! Form::input('date', 'thoidiem', null, array('id' => 'thoidiem', 'class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số quyết định</label>
                                <input name="soqd" id="soqd" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Địa bàn</label>
                                {!!Form::select('madiaban', $a_diaban, null, array('id' => 'madiaban','class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tên dịch vụ khám chữa bệnh</label>
                                {!!Form::select('maspdv', $a_dm, null, array('id' => 'maspdv', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên bệnh viện<span class="require">*</span></label>
                                <input name="tenbv" id="tenbv" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Đơn giá<span class="require">*</span></label>
                                <input type="text" name="dongia" id="dongia" class="form-control text-right" data-mask="fdecimal" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="mahs">
                    <input type="hidden" name="madv">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="btnsubmit" name="submit" value="submit" class="btn btn-primary" onclick="ClickUpdate()">Đồng ý</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        function ClickUpdate(){
            $('#frm_modify').submit();
        }
    </script>

    @include('manage.include.form.modal_approve_hs')
    @include('manage.include.form.modal_del_hs')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop