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
        $inputs['mucthutu'] = getMoneyToDb($inputs['mucthutu']);
        $inputs['mucthuden'] = getMoneyToDb($inputs['mucthuden']);
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
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Tên phí</th>';
        $result['message'] .= '<th style="text-align: center">Mức thu từ</th>';
        $result['message'] .= '<th style="text-align: center">Mức thu đến</th>';
        $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';


        $result['message'] .= '<tbody>';
        if (count($model) > 0) {
            foreach ($model as $key => $ttbog) {
                $result['message'] .= '<tr id="' . $ttbog->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td>' . $ttbog->ptcp . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold;">' . number_format($ttbog->mucthutu) . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold;">' . number_format($ttbog->mucthuden) . '</td>';
                $result['message'] .= '<td>' . $ttbog->ghichu . '</td>';
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
        }
        return $result;
    }
}
