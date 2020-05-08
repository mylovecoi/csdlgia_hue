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
                var current_path_url = '{{$inputs['url']}}' + '?';
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

@section('content-cb')
    <div class=" col-sm-12">
        <h3 class="page-title">
            Thông tin giá dịch vụ giáo dục, đào tạo
        </h3>
        <div class="portlet box">
            <div class="portlet-title"></div>

            <div class="portlet-body form-horizontal">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label style="font-weight: bold">Năm học</label>
                            <select class="form-control" id="nam">
                                <option value="all">--Tất cả các năm--</option>
                                @for($i = date('Y') - 2; $i <= date('Y'); $i++)
                                    <option value="{{$i.'-'.($i+1)}}" {{($i.'-'.($i+1)) == $inputs['nam'] ? 'selected' : ''}}>{{$i.'-'.($i+1)}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label style="font-weight: bold">Địa bàn</label>
                            {!!Form::select('madiaban', $a_diaban, $inputs['madiaban'], array('id' => 'madiaban','class' => 'form-control'))!!}
                        </div>
                    </div>
                </div>

                <table id="sample_4" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="text-align: center" width="2%">STT</th>
                        <th style="text-align: center" width="8%">Năm học</th>
                        <th style="text-align: center">Mô tả</th>
                        <th style="text-align: center" >Học phí</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($model as $key => $tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td style="text-align: center"><b>{{$tt->nam}}</b></td>
                                <td style="text-align: left" class="active">{{$tt->tenspdv}}</td>
                                <td style="text-align: right;font-weight: bold">{{dinhdangsothapphan($tt->giadv,2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@stop
