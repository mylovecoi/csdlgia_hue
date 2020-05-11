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
        function change(chucnang,maso){
            $('#dm').hide();
            $('#hs').hide();
            $('#khac').hide();
            document.getElementById("chucnang").innerHTML ='Chức năng: ' + chucnang;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#maso').val(maso);
            $.ajax({
                url: '{{$inputs['url']}}' + '/get_perm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maso_pq: $('#maso_pq').val(),
                    maso: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success'){
                        $('#chitiet').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            // Metronic.init(); // init metronic core componets
                            // Layout.init(); // init layout
                            // QuickSidebar.init(); // init quick sidebar
                            //Demo.init(); // init demo features
                        });
                    }
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
    </script>

@stop

@section('content')

    <h3 class="page-title">
        Quản lý phân quyền chức năng
    </h3>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption" style="color: #000000">
                        Nhóm tài khoản: {{$model->mota}}
                    </div>
                    <div class="actions">
                    </div>
                </div>
                <hr>
                <div class="portlet-body">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="7%" rowspan="2">STT</th>
                            <th rowspan="2">Nội dung</th>
                            <th colspan="2">Danh mục</th>
                            <th colspan="3">Hồ sơ</th>
                            <th colspan="2">Khác</th>
                            <th rowspan="2" width="7%">Thao</br>tác</th>
                        </tr>
                        <tr>
                            <th width="5%">Danh</br>sách</th>
                            <th width="5%">Thay</br>đổi</th>

                            <th width="5%">Danh</br>sách</th>
                            <th width="5%">Thay</br>đổi</th>
                            <th width="5%">Hoàn</br>thành</th>

                            <th width="5%">Tổng</br>hợp</th>
                            <th width="5%">Thông</br>tin</br>DN</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($setting as $k1=>$v1)
                            <tr style="font-weight: bold;" class="success">
                                <td class="text-left" style="text-transform: uppercase;">{{toAlpha($i++)}}</td>
                                <td class="{{(!isset($per[$k1]['index']) || $per[$k1]['index'] == '0') ? 'text-line-through' : ''}}">{{$a_chucnang[$k1] ?? $k1}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <button type="button" onclick="change('{{$a_chucnang[$k1] ?? $k1}}','{{$k1}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                        <i class="fa fa-refresh"></i></button>
                                </td>
                            </tr>
                            <!-- Duyệt các group chức năng: Định giá; Kê khai; Phí, lệ phí; ... -->
                            <?php $j = 1; ?>
                            @foreach($v1 as $k2=>$v2)
                                <tr  style="font-style: italic;font-weight: bold;" class="info">
                                    <td class="text-center">{{romanNumerals($j++)}}</td>
                                    <td class="{{(!isset($per[$k2]['index']) || $per[$k2]['index'] == '0') ? 'text-line-through' : ''}}">{{$a_chucnang[$k2] ?? $k2}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        @if(isset($per[$k1]['index']) && $per[$k1]['index'] == '1')
                                            <button type="button" onclick="change('{{$a_chucnang[$k2] ?? $k2}}','{{$k2}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                                <i class="fa fa-refresh"></i></button>
                                        @endif
                                    </td>
                                </tr>

                                <?php $m = 1; ?>
                                @foreach($v2 as $k3=>$v3)
                                    <tr>
                                        <td class="text-right">{{$m++}}</td>
                                        <td class="{{(!isset($per[$k3]['index']) || $per[$k3]['index'] == '0') ? 'text-line-through' : ''}}">{{$a_chucnang[$k3] ?? $k3}}</td>
                                        <td class="text-center">
                                            @if(isset($per[$k3]['danhmuc']['index']))
                                                {!!  $per[$k3]['danhmuc']['index'] == 1 ? '<i class="fa fa-check"></i>':'' !!}
                                            @else
                                                 <i class="fa fa-ban"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($per[$k3]['danhmuc']['modify']))
                                                {!!  $per[$k3]['danhmuc']['modify'] == 1 ? '<i class="fa fa-check"></i>':'' !!}
                                            @else
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($per[$k3]['hoso']['index']))
                                                {!!  $per[$k3]['hoso']['index'] == 1 ? '<i class="fa fa-check"></i>':'' !!}
                                            @else
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($per[$k3]['hoso']['modify']))
                                                {!!  $per[$k3]['hoso']['modify'] == 1 ? '<i class="fa fa-check"></i>':'' !!}
                                            @else
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($per[$k3]['hoso']['approve']))
                                                {!!  $per[$k3]['hoso']['approve'] == 1 ? '<i class="fa fa-check"></i>':'' !!}
                                            @else
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($per[$k3]['khac']['baocao']))
                                                {!!  $per[$k3]['khac']['baocao'] == 1 ? '<i class="fa fa-check"></i>':'' !!}
                                            @else
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($per[$k3]['khac']['company']))
                                                {!!  $per[$k3]['khac']['company'] == 1 ? '<i class="fa fa-check"></i>':'' !!}
                                            @else
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($per[$k1]['index']) && isset($per[$k2]['index']) && $per[$k1]['index'] == '1'&& $per[$k2]['index'] == '1')
                                                <button type="button" onclick="change('{{$a_chucnang[$k3] ?? $k3}}','{{$k3}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                                    <i class="fa fa-refresh"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="text-align: center">
            <a href="{{url($inputs['url'].'/danhsach')}}" class="btn btn-danger">
                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
        </div>
    </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/perm','id' => 'frm_delete','method'=>'POST'])!!}
                <input type="hidden" name="maso" id="maso" />
                <input type="hidden" name="maso_pq" id="maso_pq" value="{{$model->maso}}" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 id="chucnang" class="modal-title">Chức năng:</h4>
                </div>

                <div class="modal-body" id="chitiet">
                    <div class="row" >
                        <div class="col-md-offset-4 col-md-8">
                            <div class="md-checkbox">
                                <input type="checkbox" id="index" name="index" class="md-check">
                                <label for="index">
                                    <span></span><span class="check"></span><span class="box"></span>Phân quyền chức năng</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="dm">
                        <h4>Danh mục</h4>
                        <div class="row">
                            <div class="col-md-offset-1 col-md-3">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="dm_index" name="dm_index" class="md-check">
                                    <label for="dm_index">
                                        <span></span><span class="check"></span><span class="box"></span>Danh sách</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="dm_modify" name="dm_modify" class="md-check">
                                    <label for="dm_modify">
                                        <span></span><span class="check"></span><span class="box"></span>Thay đổi</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs">
                        <h4>Hồ sơ</h4>
                        <div class="row">
                            <div class="col-md-offset-1 col-md-3">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="hs_index" name="hs_index" class="md-check">
                                    <label for="hs_index">
                                        <span></span><span class="check"></span><span class="box"></span>Danh sách</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="hs_modify" name="hs_modify" class="md-check">
                                    <label for="hs_modify">
                                        <span></span><span class="check"></span><span class="box"></span>Thay đổi</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="hs_approve" name="hs_approve" class="md-check">
                                    <label for="hs_approve">
                                        <span></span><span class="check"></span><span class="box"></span>Hoàn thành</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="khac">
                        <h4>Chức năng khác</h4>
                        <div class="row" >
                            <div class="col-md-offset-1 col-md-3">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="khac_tonghop" name="khac_tonghop" class="md-check">
                                    <label for="khac_tonghop">
                                        <span></span><span class="check"></span><span class="box"></span>Tổng hợp</label>
                                </div>
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
@stop