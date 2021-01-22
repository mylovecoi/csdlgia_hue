<div id="modal-phanloaidv" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Thông tin phân loại</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-control-label">Phân loại sản phẩm, dịch vụ<span class="require">*</span></label>
                        {!!Form::text('phanloaidv_add', null, array('id' => 'phanloaidv_add','class' => 'form-control','required'=>'required'))!!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button class="btn btn-primary" onclick="addpl()">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
<script>
    function addpl(){
        $('#modal-phanloaidv').modal('hide');
        var gt = $('#phanloaidv_add').val();
        $('#phanloaidv').append(new Option(gt, gt, true, true));
        $('#phanloaidv').val(gt).trigger('change');
    }
</script>