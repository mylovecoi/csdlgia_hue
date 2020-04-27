
<script>
    function ClickBc1(){
        $('#frm_Bc1').submit();
    }
</script>

<!--Modal Thoại PL5-->
<div id="pl5-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        {!! Form::open(['url'=>'/thamdinhgia/baocao/BC1','target'=>'_blank' , 'id' => 'frm_Bc1', 'class'=>'form-horizontal form-validate']) !!}
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Thông tin về tài sản thẩm định giá</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label><b>Từ ngày</b></label>
                        <input type="date" id="ngaytu" name="ngaytu" class="form-control" value="{{intval(date('Y')).'-01-01'}}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Đến ngày</b></label>
                        <input type="date" id="ngayden" name="ngayden" class="form-control" value="{{intval(date('Y')).'-12-31'}}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label">Đơn vị</label>
                        <select class="form-control select2me" name="madv" id="madv">
                            <option value="all">-- Tất cả các đơn vị --</option>
                            @foreach($m_diaban as $diaban)
                                <optgroup label="{{$diaban->tendiaban}}">
                                    <?php $donvi = $m_donvi->where('madiaban',$diaban->madiaban); ?>
                                    @foreach($donvi as $ct)
                                        <option value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBc1()" >Đồng ý</button>
                <!--button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="" >Xuất Excel</button-->
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

