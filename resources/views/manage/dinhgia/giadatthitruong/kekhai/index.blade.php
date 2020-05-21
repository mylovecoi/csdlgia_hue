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
                var url = current_path_url + 'nam=' + $('#nam').val() + '&madiaban=' + $('#madiaban').val();
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
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin giá đất giao dịch thực tế trên thị trường
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
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadaugiadat', 'hoso', 'modify'))
                            <a href="{{url($inputs['url'].'/new?&madv='.$inputs['madv'].'&madiaban='.$inputs['madiaban'])}}" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Thêm mới</a>

{{--                            <a href="{{url($inputs['url'].'/nhandulieutuexcel')}}" class="btn btn-default btn-sm">--}}
{{--                                <i class="fa fa-file-excel-o"></i> Nhận dữ liệu</a>--}}
                        @endif
{{--                        <a href="{{url($inputs['url'].'/prints?&nam='.$inputs['nam'].'&madiaban='.$inputs['madiaban'])}}" class="btn btn-default btn-sm" target="_blank">--}}
{{--                            <i class="fa fa-print"></i> In</a>--}}

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
                        </div>
                    </div>

                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Địa bàn</th>
                                <th style="text-align: center">Thời điểm</th>
                                <th style="text-align: center">Mô tả</th>
                                <th style="text-align: center"  width="5%">Trạng thái</th>
                                <th style="text-align: center">Cơ quan tiếp nhận</th>
                                <th style="text-align: center"> Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td><b>{{$a_diaban[$tt->madiaban] ?? ''}}</b></td>
                                <td><b>{{getDayVn($tt->thoidiem)}}</b></td>
                                <td style="text-align: left" class="active">{{$tt->tenduan}}</td>
                                @include('manage.include.form.td_trangthai')
                                <td style="text-align: left">{{$a_donvi_th[$tt->macqcq]?? ''}}</td>
                                <td>
                                    @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadaugiadat', 'hoso', 'modify') && in_array($tt->trangthai,['CHT', 'HHT']))
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=true')}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i>&nbsp;Chi tiết</a>
                                        <button type="button" onclick="confirmDelete('{{$tt->mahs}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    @else
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=false')}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i>&nbsp;Chi tiết</a>
                                    @endif

                                    @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadaugiadat', 'hoso', 'approve')&& in_array($tt->trangthai,['CHT', 'HHT']))
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
    <!-- BEGIN DASHBOARD STATS -->
    <!-- END DASHBOARD STATS -->
    @include('manage.include.form.modal_approve_hs')
    @include('manage.include.form.modal_del_hs')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop