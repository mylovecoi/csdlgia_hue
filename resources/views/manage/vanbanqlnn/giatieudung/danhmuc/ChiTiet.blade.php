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
        function getId(maso){
            $('#frm_delete').find("[id='matt']").val(maso);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function ClickEdit(maso){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/show_nhomdm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    matt: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    var form = $('#frm_create');
                    form.find("[name='matt']").val(data.matt);
                    form.find("[name='tentt']").val(data.tentt);
                    form.find("[name='theodoi']").val(data.theodoi).trigger('change');
                    //form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            form.find("[name='matt']").val('NEW');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Chi tiết danh mục giỏ hàng
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'danhmuc', 'modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center" width="5%">STT</th>
                            <th colspan="4" style="text-align: center">Phân nhóm</th>
                            <th rowspan="2" style="text-align: center">Mã số</th>
                            <th rowspan="2" style="text-align: center">Tên mặt hàng</th>
                            <th rowspan="2" style="text-align: center">Đơn vị<br>tính</th>
                            <th rowspan="2" style="text-align: center">Quyền số</th>
                            <th rowspan="2" style="text-align: center">Hiện thị<br>báo cáo</th>
                            <th rowspan="2" style="text-align: center" width="10%">Thao tác</th>
                        </tr>
                        <tr>
                            <th style="text-align: center" width="3%">Nhóm<br>I</th>
                            <th style="text-align: center" width="3%">Nhóm<br>II</th>
                            <th style="text-align: center" width="3%">Nhóm<br>II</th>
                            <th style="text-align: center" width="3%">Nhóm<br>IV</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $model_nhomI = $model->where('masonhomhanghoa','01');
                                $i_I = 1;
                            ?>
                        @foreach($model_nhomI as $tt_I)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$i_I++}}</td>
                            <td class="text-center">-</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$tt_I->masohanghoa}}</td>
                            <td>{{$tt_I->tenhanghoa}}</td>
                            <td>{{$tt_I->dvt}}</td>
                            <td class="text-center">{{$tt_I->quyensogoc}}</td>
                            <td class="text-center">{{$tt_I->baocao}}</td>
                            <td class="text-center">
                                
                                    <button title="Sửa" type="button" onclick="ClickEdit('{{$tt_I->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                        <i class="fa fa-edit"></i></button>
                                    <button title="Xoá" type="button" onclick="getId('{{$tt_I->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                        <i class="fa fa-trash-o"></i></button>
                                
                            </td>
                        </tr>
                            <?php 
                                $model_nhomII = $model->where('masonhomhanghoa','02')->where('masogoc',$tt_I->masohanghoa);
                                $i_II = 1;
                            ?>
                            @foreach($model_nhomII as $tt_II)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$i_II++}}</td>
                                <td></td>
                                <td class="text-center">-</td>                            
                                <td></td>
                                <td></td>
                                <td>{{$tt_II->masohanghoa}}</td>
                                <td>{{$tt_II->tenhanghoa}}</td>
                                <td>{{$tt_II->dvt}}</td>
                                <td class="text-center">{{$tt_II->quyensogoc}}</td>
                                <td class="text-center">{{$tt_II->baocao}}</td>
                                <td class="text-center">
                                    
                                        <button title="Sửa" type="button" onclick="ClickEdit('{{$tt_II->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                            <i class="fa fa-edit"></i></button>
                                        <button title="Xoá" type="button" onclick="getId('{{$tt_II->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                            <i class="fa fa-trash-o"></i></button>
                                    
                                </td>
                            </tr>
                                <?php 
                                    $model_nhomIII = $model->where('masonhomhanghoa','03')->where('masogoc',$tt_II->masohanghoa);
                                    $i_III = 1;
                                ?>
                                @foreach($model_nhomIII as $tt_III)
                                <tr class="odd gradeX">
                                    <td style="text-align: center">{{$i_III++}}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">-</td>                            
                                    
                                    <td></td>
                                    <td>{{$tt_III->masohanghoa}}</td>
                                    <td>{{$tt_III->tenhanghoa}}</td>
                                    <td>{{$tt_III->dvt}}</td>
                                    <td class="text-center">{{$tt_III->quyensogoc}}</td>
                                    <td class="text-center">{{$tt_III->baocao}}</td>
                                    <td class="text-center">
                                        
                                            <button title="Sửa" type="button" onclick="ClickEdit('{{$tt_III->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                                <i class="fa fa-edit"></i></button>
                                            <button title="Xoá" type="button" onclick="getId('{{$tt_III->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                                <i class="fa fa-trash-o"></i></button>
                                        
                                    </td>
                                </tr>
                                    <?php 
                                        $model_nhomIV = $model->where('masonhomhanghoa','04')->where('masogoc',$tt_III->masohanghoa);
                                        $i_IV = 1;
                                    ?>
                                    @foreach($model_nhomIV as $tt_IV)
                                    <tr class="odd gradeX">
                                        <td style="text-align: center">{{$i_IV++}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">-</td>                                        
                                        <td>{{$tt_IV->masohanghoa}}</td>
                                        <td>{{$tt_IV->tenhanghoa}}</td>
                                        <td>{{$tt_IV->dvt}}</td>
                                        <td class="text-center">{{$tt_IV->quyensogoc}}</td>
                                        <td class="text-center">{{$tt_IV->baocao}}</td>
                                        <td class="text-center">
                                            
                                                <button title="Sửa" type="button" onclick="ClickEdit('{{$tt_IV->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                                    <i class="fa fa-edit"></i></button>
                                                <button title="Xoá" type="button" onclick="getId('{{$tt_IV->masodanhmuc}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                                    <i class="fa fa-trash-o"></i></button>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/ChiTietDM', 'method'=>'post','id' => 'frm_create'])!!}
                <input type="hidden" name="masodanhmuc" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin hàng hoá</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên hàng hoá<span class="require">*</span></label>
                                <input name="noidung" id="noidung" class="form-control" required>
                            </div>
                        </div>
                    </div>                   
                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Hiện thị báo cáo</label>
                                <select name="trangthai" id="trangthai" class="form-control">
                                    <option value="TD">Đang theo dõi</option>
                                    <option value="KTD">Không theo dõi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/delete_nhomdm','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="matt" id="matt">
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
@stop