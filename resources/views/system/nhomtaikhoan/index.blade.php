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

        function new_hs() {
            var form = $('#frm_modify');
            form.find("[name='maso']").val('NEW');
            form.find("[name='mota']").val(null);
        }

        function ClickEdit(maso){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/nhomtaikhoan/get_tk',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_modify');
                    form.find("[name='maso']").val(data.maso);
                    form.find("[name='mota']").val(data.mota);
                    form.find("[name='chucnang']").val(data.chucnang).trigger('change');
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }

        function setPerGroup(maso){
            $('#frm_pergroup').find("[name='maso']").val(maso);
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh sách nhóm tài khoản
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('hethong', 'hethong_pq', 'nhomtaikhoan','danhmuc', 'modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr class="text-center">
                                <th style="text-align: center" width="5%">STT</th>
                                <th style="text-align: center">Tên nhóm tài khoản</th>
                                <th style="text-align: center">Chức năng</th>
                                <th style="text-align: center" width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key + 1}}</td>
                                    <td class="active">{{$tt->mota}}</td>
                                    <td class="active">{{$a_phanloai[$tt->chucnang] ?? ''}}</td>
                                    <td>
                                        @if(chkPer('hethong', 'hethong_pq', 'nhomtaikhoan','danhmuc', 'modify'))
                                            <button type="button" onclick="ClickEdit('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</button>

                                            <a href="{{url('/nhomtaikhoan/perm?maso='.$tt->maso)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-cogs"></i>&nbsp;Phân quyền</a>

                                            <button type="button" onclick="setPerGroup('{{$tt->maso}}')" class="btn btn-default btn-xs mbs" data-target="#modify-phanquyen" data-toggle="modal">
                                                <i class="fa fa-cogs"></i>&nbsp;Tải quyền theo tài khoản</button>

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

    {!! Form::open(['url'=>'/nhomtaikhoan/store','id' => 'frm_modify'])!!}
    <input type="hidden" name="maso" id="maso">
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin nhóm tài khoản</h4>
                </div>

                <div class="modal-body" id="edit-tt">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mô tả<span class="require">*</span></label>
                                <input type="text" name="mota" id="mota" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Chức năng</label>
                                {!! Form::select('chucnang', $a_phanloai, null, array('id'=>'chucnang','class'=>'form-control'))!!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn blue">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! Form::close() !!}

    {!! Form::open(['url'=>'nhomtaikhoan/set_perm_user','id' => 'frm_pergroup'])!!}
    {!! Form::hidden('maso', null) !!}
    <div id="modify-phanquyen" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Phân quyền theo tài khoản</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Tên tài khoản</label>
                                {!!Form::select('username',$a_user, null,  array('id' => 'username','class' => 'form-control select2me'))!!}
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
                {!! Form::open(['url'=>'nhomtaikhoan/delete','id' => 'frm_delete'])!!}
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