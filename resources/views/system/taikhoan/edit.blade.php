@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>

@stop

@section('content')


    <h3 class="page-title">
        Thông tin tài khoản <small>chỉnh sửa</small>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <!--div class="portlet-title">
                </div-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {!! Form::model($model,['url'=>'taikhoan/modify', 'id' => 'create_tttaikhoan', 'class'=>'horizontal-form', 'method'=>'post']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Đơn vị</label>
                                        {!!Form::select('madv', $a_donvi, null, array('id' => 'madv','class' => 'form-control', 'required'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên tài khoản<span class="require">*</span></label>
                                        {!!Form::text('name', null, array('id' => 'name','class' => 'form-control', 'required'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Trạng thái</label>
                                        {!! Form::select('status', array('Kích hoạt'=>'Kích hoạt','Vô hiệu'=>'Vô hiệu',),null, array('id'=>'status','class'=>'form-control'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Tài khoản truy cập<span class="require">*</span></label>
                                        {!!Form::text('username', null, array('id' => 'username','class' => 'form-control', 'readonly'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Mật khẩu mới</label>
                                        <input type="password" class="form-control"  name="password" id="password">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Nhập lại mật khẩu mới</label>
                                        <input type="password" class="form-control"  name="rpassword" id="rpassword">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <div id="hs">
                                <label class="control-label">Phân loại chức năng (Tài khoản không đồng thời có chức năng: Quản trị và Tổng hợp/Nhập liệu)</label>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-3">
                                        <div class="md-checkbox">
                                            <input type="checkbox" onchange="setTongHop()" {{$model->nhaplieu == 1 ? 'checked' : ''}} id="nhaplieu" name="nhaplieu" class="md-check">
                                            <label for="nhaplieu">
                                                <span></span><span class="check"></span><span class="box"></span>Nhập liệu</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="md-checkbox">
                                            <input type="checkbox" onchange="setTongHop()" {{$model->tonghop == 1 ? 'checked' : ''}} id="tonghop" name="tonghop" class="md-check">
                                            <label for="tonghop">
                                                <span></span><span class="check"></span><span class="box"></span>Tổng hợp</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="md-checkbox">
                                            <input type="checkbox" onchange="setQuanTri()" {{$model->quantri == 1 ? 'checked' : ''}} id="quantri" name="quantri" class="md-check">
                                            <label for="quantri">
                                                <span></span><span class="check"></span><span class="box"></span>Quản trị</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <!-- END FORM-->
                </div>

            </div>
            <div style="text-align: center">
                <a href="{{url('/taikhoan/danhsach?madv='.$model->madv)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function setQuanTri() {
            if(document.getElementById("quantri").checked){
                $('#tonghop').prop('checked', false);
                $('#nhaplieu').prop('checked', false);
            }
        }
        function setTongHop() {
            if(document.getElementById("tonghop").checked ||document.getElementById("nhaplieu").checked){
                $('#quantri').prop('checked', false);
            }
        }

        function validateForm() {
            var chk = true;
            var str = '';
            var password = $("#password").val();
            var rpassword = $("#rpassword").val();
            var patte = new RegExp("^(?=.*[A-Za-z@$!%*?&])(?=.*\\d)[A-Za-z@$!%*?&\\d]{6,}");//6 ký tự, 1 số, 1 chữ cái hoặc 1 ký tự đặc biệt

            // if(password != '' || rpassword != ''){
            //     if (patte.test(password) == false) {
            //         str = str + '\t Mật khẩu mới cần thỏa mãn: độ dài tối thiểu 06 ký tự; ít nhất 01 chữ số; ít nhất 01 chữ cái hoặc ký tự đặc biệt. \n';
            //         chk = false;
            //     }
            // }

            if(password.length > 0){
                if (patte.test(password) == false) {
                    str = str + '\t Mật khẩu mới cần thỏa mãn: độ dài tối thiểu 06 ký tự; ít nhất 01 chữ số; ít nhất 01 chữ cái hoặc ký tự đặc biệt. \n';
                    chk = false;
                }
            }

            if( password != rpassword){
                str = str + '\t Mật khẩu mới không trùng nhau \n';
                chk = false;
            }

            if (chk == false) {
                alert('Thông tin không hợp lệ: \n' + str);
                $("#create_tttaikhoan").submit(function (e) {
                    e.preventDefault();
                });
            } else {
                $("#create_tttaikhoan").unbind('submit').submit();
            }

            // var validator = $("#create_tttaikhoan").validate({
            //     rules: {
            //         name :"required",
            //         mahuyen :"required",
            //         username :"required",
            //         password :"required"
            //
            //     },
            //     messages: {
            //         name :"Chưa nhập dữ liệu",
            //         mahuyen :"Chưa nhập dữ liệu",
            //         username :"Chưa nhập dữ liệu",
            //         password :"Chưa nhập dữ liệu"
            //     }
            // });
        }
        // function validateForm(){
        //
        //     var validator = $("#create_tttaikhoan").validate({
        //         rules: {
        //             name :"required",
        //             mahuyen :"required",
        //             username :"required",
        //         },
        //         messages: {
        //             name :"Chưa nhập dữ liệu",
        //             mahuyen :"Chưa nhập dữ liệu",
        //             username :"Chưa nhập dữ liệu",
        //         }
        //     });
        // }
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="username"]').change(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'GET',
                    url: '/checktaikhoan',
                    data: {
                        _token: CSRF_TOKEN,
                        user:$(this).val()

                    },
                    success: function (respond) {
                        if(respond != 'ok'){
                            toastr.error("Bạn cần nhập tài khoản khác", "Tài khoản nhập vào đã tồn tại!!!");
                            $('input[name="username"]').val('');
                            $('input[name="username"]').focus();
                        }
                    }

                });
            })
        }(jQuery));
    </script>
@stop