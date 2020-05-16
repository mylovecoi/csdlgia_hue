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
            $('#madv').change(function () {
                window.location.href = '/thongtincskd?madv=' + $('#madv').val();
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
        <b style="color: #ff0000">Ghi chú:</b> Màn hình hiển thị thông tin cơ sở kinh doanh mà doanh nghiệp đang quản lý. Cơ sở kinh doanh là duy nhất khi doanh nghiệp bắt đầu nhập chương trình cần cập
        nhật cơ sở kinh doanh mình đang quản lý. Có thể sửa thông tin của cơ sở kinh doanh nhưng ko thể xoá cơ sở kinh doanh.
    </marquee>
    <h3 class="page-title">
        Danh sách cơ sở kinh doanh <small>dịch vụ lưu trú</small>
        <p><h5 style="color: blue">{{$modeldn->tendn}}&nbsp;- Mã số thuế: {{$modeldn->madv}}</h5></p>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{url('thongtincskd/create?madv='.$inputs['madv'])}}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Thêm mới </a>
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
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
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center" width="10%">Ảnh đại diện</th>
                            <th style="text-align: center">Tên cơ sở kinh doanh</th>
                            <th style="text-align: center" width="10%">Loại hạng</th>
                            <th style="text-align: center" width="20%">Địa chỉ</th>
                            <th style="text-align: center" width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td align="center">{{$key+1}}</td>
                                <td align="center" style="vertical-align: middle">
                                    <img src="{{ url('images/avatar/'.$tt->avatar)}}" width="96">
                                </td>
                                <td><a href="{{$tt->link}}" target="_blank">{{$tt->tencskd}}</a></td>
                                <td align="center">{{$tt->loaihang}}</td>
                                <td>{{$tt->diachikd}}</td>
                                <td>
                                    <a href="{{url('thongtincskd/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs">
                                        <i class="fa fa-edit"></i>&nbsp;Sửa</a>
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
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'district/delete','id' => 'frm_delete'])!!}
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