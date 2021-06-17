<?php

namespace App\Http\Controllers\manage\giaspdvtoida;

use App\Model\manage\dinhgia\giaspdvtoida\giaspdvtoida_ct;
use App\Model\manage\dinhgia\giaspdvtoida\giaspdvtoida_dm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giaspdvtoidactController extends Controller
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

        $inputs['dongia'] = chkDbl($inputs['dongia']);
//        $inputs['trangthai'] = 'CXD';
        $m_chk = giaspdvtoida_ct::where('id',$inputs['id'])->first();
        if($m_chk == null){
            unset($inputs['id']);
            giaspdvtoida_ct::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = giaspdvtoida_ct::where('mahs',$inputs['mahs'])->get();
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
        $model = giaspdvtoida_ct::findOrFail($inputs['id']);
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
        giaspdvtoida_ct::where('id',$inputs['id'])->delete();
        $model = giaspdvtoida_ct::where('mahs',$inputs['mahs'])->get();
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
        $result['message'] .= '<th style="text-align: center">Mức giá<br>tối đa</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
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
                $result['message'] .= '<td class="text-center">' . $tents->dvt. '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->dongia) . '</td>';
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
