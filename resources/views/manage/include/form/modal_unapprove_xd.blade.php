<!--Modal Chuyển hồ sơ-->
<div id="tralai-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>'','id' => 'frm_tralai'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hủy hoàn thành hồ sơ?</h4>

                <input type="hidden" name="mahs" id="mahs">
                <input type="hidden" name="madv" id="madv">

            </div>
            <div class="modal-body">
                <p style="color: #0000FF">Hồ sơ Bị hủy sẽ chuyển lại cho cơ quan nhập chủ quản có thể chỉnh sửa hồ sơ!</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickTraLai()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    function clickTraLai(){
        $('#frm_tralai').submit();
    }

    function confirmTraLai(mahs,url,madv) {
        $('#frm_tralai').attr('action', url);
        $('#frm_tralai').find("[id='mahs']").val(mahs);
        $('#frm_tralai').find("[id='madv']").val(madv);
    }
</script>