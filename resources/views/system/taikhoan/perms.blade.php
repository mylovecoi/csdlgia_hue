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
        Quản lý phân quyền chức năng cho<small>&nbsp;tài khoản</small>
    </h3>
    <!-- END PAGE HEADER-->
    {!! Form::open(['url' => '/taikhoan/perm'])!!}
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption" style="color: #000000">
                        Tên tài khoản: {{$model->name .' ( Tài khoản truy cập: '. $model->username. ')' }}
                        <input type="hidden" name="id" id="id" value="{{$model->id}}">
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
                            <th rowspan="2">Nội dung CSDL địa phương</th>
                            <th colspan="2">Danh mục</th>
                            <th colspan="3">Hồ sơ</th>
                            <th>Khác</th>
                            <th rowspan="2" width="7%">Thao</br>tác</th>
                        </tr>
                        <tr>
                            <th width="5%">Danh</br>sách</th>
                            <th width="5%">Thay</br>đổi</th>

                            <th width="5%">Danh</br>sách</th>
                            <th width="5%">Thay</br>đổi</th>
                            <th width="5%">Hoàn</br>thành</th>

                            <th width="5%">Tổng</br>hợp</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($setting as $k1=>$v1)
                            <tr style="font-weight: bold;" class="success">
                                <td class="text-left" style="text-transform: uppercase;">{{toAlpha($i++)}}</td>
                                <td class="text-line-through">{{$a_chucnang[$k1] ?? $k1}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <button type="button" onclick="change()" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                        <i class="fa fa-refresh"></i></button>
                                </td>
                            </tr>
                            <!-- Duyệt các group chức năng: Định giá; Kê khai; Phí, lệ phí; ... -->
                            <?php $j = 1; ?>
                            @foreach($v1 as $k2=>$v2)
                                <tr  style="font-style: italic;font-weight: bold;" class="info">
                                    <td class="text-center">{{romanNumerals($j++)}}</td>
                                    <td>{{$a_chucnang[$k2] ?? $k2}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <button type="button" onclick="change()" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                            <i class="fa fa-refresh"></i></button>
                                    </td>
                                </tr>

                                <?php $m = 1; ?>
                                @foreach($v2 as $k3=>$v3)
                                    <tr>
                                        <td class="text-right">{{$m++}}</td>
                                        <td>{{$a_chucnang[$k3] ?? $k3}}</td>
                                        <td class="text-center">
{{--                                                    {!!$v['index'] == 1 ? '<i class="fa fa-check"></i>':''!!} --}}
                                        </td>
                                        <td class="text-center">
                                        </td>
                                        <td class="text-center">
                                        </td>
                                        <td class="text-center">
                                        </td>
                                        <td class="text-center">
                                        </td>
                                        <td class="text-center">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" onclick="change()" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal">
                                                <i class="fa fa-refresh"></i></button>
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
            <a href="{{url('/taikhoan/danhsach?madv='.$model->madv)}}" class="btn btn-danger">
                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-check"></i> Cập nhật</button>
        </div>
    </div>

    {!! Form::close() !!}
        <!-- END EXAMPLE TABLE PORTLET-->
        <div class="clearfix"></div>


@stop