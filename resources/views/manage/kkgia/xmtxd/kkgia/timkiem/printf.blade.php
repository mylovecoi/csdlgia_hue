<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$pageTitle}}</title>
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
    <style type="text/css">
        body {
            font: normal 14px/16px time, serif;
        }
        table, p {
            width: 98%;
            margin: auto;
        }
        table tr td:first-child {
            text-align: center;
        }
        td, th {
            padding: 10px;
        }
        p{
            padding: 5px;
        }
        tr{
            padding: 20px;
        }
        span {
            text-transform: uppercase;
            font-weight: bold;
        }
        @media print {
            .in{
                display: none !important;
            }
        }
    </style>
</head>



<body style="font:normal 14px Times, serif;">

@extends('reports.main_rps')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-body">
                <div class="row">
                    <div class="portlet-body form" id="form_wizard">
                        <div class="form-body">
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <h2 class="page-title" style="text-align: center;text-transform: uppercase">
                                    Tìm kiếm thông tin kê khai giá xi măng thép xây dựng
                                </h2>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="portlet-body">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" border="1" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr>
                                <th style="text-align: center ; margin: auto" width="2%">STT</th>
                                <th style="text-align: center" width="20%">Doanh nghiệp</th>
                                <th style="text-align: center" width="8%">Ngày thực hiện<br>mức giá</th>
                                <th style="text-align: center" >Mô tả</th>
                                <th style="text-align: center" >Quy cách chất lượng</th>
                                <th style="text-align: center" >Đơn vị tính</th>
                                <th style="text-align: center" >Mức giá kê khai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $key=>$tt)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td class="active"><b>Tên DN: </b> {{$tt->tendn}}
                                        <br><b>Mã số thuế:</b> {{$tt->madv}}</td>
                                    <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                    <td style="text-align: left">{{$tt->tendvcu}}</td>
                                    <td style="text-align: left">{{$tt->qccl}}</td>
                                    <td style="text-align: left">{{$tt->dvt}}</td>
                                    <td style="text-align: right;font-weight: bold">{{number_format($tt->giakk)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop