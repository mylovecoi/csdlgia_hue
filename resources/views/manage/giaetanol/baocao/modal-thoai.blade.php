
<script>
    function setUrl(url) {
        $('#frm_bc1').attr('action',url);
    }
    function ClickBC1(){
        $('#frm_bc1').submit();
    }
    function ClickBC2(url){
        $('#frm_bc1').attr('action',url);
        $('#frm_bc1').submit();
    }
    $(document).ready(function(){
        $("#thoidiem").change(function(){
            var d = new Date();
            var nam = d.getFullYear().toString();
            switch ($(this).val()) {
                case 'quy1':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-01-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-03-31');
                    break;
                }
                case 'quy2':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-04-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-06-30');
                    break;
                }
                case 'quy3':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-07-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-09-30');
                    break;
                }
                case 'quy4':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-10-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-12-31');
                    break;
                }
                case 'thang01':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-01-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-01-31');
                    break;
                }
                case 'thang02':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-02-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-02-28');
                    break;
                }
                case 'thang03':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-03-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-03-31');
                    break;
                }
                case 'thang04':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-04-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-04-30');
                    break;
                }
                case 'thang05':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-05-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-05-31');
                    break;
                }
                case 'thang06':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-06-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-06-30');
                    break;
                }
                case 'thang07':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-07-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-07-31');
                    break;
                }
                case 'thang08':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-08-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-08-31');
                    break;
                }
                case 'thang09':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-09-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-09-30');
                    break;
                }
                case 'thang10':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-10-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-10-31');
                    break;
                }
                case 'thang11':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-11-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-11-30');
                    break;
                }
                case 'thang12':{
                    $('#frm_bc1').find("[id='tungay']").val(nam + '-12-01');
                    $('#frm_bc1').find("[id='denngay']").val( nam + '-12-31');
                    break;
                }
            }
        })

    });
</script>

<!--Modal Thoại PL1-->
<div id="pl1-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'','target'=>'_blank' , 'id' => 'frm_bc1', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp kê khai, đăng ký giá</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"><b>Đơn vị</b></label>
                            <select id="madv" name="madv" class="form-control">
                                <option value="all">--Tất cả--</option>
                                @foreach($m_donvi as $donvi)
                                    <option value="{{$donvi->madv}}">{{$donvi->tendv}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Ngành nghề kê khai</label>
                            <select class="form-control select2me" name="manghe" id="manghe" disabled>
                                {{--<option value="all">-- Tất cả ngành nghề --</option>--}}
                                @foreach($a_dm as $key=>$val)
                                    <option value="{{$key}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"><b>Phân loại</b></label>
                            <select id="phanloai" name="phanloai" class="form-control">
                                <option value="ngaychuyen">Ngày chuyển hồ sơ</option>
                                <option value="ngaynhan">Ngày duyệt</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"><b>Thời điểm</b></label>
                            {!! Form::select('thoidiem',getThoiDiem(),null,['id'=>'thoidiem','class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label><b>Từ ngày</b></label>
                            {!! Form::input('date', 'tungay', date('Y').'-01-01', array('id' => 'tungay', 'class' => 'form-control'))!!}
                        </div>

                        <div class="col-md-6">
                            <label><b>Đến ngày</b></label>
                            {!! Form::input('date', 'denngay', date('Y').'-12-31', array('id' => 'denngay', 'class' => 'form-control'))!!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC1()">Hoàn thành</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBCExcel('/reports/thuetn/bcgiathuetnexcel')">Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
