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

            $('#namhs').change(function() {
                changeUrl();
            });

            $('#madv').change(function() {
                changeUrl();
            });

            $('#macskd').change(function() {
                changeUrl();
            });
        });
        function changeUrl() {
            var nam = $('#namhs').val();
            var url = '/kekhaigiadvlt?&madv='+$('#madv').val()+'&nam='+nam + '&macskd=' + $('#macskd').val();
            window.location.href = url;
        }
        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
        function confirmCopy(macskd){
            document.getElementById("macskdcp").value=macskd;
        }

        function confirmChuyenHSCham(id){
            document.getElementById("idchuyenhscham").value=id;
        }
        function ClickChuyenHsCham(){
            $('#frm_chuyenhscham').submit();
        }
        function ClickChuyen(){
            if($('#nguoinop').val() != '' && $('#dtll').val() != ''){
                var btn = document.getElementById('submitChuyen');
                btn.disabled = true;
                btn.innerText = 'Loading...';
                toastr.success("Hồ sơ đã được chuyển!", "Thành công!");
                $("#frm_chuyen").unbind('submit').submit();
            }else{
                toastr.error("Bạn cần nhập thông tin người chuyển", "Lỗi!!!");
                $("#frm_chuyen").submit(function (e) {
                    e.preventDefault();
                });
            }
        }

    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai giá<small>&nbsp;dịch vụ lưu trú</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{url('kekhaigiadvlt/create?&macskd='.$inputs['macskd'])}}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Kê khai mới </a>
                    </div>

                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label style="font-weight: bold">Năm hồ sơ</label>
                                <select name="namhs" id="namhs" class="form-control">
                                    @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                    @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                    @for($i = $nam_start; $i <= $nam_stop; $i++)
                                        <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label style="font-weight: bold">Đơn vị</label>
                                <select class="form-control select2me" id="madv">
                                    @foreach($a_diaban as $key=>$val)
                                        <optgroup label="{{$val}}">
                                            <?php $donvi = $m_donvi->where('madiaban', $key); ?>
                                            @foreach($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendn}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4">
                                    <label style="font-weight: bold">Cơ sở kinh doanh</label>
                                    {!! Form::select('macskd',$a_cskd, $inputs['macskd'], array('id' => 'macskd','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                            <thead>
                            <tr>
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Ngày kê khai</th>
                                <th style="text-align: center">Ngày thực hiện<br>mức giá kê khai</th>
                                <th style="text-align: center">Số công văn</th>
                                <th style="text-align: center">Số công văn<br> liền kề</th>
                                <th style="text-align: center">Cơ quan tiếp nhận</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
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
                                    <td style="text-align: left">{{$a_donvi_th[$tt->macqcq]?? ''}}</td>
                                    @if($tt->trangthai == "CC")
                                        <td align="center"><span class="badge badge-warning">Chờ chuyển</span></td>
                                    @elseif($tt->trangthai == 'CD')
                                        <td align="center"><span class="badge badge-blue">Chờ duyệt</span>
                                            <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                        </td>
                                    @elseif($tt->trangthai == 'BTL')
                                        <td align="center">
                                            <span class="badge badge-danger">Bị trả lại</span><br>&nbsp;
                                        </td>
                                    @elseif($tt->trangthai == 'CB')
                                        <td align="center"><span class="badge badge-warning">Công bố</span>
                                            <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                        </td>
                                    @else
                                        <td align="center">
                                            <span class="badge badge-success">Đã duyệt</span>
                                            <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{url('kekhaigiadvlt/prints?&mahs='.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>

                                        @if(canEdit($tt->trangthai))
                                            <a href="{{url('kekhaigiadvlt/edit?mahs='.$tt->mahs)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</a>
                                            @if($tt->trangthai == 'CC' || $tt->trangthai=='BTL')
                                                @if($tt->trangthai == 'CC')
                                                    <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal">
                                                        <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                                @endif

                                                @if( $tt->trangthai == 'BTL')
                                                    <button type="button" data-target="#tralai-modal-confirm" onclick="viewLyDo('{{$tt->mahs}}','{{$tt->madv}}')" data-toggle="modal" class="btn btn-default btn-xs mbs">
                                                        <i class="fa fa-search"></i>&nbsp;Lý do trả lại</button>
                                                @endif

                                                <button type="button" onclick="confirmChuyen('{{$tt->mahs}}','{{$inputs['url'].'/chuyen'}}')" class="btn btn-default btn-xs mbs" data-target="#chuyen-modal-confirm" data-toggle="modal">
                                                    <i class="fa fa-share-square-o"></i>&nbsp;Chuyển</button>
                                            @endif
                                        @endif
                                                        <!--a href="{{url('ke_khai_gia_sua/'.$tt->mahs.'/history')}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Lịch sử</a-->

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


    <!--Model chuyển hs chậm-->
    <div class="modal fade" id="chuyenhscham-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru/chuyenhscham','id' => 'frm_chuyenhscham'])!!}
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
                {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru/copy','id' => 'frm_chuyen_copy'])!!}
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


    <!--Modal delete-->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'kekhaigiadvlt/delete','id' => 'frm_delete'])!!}
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

    @include('manage.include.form.modal_approve_hsdn')
    @include('manage.include.form.modal_unapprove_dn')
@stop