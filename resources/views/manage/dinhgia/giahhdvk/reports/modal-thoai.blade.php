
<script>
    function ClickBC1(url){
        $('#frm_bc1').attr('action',url);
        $('#frm_bc1').submit();
    }
    function ClickBC2(url){
        $('#frm_bc2').attr('action',url);
        $('#frm_bc2').submit();
    }
    function ClickBc2Word(url){
        $('#frm_bc2').attr('action',url);
        $('#frm_bc2').submit();
    }
</script>

<!--Modal Thoại PL1-->
<div id="pl1-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'','target'=>'_blank' , 'id' => 'frm_bc1', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp giá hàng hóa thị trường</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="matt" value="{{$inputs['matt']}}" />
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<label>Nhóm hàng hóa dịch vụ khác</label>--}}
                        {{--<select name="matt" id="matt" class="form-control">--}}
                            {{--@foreach($modelnhomhhdvk as $nhomhhdvk)--}}
                            {{--<option value="{{$nhomhhdvk->matt}}">{{$nhomhhdvk->tentt}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="row">
                    <div class="col-md-6">
                        <label>Từ ngày</label>
                        <input type="date" id="tungay" name="tungay" class="form-control" value="{{intval(date('Y')).'-01-01'}}" style="text-align: center">
                    </div>

                    <div class="col-md-6">
                    <label>Ngày báo cáo đến ngày</label>
                        <input type="date" id="denngay" name="denngay" class="form-control" value="{{intval(date('Y')).'-12-31'}}" style="text-align: center">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Đơn vị nhập liệu</label>
                        {!!Form::select('madv', $a_nhaplieu, null, array('id' => 'madv','class' => 'form-control select2me'))!!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC1('/giahhdvk/bc1')">Đồng ý</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBCExcel('/reports/thuetn/bcgiathuetnexcel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!--Modal Thoại PL1-->
<div id="pl2-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'','target'=>'_blank' , 'id' => 'frm_bc2','class'=>'form-horizontal1']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp giá hàng hóa thị trường</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" name="matt" value="{{$inputs['matt']}}" />
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-11">
                            <label>Kỳ báo cáo liền kề</label>
                            {!! Form::select('mahslk',$a_hoso,null,array('id' => 'mahslk', 'class' => 'form-control select2me'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-11">
                            <label>Kỳ báo cáo</label>
                            {!! Form::select('mahs',$a_hoso,null,array('id' => 'mahs', 'class' => 'form-control select2me'))!!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC2('/giahhdvk/bc2')">Đồng ý</button>
                {{--<button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBc2Word('/reportshanghoadichvukhac/exWordBc2')">Xuất Word</button>--}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Thông tin hàng hóa, dịch vụ</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover" id="sample_3">
                    <thead>
                    <tr>
                        <th style="text-align: center" width="2%">STT</th>
                        <th style="text-align: center">Mã số</th>
                        <th style="text-align: center">Tên hàng hóa dịch vụ</th>
                        <th style="text-align: center">Đặc điểm kỹ thuật</th>
                        <th style="text-align: center">Đơn vị<br>tính</th>
                        <th style="text-align: center" width="15%">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($m_hoso as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$i++}}</td>
                            <td>{{$tt->mahhdv}}</td>
                            <td class="success" style="font-weight: bold">{{$tt->tenhhdv}}</td>
                            <td>{{$tt->dacdiemkt}}</td>
                            <td style="text-align: center">{{$tt->dvt}}</td>
                            <td class="text-center">
                                <input type="checkbox" value="{{$tt->mahhdv}}" onclick="setMaSo(this)" />
                                {{--                                    <input type="checkbox" onclick="setMaSo('{{$tt->mahhdv}}')" />--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button id="btn_addall" type="button" onclick="setMaHHAll()" class="btn blue">Thêm tất cả</button>
                <button id="btn_add" type="button" onclick="setMaHH()" class="btn blue">Đồng ý</button>
                <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
