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
            $('#madiaban').change(function(){
                window.location.href = '/donvi/danhsach?madiaban=' + $(this).val();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh sách đơn vị<small>&nbsp;quản lý</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('hethong', 'hethong', 'danhsachdiaban', 'danhmuc','modify'))
                            <a href="{{url('/donvi/create?&madiaban='.$inputs['madiaban'])}}" class="btn btn-default btn-xs">
                                <i class="fa fa-plus"></i> Thêm mới</a>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label style="font-weight: bold">Địa bàn</label>
                                {{Form::select('madiaban',$a_diaban, $inputs['madiaban'],['id'=>'madiaban', 'class'=>'form-control'])}}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr class="text-center">
                                <th width="4%">STT</th>
                                <th width="15%">Mã đơn vị</th>
                                <th>Tên đơn vị</th>
                                <th width="20%">Phân loại</th>
                                <th width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            @foreach($model as $key=>$tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{$i++}}</td>
                                    <td class="text-center">{{$tt->madv}}</td>
                                    <td class="active" >{{$tt->tendv}}</td>
                                    <td>{{$a_phanloai[$tt->chucnang] ?? ''}}</td>
                                    <td>
                                        @if(chkPer('hethong', 'hethong', 'danhsachdiaban','danhmuc', 'modify'))
                                            <a href="{{url('/donvi/modify?madv='.$tt->madv)}}" class="btn btn-default btn-xs mbs">
                                                <i class="fa fa-edit"></i> Sửa</a>

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
        <!--Modal thông tin chi tiết -->
        {!! Form::open(['url'=>'diaban/modify','id' => 'frm_modify'])!!}
        <div id="modify-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin địa bàn quản lý</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Mã số</label>
                                    {!!Form::text('madiaban', null, array('id' => 'madiaban','class' => 'form-control'))!!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Tên địa bàn<span class="require">*</span></label>
                                    {!!Form::text('tendiaban', null, array('id' => 'tendiaban','class' => 'form-control', 'required'=>'required'))!!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Phân loại</label>
                                    {!!Form::select('level', getPhanLoaiDonVi_DiaBan(), null, array('id' => 'level','class' => 'form-control'))!!}
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
                {!! Form::open(['url'=>'donvi/delete','id' => 'frm_delete'])!!}
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

        <script>
            function add(){
                $('#madiaban').val('');
                $('#madiaban').attr('readonly',true);
            }

            function edit(madiaban, tendiaban, level){
                $('#madiaban').attr('readonly',false);
                $('#madiaban').val(madiaban);
                $('#tendiaban').val(tendiaban);
                $('#level').val(level).trigger('change');
            }
        </script>
</div>
@stop