<?php

namespace App\Http\Controllers\manage\thuemuanhaxh;

use App\DmGiaRung;
use App\Model\manage\dinhgia\GiaRungCt;
use App\Model\manage\dinhgia\giathuemuanhaxh\dmnhaxh;
use App\Model\manage\dinhgia\giathuemuanhaxh\GiaThueMuaNhaXhCt;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaThueMuaNhaXhCtController extends Controller
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

        $inputs['dongia'] = getDoubleToDb($inputs['dongia']);
        $inputs['dongiathue'] = getDoubleToDb($inputs['dongiathue']);
        $m_chk = GiaThueMuaNhaXhCt::where('id',$inputs['id'])->first();
        unset($inputs['id']);
        if($m_chk == null){
            GiaThueMuaNhaXhCt::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = GiaThueMuaNhaXhCt::where('mahs',$inputs['mahs'])->get();
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
        $model = GiaThueMuaNhaXhCt::findOrFail($id);
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
        GiaThueMuaNhaXhCt::where('id',$inputs['id'])->delete();
        $model = GiaThueMuaNhaXhCt::where('mahs',$inputs['mahs'])->get();
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
        $result['message'] .= '<th style="text-align: center">Tên nhà</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
        $result['message'] .= '<th style="text-align: center">Giá bán</th>';
        $result['message'] .= '<th style="text-align: center">Giá thuê</th>';
        $result['message'] .= '<th style="text-align: center"> Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            $i=1;
            $a_dm = array_column(dmnhaxh::all()->toArray(),'tennha','maso');
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr>';
                $result['message'] .= '<td style="text-align: center">' . ($i++) . '</td>';
                $result['message'] .= '<td>' . ($a_dm[$tt->maso] ?? '') . '</td>';
                $result['message'] .= '<td>' . $tt->dvt . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->dongia) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tt->dongiathue) . '</td>';
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
