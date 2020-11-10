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

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Địa bàn kinh doanh</label>
                            <select class="form-control select2me" id="diabankinhdoanh" name="diabankinhdoanh">
                                <option value="all">-Chọn địa bàn kinh doanh--</option>
                                @foreach($m_diaban as $diaban)
                                    <option value="{{$diaban->madiaban}}">{{$diaban->tendiaban}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Đơn vị nhận hồ sơ</label>
                            <select class="form-control select2me" id="macqcq" name="macqcq">
                                <option value="all">-Chọn đơn vị nhận hồ sơ--</option>
                                @foreach($m_diaban as $diaban)
                                    <optgroup label="{{$diaban->tendiaban}}">
                                        <?php $donvi = $m_donvi->where('madiaban',$diaban->madiaban); ?>
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
    function get_dvtonghop() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'GET',
            url: '/ajax/get_dvtonghop_diaban',
            data: {
                _token: CSRF_TOKEN,
                madiaban: $('#diabankinhdoanh').val(),
                manghe: $('#manghe').val()
            },
            dataType: 'JSON',
            success: function (data) {
                $('#macqcq').replaceWith(data.message);
                // if (data.status == 'success'){
                //     toastr.success("Mã số thuế sử dụng được!", "Thành công!");
                // }else{
                //     toastr.error("Bạn cần nhập lại mã số thuế", "Mã số thuế nhập vào đã tồn tại hoặc đã được đăng ký!!!");
                //     $('input[name="madv"]').val('');
                //     $('input[name="madv"]').focus();
                // }

            }
        });
    }

    $('#manghe').change(function () {
        get_dvtonghop();
    });

    $('#diabankinhdoanh').change(function(){
        get_dvtonghop();
    });

    $('#madv').change(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'GET',
            url: '/ajax/checkmasothue',
            data: {
                _token: CSRF_TOKEN,
                madv:$(this).val()
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'success'){
                    toastr.success("Mã số thuế sử dụng được!", "Thành công!");
                }else{
                    toastr.error("Bạn cần nhập lại mã số thuế", "Mã số thuế nhập vào đã tồn tại hoặc đã được đăng ký!!!");
                    $('input[name="madv"]').val('');
                    $('input[name="madv"]').focus();
                }

            }
        });
    });

    $('#username').change(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'GET',
            url: '/ajax/checkuser',
            data: {
                _token: CSRF_TOKEN,
                username:$(this).val()
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'success')
                    toastr.success("Tài khoản đăng ký sử dụng được!", "Thành công!");
                else {
                    toastr.error("Bạn cần nhập lại tài khoản đăng ký", "Tài khoản đăng ký nhập vào đã tồn tại hoặc đã được đăng ký!!!");
                    $('input[name="username"]').val('');
                    $('#username').focus();
                }
            }

        });
    });

    function add_lvkd() {
        if ($('#madv').val() == '' || $('#madv').val() == null) {
            toastr.error('Mã số thuế không được bỏ trống.', 'Lỗi mã số thuế');
            $('#madv').focus();
        } else {
            var mahs = $('#mahs').val();
            if (mahs == '{{$inputs['mahs']}}') {//tạo lại mã hồ sơ do có trường hợp trùng thời gian
                $('#mahs').val(mahs + '_' + $('#madv').val());
            }
            $('#modal-create').modal("show");
        }

    }

    {{--$('#manghe').change(function () {--}}
    {{--    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}
    {{--    $.ajax({--}}
    {{--        type: 'GET',--}}
    {{--        url: '{{$inputs['url']}}' +'/get_dvql',--}}
    {{--        data: {--}}
    {{--            _token: CSRF_TOKEN,--}}
    {{--            manghe: $(this).val(),--}}

    {{--        },--}}
    {{--        dataType: 'JSON',--}}
    {{--        success: function (data) {--}}
    {{--            if (data.status == 'success')--}}
    {{--                $('#macqcq').replaceWith(data.message);--}}
    {{--        }--}}

    {{--    });--}}
    {{--});--}}

    function getDvQl(){

    }

    function capnhatts(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/store_lvkd',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                manghe: $('#manghe').val(),
                macqcq: $('#macqcq').val(),
                mahs: $('#mahs').val(),
                madv:$('#madv').val()
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
                }
            }
        })
    }

    function getidedit(manghe){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/edit_lvkd',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                manghe: manghe,
                mahs: $('#mahs').val()
            },
            dataType: 'JSON',
            success: function (data) {
                $('#macqcq').val(data.macqcq).trigger('change');
                $('#manghe').val(data.manghe).trigger('change');
                //alert(data.macqcq);
            }
        })
    }


    function getid(id){
        document.getElementById("iddelete").value=id;
    }
    function deleteRow() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/delete_lvkd',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: $('input[name="iddelete"]').val()
            },
            dataType: 'JSON',
            success: function (data) {
                toastr.success("Bạn đã xóa thông tin thành công!", "Thành công!");
                $('#dsts').replaceWith(data.message);
                jQuery(document).ready(function () {
                    TableManaged.init();
                });
                $('#modal-delete').modal("hide");
            }
        })
    }
</script>