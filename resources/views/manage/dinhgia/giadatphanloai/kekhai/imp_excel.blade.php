{{--@extends('main')--}}
@extends('manage.dinhgia._include.importexcel')

@section('thongtin')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Tên đường, giới hạn, khu vực<span class="require">*</span></label>
                {!!Form::text('khuvuc', 'B', array('id' => 'khuvuc','class' => 'form-control','required'))!!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Loại đất<span class="require">*</span></label>
                {!!Form::text('maloaidat', 'C', array('id' => 'maloaidat','class' => 'form-control','required'))!!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Vị trí<span class="require">*</span></label>
                {!!Form::text('vitri', 'D', array('id' => 'vitri','class' => 'form-control','required'))!!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Giá tại bảng giá<span class="require">*</span></label>
                {!!Form::text('banggiadat', 'E', array('id' => 'banggiadat','class' => 'form-control','required'))!!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Giá đất cụ thể<span class="require">*</span></label>
                {!!Form::text('giacuthe', 'F', array('id' => 'giacuthe','class' => 'form-control','required'))!!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Hệ số điều chỉnh<span class="require">*</span></label>
                {!!Form::text('hesodc', 'G', array('id' => 'hesodc','class' => 'form-control','required'))!!}
            </div>
        </div>
    </div>
@stop