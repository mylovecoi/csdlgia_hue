@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
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
            $('#namhs').change(function() {
                var nam = $('#namhs').val();
                var masothue = $('#masothue').val();
                var url = '/kekhaigiavetqkdl?&masothue='+masothue+'&nam='+nam;

                window.location.href = url;
            });
        });
        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
    </script>
@stop

@section('content')
    <marquee>
        <b style="color: #ff0000">{{$modeldv->tendv}} xin thông báo:</b> Ngày áp dụng hồ sơ kê khai giá vé tham quan khu du lịch phải sau {{$modeldv->songaylv}} ngày làm việc, tính từ thời điểm chuyển hồ sơ. Hồ sơ chuyển  trước 17h sẽ tính từ ngày gửi, sau 17h sẽ tính ngày hôm sau!!! (Ngày làm việc không tính thứ 7, CN và ngày nghỉ lể)
    </marquee>
    <h3 class="page-title">
        Thông tin kê khai giá<small>&nbsp;vé tham quan khu du lịch trên địa bàn tỉnh</small>
        <p><h5 style="color: blue">{{$modeldn->tendn}}&nbsp;- Mã số thuế: {{$modeldn->maxa}} - Cơ quan chủ quản: {{$modeldv->tendv}}</h5></p>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{url('kekhaigiavetqkdl/create?&masothue='.$inputs['masothue'])}}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Kê khai mới </a>
                        @if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X')
                            <a href="{{url('thongtindntqkdl?&maxa='.$modeldn->mahuyen)}}" class="btn btn-default btn-sm">
                                <i class="fa fa-reply"></i> Quay lại </a>
                        @endif
                    </div>
                <input type="hidden" name="masothue" id="masothue" value="{{$inputs['masothue']}}">
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label style="font-weight: bold">Năm hồ sơ</label>
                                    <select name="namhs" id="namhs" class="form-control">
                                        @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                        @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                        @for($i = $nam_start; $i <= $nam_stop; $i++)
                                            <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Ngày kê khai</th>
                            <th style="text-align: center">Ngày thực hiện<br>mức giá kê khai</th>
                            <th style="text-align: center">Số công văn</th>
                            <th style="text-align: center">Số công văn<br> liền kề</th>
                            <th style="text-align: center">Người chuyển</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                <td style="text-align: center" class="active">{{$tt->socv}}</td>
                                <td style="text-align: center">{{$tt->socvlk}}</td>
                                <td style="text-align: left">@if($tt->nguoinop != '')Họ và tên: {{$tt->nguoinop}}
                                    <br>Số điện thoại liên hệ: {{$tt->dtll}}<br>Số Fax: {{$tt->fax}}@endif</td>
                                @if($tt->trangthai == "CC")
                                    <td align="center"><span class="badge badge-warning">Chờ chuyển</span></td>
                                @elseif($tt->trangthai == 'CD')
                                    <td align="center"><span class="badge badge-blue">Chờ duyệt</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @elseif($tt->trangthai == 'CN')
                                    <td align="center"><span class="badge badge-warning">Chờ nhận</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @elseif($tt->trangthai == 'BTL')
                                    <td align="center">
                                        <span class="badge badge-danger">Bị trả lại</span><br>&nbsp;
                                        Thời gian trả hồ sơ:<br><b>{{getDateTime($tt->updated_at)}}</b>
                                    </td>
                                @else
                                    <td align="center">
                                        <span class="badge badge-success">Đã duyệt</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @endif
                                <td>
                                    <a href="{{url('kekhaigiavetqkdl/prints?&mahs='.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                    @if(canEdit($tt->trangthai))
                                            <a href="{{url('kekhaigiavetqkdl/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                        @if(canChuyenXoa($tt->trangthai))
                                            @if($tt->trangthai == 'CC')
                                            <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                                Xóa</button>
                                            @endif
                                            @if($tt->trangthai == 'CC' || $tt->trangthai == 'BTL')
                                            <button type="button" onclick="confirmChuyen('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#chuyen-modal" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;
                                                Chuyển</button>
                                            @endif
                                            @if(session('admin')->sadmin == 'ssa')
                                                <!--button type="button" onclick="confirmChuyenHSCham('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#chuyenhscham-modal" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;
                                                    Chuyển HS chậm</button-->
                                            @endif
                                        @endif
                                        @if(canShowLyDo($tt->trangthai))
                                        <button type="button" data-target="#lydo-modal" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="viewLyDo({{$tt->id}})"><i class="fa fa-search"></i>&nbsp;Lý do trả lại</button>
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
    <div class="clearfix"></div>
    <!--Model chuyển-->
        <div class="modal fade" id="chuyen-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'kekhaigiavetqkdl/chuyen','id' => 'frm_chuyen'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý chuyển hồ sơ?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="tthschuyen">
                        </div>
                        <div class="form-group">
                            <label><b>Họ và tên người nộp</b></label>
                            <input type="text" id="nguoinop" name="nguoinop" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><b>Số điện thoại liên hệ</b></label>
                            <input type="tel" id="dtll" name="dtll" class="form-control" maxlength="15">
                        </div>
                        <div class="form-group">
                            <label><b>Email</b></label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label><b>Số Fax</b></label>
                            <input type="tel" id="fax" name="fax" class="form-control" maxlength="15">
                        </div>
                    </div>
                    <input type="hidden" name="idchuyen" id="idchuyen">
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickChuyen()" id="submitChuyen">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    <!--Model chuyển hs chậm-->
        <div class="modal fade" id="chuyenhscham-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'kekhaigiavetqkdl/chuyenhscham','id' => 'frm_chuyenhscham'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý chuyển hồ sơ bị chậm?</h4>
                    </div>
                    <input type="hidden" name="idchuyenhscham" id="idchuyenhscham">
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickChuyenHsCham()">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    <!--Model copy-->
        <div class="modal fade" id="copy-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'kekhaigiavetqkdl/copy','id' => 'frm_chuyen'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Sao chép hồ sơ kê khai?</h4>
                    </div>
                    <div class="modal-body">
                        <p style="color: #000066"><u>Ghi chú</u>: Chức năng này sẽ hỗ trợ kê khai nhanh giá dịch vụ, chương trình sẽ tự động sao chép thông tin từ hồ sơ kê khai đã được duyệt
                            và chuyển các thông tin vào màn hình kê khai mới.Các mức giá kê khai liền kề sẽ tự động lấy từ thông tin kê khai sao chép chuyển vào</p>
                    <input type="hidden" name="macskdcp" id="macskdcp" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickCopy()">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>

    <!--Model lý do-->
    <div class="modal fade" id="lydo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><b>Lý do trả lại hồ sơ?</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="showlydo">
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

        <!--Modal delete-->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'kekhaigiavetqkdl/delete','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="iddelete" id="iddelete">
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



@stop