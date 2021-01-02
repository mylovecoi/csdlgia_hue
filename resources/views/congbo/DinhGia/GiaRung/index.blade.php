@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop

@section('custom-script-cb')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();

            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/?';
                var url = current_path_url + 'nam=' + $('#nam').val();
                window.location.href = url;
            }
            $('#nam').change(function() {
                changeUrl();
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <h3 class="page-title"></h3>
                <div class="portlet box">
                    <div class="portlet-title">
                        <div class="caption text-uppercase">
                            <span class="caption-subject theme-font bold uppercase">{{session('congbo')['chucnang']['giarung'] ?? 'Giá rừng'}}</span>
                        </div>
                    </div>

                    <div class="portlet-body form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <label style="font-weight: bold">Năm</label>
                                {!! Form::select('nam', getNam(true), $inputs['nam'], array('id' => 'nam', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                        <hr>

                        <table id="sample_4" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Thời điểm</th>
                                <th style="text-align: center">Phân loại</th>
                                <th style="text-align: center">Loại rừng</th>
                                <th style="text-align: center">Nội dung chi tiết</th>
                                <th style="text-align: center">Diện tích<br>rừng</th>
                                <th style="text-align: center">Diện tích<br>sử dụng</th>
                                <th style="text-align: center">Đơn vị<br>tính</th>
                                <th style="text-align: center" >Giá trị</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($model_dk as $key=>$tt)
                                    <tr>
                                        <td style="text-align: center">{{$i++}}</td>
                                        <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                        <td>{{$tt->phanloai}}</td>
                                        <td style="text-align: left;">{{$a_loairung[$tt->manhom] ?? ''}}</td>
                                        <td style="text-align: left" class="active">{{$tt->mota}}</td>
                                        <td>
                                            <button type="button" onclick="get_attack('{{$tt->mahs}}','giarung')" class="btn btn-default btn-xs mbs" data-target="#dinhkem-modal-confirm" data-toggle="modal">
                                                <i class="fa fa-cloud-download"></i>&nbsp;Tải tệp đính kèm</button>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                @foreach($model as $key => $tt)
                                    <tr>
                                        <td style="text-align: center">{{$i++}}</td>
                                        <td style="text-align: center">{{getDayVn($tt->thoidiem)}}</td>
                                        <td>{{$tt->phanloai}}</td>
                                        <td style="text-align: left;">{{$a_loairung[$tt->manhom] ?? ''}}</td>
                                        <td style="text-align: left" class="active">{{$tt->noidung}}</td>
                                        <td style="text-align: center">{{dinhdangso($tt->dientich)}}</td>
                                        <td style="text-align: center">{{dinhdangso($tt->dientichsd)}}</td>
                                        <td style="text-align: center">{{$tt->dvt}}</td>
                                        <td style="text-align: center">{{dinhdangso($tt->giatri)}}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('manage.include.form.modal_attackfile_congbo')
@stop
