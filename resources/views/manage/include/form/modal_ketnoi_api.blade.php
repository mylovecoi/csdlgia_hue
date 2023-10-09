<div id="ketnoiapi-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url' => '/KetNoiAPI/TruyenHoSo', 'id' => 'frm_ketnoiapi']) !!}
    <input type="hidden" name="mahs" />
    <input type="hidden" name="chucnang" />
    <input type="hidden" name="url" />

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Truyền thông tin hồ sơ lên Cơ sở dữ liệu Quốc
                    gia </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Link API xác thực<span class="require">*</span>:</label>
                            {!! Form::text('linkAPIXacthuc', session('admin')->linkAPIXacthuc, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                @switch(session('admin')->phanloaiketnoi)
                    @case('TAIKHOAN')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tài khoản đăng nhập <span class="require">*</span> </label>
                                    {!! Form::text('taikhoanketnoi', session('admin')->taikhoanketnoi, [
                                        'id' => 'taikhoanketnoi',
                                        'class' => 'form-control',
                                        'required',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="control-label">Mật khẩu <span class="require">*</span> </label>
                                    <input id="matkhauketnoi" value="{{ session('admin')->taikhoanketnoi }}"
                                        class="form-control" required name="matkhauketnoi" type="password" />
                                    <span class="input-group-btn">
                                        <button style="margin-top: 25px" onclick="AnHienMatKhau('matkhauketnoi')"
                                            class="btn blue" type="button"><i class="fa fa-eye"></i></button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </div>

                        </div>
                    @break

                    @case('TOKEN')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mã AccessKey<span class="require">*</span>: </label>
                                    {!! Form::text('accesskey', session('admin')->accesskey, [
                                        'class' => 'form-control',
                                        'required',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mã SecretKey<span class="require">*</span>: </label>
                                    {!! Form::text('secretkey', session('admin')->secretkey, [
                                        'class' => 'form-control',
                                        'required',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    @break

                    @case('CHUOIKETNOI')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Chuỗi xác thực đăng nhập <span class="require">*</span></label>
                                    {!! Form::text('token_ketnoi', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    @break
                @endswitch


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Link API kết nối <span class="require">*</span></label>
                            {!! Form::text('linkTruyenPost', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Đồng ý</button>
                <button type="button" data-dismiss="modal" class="btn btn-default">Đóng</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    function ketnoiapi(mahs, chucnang, url) {
        $('#frm_ketnoiapi').find('[name="mahs"]').val(mahs);
        $('#frm_ketnoiapi').find('[name="chucnang"]').val(chucnang);
        $('#frm_ketnoiapi').find('[name="url"]').val(url);
        //Làm js lấy link kết nôi (viết dùng chung)
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(id);
        $.ajax({
            url: '/KetNoiAPI/getLink',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                maso: chucnang
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                $('#frm_ketnoiapi').find("[name='linkTruyenPost']").val(data.linkTruyenPost);
            }
        })
    }

    function AnHienMatKhau(name) {
        const elem = document.getElementById(name);
        var type = elem.type;
        if (elem.type == 'password')
            elem.type = 'text';
        else
            elem.type = 'password';
    }
</script>
