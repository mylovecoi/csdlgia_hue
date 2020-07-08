<!--Model Create-->
<div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Thông tin lĩnh vực kinh doanh</h4>
            </div>
            <div class="modal-body" id="ttmhbog">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Ngành - Nghề</label>
                            <select class="form-control select2me" name="manghe" id="manghe">
                                @foreach($m_nganh as $nganh)
                                    <optgroup label="{{$nganh->tennganh}}">
                                        <?php $mode_ct = $m_nghe->where('manganh',$nganh->manganh); ?>
                                        @foreach($mode_ct as $ct)
                                            <option value="{{$ct->manghe}}">{{$ct->tennghe}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                <button type="button" class="btn btn-primary" onclick="capnhatts()">Thêm mới</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!--Modal Wide Width-->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Đồng ý xóa?</h4>
            </div>
            <input type="hidden" id="iddelete" name="iddelete">
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                <button type="button" class="btn btn-primary" onclick="deleteRow()">Đồng ý</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function capnhatts(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/doanhnghiep/store_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                manghe: $('#manghe').val(),
                madv:$('#madv').val(),
                type: $('#type').val()
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'success') {
                    toastr.success("Bổ xung thông tin thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });
                    $('#modal-create').modal("hide");
                }else {
                    toastr.error('Trùng lặp ngành nghề', "Lỗi!!!");
                    $('#modal-create').modal("hide");
                }
            }
        })
    }

    function getid(id){
        document.getElementById("iddelete").value=id;
    }

    function deleteRow() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/doanhnghiep/delete_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: $('input[name="iddelete"]').val(),
                madv: $('#madv').val()
            },
            dataType: 'JSON',
            success: function (data) {
                //if(data.status == 'success') {
                toastr.success("Bạn đã xóa thông tin thành công!", "Thành công!");
                $('#dsts').replaceWith(data.message);
                jQuery(document).ready(function () {
                    TableManaged.init();
                });

                $('#modal-delete').modal("hide");

                //}
            }
        })
    }
</script>