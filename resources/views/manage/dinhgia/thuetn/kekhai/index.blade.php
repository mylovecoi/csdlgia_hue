@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
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

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/danhsach?';
//                var url = current_path_url + 'nam=' + $('#nam').val() + '&madiaban=' + $('#madiaban_td').val();
                var url = current_path_url + 'nam=' + $('#nam').val()+ '&madv=' + $('#madv').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });

            $('#madv').change(function() {
                changeUrl();
            });
        });

        function clickfilemau(){
            $('#frm_filemau').submit();
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin hồ sơ giá thuế tài nguyên
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                    @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetn', 'hoso', 'modify'))
                        @if(count($a_dv) > 0)
                            <!-- Địa bàn có đơn vị có chức năng nhập liệu -->
                                <button type="button" class="btn btn-default btn-sm" data-target="#create-modal-confirm" data-toggle="modal">
                                    <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                            @endif

{{--                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-filemau">--}}
{{--                                <i class="fa fa-cloud-download"></i> Xuất dữ liệu</button>--}}

                            {{--                            <a href="{{url($inputs['url'].'/nhanexcel?&madiaban='. $inputs['madiaban'])}}" class="btn btn-default btn-sm">--}}
                            {{--                                <i class="fa fa-file-excel-o"></i>&nbsp;Nhận dữ liệu</a>--}}
                        @endif
                    </div>

                </div>
                <hr>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Năm báo cáo</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Đơn vị</label>
                            <select class="form-control select2me" id="madv">
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
                        {{--<div class="col-md-4">--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Địa bàn</label>--}}
                                {{--{!! Form::select('madiaban_td', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban_td', 'class' => 'form-control'))!!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">STT</th>
                                <th>Ngày báo cáo</th>
                                <th>Số quyết định</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                                <th>Cơ quan tiếp nhận</th>
                                <th style="text-align: center" width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td class="text-center">{{getDayVn($tt->thoidiem)}}</td>
                                <td class="text-center">{{$tt->soqd}}</td>
                                <td>{{$tt->cqbh}}</td>
                                @include('manage.include.form.td_trangthai')
                                <td style="text-align: left">{{$a_donvi_th[$tt->macqcq] ?? ''}}</td>
                                <td>
                                    <a href="{{url($inputs['url'].'/chitiet?mahs='.$tt->mahs)}}" class="btn btn-default btn-xs mbs" target="_blank">
                                        <i class="fa fa-eye"></i>&nbsp;Chi tiết</a>
                                    @if(chkPer('csdlmucgiahhdv','dinhgia', 'giathuetn', 'hoso', 'modify') && in_array($tt->trangthai,['CHT', 'HHT']))
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=true')}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i>&nbsp;Sửa</a>

                                        <button type="button" onclick="confirmDelete('{{$tt->mahs}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>

                                        <button type="button" onclick="confirmChuyen('{{$tt->mahs}}','{{$inputs['url'].'/chuyenhs'}}')" class="btn btn-default btn-xs mbs" data-target="#chuyen-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-check"></i> Hoàn thành</button>
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
    <div class="clearfix">
    </div>
    @include('includes.e.modal-attackfile')
    <!--Modal Create-->
    <div id="create-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">
        {!! Form::open(['url'=>$inputs['url'].'/new','id' => 'frm_create','method'=>'get'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thêm mới hồ sơ giá thuế tài nguyên</h4>
                </div>

                <div class="modal-body">
                    <div class="form-horizontal">
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<label>Địa bàn</label>--}}
                                {{--{!!Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('class' => 'form-control','disabled'=>'disabled'))!!}--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Đơn vị báo cáo</label>
                                {!!Form::select('madv', $a_dv, null, array('id' => 'madv','class' => 'form-control select2me'))!!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Phân loại nhóm hàng hóa dịch vụ</label>
                                {!!Form::select('manhom', a_merge(['ALL'=>'--Tất cả các loại tài nguyên--'],$a_nhom), null, array('id' => 'manhom','class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<label>Năm</label>--}}
                                {{--{!! Form::select('nam',getNam(),date('Y'),array('id' => 'nam', 'class' => 'form-control'))!!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
{{--                    <input type="hidden" id="madiaban" name="madiaban" value="{{$inputs['madiaban']}}">--}}
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!--Modal File mẫu-->
    <div id="modal-filemau" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">
        {!! Form::open(['url'=>$inputs['url'].'/danhmucmau','id' => 'frm_filemau','method'=>'post'])!!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Xuất danh mục hàng hóa, dịch vụ</h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lấy danh mục hàng hóa từ</label>
                                    <div class="radio-list">
                                        <label>
                                            <span><input type="radio" name="phanloai" value="DM"></span>Danh mục hàng hóa
                                        </label>
                                        <label>
                                            <span><input type="radio" name="phanloai" value="HS" checked=""></span>Hồ sơ đã hoàn thành gần nhất
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Thông tư quyết định</label>
                                {!!Form::select('matt', $a_nhom, null, array('id' => 'matt','class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>
                    {{--<input type="hidden" id="madiaban" name="madiaban" value="{{$inputs['madiaban']}}">--}}
                </div>


                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickfilemau()">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    @include('manage.include.form.modal_del_hs')
    @include('manage.include.form.modal_approve_hs')
@stop