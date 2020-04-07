<!--Modal Chuyển hồ sơ-->
<div id="duyeths-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>'','id' => 'frm_duyeths'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý duyệt hồ sơ?</h4>
                <input type="hidden" name="mahs" id="mahs">
                <input type="hidden" name="madv" id="madv">

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Số hồ sơ nhận<span class="require">*</span></label>
                            <input type="text" style="text-align: center" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" required autofocus/>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Ngày duyệt hồ sơ</label>
                            <input type="date" name="ngaynhan" id="ngaynhan" class="form-control" value="{{date('Y-m-d')}}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" class="btn btn-primary" onclick="clickDuyetHS()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    function clickDuyetHS(){
        if($('#frm_duyeths').find("[id='sohsnhan']".val() == '')){
            toastr.error('Số hồ sơ nhận không được bỏ trống.','Lỗi.')
        }else{
            $('#frm_duyeths').submit();
        }
    }

    function confirmDuyetHS(mahs,url,madv) {
        $('#frm_duyeths').attr('action', url);
        $('#frm_duyeths').find("[id='mahs']").val(mahs);
        $('#frm_duyeths').find("[id='madv']").val(madv);
    }
</script>