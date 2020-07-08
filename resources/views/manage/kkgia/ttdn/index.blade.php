@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
<script>
    jQuery(document).ready(function() {
        //TableManaged.init();

        $('#madv').change(function() {
            changeUrl();
        });
    });

    function changeUrl() {
        var url = '/doanhnghiep/danhsach?&madv='+$('#madv').val();
        window.location.href = url;
    }

    function getId(id){
        document.getElementById("id").value=id;
    }
    function ClickUpAvatar(){
        if($('#avatar').val() != ''){
            toastr.success("Ảnh đại diện được thay đổi!", "Thành công!");
            $("#frm_upavatar").unbind('submit').submit();
        }else{
            toastr.error("Bạn cần chọn ảnh đại diện cần thay đổi", "Lỗi!!!");
            $("#frm_upavatar").submit(function (e) {
                e.preventDefault();
            });
        }

    }
</script>
@stop

@section('content')
    <h3 class="page-title text-uppercase">
        {{session('admin')['a_chucnang']['thongtinkknygia'] ?? 'Thông tin doanh nghiệp'}}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        @if($modeltttd == null || $modeltttd->trangthai != 'CD')
                            <a href="{{url('doanhnghiep/modify?madv='.$model->madv)}}" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Thay đổi thông tin </a>
                        @endif

                        @if(isset($modeltttd) && $modeltttd->trangthai == 'CC')
                            <a href="{{url('doanhnghiep/chuyenhs?madv='.$modeltttd->madv)}}" class="btn btn-default btn-sm">
                                <i class="fa fa-share-square-o"></i> Chuyển thông tin</a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label style="font-weight: bold">Đơn vị</label>
                                <select class="form-control select2me" id="madv">
                                    @foreach($m_diaban as $diaban)
                                        <optgroup label="{{$diaban->tendiaban}}">
                                            <?php $donvi = $m_doanhnghiep->where('madiaban', $diaban->madiaban); ?>
                                            @foreach($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendn}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    @if(isset($modeltttd))
                        @if($modeltttd->trangthai == 'BTL')
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <h3 style="font-weight: bold; color: #ff0000">Hồ sơ bị trả lại</h3>
                                        <p>Lý do: {{$modeltttd->lydo}}</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($modeltttd->trangthai == 'CD')
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <h3 style="font-weight: bold; color: #ff0000">Hồ sơ đang chờ duyệt</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <table id="user" class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: center;color: #5b9bd1"><b>Thông tin hiện tại</b></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"> <b>Tên doanh nghiệp</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->tendn}}</span> </td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Mã số thuế</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->madv}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa chỉ trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->diachi}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Điện thoại trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->tel}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Số fax trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->fax}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Email quản lý</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->email}}</span></td>
                                    </tr>
                                    {{--<tr>--}}
                                        {{--<td style="width:15%"><b>Nơi đăng ký nộp thuế</b></td>--}}
                                        {{--<td style="width:35%"><span class="text-muted">{{$model->noidknopthue}}</span></td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td style="width:15%"><b>Giấy phép kinh doanh</b></td>--}}
                                        {{--<td style="width:35%"><span class="text-muted">{{$model->giayphepkd}}</span></td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td style="width:15%"><b>Giấy phép đăng ký kinh doanh</b></td>--}}
                                        {{--<td style="width:35%"><span class="text-muted"><a href="{{url('data/doanhnghiep/'.$model->tailieu)}}" target="_blank">Xem chi tiết</a></span></td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td style="width:15%"><b>Chức danh người ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->chucdanh}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Họ và tên người ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->nguoiky}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa bàn bàn đăng ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$a_diaban[$model->madiaban] ?? ''}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa danh</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$model->diadanh}}</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <tr>
                                        <th>STT</th>
                                        <th>Ngành nghề kinh doanh</th>
                                    </tr>
                                    @foreach($modellvcc as $key=> $lvcc)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>{{$a_nghe[$lvcc->manghe] ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @if(isset($modeltttd))
                            <div class="col-md-6">
                                <table id="user" class="table table-bordered table-striped">
                                    <tbody>
                                    <tr><td colspan="2" style="text-align: center;color: #5b9bd1"><b>Thông tin thay đổi</b></td></tr>
                                    <tr>
                                        <td style="width:15%"><b>Tên doanh nghiệp</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->tendn}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Mã số thuế</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->madv}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa chỉ trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->diachi}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Điện thoại trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->tel}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Số fax trụ sở chính</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->fax}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Email quản lý</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->email}}</span></td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td style="width:15%"><b>Nơi đăng ký nộp thuế</b></td>--}}
{{--                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->noidknopthue}}</span></td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td style="width:15%"><b>Giấy phép kinh doanh</b></td>--}}
{{--                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->giayphepkd}}</span></td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td style="width:15%"><b>Giấy phép đăng ký kinh doanh</b></td>--}}
{{--                                        <td style="width:35%">--}}
{{--                                            @if($modeltttd->tailieu !='')--}}
{{--                                                <span class="text-muted"><a href="{{url('data/doanhnghiep/'.$modeltttd->tailieu)}}" target="_blank">Xem chi tiết</a></span>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
                                    <tr>
                                        <td style="width:15%"><b>Chức danh người ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->chucdanh}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Họ và tên người ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->nguoiky}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa bàn bàn đăng ký</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$a_diaban[$model->madiaban] ?? ''}}</span></td>
                                    </tr>
                                    <tr>
                                        <td style="width:15%"><b>Địa danh</b></td>
                                        <td style="width:35%"><span class="text-muted">{{$modeltttd->diadanh}}</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <tr>
                                        <th>STT</th>
                                        <th>Ngành nghề kinh doanh</th>
                                    </tr>
                                    @foreach($modeltttdct as $key=> $ttdncttd)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>{{$a_nghe[$ttdncttd->manghe] ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Model avatar-->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'thongtindoanhnghiep/upavatar','id' => 'frm_upavatar','files'=>true,'enctype'=>'multipart/form-data'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thay đổi hình ảnh đại diện</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!!Form::file('avatar',array('id'=>'avatar','class' => 'passvalid','accept'=>'image/*'))!!}
                    </div>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn blue" onclick="ClickUpAvatar()">Đồng ý</button>

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop