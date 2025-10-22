@extends('main')

@section('custom-style')

@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <!--cript src="{{url('assets/admin/pages/scripts/form-validation.js')}}"></script-->

@stop

@section('content')
    <h3 class="page-title">
        Thông tin đơn vị <small> thêm mới</small>
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
                    {!! Form::model($model,['url'=>'/donvi/update', 'id' => 'create', 'class'=>'horizontal-form']) !!}
                        <input type="hidden" name="madv" value="{{$model->madv}}" />
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Mã quan hệ ngân sách</label>
                                        {!!Form::text('maqhns', null, array('id' => 'maqhns','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Tên đơn vị<span class="require">*</span></label>
                                        {!!Form::text('tendv', null, array('id' => 'tendv','class' => 'form-control', 'required'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Tên đơn vị hiển thị báo cáo<span class="require">*</span></label>
                                        {!!Form::text('tendvhienthi', null, array('id' => 'tendvhienthi','class' => 'form-control', 'required'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Tên đơn vị cấp trên</label>
                                        {!!Form::text('tendvcqhienthi', null, array('id' => 'tendvcqhienthi','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ trụ sở</label>
                                        {!!Form::text('diachi', null, array('id' => 'diachi','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Địa danh</label>
                                        {!!Form::text('diadanh', null, array('id' => 'didanh','class' => 'form-control'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Chức vụ người ký</label>
                                        {!!Form::text('chucvuky', null, array('id' => 'chucvuky','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Họ và tên người ký</label>
                                        {!!Form::text('nguoiky', null, array('id' => 'nguoiky','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Chức vụ người ký thay</label>
                                        {!!Form::text('chucvukythay', null, array('id' => 'chucvukythay','class' => 'form-control'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Địa bàn quản lý</label>
                                        {!! Form::select('madiaban', $a_diaban, null, array('id'=>'madiaban','class'=>'form-control'))!!}
                                    </div>
                                </div>

                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label class="control-label">Phân loại đơn vị</label>
                                       {!! Form::select('chucnang', $a_phanloai, null, array('id'=>'chucnang','class'=>'form-control'))!!}
                                   </div>
                               </div>
                            </div>


                            <div id="quanly" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Email quản lý</label>
                                        {!!Form::text('emailql', null, array('id' => 'emailql','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Email quản trị</label>
                                        {!!Form::text('emailqt', null, array('id' => 'emailqt','class' => 'form-control'))!!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Số ngày làm việc</label>
                                        {!! Form::select('songaylv', array(
                                        '1'=>'1','2'=>'2','3'=>'3','4'=>'4',
                                        '5'=>'5','6'=>'6','7'=>'7',
                                        ),null, array('id'=>'songaylv','class'=>'form-control'))!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Thông tin liên hệ </label>
                                        {!!Form::textarea('ttlienhe', null, array('id' => 'ttlienhe','class' => 'form-control','rows'=>'2' ))!!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div style="text-align: center">
                <a href="{{url('/donvi/danhsach?madiaban='.$model->madiaban)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="submit" class="btn green"><i class="fa fa-check"></i> Hoàn thành</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create_town").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>
    <script>
        $('input[name="username"]').change(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'GET',
                url: '/ajax/checkusername',
                data: {
                    _token: CSRF_TOKEN,
                    username:$(this).val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status != 'success') {
                        toastr.error("Bạn cần nhập lại username", "Username nhập vào đã tồn tại!!!");
                        $('input[name="username"]').val('');
                        $('input[name="username"]').focus();
                    }else
                        toastr.success("Username sử dụng được!", "Thành công!");
                }

            });
        });
        $(function(){
            $('#chucnang').change(function(){
                if($(this).val() == 'TONGHOP'){
                    $('#quanly').show();
                }else{
                    $('#quanly').hide();
                }
            });
        });
    </script>
    @include('includes.script.create-header-scripts')
@stop