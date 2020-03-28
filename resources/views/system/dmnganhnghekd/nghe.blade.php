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
//            $("#edit_mahuyen").select2();
        });
        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
        function ClickUpdate(){
            $("#frm_update").submit();
        }
        function ClickEdit(manghe){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}'+'/chitiet/edit',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    manghe: manghe
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#manghe').val(data.manghe);
                    $('#tennghe').val(data.tennghe);
                    $('#theodoi').val(data.theodoi);
                    $('#id').val(data.id);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
        function new_hs() {
            var form = $('#frm_create');
            //Nhà xã hội cho thuê
            form.find("[name='manghe']").val('NEW');
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục nghề kinh doanh
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','hethong', 'danhmucnganhkd', 'modify'))
                            <button type="button" onclick="new_hs()" class="btn btn-default btn-xs mbs" data-target="#modal-edit" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                        <a href="{{url('/dmnganhnghe/danhsach')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-reply"></i> Quay lại </a>
                    </div>
                </div>
                <hr>

                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label style="font-weight: bold">Tên ngành</label>
                                {!!Form::select('nganh', $a_nganh, null, array('id' => 'nganh','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
{{--                            <th style="text-align: center">Tên ngành</th>--}}
                            <th style="text-align: center">Mã nghề</th>
                            <th style="text-align: center">Tên nghề</th>
{{--                            <th style="text-align: center">Cơ quan chủ quản</th>--}}
                            <th style="text-align: center">Theo dõi</th>
                            <th style="text-align: center" width="20%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$key + 1}}</td>
{{--                                <td>{{$a_nganh[$tt->manganh]}}</td>--}}
                                <td>{{$tt->manghe}}</td>
                                <td>{{$tt->tennghe}}</td>
{{--                                <td>{{$tt->tendv}}</td>--}}
                                <td style="text-align: center">
                                    @if($tt->theodoi == 'KTD')
                                        <span class="badge badge-active">Không theo dõi</span>
                                    @else
                                        <span class="badge badge-success">Theo dõi</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" onclick="ClickEdit('{{$tt->manghe}}')" class="btn btn-default btn-xs mbs" data-target="#modal-edit" data-toggle="modal">
                                        <i class="fa fa-edit"></i>&nbsp;Sửa</button>
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

    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin ngành nghề</h4>
                </div>
                {!! Form::open(['url'=>$inputs['url'].'/chitiet/store','id' => 'frm_create'])!!}
                <div class="modal-body" id="edit-tt">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mã ngành</label>
                                {!!Form::select('manganh', $a_nganh, null, array('id' => 'manganh','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Mã nghề<span class="require">*</span></label>
                                <input type="text" name="manghe" id="manghe" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên nghề<span class="require">*</span></label>
                                <input type="text" name="tennghe" id="tennghe" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Theo dõi<span class="require">*</span></label>
                                <select  name="theodoi" id="theodoi" class="form-control">
                                    <option value="KTD" >Dừng theo dõi</option>
                                    <option value="TD" >Theo dõi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickUpdate()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('includes.script.create-header-scripts')
@stop