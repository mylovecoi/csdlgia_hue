<?php

namespace App\Http\Controllers\manage\giataisancong;

use App\Model\manage\dinhgia\GiaTaiSanCongCt;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaTaiSanCongCtController extends Controller
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
//        $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
//        if (count($chk_dvt) == 0) {
//            dmdvt::insert(['dvt' => $inputs['dvt']]);
//        }

        $inputs['giathue'] = getDoubleToDb($inputs['giathue']);
        $inputs['giaban'] = getDoubleToDb($inputs['giaban']);
        $inputs['giapheduyet'] = getDoubleToDb($inputs['giapheduyet']);
        $inputs['giaconlai'] = getDoubleToDb($inputs['giaconlai']);
        $m_chk = GiaTaiSanCongCt::where('id',$inputs['id'])->first();
        unset($inputs['id']);
        if($m_chk == null){
            GiaTaiSanCongCt::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = GiaTaiSanCongCt::where('mahs',$inputs['mahs'])->get();
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
        $model = GiaTaiSanCongCt::findOrFail($id);
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
        GiaTaiSanCongCt::where('id',$inputs['id'])->delete();
        $model = GiaTaiSanCongCt::where('mahs',$inputs['mahs'])->get();
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
        $result['message'] .= '<th style="text-align: center">Tên tài sản</th>';
        $result['message'] .= '<th style="text-align: center">Đặc điểm</th>';
        $result['message'] .= '<th style="text-align: center">Nguyên giá</th>';
        $result['message'] .= '<th style="text-align: center">Giá còn lại</th>';
        $result['message'] .= '<th style="text-align: center">Giá phê duyệt</th>';
        $result['message'] .= '<th style="text-align: center">Giá bán<br>(thanh lý)</th>';
        $result['message'] .= '<th style="text-align: center"> Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            $i=1;
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr>';
                $result['message'] .= '<td style="text-align: center">' . ($i++) . '</td>';
                $result['message'] .= '<td>' .$tt->tentaisan. '</td>';
                $result['message'] .= '<td>' . $tt->dacdiem . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->giathue) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->giaban) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->giapheduyet) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->giaconlai) . '</td>';
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
