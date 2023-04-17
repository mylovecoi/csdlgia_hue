<?php

namespace App\Http\Controllers\manage\kekhaigia;

use App\Town;
use App\TtDnTdCt;
use App\Model\system\dmnganhnghekd\DmNganhKd;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TtDnTdCtController extends Controller
{
    public function store(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        $inputs = $request->all();

        $check = TtDnTdCt::where('madv', $inputs['madv'])
            ->where('manghe', $inputs['manghe'])->first();
        if ($check == null) {
            $inputs['trangthai'] = 'CXD';
            $modelkkgia = new TtDnTdCt();
            $modelkkgia->create($inputs);

            $a_nghe = array_column(DmNgheKd::all()->toArray(), 'tennghe', 'manghe');
            $model = TtDnTdCt::where('madv', $inputs['madv'])->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="5%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Tên ngành nghề</th>';
            $result['message'] .= '<th width="10%" style="text-align: center">Thao tác</th>';
            $result['message'] .= '</thead>';
            $result['message'] .= '<tbody>';
            if (count($model) > 0) {
                foreach ($model as $key => $tt) {
                    $result['message'] .= '<tr id="' . $tt->id . '">';
                    $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                    $result['message'] .= '<td>' . $a_nghe[$tt->manghe] . '</td>';
                    $result['message'] .= '<td>' .
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
                        . '</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        } else {
            $result['message'] = '';
            $result['status'] = 'unsuccess';
        }


        die(json_encode($result));
    }

    public function delete(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        $inputs = $request->all();

        $modelkkgia = TtDnTdCt::where('id', $inputs['id'])->delete();

        $a_nghe = array_column(DmNgheKd::all()->toArray(), 'tennghe', 'manghe');
        $model = TtDnTdCt::where('madv', $inputs['madv'])->get();

        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="5%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Tên ngành nghề</th>';
        $result['message'] .= '<th width="10%" style="text-align: center">Thao tác</th>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody>';
        if (count($model) > 0) {
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr id="' . $tt->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td>' . $a_nghe[$tt->manghe] . '</td>';
                $result['message'] .= '<td>' .
                    '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
                    . '</td>';
                $result['message'] .= '</tr>';
            }
            $result['message'] .= '</tbody>';
            $result['message'] .= '</table>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['status'] = 'success';
        }

        die(json_encode($result));
    }
}
