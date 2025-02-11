<script>
    function editItem(maso) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(id);
        $.ajax({
            url: '{{ $inputs['url'] }}' + '/edit_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: maso
            },
            dataType: 'JSON',
            success: function(data) {
                $('#edit_cap1').val(data.cap1);
                $('#edit_cap2').val(data.cap2);
                $('#edit_cap3').val(data.cap3);
                $('#edit_cap4').val(data.cap4);
                $('#edit_cap5').val(data.cap5);
                $('#edit_ten').val(data.ten);
                $('#edit_dvt').val(data.dvt);
                $('#edit_gia').val(data.gia);
                $('#edit_id').val(data.id);
                InputMask();
            }
        })
    }

    function updatets() {
        //alert('vcl');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ $inputs['url'] }}' + '/update_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: $('#edit_id').val(),
                gia: $('#edit_gia').val(),
                mahs: $('#mahs').val()
            },
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    toastr.success("Chỉnh sửa thông tin hàng hóa dịch vụ thành công", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });
                    $('#modal-edit').modal("hide");


                } else
                    toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
            }
        })
    }
</script>
<!--Modal Edit-->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Kê khai giá thị trường </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mã nhóm, loại tài nguyên cấp 1 </label>
                            <input type="text" id="edit_cap1" name="edit_cap1" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mã nhóm, loại tài nguyên cấp 2</label>
                            <input type="text" id="edit_cap2" name="edit_cap2" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mã nhóm, loại tài nguyên cấp 3 </label>
                            <input type="text" id="edit_cap3" name="edit_cap3" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mã nhóm, loại tài nguyên cấp 4</label>
                            <input type="text" id="edit_cap4" name="edit_cap4" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mã nhóm, loại tài nguyên cấp 5</label>
                            <input type="text" id="edit_cap5" name="edit_cap5" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Tên nhóm, loại tài nguyên</label>
                            <input type="text" id="edit_ten" name="edit_ten" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Đơn vị tính</label>
                            <input type="text" id="edit_dvt" name="edit_dvt" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Giá tính thuế tài nguyên (đồng)</label>
                            <input type="text" name="edit_gia" id="edit_gia" class="form-control"
                                data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="edit_id" name="edit_id">
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                <button type="button" class="btn btn-primary" onclick="updatets()">Cập nhật</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-importexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nhận dữ liệu từ file excel</h4>
            </div>
            {!! Form::open([
                'url' => $inputs['url'] . '/thuetainguyen/import_excel',
                'method' => 'post',
                'files' => true,
                'id' => 'frm_importexcel',
                'enctype' => 'multipart/form-data',
                'files' => true,
            ]) !!}
            <!-- Gán các trường giá trị để cho các trường hợp chưa lưu hồ sơ -->
            <input type="hidden" name="mahs" value="{{ $model->mahs }}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Mã tài nguyên<span class="require">*</span></label>
                            {!! Form::text('maso', 'I', ['class' => 'form-control required']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Giá liền kề<span class="require">*</span></label>
                            {!! Form::text('gia', 'M', ['class' => 'form-control required']) !!}
                        </div>
                    </div>                    
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Từ dòng<span class="require">*</span></label>
                            {!! Form::text('tudong', '4', ['id' => 'tudong', 'class' => 'form-control required', 'data-mask' => 'fdecimal']) !!}
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đến dòng</label>
                            {!! Form::text('dendong', '300', ['id' => 'dendong', 'class' => 'form-control', 'data-mask' => 'fdecimal']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">File dữ liệu mẫu<span class="require">*</span></label>
                            <input id="fexcel" name="fexcel" type="file"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn blue" id="submitimex">Đồng ý</button>
                <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
            </div>
            {!! Form::close() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function setValExl(mahoso) {
        if (window.confirm('Bạn có lưu các thay đổi về thông tin hồ sơ ?')) {
            var formData = new FormData($('#frm_ThayDoi')[0]);
            $.ajax({
                url: "{{ $inputs['url'] }}" + "/store",
                method: "POST",
                cache: false,
                dataType: false,
                processData: false,
                contentType: false,
                data: formData,
                success: function(data) {
                    // console.log(data);
                }
            });
        }

        $('#frm_NhanExcel').find("[name='mahoso']").val(mahoso);
    }
</script>
