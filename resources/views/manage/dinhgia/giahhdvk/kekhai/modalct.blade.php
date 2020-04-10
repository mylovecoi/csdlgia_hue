<script>
    function editItem(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/edit_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: id
            },
            dataType: 'JSON',
            success: function (data) {
                $('#mahhdv').val(data.mahhdv).trigger('change');
                $('#gialk').val(data.gialk);
                $('#gia').val(data.gia);
                $('#ghichu').val(data.ghichu);
                $('#nguontt').val(data.nguontt);
                $('#loaigia').val(data.loaigia);
                $('#id').val(data.id);
            },
            error: function (message) {
                toastr.error(message, 'Lỗi!');
            }
        });
    }

    function updatets(){
        //alert('vcl');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/update_ct',
            type: 'post',
            data: {
                _token: CSRF_TOKEN,
                id: $('#id').val(),
                dacdiemkt: $('#dacdiemkt').val(),
                dvt: $('#dvt').val(),
                gialk: $('#gialk').val(),
                gia: $('#gia').val(),
                loaigia: $('#loaigia').val(),
                nguontt: $('#nguontt').val(),
                ghichu: $('#ghichu').val(),
                mahs: $('#mahs').val(),
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
                            {!!Form::select('mahhdv', $a_dm, null, array('id' => 'mahhdv','class' => 'form-control select2me', 'disabled'=>'disabled'))!!}
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
                                <option value="Do trục tiếp điều tra, thu thập">Do trục tiếp điều tra, thu thập</option>
                                <option value="Hợp đồng mua tin">Hợp đồng mua tin</option>
                                <option value="Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định">Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định</option>
                                <option value="Từ thống kê đăng ký giá, kê khai giá, thông báo giá của doanh nghiệp">Từ thống kê đăng ký giá, kê khai giá, thông báo giá của doanh nghiệp</option>
                                <option value="Các nguồn thông tin khác">Các nguồn thông tin khác</option>
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