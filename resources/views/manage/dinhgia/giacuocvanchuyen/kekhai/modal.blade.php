<div id="modal-modify" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['id' => 'frm_modify', 'class'=>'horizontal-form']) !!}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Thông tin chi tiết</h4>
            </div>
            <div class="modal-body" id="edit_node">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Loại hình vận chuyển</label>
                            {!!Form::select('phanloai', ['Đường bộ'=>'Đường bộ','Đường thủy'=>'Đường thủy',],null, array('class' => 'form-control', 'rows'=>'2'))!!}
                        </div>

                        <div class="col-md-8">
                            <label class="control-label">Tên hàng hóa</label>
                            {!!Form::text('tencuoc',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Bậc hàng hóa</label>
                            {!!Form::select('bachh', ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5',], null, array('class' => 'form-control'))!!}
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Từ km</label>
                            <input type="text" name="tukm" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Đến km</label>
                            <input type="text" name="denkm" id="giavt1" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label class="control-label">Đường loại I</label>
                            <input type="text" name="giavc1" id="giavc1" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Đường loại II</label>
                            <input type="text" name="giavc2" id="giavc2" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Đường loại III</label>
                            <input type="text" name="giavc3" id="giavc3" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Đường loại IV</label>
                            <input type="text" name="giavc4" id="giavc4" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Đường loại V</label>
                            <input type="text" name="giavc5" id="giavc5" class="form-control" data-mask="fdecimal" style="text-align: right; font-weight: bold">
                        </div>
                    </div>
                </div>


                <input type="hidden" name="madiaban" value="{{$model->madiaban}}">
                <input type="hidden" name="id">
                <input type="hidden" name="mahs" value="{{$model->mahs}}" >
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="button" class="btn btn-primary" onclick="capnhatts()">Hoàn thành</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['id' => 'frm_delete'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                <input type="hidden" name="id">

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="button" data-dismiss="modal" class="btn btn-primary" onclick="delrow()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<div class="modal fade" id="modal-importexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Nhận dữ liệu từ file excel</h4>
            </div>
            {!! Form::open(['url'=>$inputs['url'].'/importexcel', 'method'=>'post' , 'files'=>true, 'id' => 'frm_importexcel','enctype'=>'multipart/form-data','files'=>true]) !!}
            <input type="hidden" name="mahs" value="{{$model->mahs}}" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Loại hình<span class="require">*</span></label>
                            {!!Form::text('phanloai', 'B', array('class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tên hàng hóa<span class="require">*</span></label>
                            {!!Form::text('tencuoc', 'C', array('class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Bậc hàng hóa<span class="require">*</span></label>
                            {!!Form::text('bachh', 'D', array('class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Từ km<span class="require">*</span></label>
                            {!!Form::text('tukm', 'E', array('class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đến km</label>
                            {!!Form::text('denkm', 'F', array('class' => 'form-control required'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đường loại I<span class="require">*</span></label>
                            {!!Form::text('giavc1', 'G', array('class' => 'form-control required'))!!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đường loại II<span class="require">*</span></label>
                            {!!Form::text('giavc2', 'H', array('class' => 'form-control required'))!!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đường loại III<span class="require">*</span></label>
                            {!!Form::text('giavc3', 'I', array('class' => 'form-control required'))!!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đường loại IV<span class="require">*</span></label>
                            {!!Form::text('giavc4', 'J', array('id' => 'giavc4','class' => 'form-control required'))!!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Đường loại V<span class="require">*</span></label>
                            {!!Form::text('giavc5', 'K', array('class' => 'form-control required'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Từ dòng<span class="require">*</span></label>
                            {!!Form::text('tudong', '5', array('id' => 'tudong','class' => 'form-control required','data-mask'=>'fdecimal'))!!}
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
                <button type="submit" class="btn blue" onclick="ClickImportExcel()" id="submitimex">Đồng ý</button>
                <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
            </div>
            {!! Form::close() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="delete-mul-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['url'=>$inputs['url'].'/del_mulct','id' => 'frm_delete_mul'])!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true"
                        class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                <input type="hidden" name="mahs" value="{{$model->mahs}}">

            </div>
            <div class="modal-body">
                <p style="color: #0000FF">Bạn có chắc chắn muốn xóa tất cả chi tiết giá đất theo công bố.</p>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickdeletemul()">Đồng ý</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>


<script>
    function clearForm() {
        var form = $('#frm_modify');
        form.find("[name='id']").val(-1);
        InputMask();
    }

    function editItem(maso) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(id);
        $.ajax({
            url: '{{$inputs['url']}}' + '/edit_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: maso
            },
            dataType: 'JSON',
            success: function (data) {
                var form = $('#frm_modify');
                form.find("[name='phanloai']").val(data.phanloai).trigger('change');
                form.find("[name='bachh']").val(data.bachh).trigger('change');
                form.find("[name='tencuoc']").val(data.tencuoc);
                form.find("[name='tukm']").val(data.tukm);
                form.find("[name='denkm']").val(data.denkm);
                form.find("[name='giavc1']").val(data.giavc1);
                form.find("[name='giavc2']").val(data.giavc2);
                form.find("[name='giavc3']").val(data.giavc3);
                form.find("[name='giavc4']").val(data.giavc4);
                form.find("[name='giavc5']").val(data.giavc5);
                form.find("[name='id']").val(data.id);
                InputMask();
            }
        })
    }


    function clickdeletemul(){
        $('#frm_delete_mul').submit();
    }

    function capnhatts(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var form = $('#frm_modify');
        $.ajax({
            url: '{{$inputs['url']}}' + '/store_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                mahs: $('#mahs').val(),
                phanloai: form.find("[name='phanloai']").val(),
                bachh: form.find("[name='bachh']").val(),
                tencuoc: form.find("[name='tencuoc']").val(),
                tukm: form.find("[name='tukm']").val(),
                denkm: form.find("[name='denkm']").val(),
                giavc1: form.find("[name='giavc1']").val(),
                giavc2: form.find("[name='giavc2']").val(),
                giavc3: form.find("[name='giavc3']").val(),
                giavc4: form.find("[name='giavc4']").val(),
                giavc5: form.find("[name='giavc5']").val(),
                id: form.find("[name='id']").val(),
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'success') {
                    toastr.success("Cập nhật thông tin thuê tài sản công thành công", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });
                    $('#modal-modify').modal("hide");
                }
                else
                    toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
            }
        })
    }

    function getid(id){
        $('#frm_delete').find("[name='id']").val(id);
    }

    function delrow(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$inputs['url']}}' + '/del_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: $('#frm_delete').find("[name='id']").val(),
                mahs:$('#mahs').val(),
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