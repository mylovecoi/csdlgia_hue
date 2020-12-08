@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            function changeUrl() {
                var current_path_url = '{{$inputs['url']}}' + '/dmdonvi?';
                var url = current_path_url + 'madv=' + $('#madv').val() + '&matt=' + $('#matt').val();
                window.location.href = url;
            }

            $('#madv').change(function() {
                changeUrl();
            });

            $('#matt').change(function() {
                changeUrl();
            });

        });
        var a_hh = new Array();

        function arrayRemove(arr, value) {
            return arr.filter(function(ele){
                return ele != value;
            });
        }

        function setMaSo(obj) {
            //alert(a_hh);
            if(obj.checked){
                if(!a_hh.includes(obj.value)){
                    a_hh.push(obj.value)
                }
            }else{
                if(a_hh.includes(obj.value)){
                    a_hh = arrayRemove(a_hh,obj.value)
                }
            }
            //alert(a_hh);
        }

        function setMaHHAll() {
            $('#btn_addall').hide();
            $('#btn_add').hide();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$inputs['url']}}' + '/add_dmdonvi',
                type: 'get',
                data: {
                    _token: CSRF_TOKEN,
                    madv: '{{$inputs['madv']}}',
                    matt: '{{$inputs['matt']}}',
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        location.reload();
                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })

        }

        function setMaHH() {
            if (a_hh.length > 0) {
                $('#btn_addall').hide();
                $('#btn_add').hide();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{$inputs['url']}}' + '/add_dmdonvi',
                    type: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                        a_hh: a_hh,
                        madv: '{{$inputs['madv']}}',
                        matt: '{{$inputs['matt']}}',
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'success') {
                            location.reload();
                        } else
                            toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                    }
                })
            } else {
                toastr.error("Bạn cần chọn hàng hóa, dịch vụ để thêm vào danh mục.", "Lỗi!");
            }

        }

        function getId(id){
            $('#frm_delete').find("[id='id']").val(id);
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Danh mục hàng hóa, dịch vụ<small> theo đơn vị</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'danhmuc', 'modify'))
                            <button type="button" class="btn btn-default btn-xs mbs" data-target="#modal-create" data-toggle="modal">
                                <i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="portlet-body form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label style="font-weight: bold">Đơn vị</label>
                                <select class="form-control select2me" id="madv">
                                    @foreach($m_diaban as $diaban)
                                        <optgroup label="{{$diaban->tendiaban}}">
                                            <?php $donvi = $m_donvi->where('madiaban',$diaban->madiaban); ?>
                                            @foreach($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label style="font-weight: bold">Thông tư, quyết định</label>
                                {!!Form::select('matt', $a_thongtu, $inputs['matt'], array('id' => 'matt','class' => 'form-control select2me'))!!}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="sample_4">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Mã số</th>
                            <th style="text-align: center">Tên hàng hóa dịch vụ</th>
                            <th style="text-align: center">Đặc điểm kỹ thuật</th>
                            <th style="text-align: center">Đơn vị<br>tính</th>
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($model as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$i++}}</td>
                                <td>{{$tt->mahhdv}}</td>
                                <td class="success" style="font-weight: bold">{{$tt->tenhhdv}}</td>
                                <td>{{$tt->dacdiemkt}}</td>
                                <td style="text-align: center">{{$tt->dvt}}</td>
                                <td>
                                    @if(chkPer('csdlmucgiahhdv','hhdv', 'giahhdvk', 'danhmuc', 'modify'))
                                        <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal" style="margin: 2px">
                                            <i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <!-- END EXAMPLE TABLE PORTLET-->
    </div>


    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin hàng hóa, dịch vụ</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Mã số</th>
                            <th style="text-align: center">Tên hàng hóa dịch vụ</th>
                            <th style="text-align: center">Đặc điểm kỹ thuật</th>
                            <th style="text-align: center">Đơn vị<br>tính</th>
                            <th style="text-align: center" width="15%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($m_hanghoa as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$i++}}</td>
                                <td>{{$tt->mahhdv}}</td>
                                <td class="success" style="font-weight: bold">{{$tt->tenhhdv}}</td>
                                <td>{{$tt->dacdiemkt}}</td>
                                <td style="text-align: center">{{$tt->dvt}}</td>
                                <td class="text-center">
                                    <input type="checkbox" value="{{$tt->mahhdv}}" onclick="setMaSo(this)" />
{{--                                    <input type="checkbox" onclick="setMaSo('{{$tt->mahhdv}}')" />--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button id="btn_addall" type="button" onclick="setMaHHAll()" class="btn blue">Thêm tất cả</button>
                    <button id="btn_add" type="button" onclick="setMaHH()" class="btn blue">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>$inputs['url'].'/delete_dmdonvi','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop