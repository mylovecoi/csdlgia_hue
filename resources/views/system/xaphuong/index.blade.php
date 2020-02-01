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
            $('#madiaban').change(function () {
                window.location.href = '/xaphuong/danhsach?madiaban=' + $(this).val() ;
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

    <h3 class="page-title">
        Danh sách địa bàn<small>&nbsp;xã, phường, thị trấn</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('hethong', 'hethong', 'danhsachxaphuong', 'modify'))
                            <button type="button" onclick="add()" class="btn btn-default btn-xs" data-target="#modify-modal" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-weight: bold">Huyện, Thành phố</label>
                                {{Form::select('madiaban', $a_diaban, $inputs['madiaban'], ['id'=>'madiaban', 'class'=>'form-control'])}}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                            <tr class="text-center">
                                <th width="4%">STT</th>
                                <th width="15%">Mã số</th>
                                <th>Tên xã, phường, thị trấn</th>
                                <th width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;?>
                            @foreach($model as $key=>$tt)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{$i++}}</td>
                                    <td class="text-center">{{$tt->maxp}}</td>
                                    <td class="active" >{{$tt->tenxp}}</td>
                                    <td>
                                        @if(chkPer('hethong', 'hethong', 'danhsachxaphuong', 'modify'))
                                            <button type="button" onclick="edit('{{$tt->maxp}}','{{$tt->tenxp}}','{{$tt->level}}')" class="btn btn-default btn-xs mbs" data-target="#modify-modal" data-toggle="modal">
                                                <i class="fa fa-edit"></i>&nbsp;Sửa</button>

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
        {!! Form::open(['url'=>'xaphuong/modify','id' => 'frm_modify'])!!}
        <div id="modify-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin địa bàn xã, phường, thị trấn</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Mã số</label>
                                    {!!Form::text('maxp', null, array('id' => 'maxp','class' => 'form-control'))!!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">Tên xã, phường, thị trấn<span class="require">*</span></label>
                                    {!!Form::text('tenxp', null, array('id' => 'tenxp','class' => 'form-control', 'required'=>'required'))!!}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="madiaban" value="{{$inputs['madiaban']}}" />
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
                {!! Form::open(['url'=>'xaphuong/delete','id' => 'frm_delete'])!!}
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
            $('#maxp').val('');
            $('#maxp').attr('readonly',true);
        }

        function edit(maxp, tenxp){
            $('#maxp').attr('readonly',true);
            $('#maxp').val(maxp);
            $('#tenxp').val(tenxp);
        }
    </script>
</div>
@stop