<script>
    function editItem(maso) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/tonghop/edit_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: maso
            },
            dataType: 'JSON',
            success: function (data) {
                $('#mahhdv').val(data.mahhdv).trigger('change');
                $('#nguontt').val(data.nguontt).trigger('change');
                $('#loaigia').val(data.loaigia).trigger('change');
                $('#gialk').val(data.gialk);
                $('#gia').val(data.gia);
                $('#ghichu').val(data.ghichu);
                $('#id').val(data.id);
            },
            error: function (message) {
                toastr.error(message, 'Lỗi!');
            }
        });
    }

    function updatets(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/tonghop/update_ct',
            type: 'post',
            data: {
                _token: CSRF_TOKEN,
                id: $('#id').val(),
                nguontt: $('#nguontt').val(),
                loaigia: $('#loaigia').val(),
                gialk: $('#gialk').val(),
                gia: $('#gia').val(),
                ghichu: $('#ghichu').val(),
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'success') {
                    toastr.success("Chỉnh sửa thông tin hàng hóa dịch vụ thành công", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });
                    $('#modal-edit').modal("hide");

                }else
                    toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
            }
        })
    }
</script>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Kê khai giá thị trường </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Mã hàng hóa </label>
                            {!!Form::select('', $a_dm, null, array('id' => 'mahhdv','class' => 'form-control select2me', 'disabled'=>'disabled'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Loại giá</label>
                            <select class="form-control" id="loaigia" name="loaigia">
                                <option value="Giá bán buôn">Giá bán buôn</option>
                                <option value="Giá bán lẻ">Giá bán lẻ</option>
                                <option value="Giá kê khai">Giá kê khai</option>
                                <option value="Giá đăng ký">Giá đăng ký</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Giá kỳ trước</label>
                            <input type="text" name="gialk" id="gialk" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Giá kỳ này</label>
                            <input type="text" name="gia" id="gia" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Nguồn thông tin</label>
                            <select class="form-control" id="nguontt" name="nguontt">
                                <option value="Do trực tiếp điều tra, thu thập">Do trực tiếp điều tra, thu thập</option>
                                <option value="Hợp đồng mua tin">Hợp đồng mua tin</option>
                                <option value="Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định">Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định</option>
                                <option value="Từ thống kê đăng ký giá, kê khai giá, thông báo giá của doanh nghiệp">Từ thống kê đăng ký giá, kê khai giá, thông báo giá của doanh nghiệp</option>
                                <option value="Các nguồn thông tin khác">Các nguồn thông tin khác</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <input type="text" id="ghichu" name="ghichu" class="form-control">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id" name="id">
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

<div class="modal fade" id="modal-importexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nhận dữ liệu từ file excel</h4>
            </div>
            {!! Form::open(['url'=>$inputs['url'].'/tonghop/import_excel', 'method'=>'post' , 'files'=>true, 'id' => 'frm_importexcel','enctype'=>'multipart/form-data','files'=>true]) !!}
            <!-- Gán các trường giá trị để cho các trường hợp chưa lưu hồ sơ -->
            <input type="hidden" name="mahs" value="{{$model->mahs}}">            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Mã hàng hóa<span class="require">*</span></label>
                            {!!Form::text('mahhdv', 'B', array('id' => 'mahhdv','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Loại giá<span class="require">*</span></label>
                            {!!Form::text('loaigia', 'F', array('id' => 'loaigia','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Giá liền kề<span class="require">*</span></label>
                            {!!Form::text('gialk', 'G', array('id' => 'gialk','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Giá kê khai<span class="require">*</span></label>
                            {!!Form::text('gia', 'H', array('id' => 'gia','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Nguồn thông tin<span class="require">*</span></label>
                            {!!Form::text('nguontt', 'K', array('id' => 'nguontt','class' => 'form-control required'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Từ dòng<span class="require">*</span></label>
                            {!!Form::text('tudong', '4', array('id' => 'tudong','class' => 'form-control required','data-mask'=>'fdecimal'))!!}
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đến dòng</label>
                            {!!Form::text('dendong', '300', array('id' => 'dendong','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">File dữ liệu mẫu<span class="require">*</span></label>
                            <input id="fexcel" name="fexcel" type="file"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
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
    function setValExl() {
        var form = $('#frm_importexcel');
        form.find("[name='soqd']").val($('#soqd').val());
        form.find("[name='thoidiem']").val($('#thoidiem').val());
        form.find("[name='soqdlk']").val($('#soqdlk').val());
        form.find("[name='thoidiemlk']").val($('#thoidiemlk').val());
    }
    </script>