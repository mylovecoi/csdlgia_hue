<div id="modal-modify" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url'=>$inputs['url'].'/store_ct', 'id' => 'frm_modify', 'class'=>'horizontal-form']) !!}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Thông tin giá đất theo địa bàn</h4>
            </div>
            <div class="modal-body" id="edit_node">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Loại đất</label>
                            {!!Form::select('maloaidat', $a_loaidat, null, array('class' => 'form-control select2me'))!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Xã, phường</label>
                            {!!Form::select('maxp', $a_xp, null, array('class' => 'form-control'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Khu vực (Tên đường, tên phố)<span class="require">*</span></label>
                            {!!Form::textarea('khuvuc',null, array('class' => 'form-control', 'rows'=>'2', 'required'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Điểm đầu</label>
                            {!!Form::textarea('diemdau',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Điểm cuối</label>
                            {!!Form::textarea('diemcuoi',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <label class="control-label">Loại đường</label>
                        {!!Form::text('loaiduong', null, array('class' => 'form-control'))!!}
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <label class="control-label">Hệ số K</label>
                            <input type="text" name="hesok" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Giá vị trị I</label>
                            <input type="text" name="giavt1" id="giavt1" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Giá vị trị II</label>
                            <input type="text" name="giavt2" id="giavt2" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Giá vị trị III</label>
                            <input type="text" name="giavt3" id="giavt3" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Giá vị trị IV</label>
                            <input type="text" name="giavt4" id="giavt4" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Ghi chú</label>
                            {!!Form::textarea('ghichu',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                        </div>
                    </div>
                </div>
                <input type="hidden" name="madiaban" value="{{$model->madiaban}}">
                <input type="hidden" name="id">
                <input type="hidden" name="mahs" value="{{$model->mahs}}" >
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng ý</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>$inputs['url'].'/del_ct','id' => 'frm_delete'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                <input type="hidden" name="id">

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickdelete()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="modal fade" id="modal-importexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nhận dữ liệu từ file excel</h4>
            </div>
            {!! Form::open(['url'=>$inputs['url'].'/importexcel', 'method'=>'post' , 'files'=>true, 'id' => 'frm_importexcel','enctype'=>'multipart/form-data','files'=>true]) !!}
            <input type="hidden" name="madiaban" value="{{$model->madiaban}}" />
            <input type="hidden" name="mahs" value="{{$model->mahs}}" />
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="control-label">Loại đất</label>
                            {!!Form::select('maloaidat', $a_loaidat, null, array('class' => 'form-control select2me'))!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Xã, phường</label>
                            {!!Form::select('maxp', $a_xp, null, array('class' => 'form-control'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Khu vực<span class="require">*</span></label>
                            {!!Form::text('khuvuc', 'B', array('id' => 'khuvuc','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Điểm đầu<span class="require">*</span></label>
                            {!!Form::text('diemdau', 'C', array('id' => 'diemdau','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Điểm cuối<span class="require">*</span></label>
                            {!!Form::text('diemcuoi', 'D', array('id' => 'diemcuoi','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Loại đường</label>
                            {!!Form::text('loaiduong', 'E', array('id' => 'loaiduong','class' => 'form-control required'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Giá đất VT1<span class="require">*</span></label>
                            {!!Form::text('giavt1', 'F', array('id' => 'giavt1','class' => 'form-control required'))!!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Giá đất VT2<span class="require">*</span></label>
                            {!!Form::text('giavt2', 'G', array('id' => 'giavt2','class' => 'form-control required'))!!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Giá đất VT3<span class="require">*</span></label>
                            {!!Form::text('giavt3', 'H', array('id' => 'giavt3','class' => 'form-control required'))!!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Giá đất VT4<span class="require">*</span></label>
                            {!!Form::text('giavt4', 'I', array('id' => 'giavt4','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Hệ số K<span class="require">*</span></label>
                            {!!Form::text('hesok', 'J', array('id' => 'hesok','class' => 'form-control required'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Từ dòng<span class="require">*</span></label>
                            {!!Form::text('tudong', '5', array('id' => 'tudong','class' => 'form-control required','data-mask'=>'fdecimal'))!!}
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đến dòng</label>
                            {!!Form::text('dendong', '500', array('id' => 'dendong','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Theo dõi<span class="require">*</span></label>
                            <input id="fexcel" name="fexcel" type="file"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn blue" onclick="ClickImportExcel()" id="submitimex">Đồng ý</button>
                <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
            </div>
            {!! Form::close() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script>
    function clearForm() {
        var form = $('#frm_modify');
        form.find("[name='id']").val(-1);
    }

    function editItem(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(id);
        $.ajax({
            url: '{{$inputs['url']}}' + '/edit_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: id
            },
            dataType: 'JSON',
            success: function (data) {
                var form = $('#frm_modify');
                form.find("[name='maxp']").val(data.maxp).trigger('change');
                form.find("[name='maloaidat']").val(data.maloaidat).trigger('change');
                form.find("[name='khuvuc']").val(data.khuvuc);
                form.find("[name='diemdau']").val(data.diemdau);
                form.find("[name='diemcuoi']").val(data.diemcuoi);
                form.find("[name='giavt1']").val(data.giavt1);
                form.find("[name='giavt2']").val(data.giavt2);
                form.find("[name='giavt3']").val(data.giavt3);
                form.find("[name='giavt4']").val(data.giavt4);
                form.find("[name='ghichu']").val(data.ghichu);
                form.find("[name='loaiduong']").val(data.loaiduong);
                form.find("[name='hesok']").val(data.hesok);
                form.find("[name='id']").val(data.id);
                InputMask();
            }
        })
    }

    function delItem(id) {
        $('#frm_delete').find("[name='id']").val(id);
    }

    function clickdelete(){
        $('#frm_delete').submit();
    }
</script>