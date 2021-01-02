<?php

namespace App\Http\Controllers\manage\giarung;

use App\DmGiaRung;
use App\Model\manage\dinhgia\GiaRungCt;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaRungCtController extends Controller
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

        $inputs['dientich'] = getDoubleToDb($inputs['dientich']);
        $inputs['dientichsd'] = getDoubleToDb($inputs['dientichsd']);
        $inputs['giatri'] = getDoubleToDb($inputs['giatri']);
        $m_chk = GiaRungCt::where('id',$inputs['id'])->first();
        unset($inputs['id']);
        if($m_chk == null){
            GiaRungCt::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = GiaRungCt::where('mahs',$inputs['mahs'])->get();
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
        $model = GiaRungCt::findOrFail($id);
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
        GiaRungCt::where('id',$inputs['id'])->delete();
        $model = GiaRungCt::where('mahs',$inputs['mahs'])->get();
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
        $result['message'] .= '<th style="text-align: center">Phân loại</th>';
        $result['message'] .= '<th style="text-align: center">Loại rừng</th>';
        $result['message'] .= '<th style="text-align: center">Nội dung chi tiết</th>';
        $result['message'] .= '<th style="text-align: center">Diện tích rừng</th>';
        $result['message'] .= '<th style="text-align: center">Diện tích<br>sử dụng</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
        $result['message'] .= '<th style="text-align: center" >Giá trị</th>';
        $result['message'] .= '<th style="text-align: center"> Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            $i=1;
            $a_dm = array_column(DmGiaRung::all()->toArray(), 'tennhom','manhom');
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr id="' . $i++ . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td class="info">' . $tt->phanloai . '</td>';
                $result['message'] .= '<td>' . ($a_dm[$tt->manhom] ?? '') . '</td>';
                $result['message'] .= '<td>' . $tt->noidung . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->dientich) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->dientichsd) . '</td>';
                $result['message'] .= '<td>' . $tt->dvt . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->giatri) . '</td>';
                $result['message'] .= '<td>' .
                    '<button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem(' . $tt->id . ');"><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
                    '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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
