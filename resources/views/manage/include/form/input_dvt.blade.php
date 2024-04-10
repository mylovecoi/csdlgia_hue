<div class="col-md-11" style="padding-left: 0px;">
    <label class="form-control-label">Đơn vị tính</label>
    {!! Form::select('dvt', array_merge(['' => ''], $a_dvt), null, [
        'id' => 'dvt',
        'class' => 'form-control select2me',
    ]) !!}
</div>
<div class="col-md-1" style="padding-left: 0px;">
    <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
    <button type="button" class="btn btn-default" data-target="#modal-dvt" data-toggle="modal">
        <i class="fa fa-plus"></i></button>
</div>
