<!--Modal Chuyển hồ sơ-->
<div id="chuyen-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>'','id' => 'frm_chuyen'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hoàn thành hồ sơ?</h4>
                <input type="hidden" name="mahs" id="mahs">

            </div>
            <div class="modal-body">
                <p style="color: #0000FF">Hồ sơ đã hoàn thành sẽ được chuyển lên đơn vị tiếp nhận. Bạn cần liên hệ đơn vị tiếp nhận để chỉnh sửa hồ sơ nếu cần!</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Họ và tên người nộp</label>
                            <input type="text" id="nguoinop" name="nguoinop" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số điện thoại liên hệ</label>
                            <input type="tel" id="dtll" name="dtll" class="form-control" maxlength="15">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Cơ quan tiếp nhận<span class="require">*</span></label>
                            <select class="form-control select2me" name="macqcq">
                                @foreach($a_diaban_th as $key=>$val)
                                    <optgroup label="{{$val}}">
                                        <?php $donvi = $m_donvi_th->where('madiaban',$key); ?>
                                        @foreach($donvi as $ct)
                                            <option value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickChuyen()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    function clickChuyen(){
        $('#frm_chuyen').submit();
    }

    function confirmChuyen(mahs,url) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(id);
        $.ajax({
            url: '{{$inputs['url']}}' +'/kiemtra',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                mahs: mahs
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'success') {
                    $('#chuyen-modal-confirm').modal("show");
                    $('#frm_chuyen').attr('action', url);
                    $('#frm_chuyen').find("[id='mahs']").val(mahs);
                }else{
                    toastr.error(data.message,'Lỗi.');
                }
            }
        })



    }
</script>