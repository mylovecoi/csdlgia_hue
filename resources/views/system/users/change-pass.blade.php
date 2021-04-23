@extends('main')

@section('custom-style')

@stop


@section('custom-script')
{{--    <script type="text/javascript" src="{{url('vendors/jquery-validate/jquery.validate.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        jQuery(document).ready(function() {--}}
{{--            InputMask();--}}
{{--        });--}}
{{--    </script>--}}
@stop

@section('content')
    <h3 class="page-title">
        Quản lý thông tin tài khoản<small> thay đổi mật khẩu</small>
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
                    {!! Form::open(['url'=>'/change-password', 'id' => 'form-changepass', 'class'=>'form-horizontal form-validate']) !!}
                        <div class="form-body">

                            <div class="form-group">
                                <label for="current-password" class="col-sm-5 control-label">Mật khẩu cũ <span class="require">*</span></label>
                                <div class="col-sm-4">
                                    {!!Form::password('current-password', array('id' => 'current-password','class' => 'form-control', 'autofocus'))!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newpassword" class="col-sm-5 control-label">Mật khẩu mới <span class="require">*</span></label>
                                <div class="col-sm-4">
                                    {!!Form::password('newpassword', array('id' => 'newpassword','class' => 'form-control'))!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newpassword2" class="col-sm-5 control-label">Nhập lại mật khẩu mới <span class="require">*</span></label>
                                <div class="col-sm-4">
                                    {!!Form::password('newpassword2', array('id' => 'newpassword2','class' => 'form-control required'))!!}
                                </div>
                            </div>

                        </div>


                    <!-- END FORM-->
                </div>
            </div>
            <div style="text-align: center">
                <a href="{{url('/')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" onclick="validatePassword();" class="btn btn-primary">Cập nhật</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validatePassword(){
            var chk = true;
            var str = '';
            var password = $("#current-password").val();
            var newpassword = $("#newpassword").val();
            var newpassword2 = $("#newpassword2").val();
            if( password == '' || password == null){
                str = str + '\t Mật khẩu cũ không được bỏ trống \n';
                chk = false;
            }

            if( newpassword == '' || newpassword == null){
                str = str + '\t Mật khẩu mới không được bỏ trống \n';
                chk = false;
            }
            if(newpassword.length < 6){
                str = str + '\t Mật khẩu mới cần ít nhất 06 ký tự \n';
                chk = false;
            }

            if( newpassword != newpassword2){
                str = str + '\t Mật khẩu mới không trùng nhau \n';
                chk = false;
            }

            if ( chk == false){
                alert('Thông tin không hợp lệ: \n' + str);
                $("#form-changepass").submit(function (e) {
                    e.preventDefault();
                });
            }
            else{
                $("#form-changepass").unbind('submit').submit();
            }

            // var validator = $("#form-changepass").validate({
            //     rules: {
            //         email: {required:true, email: true},
            //         newpassword :{required:true, validator: "[a-zA-Z0-9._%-]{2,4}", },
            //         newpassword2:{
            //             equalTo: "#newpassword"
            //         }
            //     },
            //     messages: {
            //         email :" Địa chỉ email không hợp lệ.",
            //         newpassword :" Nhập mật khẩu mới không hợp lệ.",
            //         newpassword2 :" Nhập lại mật khẩu mới không chính xác"
            //     }
            // });
        }
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('input[name="current-password"]').change(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'GET',
                    url: '/checkpass',
                    data: {
                        _token: CSRF_TOKEN,
                        pass:$(this).val()

                    },
                    success: function (respond) {
                        if(respond != 'ok'){
                            toastr.error("Bạn cần nhập lại mật khẩu", "Mật khẩu nhập vào không đúng");
                            $('input[name="current-password"]').val('');
                            $('input[name="current-password"]').focus();
                        }
                    }

                });
            })
        }(jQuery));
    </script>

    @include('includes.script.inputmask-ajax-scripts')
    @include('includes.script.create-header-scripts')
@stop