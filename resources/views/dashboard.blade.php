@extends('main')

@section('custom-style')
    <style type="text/css">
        table, p {
        }
        table tr td:first-child {
            text-align: center;
        }
        td, th {
            padding: 10px;
        }
    </style>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
    </script>
@stop

@section('content')
    @include('thongke')
    <h3 class="page-title">
        Thông tin hỗ trợ<small></small>
    </h3>
    @include('supports')
@stop