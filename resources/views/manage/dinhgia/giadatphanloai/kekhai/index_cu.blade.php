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
        });

        $(function(){
            $('#nam').change(function() {
                var current_path_url = '/giadatphanloai?';
                var namhs = '&nam='+$('#nam').val();
                var mahuyen = '&mahuyen='+$('#mahuyen').val();
                var maxa = '&maxa='+$('#maxa').val();
                var tenphanloai = '&tenphanloai='+$('#tenphanloai').val();
                var paginate = '&paginate='+$('#paginate').val();
                var url = current_path_url+namhs+mahuyen+tenphanloai+paginate+maxa;
                window.location.href = url;
            });
        });

        function confirmDelete(id) {
            document.getElementById("iddelete").value=id;
        }
        function confirmHoanthanh(id) {
            document.getElementById("idhoanthanh").value=id;
        }
        function confirmHHT(id){
            document.getElementById("idhuyhoanthanh").value=id;
        }
        function confirmCB(id){
            document.getElementById("idcongbo").value=id;
        }

    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin giá đất<small>&nbsp;theo phân loại</small>
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
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giadatpl', 'hoso','modify'))
                            <a href="{{url('giadatphanloai/create?&madv='.$inputs['madv'])}}" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Thêm mới </a>
                            {{--<a href="{{url('giadatphanloai/nhandulieutuexcel')}}" class="btn btn-default btn-sm">--}}
                                {{--<i class="fa fa-file-excel-o"></i> Nhận dữ liệu</a>--}}
                        @endif

                        <a href="{{url('giadatphanloai/print?madv='.$inputs['madv'].'&nam='. $inputs['nam'])}}" class="btn btn-default btn-sm" target="_blank">
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

{{--                            <div class="col-md-3">--}}
{{--                                <label style="font-weight: bold">Quận/huyện</label>--}}
{{--                                <select id="madiaban" class="form-control">--}}
{{--                                    <option value="all">--Tất cả--</option>--}}
{{--                                    @foreach($huyens as $huyen)--}}
{{--                                        <option value="{{$huyen->district}}" {{$huyen->district == $inputs['mahuyen'] ? 'selected' : ''}}>{{$huyen->diaban}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <label style="font-weight: bold">Xã phường</label>--}}
{{--                                <select id="maxp" class="form-control">--}}
{{--                                    <option value="all">--Tất cả--</option>--}}
{{--                                    @foreach($xas as $xa)--}}
{{--                                        <option value="{{$xa->town}}" {{$xa->town == $inputs['maxa'] ? 'selected' : ''}}>{{$xa->diaban}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}

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
                                <th style="text-align: center">Quận(huyện) / Xã(phường)</th>
                                <th style="text-align: center">Thời điểm <br>xác định</th>
                                <th style="text-align: center">Vị trí đất</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Cơ quan tiếp nhận</th>
                                <th style="text-align: center">Hiện trạng</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td style="text-align: center">{{$tt->tenhuyen.' - '.$tt->tenxa}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                    <td style="text-align: left">{{$tt->tenvitri}}</td>
                                    @include('include.form.td_trangthai')
                                    <td style="text-align: left">{{$tt->macqcq}}</td>
                                    <td style="text-align: left">{{$tt->tinhtrang}}</td>
                                    <td>
                                        <a href="{{url('giadatphanloai/'.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                        @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                                            @if($tt->trangthai == 'CB')
                                                @if(can('thkkgiadatpl','congbo'))
                                                    <button type="button" onclick="confirmHHT('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#huyhoanthanh-modal-confirm" data-toggle="modal"><i class="fa fa-times"></i>&nbsp;
                                                        Hủy công bố</button>
                                                @endif
                                            @elseif($tt->trangthai == 'HT')
                                                @if(can('thkkgiadatpl','congbo'))
                                                    <button type="button" onclick="confirmCB('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#congbo-modal-confirm" data-toggle="modal"><i class="fa fa-send"></i>&nbsp;
                                                        Công bố</button>
                                                    <button type="button" onclick="confirmHHT('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#huyhoanthanh-modal-confirm" data-toggle="modal"><i class="fa fa-times"></i>&nbsp;
                                                        Hủy hoàn thành</button>
                                                @endif
                                            @else
                                                @if(can('kkgiadatpl','edit'))
                                                    <a href="{{url('giadatphanloai/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>

                                                @endif
                                                @if(can('kkgiadatpl','delete'))
                                                    <button type="button" onclick="confirmDelete('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                                        Xóa</button>
                                                @endif
                                            @endif
                                        @else

                                            <!-- 03.11.19 làm để giới thiệu (chưa phân quyền) -->
                                            @if($tt->trangthai == 'CHT' || $tt->trangthai == 'HHT')
                                                @if($tt->mahuyen == session('admin')->district)
                                                    @if(can('kkgiadatpl','edit'))
                                                        <!--đúng địa bàn quản lý thì đc sửa-->
                                                            <a href="{{url('giadatphanloai/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                                    @endif

                                                    @if(can('kkgiadatpl','approve'))
                                                        <button type="button" onclick="confirmHoanthanh('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#hoanthanh-modal-confirm" data-toggle="modal"><i class="fa fa-check"></i>
                                                            &nbsp;Hoàn thành</button>
                                                    @endif

                                                    @if(can('kkgiadatpl','delete'))
                                                        <button type="button" onclick="confirmDelete('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                                            Xóa</button>
                                                    @endif
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

    @include('includes.e.modal-attackfile')
    <!--Modal Delete-->
    <div id="delete-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giadatphanloai/delete','id' => 'frm_delete'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                    <input type="hidden" name="iddelete" id="iddelete">

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickdelete()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        function clickdelete(){
            $('#frm_delete').submit();
        }
    </script>
    <!--Modal Hoàn thành-->
    <div id="hoanthanh-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giadatphanloai/hoanthanh','id' => 'frm_hoanthanh'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hoàn thành hồ sơ?</h4>

                    <input type="hidden" name="idhoanthanh" id="idhoanthanh">

                </div>
                <div class="modal-body">
                    <p style="color: #0000FF">Hồ sơ đã hoàn thành sẽ không được phép chỉnh sửa và xóa hồ sơ nữa!Bạn cần liên hệ cơ quan chủ quản để chỉnh sửa hồ sơ nếu cần!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickhoanthanh()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!--Modal Hủy Hoàn thành-->
    <div id="huyhoanthanh-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giadatphanloai/huyhoanthanh','id' => 'frm_huyhoanthanh'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hủy hoàn thành hồ sơ?</h4>

                    <input type="hidden" name="idhuyhoanthanh" id="idhuyhoanthanh">

                </div>
                <div class="modal-body">
                    <p style="color: #0000FF">Hồ sơ Bị hủy sẽ chuyển lại cho cơ quan nhập chủ quản có thể chỉnh sửa hồ sơ!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickhuyhoanthanh()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!--Modal Hủy Hoàn thành-->
    <div id="congbo-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>'giadatphanloai/congbo','id' => 'frm_congbo'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true"
                            class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Đồng ý công bố hồ sơ?</h4>

                    <input type="hidden" name="idcongbo" id="idcongbo">

                </div>
                <div class="modal-body">
                    <p style="color: #0000FF">Hồ sơ sẽ được công bố lên trang công bố của tỉnh!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickcongbo()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        function clickhoanthanh(){
            $('#frm_hoanthanh').submit();
        }
        function clickcongbo(){
            $('#frm_congbo').submit();
        }
        function clickhuyhoanthanh(){
            $('#frm_huyhoanthanh').submit();
        }
    </script>
    @include('includes.e.modal-attackfile')
@stop