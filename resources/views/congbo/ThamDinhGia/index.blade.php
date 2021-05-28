
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
        });
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <!-- BEGIN PORTLET-->
                <!--div class="portlet light"-->
                <div class="portlet-title">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light" style="min-height: 587px">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs font-green-sharp"></i>
                                        <span class="caption-subject theme-font bold uppercase">CSDL Thẩm định giá tại địa phương</span>
                                    </div>
                                    <div class="tools">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label style="font-weight: bold">Năm</label>
                                        <select name="nam" id="nam" class="form-control">
                                            <option value="all">--Tất cả các năm--</option>
                                            @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                            @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                            @for($i = $nam_start; $i <= $nam_stop; $i++)
                                                <option value="{{$i}}" {{$i == $inputs['nam'] ? 'selected' : ''}}>Năm {{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label style="font-weight: bold">Tên tài sản thẩm định giá</label>
                                        <div class="form-group">
                                            {!! Form::text('tents',$inputs['tents'], array('id'=>'tents','class'=>'form-control'))!!}
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover" id="sample_4">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center" width="10%">Số CV</th>
                                                    <th style="text-align: center" >Đơn vị thẩm định/<br>Đơn vị yêu cầu thẩm định</th>
                                                    <th style="text-align: center" >Thời gian<br> thẩm định</th>
                                                    <th style="text-align: center">Thời hạn <br>thẩm định</th>
                                                    <th style="text-align: center">Tên tài sản-<br>Thông số kỹ thuật</th>
                                                    <th style="text-align: center">Số lương-<br>Đơn vị tính</th>
                                                    <th style="text-align: center">Đơn giá<br> thẩm định</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($model as $tt)
                                                    <tr>
                                                        <td>{{$tt->sotbkl}}</td>
                                                        <td class="active">{{$tt->tendv}}/<br><b>{{$tt->dvyeucau}}</b></td>
                                                        <td>{{getDayVn($tt->thoidiem)}}</td>
                                                        <td>{{getDayVn($tt->thoihan)}}</td>
                                                        <td class="success">{{$tt->tents}}-{{$tt->thongsokt}}</td>
                                                        <td style="text-align: center; font-weight: bold;">{{$tt->sl}}-{{$tt->dvt}}</td>
                                                        <td style="text-align: right; font-weight: bold;" class="active">{{number_format($tt->nguyengiathamdinh)}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>

                    <!--/div-->
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div>
    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop
