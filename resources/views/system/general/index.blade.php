@extends('main')

@section('custom-style')

@stop


@section('custom-script')

@stop

@section('content')


    <h3 class="page-title">
        Thông tin <small>cấu hình hệ thống</small>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        {{-- Làm chức năng cho hồ sơ thầu --}}
                        {{-- <button type="button" class="btn btn-default btn-xs mbs" data-target="#modal-thietlap"
                            data-toggle="modal">
                            <i class="fa fa-copy"></i></button> --}}

                        @if (session('admin')->level == 'SSA')
                            <a href="{{ url('setting') }}" class="btn btn-default btn-sm">
                                <i class="icon-settings"></i> Setting</a>
                        @endif

                        @if (chkPer('hethong', 'hethong_pq', 'thongtin', 'danhmuc', 'modify')))
                            @if ($model->count() > 0)
                                <a href="{{ url('general/' . $model->id . '/edit') }}" class="btn btn-default btn-sm">
                                    <i class="fa fa-edit"></i> Chỉnh sửa </a>
                            @else
                                <a href="{{ url('general/create') }}" class="btn btn-default btn-sm">
                                    <i class="fa fa-plus"></i> Thêm mới</a>
                            @endif

                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td style="width:15%">
                                    <b>Bản quyền thuộc về</b>
                                </td>
                                <td style="width:35%">
                                    <span class="text-muted"><b style="color: blue">CÔNG TY TRÁCH NHIỆM HỮU HẠN PHÁT TRIỂN
                                            PHẦN MỀM CUỘC SỐNG</b>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Số đăng ký kinh doanh</b>
                                </td>
                                <td style="width:35%">
                                    <span class="text-muted" style="color: #0000ff">Số: 0106070279 - Cấp ngày 27/12/2012
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Số đăng ký bản quyền</b>
                                </td>
                                <td style="width:35%">
                                    <span class="text-muted" style="color: #0000ff">Số: 164/2016/QTG - Cấp ngày 22/04/2016
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Cấp cho đơn vị</b>
                                </td>
                                <td style="width:35%">
                                    <span class="text-muted"
                                        style="color: #0000ff">{{ isset($model) ? $model->tendonvi : '' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Địa chỉ</b>
                                </td>
                                <td style="width:35%">
                                    <span class="text-muted"
                                        style="color: #0000ff">{{ isset($model) ? $model->diachi : '' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Thông tin liên hệ</b>
                                </td>
                                <td style="width:35%">
                                    <span class="text-muted" style="color: #0000ff">{{ isset($model) ? $model->tel : '' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Thông tin hợp đồng</b>
                                </td>
                                <td style="width:35%">
                                    <span class="text-muted">
                                        <p style="color: #0000ff">{{ isset($model) ? $model->thongtinhd : '' }}</p>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Làm chức năng cho hồ sơ thầu --}}
    <div class="modal fade" id="modal-thietlap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url' => 'dmloaidat/delete', 'id' => 'frm_delete']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thiết lập truyền số liệu lên CSDL giá Quốc gia</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Link API xác thực : </label>
                                {!! Form::text('linkAPIXacthuc', null, ['id' => 'linkAPIXacthuc', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tài khoản đăng nhập : </label>
                                {!! Form::text('taikhoanketnoi', null, ['id' => 'taikhoanketnoi', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="control-label">Mật khẩu : </label>
                                <input id="matkhauketnoi" value="{{ $model->matkhauketnoi }}" class="form-control"
                                    name="matkhauketnoi" type="password" />
                                <span class="input-group-btn">
                                    <button style="margin-top: 25px" onclick="AnHienMatKhau('matkhauketnoi')"
                                        class="btn blue" type="button"><i class="fa fa-eye"></i></button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Mật khẩu : </label>
                                {!! Form::text('matkhauketnoi', null, ['id' => 'matkhauketnoi', 'class' => 'form-control']) !!}
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tự động truyền dữ liệu </label>
                                {!! Form::select(
                                    'linkAPIXacthuc',
                                    [
                                        '1' => 'Truyền số liệu thủ công',
                                        '2' => 'Tự động truyền số liệu theo tháng',
                                        '3' => 'Tự động truyền số liệu theo quý',
                                        '4' => 'Tự động truyền số liệu khi công bố',
                                    ],
                                    null,
                                    ['id' => 'linkAPIXacthuc', 'class' => 'form-control'],
                                ) !!}
                            </div>
                        </div>
                    </div>
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
@stop
