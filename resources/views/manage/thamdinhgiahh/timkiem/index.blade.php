@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css')}}"/-->
    <!-- BEGIN THEME STYLES -->
    <!--link href="{{url('assets/global/css/components.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="{{url('assets/admin/layout/css/themes/darkblue.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/-->
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!--script type="text/javascript" src="{{url('assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js')}}"></script-->
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
        $(function(){
            $('#nam').change(function() {
                var nam = '&nam=' + $('#nam').val();
                var url = 'timkiemthamdinhgiahanghoa?' + nam ;
                window.location.href = url;
            });
            $('#manhom').change(function() {
                var manhom = '&manhom=' + $('#manhom').val();
                var nam = '&nam=' + $('#nam').val();
                var url = 'timkiemthamdinhgiahanghoa?' + nam + manhom;
                window.location.href = url;
            });
            $('#tenhh').change(function() {
                var tenhh = '&tenhh=' + $('#tenhh').val();
                var nam = '&nam=' + $('#nam').val();
                var manhom = '&manhom=' + $('#manhom').val();
                var url = 'timkiemthamdinhgiahanghoa?' + nam + tenhh + manhom;
                window.location.href = url;
            });

        });
    </script>
    <script>
        function ShowItem(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/timkiemthamdinhgiahh/xemtttk',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        $('#tttsedit').replaceWith(data.message);
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin tài sản!", "Lỗi!");
                }
            })
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Tìm kiếm thông tin <small>&nbsp;thẩm định giá tài sản NN</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box wi">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Năm</label>
                            <select name="nam" id="nam" class="form-control">
                                @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                @for($i = $nam_start; $i <= $nam_stop; $i++)
                                    <option value="{{$i}}" {{$i == $inputs['nam']? 'selected' : ''}}>Năm {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label>Nhóm hàng hóa thẩm định</label>
                            <div class="form-group">
                                <select name="manhom" id="manhom" class="form-control">
                                    <option value="">--Chọn nhóm hàng hóa--</option>
                                    @foreach($modelnhom as $nhom)
                                        <option value="{{$nhom->manhom}}" {{$nhom->manhom == $inputs['manhom'] ? 'selected' : ''}}>{{$nhom->tennhom}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Tên hàng hóa</label>
                            <div class="form-group">
                                {!! Form::text('tenhh',$inputs['tenhh'], array('id'=>'tenhh','class'=>'form-control'))!!}
                            </div>
                        </div>

                    </div>
                    <div class="table-toolbar">
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <!--th class="table-checkbox">
                                <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
                            </th-->
                            <th width="2%" style="text-align: center">STT</th>
                            <th style="text-align: center" >Thời gian<br> thẩm định</th>
                            <th style="text-align: center">Thời hạn<br> thẩm định</th>
                            <th style="text-align: center">Tên nhóm hàng hóa</th>
                            <th style="text-align: center">Nhóm loại hàng hóa</th>
                            <th style="text-align: center">Loại hàng hóa-<br>Quy cách</th>
                            <th style="text-align: center">Số lương-<br>Đơn vị tính</th>
                            <th style="text-align: center">Đơn giá<br>đề nghị</th>
                            <th style="text-align: center">Giá trị<br>đề nghị</th>
                            <th style="text-align: center">Đơn giá<br> thẩm định</th>
                            <th style="text-align: center">Giá trị<br> thẩm định</th>
                            <th style="text-align: center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td>{{getDayVn($tt->thoidiem)}}</td>
                                <td>{{getDayVn($tt->thoihan)}}</td>
                                <td style="font-weight: bold;">{{$tt->tennhom}}</td>
                                <td style="font-weight: bold;">{{$tt->nhomhh}}</td>
                                <td class="success">{{$tt->tenhh}}-{{$tt->qccl}}</td>
                                <td style="text-align: center; font-weight: bold;">{{$tt->sl}}-{{$tt->dvt}}</td>
                                <td style="text-align: right; font-weight: bold;" class="active">{{number_format($tt->nguyengiadenghi)}}</td>
                                <td style="text-align: right; font-weight: bold;" class="active">{{number_format($tt->giadenghi)}}</td>
                                <td style="text-align: right; font-weight: bold;" class="active">{{number_format($tt->nguyengiathamdinh)}}</td>
                                <td style="text-align: right; font-weight: bold;" class="active">{{number_format($tt->giatritstd)}}</td>
                                <td>
                                    <button type="button" data-target="#modal-show" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="ShowItem({{$tt->id}})"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</button>
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
    <div class="clearfix">
    </div>
    <!--Modal Edit-->
    <div class="modal fade bs-modal-lg" id="modal-show" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin chi tiết tài sản thẩm định giá</h4>
                </div>
                <div class="modal-body" id="tttsedit">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop