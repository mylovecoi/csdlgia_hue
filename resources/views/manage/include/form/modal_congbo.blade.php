<!--Modal Công bố/Hủy công bố hồ sơ-->
<div id="congbo-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>'','id' => 'frm_congbo'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý công bố?</h4>
                <input type="hidden" name="mahs" id="mahs">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <select class="form-control select2me" name="trangthai_ad" id="trangthai_ad">
                                <option value="CB">Công bố hồ sơ</option>
                                <option value="HCB">Hủy công bố hồ sơ</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="ClickCongBo()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    function ClickCongBo(){
        $('#frm_congbo').submit();
    }

    function confirmCongbo(mahs,url,trangthai) {
        $('#frm_congbo').attr('action', url);
        $('#frm_congbo').find("[id='mahs']").val(mahs);
        $('#frm_congbo').find("[id='trangthai_ad']").val(trangthai).trigger('change');
    }
</script>