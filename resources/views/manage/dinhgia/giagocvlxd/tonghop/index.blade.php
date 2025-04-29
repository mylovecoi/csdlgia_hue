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
                var current_path_url = '{{$inputs['url']}}' + '/tonghop?';
                var url = current_path_url + 'nam=' + $('#nam').val() + '&thang=' + $('#thang').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });
            $('#thang').change(function () {
                changeUrl();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin hồ sơ giá vật liệu xây dựng
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
                        @if(chkPer('csdlmucgiahhdv','taisan', 'giagocvlxd', 'hoso', 'modify'))
                            <a href="{{url($inputs['url'].'/new')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Thêm mới </a>
                            {{--                            <a href="{{url($inputs['url'].'/nhandulieutuexcel')}}" class="btn btn-default btn-sm">--}}
                            {{--                            <i class="fa fa-file-excel-o"></i> Nhận dữ liệu</a>--}}
                        @endif

                        {{--                        <a href="{{url($inputs['url'].'/prints?madv='.$inputs['madv'].'&nam='. $inputs['nam'])}}" class="btn btn-default btn-sm" target="_blank">--}}
                        {{--                            <i class="fa fa-print"></i> In danh sách</a>--}}
                    </div>
                </div>

                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label>Tháng hồ sơ</label>
                                {!! Form::select('thang', getThang(true), $inputs['thang'], array('id' => 'thang', 'class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-2">
                                <label>Năm hồ sơ</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                                {{-- <select name="nam" id="nam" class="form-control">
                                    @if ($nam_start = intval(date('Y')) - 10 ) @endif
                                    @if ($nam_stop = intval(date('Y')) + 1) @endif
                                    @for($i = $nam_start; $i <= $nam_stop; $i++)
                                        <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                    @endfor
                                </select> --}}
                            </div>
                        </div>
                    </div>

                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="2%" style="text-align: center">STT</th>
                            <th style="text-align: center">Tháng/Năm</th>
                            <th style="text-align: center">Số QĐ</th>
                            <th style="text-align: center">Nội dung</th>
                            <th style="text-align: center">Trạng thái</th>
{{--                            <th style="text-align: center">Cơ quan tiếp nhận</th>--}}
                            <th style="text-align: center" width="20%">Thao tác</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td style="text-align: left">{{$tt->thang.'/'.$tt->nam}}</td>
                                <td style="text-align: left">{{$tt->sobc}}</td>
                                <td style="text-align: left">{{$tt->noidung}}</td>
                                @include('manage.include.form.td_trangthai')
{{--                                <td style="text-align: left">{{$a_donvi_th[$tt->macqcq]?? ''}}</td>--}}
                                <td>
                                    @if(chkPer('csdlmucgiahhdv','taisan', 'giagocvlxd','hoso','modify') && in_array($tt->trangthai,['CHT', 'HHT']))
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=true')}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i>&nbsp;Chi tiết</a>
                                        <button type="button" onclick="confirmDelete('{{$tt->mahs}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    @else
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=false')}}" target="_blank" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-eye"></i>&nbsp;Chi tiết</a>
                                    @endif
                                    @if(chkPer('csdlmucgiahhdv','taisan', 'giagocvlxd','hoso', 'approve')&& in_array($tt->trangthai,['CHT', 'HHT', 'HCB', 'CB']))
                                        @if($tt->trangthai == 'CB')
                                            <button type="button" onclick="confirmCongbo('{{$tt->mahs}}','{{$inputs['url'].'/congbo'}}', 'HCB')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal" data-toggle="modal">
                                                <i class="fa fa-times"></i>&nbsp;Hủy công bố</button>
                                        @else
                                            <button type="button" onclick="confirmCongbo('{{$tt->mahs}}','{{$inputs['url'].'/congbo'}}', 'CB')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal" data-toggle="modal">
                                                <i class="fa fa-send"></i>&nbsp;Công bố</button>

{{--                                            <button type="button" onclick="confirmTraLai('{{$tt->mahs}}','{{$inputs['url'].'/tralai'}}', '{{$tt->madv}}')" class="btn btn-default btn-xs mbs" data-target="#tralai-modal-confirm" data-toggle="modal">--}}
{{--                                                <i class="fa fa-times"></i> Trả lại</button>--}}
                                        @endif
                                    @endif
                                    <button type="button" onclick="get_attack('{{$tt->mahs}}')" class="btn btn-default btn-xs mbs" data-target="#dinhkem-modal-confirm" data-toggle="modal">
                                        <i class="fa fa-cloud-download"></i>&nbsp;Tải tệp</button>
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
    @include('manage.include.form.modal_attackfile')
    @include('manage.include.form.modal_approve_hs')
    @include('manage.include.form.modal_del_hs')
@stop