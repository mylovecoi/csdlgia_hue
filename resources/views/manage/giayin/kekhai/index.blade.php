@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css')}}"/-->
    <!-- BEGIN THEME STYLES -->
    <!--link href="{{url('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="{{url('assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/-->
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!--script type="text/javascript" src="{{url('assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js')}}"></script-->
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();

            $('#nam').change(function() {
                window.location.href = '{{$inputs['url']}}'+'/danhsach?madv='+$('#madv').val() + '&nam=' + $('#nam').val();
            });

            $('#madv').change(function() {
                window.location.href = '{{$inputs['url']}}'+'/danhsach?madv='+$('#madv').val() + '&nam=' + $('#nam').val();
            });
        });
    </script>
    @stop
            <!--
    Thêm mới: Load danh mục mặt hàng rồi chọn
-->
@section('content')
    <h5 class="page-title">
        Thông tin hồ sơ kê khai giá giấy</small>

    </h5>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box wi">
                <div class="portlet-title">
                    <div class="caption"></div>
                    <div class="actions">
                        {{--@if(chkPer('csdlmucgiahhdv','bog', 'bog', 'hoso', 'modify'))--}}

                        <button data-target="#create-modal" data-toggle="modal" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Thêm mới </button>
                        {{--@endif--}}

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
                                    @foreach($m_diaban as $db)
                                        <optgroup label="{{$db->tendiaban}}">
                                            <?php $donvi = $m_donvi->where('madiaban',$db->madiaban); ?>
                                            @foreach($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendn}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="table-toolbar"></div>
                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                        <tr>
                            <!--th class="table-checkbox">
                                <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
                            </th-->
                            <th width="2%" style="text-align: center">STT</th>
                            <th style="text-align: center">Ngành nghề</br>kinh doanh</th>
                            <th style="text-align: center">Mã hồ sơ</th>
                            <th style="text-align: center">Số</br>quyết định</th>
                            <th style="text-align: center">Thời điểm</br>áp dụng</th>
                            <th style="text-align: center">Hình thức</br>kê khai</th>
                            <th style="text-align: center">Ghi chú</th>

                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Cơ quan tiếp nhận</th>
                            <th width="20%" style="text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td>{{$a_nghe[$tt->manghe] ?? ''}}</td>
                                <td>{{$tt->mahs}}</td>
                                <td class="success">{{$tt->socv}}</td>
                                <td class="text-center" style="font-weight: bold">{{getDayVn($tt->ngayhieuluc)}}</td>
                                <td style="text-align: center; font-weight: bold">{{$a_phanloai[$tt->phanloai] ?? ''}}</td>
                                <td>{{$tt->ghichu}}</td>

                                @include('manage.include.form.td_trangthai_dn')
                                <td style="text-align: left">{{$a_donvi_th[$tt->macqcq]?? ''}}</td>
                                <td>
                                    <a href="{{url('giayin/xemhoso?mahs='.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>

                                    @if(in_array($tt->trangthai,['CC','TL']) /*&& chkPer('csdlmucgiahhdv','bog', 'bog', 'hoso', 'modify')*/)
                                        <a href="{{url('giayin/modify?mahs='.$tt->mahs)}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i> Chỉnh sửa </a>

                                        <button type="button" onclick="confirmChuyen('{{$tt->mahs}}','{{$inputs['url'].'/chuyenhs'}}')" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-check"></i> Hoàn thành</button>

                                        <button type="button" onclick="confirmDelete('{{$tt->mahs}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    @endif
                                    @if($tt->trangthai=='TL')
                                        <button type="button" onclick="viewLyDo('{{$tt->mahs}}','{{$tt->madv}}')" data-target="#tralai-modal-confirm" data-toggle="modal" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-search"></i>&nbsp;Lý do trả lại</button>
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
    <div class="clearfix"></div>

    <!--Model-edit-->
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin giá giấy</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <!--th class="table-checkbox">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
                                    </th-->
                                    <th width="2%" style="text-align: center">STT</th>
                                    <th style="text-align: center">Ngành nghề kinh doanh</th>
                                    <th style="text-align: center">Hình thức</br>kê khai</th>
                                    <th width="20%" style="text-align: center">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($m_giay as $key=>$tt)
                                    <tr>
                                        <td style="text-align: center">{{$key + 1}}</td>
                                        <td class="success">{{$tt->tennghe}}</td>
                                        <td style="text-align: center; font-weight: bold">{{$a_phanloai[$tt->phanloai] ?? ''}}</td>
                                        <td>
                                            <a href="{{url('giayin/create')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-plus"></i>&nbsp;Kê khai</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @include('manage.include.form.modal_del_hs')
    @include('manage.include.form.modal_approve_hsdn')
    @include('manage.include.form.modal_unapprove_dn')
@stop
