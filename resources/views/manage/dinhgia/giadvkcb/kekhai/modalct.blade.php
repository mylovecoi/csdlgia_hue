<script>
    function editItem(maso) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/edit_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: maso
            },
            dataType: 'JSON',
            success: function (data) {
                $('#mahhdv').val(data.mahhdv).trigger('change');
//                $('#gialk').val(Number.parseFloat(data.gialk).toFixed(3));
                $('#gialk').val(dinhdangso(data.gialk,3));
                $('#gia').val(dinhdangso(data.gia,3));
                $('#ghichu').val(data.ghichu);
                $('#nguontt').val(data.nguontt);
                $('#loaigia').val(data.loaigia);
                $('#id').val(data.id);
                InputMask();
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

    function setValExl() {
        var form = $('#frm_importexcel');
        form.find("[name='soqd']").val($('#soqd').val());
        form.find("[name='thoidiem']").val($('#thoidiem').val());
        form.find("[name='soqdlk']").val($('#soqdlk').val());
        form.find("[name='thoidiemlk']").val($('#thoidiemlk').val());
    }
</script>

<div class="modal fade" id="modal-importexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nhận dữ liệu từ file excel</h4>
            </div>
            {!! Form::open(['url'=>$inputs['url'].'/importexcel_chitiet', 'method'=>'post' , 'files'=>true, 'id' => 'frm_importexcel','enctype'=>'multipart/form-data','files'=>true]) !!}
            <!-- Gán các trường giá trị để cho các trường hợp chưa lưu hồ sơ -->
            <input type="hidden" name="mahs" value="{{$model->mahs}}">
            <input type="hidden" name="matt" value="{{$model->matt}}">
            <input type="hidden" name="madv" value="{{$model->madv}}">
            <input type="hidden" name="thang" value="{{$model->thang}}">
            <input type="hidden" name="nam" value="{{$model->nam}}">
            <input type="hidden" name="madiaban" value="{{$model->madiaban}}">
            <input type="hidden" name="soqd" />
            <input type="hidden" name="thoidiem" />
            <input type="hidden" name="soqdlk" />
            <input type="hidden" name="thoidiemlk" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Mã hàng hóa<span class="require">*</span></label>
                            {!!Form::text('mahhdv', 'C', array('id' => 'mahhdv','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Giá liền kề<span class="require">*</span></label>
                            {!!Form::text('gialk', 'H', array('id' => 'gialk','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Giá kê khai<span class="require">*</span></label>
                            {!!Form::text('gia', 'I', array('id' => 'gia','class' => 'form-control required'))!!}
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
                <button type="submit" class="btn blue" id="submitimex">Đồng ý</button>
                <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
            </div>
            {!! Form::close() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
