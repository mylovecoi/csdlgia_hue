<?php

namespace App\Http\Controllers\manage\giadaugiadat;

use App\DiaBanHd;
use App\GiaDatDiaBan;
use App\Model\manage\dinhgia\giadaugiadat\DauGiaDat;
use App\Model\manage\dinhgia\giadaugiadat\DauGiaDatCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DauGiaDatCtController extends Controller
{
    public function getkhuvuc(Request $request)
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
        $model = GiaDatDiaBan::where('madiaban', $inputs['madiaban'])->where('maxp', $inputs['maxp'])->get();
        $result['message'] = '<div class="row" id="sel_khuvuc">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label class="control-label">Khu vực</label>';
        $result['message'] .= '<select name="khuvuc" id="khuvuc" class="form-control">';
        foreach ($model as $ct){
            $result['message'] .= '<option value="'.$ct->khuvuc.'">'.$ct->khuvuc.'</option>';
        }
        $result['message'] .= '</select>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';
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
        $model = DauGiaDatCt::findOrFail($inputs['id']);
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
            $modeladd = DauGiaDatCt::where('id',$inputs['id'])->first();
            $modeladd->delete();
            $result = $this->return_html($inputs, $result);
        }
        $result['status'] = 'success';
        die(json_encode($result));
    }

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
        $inputs['giadaugia'] = getMoneyToDb($inputs['giadaugia']);
        $inputs['giakhoidiem'] = getMoneyToDb($inputs['giakhoidiem']);
        $inputs['dientich'] = getMoneyToDb($inputs['dientich']);
        $m_chk = DauGiaDatCt::where('id',$inputs['id'])->first();
        if($m_chk == null){
            unset($inputs['id']);
            DauGiaDatCt::create($inputs);
        }else{
            $m_chk->update($inputs);
        }

        $result = $this->return_html($inputs, $result);
        $result['status'] = 'success';
        die(json_encode($result));
    }

    public function return_html(array $inputs, $result)
    {
        $model = DauGiaDatCt::where('mahs', $inputs['mahs'])->get();
        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="5%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Số lô</th>';
        $result['message'] .= '<th style="text-align: center">Số thửa</th>';
        $result['message'] .= '<th style="text-align: center">Tờ bản đồ</th>';
        $result['message'] .= '<th style="text-align: center">Khu vực</th>';
        $result['message'] .= '<th style="text-align: center">Mô tả</th>';
        $result['message'] .= '<th style="text-align: center">Diên tích</th>';
        $result['message'] .= '<th style="text-align: center">ĐVT</th>';
        $result['message'] .= '<th style="text-align: center">Giá khởi</br>điểm</th>';
        $result['message'] .= '<th style="text-align: center">Giá đấu</br>giá</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';


        $result['message'] .= '<tbody>';
        if (count($model) > 0) {
            foreach ($model as $key => $ttbog) {
                $result['message'] .= '<tr id="' . $ttbog->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td>' . $ttbog->solo . '</td>';
                $result['message'] .= '<td>' . $ttbog->sothua . '</td>';
                $result['message'] .= '<td>' . $ttbog->sotobando . '</td>';
                $result['message'] .= '<td>' . $ttbog->khuvuc . '</td>';
                $result['message'] .= '<td>' . $ttbog->mota . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->dientich) . '</td>';
                $result['message'] .= '<td>' . $ttbog->dvt . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->giakhoidiem) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->giadaugia) . '</td>';
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
