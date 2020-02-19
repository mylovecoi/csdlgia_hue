<div id="modal-dvt" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Thông tin đơn vị tính</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-control-label">Đơn vị tính<span class="require">*</span></label>
                        {!!Form::text('dvt_add', null, array('id' => 'dvt_add','class' => 'form-control','required'=>'required'))!!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button class="btn btn-primary" onclick="adddvt()">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
<script>
    function adddvt(){
        $('#modal-dvt').modal('hide');
        var gt = $('#dvt_add').val();
        $('#dvt').append(new Option(gt, gt, true, true));
        $('#dvt').val(gt).trigger('change');
    }
</script>