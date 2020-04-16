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
        $(function(){
            $('#madv').change(function(){
                window.location.href = '/taikhoan/danhsach?madv=' + $(this).val();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh sách tài khoản<small>&nbsp;</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('hethong', 'hethong', 'danhsachtaikhoan','danhmuc', 'modify'))
                            <a href="{{url('/taikhoan/create?&madv='.$inputs['madv'])}}" class="btn btn-default btn-xs">
                                <i class="fa fa-plus"></i> Thêm mới</a>
                        @endif
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

                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr class="text-center">
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Tên tài khoản</th>
                                <th style="text-align: center" width="10%">Tài khoản</br>truy cập</th>
                                <th style="text-align: center" width="15%">Phân loại</th>
                                <th style="text-align: center" width="10%">Trạng thái</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td>{{$tt->name}}</td>
                                    <td class="active">{{$tt->username}}</td>
                                    <td>{{$a_phanloai[$tt->chucnang] ?? ''}}</td>
                                    <td style="text-align: center">
                                        @if($tt->status == 'Kích hoạt')
                                            <span class="label label-sm label-success">{{$tt->status}}</span><br>
                                            {{$tt->ttnguoitao}}
                                        @else
                                            <span class="label label-sm label-danger">{{$tt->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(chkPer('hethong', 'hethong', 'danhsachtaikhoan','danhmuc', 'modify'))
                                            <a href="{{url('/taikhoan/modify?username='.$tt->username)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i> Sửa</a>

                                            <a href="{{url('taikhoan/perm?username='.$tt->username)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-cogs"></i>&nbsp;Phân quyền</a>

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