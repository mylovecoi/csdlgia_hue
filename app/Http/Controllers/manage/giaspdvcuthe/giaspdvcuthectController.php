<?php

namespace App\Http\Controllers\manage\giaspdvcuthe;

use App\Model\manage\dinhgia\giacuocvanchuyen\giacuocvanchuyenct;
use App\Model\manage\dinhgia\GiaDvGdDtCt;
use App\Model\manage\dinhgia\giadvgddtdm;
use App\Model\manage\dinhgia\giaspdvcuthe\giaspdvcuthe_ct;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giaspdvcuthectController extends Controller
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
        $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
        if (count($chk_dvt) == 0) {
            dmdvt::insert(['dvt' => $inputs['dvt']]);
        }

        $inputs['mucgia'] = getDoubleToDb($inputs['mucgia']);

        $m_chk = giaspdvcuthe_ct::where('id',$inputs['id'])->first();
        if($m_chk == null){
            unset($inputs['id']);
            giaspdvcuthe_ct::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = giaspdvcuthe_ct::where('mahs',$inputs['mahs'])->get();
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
        $model = giaspdvcuthe_ct::findOrFail($id);
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
        $chk = giaspdvcuthe_ct::where('id',$inputs['id'])->delete();
        $mahs = $chk->mahs;
        $chk->delete();
        $model = giacuocvanchuyenct::where('mahs',$mahs)->get();
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
        $result['message'] .= '<th style="text-align: center" width="5%">STT</th>';
        $result['message'] .= '<th style="text-align: center">Phân loại sản phẩm, dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Tên sản phẩm, dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
        $result['message'] .= '<th style="text-align: center">Mức giá</th>';
        $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody>';
        $i=1;
        if (count($model) > 0) {
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr>';
                $result['message'] .= '<td style="text-align: center">' . ($i++) . '</td>';
                $result['message'] .= '<td>' . $tents->phanloaidv. '</td>';
                $result['message'] .= '<td class="active">' . $tents->mota. '</td>';
                $result['message'] .= '<td>' . $tents->dvt. '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->mucgia) . '</td>';
                $result['message'] .= '<td>' .
                    '<button type="button" data-target="#modal-modify" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem(' . $tents->id . ');"><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
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
