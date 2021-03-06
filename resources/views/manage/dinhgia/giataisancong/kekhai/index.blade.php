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
            form.find("[name='tentaisan']").val('');
            form.find("[name='dacdiem']").val('');
            form.find("[name='giaban']").val(0);
            form.find("[name='giaconloai']").val();
            form.find("[name='giapheduyet']").val();
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
                    form.find("[name='tentaisan']").val(data.tentaisan);
                    form.find("[name='dacdiem']").val(data.dacdiem);
                    form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                    form.find("[name='giathue']").val(data.giathue);
                    form.find("[name='giaban']").val(data.giaban);
                    form.find("[name='giaconlai']").val(data.giaconlai);
                    form.find("[name='giapheduyet']").val(data.giapheduyet);
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
    <h3 class="page-title text-uppercase">
        {{session('admin')['a_chucnang']['taisancong'] ?? 'tài sản công'}}
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','taisan', 'taisancong', 'hoso', 'modify'))
                            <a href="{{url($inputs['url'].'/new?madv='.$inputs['madv'])}}" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Thêm mới </a>
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

                    <table id="sample_3" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="2%" style="text-align: center">STT</th>
                            <th style="text-align: center">Số QĐ</th>
                            <th style="text-align: center">Thời điểm <br>xác định</th>
                            <th style="text-align: center">Mô tả</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Cơ quan tiếp nhận</th>
                            <th style="text-align: center" width="20%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td style="text-align: left">{{$tt->soqd}}</td>
                                <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                <td style="text-align: left">{{$tt->mota}}</td>
                                @include('manage.include.form.td_trangthai')
                                <td style="text-align: left">{{$a_donvi_th[$tt->macqcq] ?? ''}}</td>
                                <td>
                                    @if(chkPer('csdlmucgiahhdv','taisan', 'taisancong', 'hoso', 'modify') && in_array($tt->trangthai,['CHT', 'HHT']))
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=true')}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i>&nbsp;Chi tiết</a>
                                        <button type="button" onclick="confirmDelete('{{$tt->mahs}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    @else
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=false')}}" target="_blank" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-eye"></i>&nbsp;Chi tiết</a>
                                    @endif
                                    @if(chkPer('csdlmucgiahhdv','taisan', 'taisancong', 'hoso', 'approve')&& in_array($tt->trangthai,['CHT', 'HHT']))
                                        <button type="button" onclick="confirmChuyen('{{$tt->mahs}}','{{$inputs['url'].'/chuyenhs'}}')" class="btn btn-default btn-xs mbs" data-target="#chuyen-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-check"></i> Hoàn thành</button>
                                    @endif
                                    <button type="button" onclick="get_attack('{{$tt->mahs}}')" class="btn btn-default btn-xs mbs" data-target="#dinhkem-modal-confirm" data-toggle="modal">
                                        <i class="fa fa-cloud-download"></i>&nbsp;Tải tệp</button>
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

    @include('manage.include.form.modal_approve_hs')
    @include('manage.include.form.modal_del_hs')
    @include('includes.script.create-header-scripts')
    @include('manage.include.form.modal_attackfile')
@stop