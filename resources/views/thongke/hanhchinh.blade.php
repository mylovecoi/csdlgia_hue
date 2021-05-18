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

            function changeUrl() {
                var current_path_url = '/thongke/hanhchinh?';
                var url = current_path_url + 'username=' + $('#username').val()
                        + '&thang=' + $('#thang').val()
                        + '&nam=' + $('#nam').val();
                window.location.href = url;
            }
            $('.dieukien').change(function(){
                changeUrl();
            });

//            $('#username').change(function() {
//                changeUrl();
//            });
//            $('#thang','#nam').change(function() {
//
//            });
        });

    </script>

@stop

@section('content')
    <h3 class="page-title text-uppercase">
        Thống kê hồ sơ của đơn vị hành chính
    </h3>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label>Tháng</label>
                                {!! Form::select('', getThang(false), $inputs['thang'], array('id' => 'thang', 'class' => 'form-control dieukien'))!!}
                            </div>

                            <div class="col-md-2">
                                <label>Năm</label>
                                {!! Form::select('', getNam(false), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control dieukien'))!!}
                            </div>

                            <div class="col-md-6">
                                <label>Tên tài khoản nhập liệu</label>
                                <select class="form-control select2me dieukien" id="username">
                                    @foreach($a_donvi as $ma=>$ten)
                                        <optgroup label="{{$ten}}">
                                            <?php $taikhoan = $m_taikhoan->where('madv',$ma); ?>
                                            @foreach($taikhoan as $ct)
                                                <option {{$ct->username == $inputs['username'] ? "selected":""}} value="{{$ct->username}}">{{$ct->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <table id="sample_4" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="5%">STT</th>
                                    <th rowspan="2">Nội dung CSDL địa phương</th>
                                    <th colspan="2">Hồ sơ trong tháng</th>
                                    <th colspan="2">Tổng số hồ sơ</th>
                                </tr>
                                <tr>
                                    <th width="5%">Nhập mới</th>
                                    <th width="5%">Hoàn thành</th>
                                    <th width="5%">Nhập mới</th>
                                    <th width="5%">Hoàn thành</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($setting as $k1=>$v1)
                                @if(in_array($k1, ['hoso','hoanthanh','hosothang','hoanthanhthang']))
                                    @continue
                                @endif
                                <tr style="font-weight: bold;" class="success">
                                    <td class="text-left" style="text-transform: uppercase;">{{toAlpha($i++)}}</td>
                                    <td class="{{(!isset($per[$k1]['index']) || $per[$k1]['index'] == '0') ? 'text-line-through text-danger' : ''}}">{{$a_chucnang[$k1] ?? $k1}}</td>
                                    <td class="text-center">{{dinhdangso($v1['hosothang'] ?? 0)}}</td>
                                    <td class="text-center">{{dinhdangso($v1['hoanthanhthang'] ?? 0)}}</td>
                                    <td class="text-center">{{dinhdangso($v1['hoso'] ?? 0)}}</td>
                                    <td class="text-center">{{dinhdangso($v1['hoanthanh'] ?? 0)}}</td>
                                </tr>
                                <!-- Duyệt các group chức năng: Định giá; Kê khai; Phí, lệ phí; ... -->
                                <?php $j = 1; ?>
                                @foreach($v1 as $k2=>$v2)
                                    @if(in_array($k2, ['hoso','hoanthanh','hosothang','hoanthanhthang']))
                                        @continue
                                    @endif
                                    <tr style="font-style: italic;font-weight: bold;" class="info">
                                        <td class="text-center">{{romanNumerals($j++)}}</td>
                                        <td class="{{(!isset($per[$k2]['index']) || $per[$k2]['index'] == '0') ? 'text-line-through text-danger' : ''}}">{{$a_chucnang[$k2] ?? $k2}}</td>
                                        <td class="text-center">{{dinhdangso($v2['hosothang'] ?? 0)}}</td>
                                        <td class="text-center">{{dinhdangso($v2['hoanthanhthang'] ?? 0)}}</td>
                                        <td class="text-center">{{dinhdangso($v2['hoso'] ?? 0)}}</td>
                                        <td class="text-center">{{dinhdangso($v2['hoanthanh'] ?? 0)}}</td>
                                    </tr>

                                    <?php $m = 1; ?>
                                    @foreach($v2 as $k3=>$v3)
                                        @if(in_array($k3, ['hoso','hoanthanh','hosothang','hoanthanhthang']))
                                            @continue
                                        @endif
                                        <tr>
                                            <td class="text-right">{{$m++}}</td>
                                            <td class="{{(!isset($per[$k3]['index']) || $per[$k3]['index'] == '0') ? 'text-line-through text-danger' : ''}}">{{$a_chucnang[$k3] ?? $k3}}</td>
                                            <td class="text-center">{{dinhdangso($v3['hosothang'] ?? 0)}}</td>
                                            <td class="text-center">{{dinhdangso($v3['hoanthanhthang'] ?? 0)}}</td>
                                            <td class="text-center">{{dinhdangso($v3['hoso'] ?? 0)}}</td>
                                            <td class="text-center">{{dinhdangso($v3['hoanthanh'] ?? 0)}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="col-md-12" style="text-align: center">--}}
{{--            <a href="{{url('/taikhoan/danhsach?madv='.$model->madv)}}" class="btn btn-danger">--}}
{{--                <i class="fa fa-reply"></i>&nbsp;Quay lại</a>--}}
{{--        </div>--}}
    </div>
        <!-- END EXAMPLE TABLE PORTLET-->

@stop