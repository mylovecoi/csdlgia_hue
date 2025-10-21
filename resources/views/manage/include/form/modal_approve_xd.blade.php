<!--Modal Nhận hồ sơ-->
<div id="nhanhs-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>'','id' => 'frm_nhanhs'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                    class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý tiếp nhận hồ sơ?</h4>
                <input type="hidden" name="mahs" id="mahs">
                <input type="hidden" name="madv" id="madv">
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickNhanHs()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<!--Modal Chuyển hồ sơ-->
<div id="chuyenxd-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>'','id' => 'frm_chuyenxd'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hoàn thành hồ sơ?</h4>
                <input type="hidden" name="mahs" id="mahs">
                <input type="hidden" name="madv" id="madv">

            </div>
            <div class="modal-body">
                <p style="color: #0000FF">Hồ sơ đã hoàn thành sẽ được chuyển lên đơn vị tiếp nhận. Bạn cần liên hệ đơn vị tiếp nhận để chỉnh sửa hồ sơ nếu cần!</p>
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
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickChuyenXD()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    function clickChuyenXD(){
        $('#frm_chuyenxd').submit();
    }

    function clickNhanHs(){
        $('#frm_nhanhs').submit();
    }

    function confirmChuyenXD(mahs,url,madv) {
        $('#frm_chuyenxd').attr('action', url);
        $('#frm_chuyenxd').find("[id='mahs']").val(mahs);
        $('#frm_chuyenxd').find("[id='madv']").val(madv);
    }

    function confirmNhanHs(mahs,url,madv) {
        $('#frm_nhanhs').attr('action', url);
        $('#frm_nhanhs').find("[id='mahs']").val(mahs);
        $('#frm_nhanhs').find("[id='madv']").val(madv);
    }
</script>