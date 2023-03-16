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
                var current_path_url = '{{$inputs['url']}}' +'/xetduyet?';
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
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin hồ sơ thuê mặt đất, mặt nước
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        <a href="{{url($inputs['url'].'/print?madv='.$inputs['madv'].'&nam='. $inputs['nam'])}}" class="btn btn-default btn-sm" target="_blank">
                            <i class="fa fa-print"></i> In danh sách</a>
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
                                <th style="text-align: center">Cơ quan chuyển hồ sơ</th>
                                <th style="text-align: center">Địa bàn</th>
                                <th style="text-align: center">Thời điểm <br>xác định</th>
                                <th style="text-align: center">Vị trí đất</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Cơ quan tiếp nhận hồ sơ</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td style="text-align: left">{{$tt->tendv_ch}}</td>
                                    <td style="text-align: center">{{$a_diaban[$tt->madiaban] ?? ''}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td style="text-align: left">{{$tt->vitri}}</td>
                                    @include('manage.include.form.td_trangthai')
                                    <td style="text-align: left">{{$tt->tencqcq}}</td>
                                    <td>
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=false')}}" class="btn btn-default btn-xs mbs" target="_blank">
                                            <i class="fa fa-eye"></i>&nbsp;Chi tiết</a>
                                        <!--
                                        Xem xét bổ sung madv_ad, trangthai_ad,
                                        Tùy level mà chức năng nút chuyển lại khác nhau
                                        Đơn vị tiếp nhận có tổng hợp Toàn tỉnh
                                        ADMIN-> Công bố
                                        T->
                                        H->Hoàn thành (có đơn

                                        -->
                                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuedatnuoc', 'hoso', 'approve'))
                                            @if($tt->level == 'ADMIN')
                                                @if($tt->trangthai == 'CB')
                                                    <button type="button" onclick="confirmCongbo('{{$tt->mahs}}','{{$inputs['url'].'/congbo'}}', 'HCB')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal" data-toggle="modal">
                                                        <i class="fa fa-times"></i>&nbsp;Hủy công bố</button>
                                                @else
                                                    <button type="button" onclick="confirmCongbo('{{$tt->mahs}}','{{$inputs['url'].'/congbo'}}', 'CB')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal" data-toggle="modal">
                                                        <i class="fa fa-send"></i>&nbsp;Công bố</button>

                                                    <button type="button" onclick="confirmTraLai('{{$tt->mahs}}','{{$inputs['url'].'/tralai'}}', '{{$tt->madv}}')" class="btn btn-default btn-xs mbs" data-target="#tralai-modal-confirm" data-toggle="modal">
                                                        <i class="fa fa-times"></i> Trả lại</button>
                                                @endif
                                            @else
                                                @if(in_array($tt->trangthai, ['HHT', 'CHT']))
                                                    <button type="button" onclick="confirmChuyenXD('{{$tt->mahs}}','{{$inputs['url'].'/chuyenxd'}}', '{{$tt->madv}}')" class="btn btn-default btn-xs mbs" data-target="#chuyenxd-modal-confirm" data-toggle="modal">
                                                        <i class="fa fa-check"></i> Hoàn thành</button>

                                                    <button type="button" onclick="confirmTraLai('{{$tt->mahs}}','{{$inputs['url'].'/tralai'}}', '{{$tt->madv}}')" class="btn btn-default btn-xs mbs" data-target="#tralai-modal-confirm" data-toggle="modal">
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
                <!-- END EXAMPLE TABLE PORTLET-->

        </div>
        <!-- BEGIN DASHBOARD STATS -->
        <!-- END DASHBOARD STATS -->
        </div>
    </div>
    @include('manage.include.form.modal_congbo')
    @include('manage.include.form.modal_approve_xd')
    @include('manage.include.form.modal_unapprove_xd')
    @include('manage.include.form.modal_del_hs')
@stop