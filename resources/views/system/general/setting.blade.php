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
    </script>

@stop

@section('content')

    <h3 class="page-title">
        Cấu hình chức năng của chương trình
    </h3>
    <hr>
    <!-- END PAGE HEADER-->
    {!! Form::open(['url' => '/setting'])!!}
    <div class="row">
        <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="7%" rowspan="2">STT</th>
                                <th rowspan="2">Nội dung CSDL địa phương</th>
                                <th colspan="2">Chức năng</th>
                                <th rowspan="2" width="15%">Thao</br>tác</th>
                            </tr>
                            <tr>
                               <th width="7%">Quản lý</th>
                               <th width="7%">Công bố</th>
                            </tr>
                            </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($setting as $k_csdl=>$v_csdl)
                                <tr style="font-weight: bold;" class="success">
                                    <td class="text-left" style="text-transform: uppercase;">{{toAlpha($i++)}}</td>
                                    <td>{{$a_chucnang[$k_csdl] ?? $k_csdl}}</td>
                                    <td class="text-center">
                                        @if($v_csdl['index'] == '1')
                                            <i class="fa fa-check"></i>
                                        @endif

                                    </td>
                                    <td class="text-center">{!! $v_csdl['congbo'] == 1 ? '<i class="fa fa-check"></i>':'' !!} </td>
                                    <td class="text-center">
                                        <button type="button" onclick="change('[{{$k_csdl}}]', '{{$v_csdl['index']}}', '{{$v_csdl['congbo']}}', '{{isset($a_chucnang[$k_csdl]) ? $a_chucnang[$k_csdl] : $k_csdl}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                            <i class="fa fa-gear"></i></button>
                                    </td>
                                </tr>
                                <!-- Duyệt các group chức năng: Định giá; Kê khai; Phí, lệ phí; ... -->
                                <?php $j = 1; ?>
                                @foreach($v_csdl as $k_gr=>$v_gr)
                                    @if(is_array($v_gr))
                                        <tr  style="font-style: italic;font-weight: bold;" class="info">
                                            <td class="text-center">{{romanNumerals($j++)}}</td>
                                            <td>{{isset($a_chucnang[$k_gr]) ? $a_chucnang[$k_gr] : $k_gr}}</td>
                                            <td class="text-center">{!!$v_gr['index'] == 1 ? '<i class="fa fa-check"></i>':''!!} </td>
                                            <td class="text-center">{!!$v_gr['congbo'] == 1 ? '<i class="fa fa-check"></i>':''!!} </td>
                                            <td class="text-center">
                                                <button type="button" onclick="change('{{'['.$k_csdl.']['.$k_gr.']'}}', '{{$v_gr['index']}}', '{{$v_gr['congbo']}}', '{{isset($a_chucnang[$k_gr]) ? $a_chucnang[$k_gr] : $k_csdl}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                                    <i class="fa fa-gear"></i></button>
                                                @if($v_gr['index'] == 1)
                                                    <button type="button" onclick="change_nhom('{{$k_csdl.';'.$k_gr}}', '{{isset($a_chucnang[$k_gr]) ? $a_chucnang[$k_gr] : $k_csdl}}')" class="btn btn-default btn-xs mbs" data-target="#edit-nhom-modal" data-toggle="modal">
                                                        <i class="fa fa-gears"></i></button>
                                                @endif
                                            </td>
                                        </tr>

                                        <?php $m = 1; ?>
                                        @foreach($v_gr as $k=>$v)
                                            @if(is_array($v))
                                                <tr>
                                                    <td class="text-right">{{$m++}}</td>
                                                    <td>{{isset($a_chucnang[$k]) ? $a_chucnang[$k] : $k}}</td>
                                                    <td class="text-center">{!!$v['index'] == 1 ? '<i class="fa fa-check"></i>':''!!} </td>
                                                    <td class="text-center">{!!$v['congbo'] == 1 ? '<i class="fa fa-check"></i>':''!!} </td>
                                                    <td class="text-center">
                                                        <button type="button" onclick="change('{{'['.$k_csdl.']['.$k_gr.']['.$k.']'}}', '{{$v['index']}}', '{{$v['congbo']}}', '{{isset($a_chucnang[$k]) ? $a_chucnang[$k_csdl] : $k}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                                            <i class="fa fa-gear"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <a href="{{url('general')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    {!! Form::close() !!}

    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/setting','id' => 'frm_delete','method'=>'POST'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 id="chucnang" class="modal-title">Chức năng:</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-4">
                            <label class="control-label">Quản lý</label>
                            {!!Form::select('index',array('0'=>'Vô hiệu', '1'=>'Sử dụng'), null, array('id' => 'index','class' => 'form-control'))!!}
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Công bố</label>
                            {!!Form::select('congbo',array('0'=>'Vô hiệu', '1'=>'Sử dụng'), null, array('id' => 'congbo','class' => 'form-control'))!!}
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

    <div class="modal fade" id="edit-nhom-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'/setting_gr','id' => 'frm_modify_gr','method'=>'POST'])!!}
                <input type="hidden" name="roles" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 id="chucnang_nhom" class="modal-title">Chức năng nhóm:</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-4">
                            <div class="md-checkbox">
                                <input type="checkbox" id="gr_index" name="gr_index" class="md-check">
                                <label for="gr_index">
                                    <span></span><span class="check"></span><span class="box"></span>Quản lý</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="md-checkbox">
                                <input type="checkbox" id="gr_congbo" name="gr_congbo" class="md-check">
                                <label for="gr_congbo">
                                    <span></span><span class="check"></span><span class="box"></span>Công bố</label>
                            </div>
                        </div>
                    </div>

                    <p style="color: #0000FF; text-align: center;">
                        Thiết đặt này sẽ áp dụng lên toàn bộ nhóm chức năng.
                    </p>
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

    <script>
        function change_nhom(roles, chucnang){
            frm = $('#frm_modify_gr');
            frm.find("[name='roles']").val(roles);
            document.getElementById("chucnang_nhom").innerHTML ='Chức năng nhóm: ' + chucnang;
        }

        function change(roles, index, congbo, chucnang){
            $('#index').val(index).trigger('change');
            $('#index').attr('name','roles' + roles+'[index]');
            $('#congbo').val(congbo).trigger('change');
            $('#congbo').attr('name','roles' + roles+'[congbo]');
            document.getElementById("chucnang").innerHTML ='Chức năng: ' + chucnang;
        }
    </script>
@stop