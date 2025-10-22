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
        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
        function setPerGroup(username){
            $('#frm_pergroup').find("[name='username']").val(username);
        }
        $(function(){
            $('#madv').change(function(){
                window.location.href = '/taikhoan/danhsach?madv=' + $(this).val();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh sách tài khoản
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify'))
                            <a href="{{url('/taikhoan/create?&madv='.$inputs['madv'])}}" class="btn btn-default btn-xs">
                                <i class="fa fa-plus"></i>Thêm mới
                            </a>
                        @endif
                        <a href="{{ url('/data/download/filemau/FileExcelDsTaiKhoan.xlsx') }}" target="_blank" class="btn btn-success btn-xs mbs">
                            <i class="fa fa-file-excel-o"></i>&nbsp;Tải file mẫu
                        </a>
                        <a href="{{ url('taikhoan/danhsach/nhanexcel?madv=' . $inputs['madv']) }}" class="btn btn-default btn-sm">
                            <i class="fa fa-file-excel-o"></i>Nhận dữ liệu
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-weight: bold">Đơn vị</label>
                                <select class="form-control select2me" name="madv" id="madv">
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

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2" width="2%">STT</th>
                                <th rowspan="2" >Tên tài khoản</th>
                                <th rowspan="2" width="15%">Tài khoản</br>truy cập</th>
                                <th colspan="3">Chức năng</th>
                                <th rowspan="2" width="10%">Trạng thái</th>
                                <th rowspan="2" width="20%">Thao tác</th>
                            </tr>
                            <tr class="text-center">
                                <th width="5%">Nhập<br>liệu</th>
                                <th width="5%">Tổng<br>hợp</th>
                                <th width="5%">Quản<br>trị</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$tt->name}}</td>
                                    <td class="active text-center">{{$tt->username}}</td>
                                    <td class="text-center">{!!  $tt->nhaplieu == 1 ? '<i class="fa fa-check"></i>':'' !!}</td>
                                    <td class="text-center">{!!  $tt->tonghop == 1 ? '<i class="fa fa-check"></i>':'' !!}</td>
                                    <td class="text-center">{!!  $tt->quantri == 1 ? '<i class="fa fa-check"></i>':'' !!}</td>
                                    <td class="text-center">
                                        @if($tt->status == 'Kích hoạt')
                                            <span class="label label-sm label-success">{{$tt->status}}</span><br>
                                            {{$tt->ttnguoitao}}
                                        @else
                                            <span class="label label-sm label-danger">{{$tt->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify'))
                                            <a href="{{url('/taikhoan/modify?username='.$tt->username)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i> Sửa</a>

                                            <a href="{{url('taikhoan/perm?username='.$tt->username)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-cogs"></i>&nbsp;Phân quyền</a>

                                            <button type="button" onclick="setPerGroup('{{$tt->username}}')" class="btn btn-default btn-xs mbs" data-target="#modify-phanquyen" data-toggle="modal">
                                                <i class="fa fa-cogs"></i>&nbsp;Phân quyền theo nhóm</button>

                                            <a href="{{url('taikhoan/copy?username='.$tt->username)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-copy"></i>&nbsp;Sao chép</a>

                                            <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal">
                                                <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
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




    {!! Form::open(['url'=>'taikhoan/perm_group','id' => 'frm_pergroup'])!!}
    {!! Form::hidden('username', null) !!}
    <div id="modify-phanquyen" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Phân quyền theo nhóm tài khoản</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Nhóm tài khoản</label>
                                {!!Form::select('maso',$a_nhomtk, null,  array('id' => 'maso','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'taikhoan/delete','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="iddelete" id="iddelete">
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@stop