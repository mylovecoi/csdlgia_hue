
<script>
   function getBCLK() {
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
           url: '/gianuocsachsinhhoat/getBCLK',
           type: 'GET',
           data: {
               _token: CSRF_TOKEN,
               madv: $('#madv').val()
           },
           dataType: 'JSON',
           success: function (data) {
               $('#row_bclk').replaceWith(data.message);
           },
           error: function (message) {
               toastr.error(message, 'Lỗi!');
           }
       });
   }
    function ClickBC1(url){
        $('#frm_bc1').attr('action',url);
        $('#frm_bc1').submit();
    }
</script>

<!--Modal Thoại PL1-->
<div id="pl1-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>'','target'=>'_blank' , 'id' => 'frm_bc1', 'class'=>'form-horizontal form-validate']) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp giá thị trường</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label style="font-weight: bold">Đơn vị</label>
                        <select class="form-control select2me" id="madv" name="madv" onchange="getBCLK()">
                            @foreach($m_diaban as $diaban)
                                <optgroup label="{{$diaban->tendiaban}}">
                                    <?php $donvi = $m_donvi->where('madiaban',$diaban->madiaban); ?>
                                    @foreach($donvi as $ct)
                                        <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="row_bclk" class="row">
                    <div class="col-md-12">
                        <label><b>Báo cáo liền kề</b></label>
                        <select name="mahslk" id="mahslk" class="form-control">
                            <option value="ALL">-- Chọn báo cáo liền kề --</option>
                            @foreach($modelhs as $hslk)
                                <option value="{{$hslk->mahs}}">Số {{$hslk->soqd}}- Ngày {{getDayVn($hslk->ngayapdung)}}-{{$hslk->mota}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label><b>Báo cáo</b></label>
                        <select name="mahsbc" id="mahsbc" class="form-control">
                            <option value="ALL">-- Chọn báo cáo--</option>
                            @foreach($modelhs as $hsbc)
                                <option value="{{$hsbc->mahs}}">Số {{$hslk->soqd}}- Ngày {{getDayVn($hsbc->ngayapdung)}}-{{$hsbc->mota}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC1('/gianuocsachsinhhoat/baocao/baocaonuocsh1')">Đồng ý</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickBCExcel('/reports/thuetn/bcgiathuetnexcel')">Xuất Excel</button-->
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

