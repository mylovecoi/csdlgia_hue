@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--Date-->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <!--End Date-->

@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>


    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>

    <!--Date>
    <script type="text/javascript" src="{{ url('js/jquery-1.10.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>

    <End Date-->
    <!--Date new-->
    <!--script src="{{url('minhtran/jquery.min.js')}}"></script-->
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(":input").inputmask();
        });
    </script>
    <!--End date new-->

    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
        function InputMask(){
            //$(function(){
            // Input Mask
            if($.isFunction($.fn.inputmask))
            {
                $("[data-mask]").each(function(i, el)
                {
                    var $this = $(el),
                            mask = $this.data('mask').toString(),
                            opts = {
                                numericInput: attrDefault($this, 'numeric', false),
                                radixPoint: attrDefault($this, 'radixPoint', ''),
                                rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
                            },
                            placeholder = attrDefault($this, 'placeholder', ''),
                            is_regex = attrDefault($this, 'isRegex', '');


                    if(placeholder.length)
                    {
                        opts[placeholder] = placeholder;
                    }

                    switch(mask.toLowerCase())
                    {
                        case "phone":
                            mask = "(999) 999-9999";
                            break;

                        case "currency":
                        case "rcurrency":

                            var sign = attrDefault($this, 'sign', '$');;

                            mask = "999,999,999.99";

                            if($this.data('mask').toLowerCase() == 'rcurrency')
                            {
                                mask += ' ' + sign;
                            }
                            else
                            {
                                mask = sign + ' ' + mask;
                            }

                            opts.numericInput = true;
                            opts.rightAlignNumerics = false;
                            opts.radixPoint = '.';
                            break;

                        case "email":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
                            break;

                        case "fdecimal":
                            mask = 'decimal';
                            $.extend(opts, {
                                autoGroup		: true,
                                groupSize		: 3,
                                radixPoint		: attrDefault($this, 'rad', '.'),
                                groupSeparator	: attrDefault($this, 'dec', ',')
                            });
                    }

                    if(is_regex)
                    {
                        opts.regex = mask;
                        mask = 'Regex';
                    }

                    $this.inputmask(mask, opts);
                });
            }
            //});
        }

        // </editor-fold>
    </script>
    <script>
        function clearForm(){
            $('#tthhdv').val('');
            $('#qccl').val('');
            $('#dvt').val('');
            $('#dongialk').val('');
            $('#dongia').val('');
            $('#ghichu').val('');

        }
        function createttp(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/giadvdlbbct/storett',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    tthhdv: $('#tthhdv').val(),
                    qccl: $('#qccl').val(),
                    dvt: $('#dvt').val(),
                    dongialk: $('#dongialk').val(),
                    dongia: $('#dongia').val(),
                    ghichu: $('#ghichu').val(),
                    mahs: $('input[name="mahs"]').val(),
                    maxa: $('input[name="maxa"]').val(),
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
        function editTtPh(maso) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/giadvdlbbct/edittt',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: maso
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttpedit').replaceWith(data.message);
                        InputMask();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin!", "Lỗi!");
                }
            })
        }

        function updatets() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/giadvdlbbct/updatett',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="idedit"]').val(),
                    tthhdv: $('#tthhdvedit').val(),
                    qccl: $('#qccledit').val(),
                    dvt: $('#dvtedit').val(),
                    ghichu: $('#ghichuedit').val(),
                    dongia: $('#dongiaedit').val(),
                    dongialk: $('#dongialkedit').val(),
                    mahs: $('input[name="mahs"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Chỉnh sửa thông tin thành công", "Thành công!");
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
        function getid(id){
            document.getElementById("iddelete").value=id;
        }
        function deleteRow() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/giaxemaynksxct/deletett',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    mahs: $('input[name="mahs"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin thành công!", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });

                    $('#modal-delete').modal("hide");

                    //}
                }
            })

        }
    </script>
    <script>
        function InputMask() {
            //$(function(){
            // Input Mask
            if ($.isFunction($.fn.inputmask)) {
                $("[data-mask]").each(function (i, el) {
                    var $this = $(el),
                            mask = $this.data('mask').toString(),
                            opts = {
                                numericInput: attrDefault($this, 'numeric', false),
                                radixPoint: attrDefault($this, 'radixPoint', ''),
                                rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
                            },
                            placeholder = attrDefault($this, 'placeholder', ''),
                            is_regex = attrDefault($this, 'isRegex', '');


                    if (placeholder.length) {
                        opts[placeholder] = placeholder;
                    }

                    switch (mask.toLowerCase()) {
                        case "phone":
                            mask = "(999) 999-9999";
                            break;

                        case "currency":
                        case "rcurrency":

                            var sign = attrDefault($this, 'sign', '$');
                            ;

                            mask = "999,999,999.99";

                            if ($this.data('mask').toLowerCase() == 'rcurrency') {
                                mask += ' ' + sign;
                            }
                            else {
                                mask = sign + ' ' + mask;
                            }

                            opts.numericInput = true;
                            opts.rightAlignNumerics = false;
                            opts.radixPoint = '.';
                            break;

                        case "email":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
                            break;

                        case "fdecimal":
                            mask = 'decimal';
                            $.extend(opts, {
                                autoGroup: true,
                                groupSize: 3,
                                radixPoint: attrDefault($this, 'rad', '.'),
                                groupSeparator: attrDefault($this, 'dec', ',')
                            });
                    }

                    if (is_regex) {
                        opts.regex = mask;
                        mask = 'Regex';
                    }

                    $this.inputmask(mask, opts);
                });
            }
            //});
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin kê khai hồ sơ giá <small>&nbsp;dịch vụ du lịch tại bãi biển chỉnh sửa</small>
        <p><h5 style="color: blue">{{$modeldn->tendn}}&nbsp;- Mã số thuế: {{$modeldn->maxa}}</h5></p>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::model($model, ['method' => 'PATCH', 'url'=>'kekhaigiadvdlbb/'. $model->id, 'class'=>'horizontal-form','id'=>'update_kkgiavtxb']) !!}
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-body">
                    <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngaynhap" id="ngaynhap" class="form-control required" autofocus-->
                                {!!Form::text('ngaynhap',date('d/m/Y',  strtotime($model->ngaynhap)), array('id' => 'ngaynhap','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày thực hiện mức giá kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngayhieuluc" id="ngayhieuluc" class="form-control required"-->
                                {!!Form::text('ngayhieuluc',date('d/m/Y',  strtotime($model->ngayhieuluc)), array('id' => 'ngayhieuluc','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required','onchange'=>"checkngay()"))!!}
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số công văn<span class="require">*</span></label>
                                {!!Form::text('socv',null, array('id' => 'socv','class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số công văn liền kề</label>
                                {!!Form::text('socvlk',null, array('id' => 'socvlk','class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày nhập số công văn liền kề<span class="require">*</span></label>
                                {{-- {!!Form::text('ngaycvlk',$model->ngaycvlk != '' ? date('d/m/Y',  strtotime($model->ngaycvlk)) : '', array('id' => 'ngaycvlk','class' => 'form-control'))!!} --}}
                                {!! Form::input('date', 'ngaycvlk', $model->ngaycvlk != '' ? date('d/m/Y',  strtotime($model->ngaycvlk)) : '', array('id' => 'ngaycvlk', 'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label">Phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá tác động
                                    làm tăng hoặc giảm giá hàng hóa, dịch vụ thực hiện kê khai giá</label>
                                <div>
                                        <textarea id="ptnguyennhan" class="form-control" name="ptnguyennhan" cols="30" rows="5"
                                                >{{$model->ptnguyennhan}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label">Ghi rõ cách chính sách và mức khuyến mại, giảm giá hoặc chiết khấu đối với các đối
                                    tượng khách hàng, các Điều kiện vận chuyển, giao hàng, bán hàng kèm theo mức giá kê khai (nếu có)</label>
                                <div>
                                        <textarea id="chinhsachkm" class="form-control" name="chinhsachkm" cols="30" rows="5"
                                                >{{$model->chinhsachkm}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="mahs" id="mahs" value="{{$model->mahs}}">
                    <input type="hidden" name="maxa" id="maxa" value="{{$model->maxa}}">

                    <!--/row-->
                    <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()"><i class="fa fa-plus"></i>&nbsp;Kê khai bổ sung dịch vụ</button>
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="row" id="dsts">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th style="text-align: center" width="2%">STT</th>
                                    <th style="text-align: center">Tên Hàng hóa, dịch vụ</th>
                                    <th style="text-align: center">Quy cách chất lượng</th>
                                    <th style="text-align: center">Đơn vị<br>tính</th>
                                    <th style="text-align: center">Mức giá <br>liền kề</th>
                                    <th style="text-align: center">Mức giá <br>kê khai</th>
                                    <th style="text-align: center">Ghi chú</th>
                                    <th style="text-align: center" width="20%">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelct as $key=>$tt)
                                    <tr>
                                        <td style="text-align: center">{{($key +1)}}</td>
                                        <td class="active">{{$tt->tthhdv}}</td>
                                        <td style="text-align: left">{{$tt->qccl}}</td>
                                        <td style="text-align: center">{{$tt->dvt}}</td>
                                        <td style="text-align: right">{{number_format($tt->dongialk)}}</td>
                                        <td style="text-align: right">{{number_format($tt->dongia)}}</td>
                                        <td style="text-align: left">{{$tt->ghichu}}</td>
                                        <td>
                                            <button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>
                                            <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$tt->id}});" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
            <div style="text-align: center">
                <a href="{{url('kekhaigiadvdlbb?&masothue='.$model->maxa)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>

    <!--Validate Form-->
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#update_kkgiavtxb").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>



    <!--Modal kê khai giá-->
    <div class="modal fade" id="modal-kkgia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Kê khai giá hàng hoá</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal" id="ttkkgia">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="upkkgia()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-kkgialk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Kê khai giá hàng hoá kiền kề</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal" id="ttkkgialk">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="upkkgialk()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Model them moi ttp-->
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin dịch vụ- quy cách chất lượng</h4>
                </div>
                <div class="modal-body" id="ttpthemmoi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Tên Hàng hóa, dịch vụ</b></label>
                                {!!Form::textarea('tthhdv', null, array('id' => 'tthhdv','class' => 'form-control','rows'=>'3'))!!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Quy cách chất lượng dịch vụ</b></label>
                                {!!Form::textarea('qccl', null, array('id' => 'qccl','class' => 'form-control','rows'=>'3'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label"><b>Đơn vị tính</b><span class="require">*</span></label>
                                {!!Form::text('dvt', null, array('id' => 'dvt','class' => 'form-control','required'=>'required'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Giá liền kề</b><span class="require">*</span></label>
                                <div><input type="text" name="dongialk" id="dongialk" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Giá kê khai</b><span class="require">*</span></label>
                                <div><input type="text" name="dongia" id="dongia" class="form-control" data-mask="fdecimal" style="text-align: right;font-weight: bold"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Ghi chú</b></label>
                                {!!Form::textarea('ghichu', null, array('id' => 'ghichu','class' => 'form-control','rows'=>'2'))!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="createttp()">Bổ xung</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Modal chỉnh sửa ttp-->
    <div class="modal fade bs-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa thông tin mặt hàng, quy cách chất lượng</h4>
                </div>
                <div class="modal-body" id="ttpedit">
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
    <!--Modal Xoá-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa thông tin?</h4>
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

    @include('includes.script.create-header-scripts')


@stop