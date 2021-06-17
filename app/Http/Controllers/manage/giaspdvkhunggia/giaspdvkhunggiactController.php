<?php

namespace App\Http\Controllers\manage\giaspdvkhunggia;

use App\Model\manage\dinhgia\giaspdvkhunggia\giaspdvkhunggia_ct;
use App\Model\manage\dinhgia\giaspdvkhunggia\giaspdvkhunggia_dm;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giaspdvkhunggiactController extends Controller
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
        //dd($inputs);
        $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
        if (count($chk_dvt) == 0) {
            dmdvt::insert(['dvt' => $inputs['dvt']]);
        }
        $inputs['giatoida'] = chkDbl($inputs['giatoida']);
        $inputs['giatoithieu'] = chkDbl($inputs['giatoithieu']);
        //$inputs['trangthai'] = 'CXD';

        $m_chk = giaspdvkhunggia_ct::where('id',$inputs['id'])->first();
        if($m_chk == null){
            unset($inputs['id']);
            giaspdvkhunggia_ct::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = giaspdvkhunggia_ct::where('mahs',$inputs['mahs'])->get();
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
        $model = giaspdvkhunggia_ct::findOrFail($inputs['id']);
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
        giaspdvkhunggia_ct::where('id',$inputs['id'])->delete();
        $model = giaspdvkhunggia_ct::where('mahs',$inputs['mahs'])->get();
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
        $result['message'] .= '<th style="text-align: center">Phân loại sản phẩm, dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Tên sản phẩm, dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
        $result['message'] .= '<th style="text-align: center">Mức giá<br>tối thiểu</th>';
        $result['message'] .= '<th style="text-align: center">Mức giá<br>tối đa</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            $i=1;
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr>';
                $result['message'] .= '<td style="text-align: center">' . $i++ . '</td>';
                $result['message'] .= '<td>' . $tents->phanloaidv . '</td>';
                $result['message'] .= '<td class="active">' . $tents->mota . '</td>';
                $result['message'] .= '<td class="text-center">' . $tents->dvt . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->giatoithieu) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->giatoida) . '</td>';
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
