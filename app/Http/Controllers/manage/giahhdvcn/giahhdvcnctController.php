<?php

namespace App\Http\Controllers\manage\giahhdvcn;

use App\Model\manage\dinhgia\giahhdvcn\giahhdvcnct;
use App\Model\manage\dinhgia\giahhdvcn\giahhdvcndm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giahhdvcnctController extends Controller
{
    public function store(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $inputs['dongia'] = getMoneyToDb($inputs['dongia']);
        $inputs['trangthai'] = 'CXD';
        $m_chk = giahhdvcnct::where('maspdv',$inputs['maspdv'])->where('mahs',$inputs['mahs'])->first();
        if($m_chk == null){
            giahhdvcnct::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = giahhdvcnct::where('mahs',$inputs['mahs'])->get();
        $result = $this->return_spdv($model);
        die(json_encode($result));
    }

    public function show(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $id = $inputs['id'];
        $model = giahhdvcnct::findOrFail($id);
        die($model);
    }

    public function destroy(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        giahhdvcnct::where('id',$inputs['id'])->first();
        $model = giahhdvcnct::where('mahs',$inputs['mahs'])->get();
        $result = $this->return_spdv($model);
        die(json_encode($result));
    }

    public function return_spdv($model)
    {
        $result = array(
            'status' => 'success',
            'message' => 'error',
        );


        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="5%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Mô tả</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Mức giá</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            $a_dm = array_column( giahhdvcndm::all()->toArray(), 'tenspdv','maspdv');
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr id="' . $tents->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td class="active" style="font-weight: bold">' . $a_dm[$tents->maspdv] . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->dongia) . '</td>';
                $result['message'] .= '<td>' .
                    '<button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem(' . $tents->id . ');"><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
                    '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tents->id . ')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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
