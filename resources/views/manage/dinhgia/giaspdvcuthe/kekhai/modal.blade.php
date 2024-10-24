<div id="modal-modify" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    {!! Form::open(['id' => 'frm_modify', 'class'=>'horizontal-form']) !!}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-header-primary-label" class="modal-title">Thông tin chi tiết</h4>
            </div>
            <div class="modal-body" id="edit_node">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @include('manage.include.form.phanloaidv.input_phanloaidv')
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Tên sản phẩm, dịch vụ</label>
                            {!!Form::text('mota',null, array('class' => 'form-control', 'rows'=>'2'))!!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            @include('manage.include.form.input_dvt')
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mức giá</label>
                            <input type="text" name="mucgia" class="form-control" data-mask="fdecimal">
                        </div>
                    </div>
                </div>

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
                // form.find("[name='phanloaidv']").val(data.phanloaidv).trigger('change');
                form.find("[name='mota']").val(data.mota);
                // form.find("[name='dvt']").val(data.dvt);
                form.find("[name='mucgia']").val(data.mucgia);
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
                // phanloaidv: form.find("[name='phanloaidv']").val(),
                mota: form.find("[name='mota']").val(),
                // dvt: form.find("[name='dvt']").val(),
                mucgia: form.find("[name='mucgia']").val(),
                id: form.find("[name='id']").val(),
            },
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'success') {
                    $('#modal-modify').modal("hide");
                    toastr.success("Cập nhật thông tin thành công", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });
                    //$('#modal-create').modal("hide");
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