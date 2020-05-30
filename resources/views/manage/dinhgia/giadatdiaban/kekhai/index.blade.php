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
                var url = current_path_url + 'nam=' + $('#nam').val() + '&madiaban=' + $('#madiaban').val();
                window.location.href = url;
            }

            $('#nam').change(function() {
                changeUrl();
            });
            $('#madiaban').change(function () {
                changeUrl();
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin hồ sơ giá đất theo công bố
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'modify'))
                            <button type="button" onclick="new_hs('{{$inputs['madv']}}')" class="btn btn-default btn-xs mbs" data-target="#modal-modify" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                            {{--                            <a href="{{url($inputs['url'].'/nhandulieutuexcel?madv='.$inputs['madv'])}}" class="btn btn-default btn-sm">--}}
                            {{--                                <i class="fa fa-file-excel-o"></i> Nhận dữ liệu</a>--}}
                        @endif

                        <a href="{{url($inputs['url'].'/prints?&nam='.$inputs['nam'].'&madv='.$inputs['madv'])}}" class="btn btn-default btn-sm" target="_blank">
                            <i class="fa fa-print"></i> In</a>
                    </div>
                </div>

                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>

                            <div class="col-md-4">
                                <label style="font-weight: bold">Địa bàn</label>
                                {!!Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban','class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                        <tr>
                            <th width="2%" style="text-align: center">STT</th>
                            <th style="text-align: center">Thời điểm</th>
                            <th style="text-align: center">Thông tư, quyết định</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Cơ quan tiếp nhận</th>
                            <th style="text-align: center" width="20%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                <td class="success">{{$a_dm[$tt->soqd] ?? ''}}</td>
                                @include('manage.include.form.td_trangthai')
                                <td style="text-align: left">{{$a_donvi_th[$tt->macqcq]?? ''}}</td>
                                <td>
                                    @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'modify') && in_array($tt->trangthai,['CHT', 'HHT']))
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=true')}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i>&nbsp;Sửa</a>
                                        <button type="button" onclick="confirmDelete('{{$tt->mahs}}','{{$inputs['url'].'/delete'}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    @else
                                        <a href="{{url($inputs['url'].'/modify?mahs='.$tt->mahs.'&act=false')}}" class="btn btn-default btn-xs mbs">
                                            <i class="fa fa-edit"></i>&nbsp;Chi tiết</a>
                                    @endif

                                    @if(chkPer('csdlmucgiahhdv','dinhgia', 'giacldat', 'hoso', 'approve')&& in_array($tt->trangthai,['CHT', 'HHT']))
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

    <!--Modal edit-->
    <div id="modal-modify" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>$inputs['url'].'/new', 'id' => 'frm_modify', 'class'=>'horizontal-form']) !!}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin giá đất theo địa bàn</h4>
                </div>
                <div class="modal-body" id="edit_node">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Đơn vị nhập liệu</label>
                                <select class="form-control select2me" name="madv">
                                    @foreach($a_diaban as $key=>$val)
                                        <optgroup label="{{$val}}">
                                            <?php $donvi = $m_donvi->where('madiaban',$key); ?>
                                            @foreach($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Địa bàn</label>
                                {!!Form::select('madiaban', [$inputs['madiaban']=> $a_diaban[$inputs['madiaban']] ?? ''], null, array('class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Số quyết định</label>
                                {!! Form::select('soqd', $a_dm, null, array('class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" onclick="ClickUpdate()">Đồng ý</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>



    <script>
        function ClickUpdate(){
            $('#frm_modify').submit();
        }
    </script>

    @include('manage.include.form.modal_approve_hs')
    @include('manage.include.form.modal_del_hs')
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop