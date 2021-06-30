<?php

namespace App\Http\Controllers;

use App\PhiLePhiCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PhiLePhiCtController extends Controller
{
    public function store(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'permission denied',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        $inputs['mucthutu'] = chkDbl($inputs['mucthutu']);
        $inputs['mucthuden'] = chkDbl($inputs['mucthuden']);
        $m_chk = PhiLePhiCt::where('id',$inputs['id'])->first();
        if($m_chk == null){
            unset($inputs['id']);
            PhiLePhiCt::create($inputs);
        }else{
            $m_chk->update($inputs);
        }

        $result = $this->return_html($inputs, $result);
        $result['status'] = 'success';
        die(json_encode($result));
    }

    public function show(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();
        $model = PhiLePhiCt::findOrFail($inputs['id']);
        die($model);
    }

    public function destroy(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        if(isset($inputs['id'])){
            $modeladd = PhiLePhiCt::where('id',$inputs['id'])->first();
            $modeladd->delete();
            $result = $this->return_html($inputs, $result);
        }
        $result['status'] = 'success';
        die(json_encode($result));
    }

    /**
     * @param array $inputs
     * @param $result
     * @return mixed
     */
    public function return_html(array $inputs, $result)
    {
        $model = PhiLePhiCt::where('mahs', $inputs['mahs'])->get();
        $result['message'] = '<div class="row" id="dsmhbog">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr class="text-center">';
        $result['message'] .= '<th rowspan="2" width="5%">STT</th>';
        $result['message'] .= '<th rowspan="2">Phân loại</th>';
        $result['message'] .= '<th rowspan="2">Tên phí, lệ phí</th>';
        $result['message'] .= '<th rowspan="2">Phần<br>trăm</th>';
        $result['message'] .= '<th colspan="2">Mức thu</th>';

        $result['message'] .= '<th rowspan="2" width="15%">Thao tác</th>';
        $result['message'] .= '</tr>';

        $result['message'] .= '<tr class="text-center">';
        $result['message'] .= '<th>Từ</th>';
        $result['message'] .= '<th>Đến</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';

        $result['message'] .= '<tbody>';
        $i = 1;
        foreach ($model as $key => $ttbog) {
            $result['message'] .= '<tr>';
            $result['message'] .= '<td class="text-center">' . $i++ . '</td>';
            $result['message'] .= '<td>' . $ttbog->phanloai . '</td>';
            $result['message'] .= '<td>' . $ttbog->ptcp . '</td>';
            $result['message'] .= '<td class="text-center">' . $ttbog->phantram . '</td>';
            $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->mucthutu) . '</td>';
            $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->mucthuden) . '</td>';
            $result['message'] .= '<td>' .
                '<button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editmhbog(' . $ttbog->id . ');"><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
                '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $ttbog->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
                . '</td>';
            $result['message'] .= '</tr>';
        }
        $result['message'] .= '</tbody>';
        $result['message'] .= '</table>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';

        return $result;
    }
}
