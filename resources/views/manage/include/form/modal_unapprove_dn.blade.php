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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Lý do trả lại</label>
                            {!! Form::textarea('lydo', null, array('id' => 'lydo','class' => 'form-control', 'rows'=>'3','required'=>'required')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button id="btn_tralai" type="submit" class="btn btn-primary" onclick="clickTraLai()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    function clickTraLai(){
        if($('#frm_tralai').find("[id='lydo']".val() == '')){
            toastr.error('Lý do trả lại không được bỏ trống.','Lỗi.')
        }else{
            $('#frm_tralai').submit();
        }
    }

    function confirmTraLai(mahs,url,madv) {
        $('#frm_tralai').attr('action', url);
        $('#frm_tralai').find("[id='mahs']").val(mahs);
        $('#frm_tralai').find("[id='madv']").val(madv);
        $('#btn_tralai').show();
    }

    function viewLyDo(mahs,madv) {
        $('#btn_tralai').hide();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(id);
        $.ajax({
            url: '{{$inputs['url']}}' + '/get_sohs',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                mahs: mahs,
                madv: madv
            },
            dataType: 'JSON',
            success: function (data) {
                $('#frm_tralai').find("[id='lydo']").val(data.lydo);
            }
        })
    }
</script>