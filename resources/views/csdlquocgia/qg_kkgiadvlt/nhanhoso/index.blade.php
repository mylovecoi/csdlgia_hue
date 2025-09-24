@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();

            $('#namhs').change(function() {
                changeUrl();
            });

            $('#madv').change(function() {
                changeUrl();
            });

            $('#macskd').change(function() {
                changeUrl();
            });

            $('#trangthai').change(function() {
                changeUrl();
            });
        });
        function changeUrl() {
            var nam = $('#namhs').val();
            var url = '{{$inputs['url']}}' + $('#madv').val() + '&nam=' + nam + '&macskd=' + $('#macskd').val() + '&trangthai=' + $('#trangthai').val();
            window.location.href = url;
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Nhận hồ sơ Giá dịch vụ lưu trú
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        @if (count($m_donvi) > 0)
                            <button type="button" class="btn btn-default btn-sm" data-target="#create-modal-confirm"
                                data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Nhận dữ liệu
                            </button>
                        @endif
                    </div>

                </div>
                <hr>
                <div class="portlet-body form-horizontal">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label style="font-weight: bold">Năm hồ sơ</label>
                                <select name="namhs" id="namhs" class="form-control">
                                    @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                    @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                    @for($i = $nam_start; $i <= $nam_stop; $i++)
                                        <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                    @endfor
                                </select>
                            </div>

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

                            <div class="form-group">
                                <div class="col-md-4">
                                    <label style="font-weight: bold">Cơ sở kinh doanh</label>
                                    {!! Form::select('macskd',$a_cskd, $inputs['macskd'], array('id' => 'macskd','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label style="font-weight: bold">Trạng thái</label>
                                {!! Form::select('trangthai', getTenTrangThaiHoSoDN(true), $inputs['trangthai'], [
                                    'id' => 'trangthai',
                                    'class' => 'form-control select2me',
                                ]) !!}
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">STT</th>
                                <th style="text-align: center">Ngày kê khai</th>
                                <th style="text-align: center">Ngày thực hiện<br>mức giá kê khai</th>
                                <th style="text-align: center">Số công văn</th>
                                <th style="text-align: center">Số công văn<br> liền kề</th>
                                <th style="text-align: center">Cơ quan tiếp nhận</th>
                                <th style="text-align: center" width="15%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tt)
                                <tr>
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                    <td style="text-align: center" class="active">{{$tt->socv}}</td>
                                    <td style="text-align: center">{{$tt->socvlk}}</td>
                                    <td style="text-align: left">{{$a_donvi_th[$tt->macqcq]?? ''}}</td>
                                    <td>
                                        <button type="button"
                                            onclick="confirmChuyen('{{ $tt->mahs }}','{{ '/csdlquocgia/qg_kkgiadvlt/chuyenhs' }}')"
                                            class="btn btn-default btn-xs mbs" data-target="#chuyen-modal-confirm"
                                            data-toggle="modal">
                                            <i class="fa fa-check"></i> Nhận vào phần mềm</button>
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

    <!--Modal Create-->
    <div id="create-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade bs-modal-lg">
        {!! Form::open(['url' => '/kkgiadvlt/new', 'id' => 'frm_create', 'method' => 'get']) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Nhận hồ sơ từ CSDL Quốc gia</h4>
                </div>

                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Loại giá</label>
                                {!! Form::select('matt', ['1'=>'Giá đăng ký giá', '2'=>'Giá kê khai giá', '3'=>'Giá thị trường hàng hoá, dịch vụ','4'>'Giá thuế tài nguyên'], null, ['id' => 'matt', 'class' => 'form-control select2me']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Từ ngày<span class="require">*</span></label>
                                {!! Form::input('date', 'thoidiem', null, ['id' => 'thoidiem', 'class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Đến ngày<span class="require">*</span></label>
                                {!! Form::input('date', 'thoidiem', null, ['id' => 'thoidiem', 'class' => 'form-control', 'required']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Link API kết nối <span class="require">*</span></label>
                                {!! Form::text('linkTruyenPost', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <input type="hidden" name="madv" id="madv" value="{{ $inputs['madv'] }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    @include('manage.include.form.modal_approve_hs')
@stop
