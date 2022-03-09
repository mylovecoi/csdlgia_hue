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
            document.getElementById("chucnang").innerHTML ='Chức năng: ' + chucnang;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#maso').val(maso);
            $.ajax({
                url: '/taikhoan/get_perm',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    username: $('#username').val(),
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

    <h3 class="page-title text-uppercase">
        Thiết lập hồ sơ chức năng kết nối API
    </h3>
    <!-- END PAGE HEADER-->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
{{--                <div class="portlet-title">--}}
{{--                    <div class="caption">--}}

{{--                    </div>--}}
{{--                    <div class="actions">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <hr>
                <div class="portlet-body">
                    <table id="sample_4" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th>Nội dung CSDL địa phương</th>
                            <th width="10%">Thiết lập</th>
                            <th width="10%">Link API</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($setting as $k1=>$v1)
                            <tr style="font-weight: bold;" class="success">
                                <td class="text-left" style="text-transform: uppercase;">{{toAlpha($i++)}}</td>
                                <td>{{$a_chucnang[$k1] ?? $k1}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <!-- Duyệt các group chức năng: Định giá; Kê khai; Phí, lệ phí; ... -->
                            <?php $j = 1; ?>
                            @foreach($v1 as $k2=>$v2)
                                <tr  style="font-style: italic;font-weight: bold;" class="info">
                                    <td class="text-center">{{romanNumerals($j++)}}</td>
                                    <td>{{$a_chucnang[$k2] ?? $k2}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <?php $m = 1; ?>
                                @foreach($v2 as $k3=>$v3)
                                    <tr>
                                        <td class="text-right">{{$m++}}</td>
                                        @if(!isset($v3['API']) || $v3['API'] == '0')
                                            <td class="text-line-through">{{$a_chucnang[$k3] ?? $k3}}</td>
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td>{{$a_chucnang[$k3] ?? $k3}}</td>
                                            <td class="text-center">
                                                <a href="{{$inputs['url'].'/HoSo?maso='.$k3}}" class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-gear"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{$inputs['url'].'/DanhSachKetNoi?maso='.$k3}}" class="btn btn-default btn-xs mbs">
                                                    <i class="fa fa-gear"></i></a>
                                            </td>
                                        @endif
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

@stop