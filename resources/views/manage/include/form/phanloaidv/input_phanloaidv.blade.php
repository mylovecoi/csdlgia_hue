<div class="col-md-11" style="padding-left: 0px;">
    <label class="control-label">Phân loại sản phẩm, dịch vụ</label>
    {!!Form::select('phanloaidv', $a_phanloaidv, null, array('id' => 'phanloaidv','class' => 'form-control select2me'))!!}
</div>
<div class="col-md-1" style="padding-left: 0px;">
    <label class="control-label">Thêm</label>
    <button type="button" class="btn btn-default" data-target="#modal-phanloaidv" data-toggle="modal">
        <i class="fa fa-plus"></i></button>
</div>
