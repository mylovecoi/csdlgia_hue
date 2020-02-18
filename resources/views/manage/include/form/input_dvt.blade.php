<div class="col-md-10" style="padding-left: 0px;">
    <label class="form-control-label">Đơn vị tính</label>
    {!!Form::select('dvt', $a_dvt, null, array('id' => 'dvt','class' => 'form-control select2me'))!!}
</div>
<div class="col-md-2" style="padding-left: 0px;">
    <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
    <button type="button" class="btn btn-default" data-target="#modal-dvt" data-toggle="modal">
        <i class="fa fa-plus"></i></button>
</div>
