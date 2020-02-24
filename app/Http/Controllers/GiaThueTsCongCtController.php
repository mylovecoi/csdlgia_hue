<?php

namespace App\Http\Controllers;

use App\GiaThueTsCongCt;
use App\Model\manage\dinhgia\GiaTaiSanCongDm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaThueTsCongCtController extends Controller
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
        $inputs['dongiathue'] = getMoneyToDb($inputs['dongiathue']);
        $inputs['sotienthuenam'] = getMoneyToDb($inputs['sotienthuenam']);
        $m_chk = GiaThueTsCongCt::where('mataisan',$inputs['mataisan'])->where('mahs',$inputs['mahs'])->first();

        if($m_chk == null){
            GiaThueTsCongCt::create($inputs);
        }else{
            $m_chk->update($inputs);
        }

        $model = GiaThueTsCongCt::where('mahs',$inputs['mahs'])->get();
        $result = $this->return_thuetscong($model);
        die(json_encode($result));
    }

    public function show(Request $request)
    {
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = GiaThueTsCongCt::where('id',$inputs['id'])->first();
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
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            GiaThueTsCongCt::where('id',$inputs['id'])->delete();
            $model = GiaThueTsCongCt::where('mahs',$inputs['mahs'])->get();

            $result = $this->return_thuetscong($model);
        }
        die(json_encode($result));
    }

    /**
     * @param array $result
     * @param $model
     * @return array
     */
    public function return_thuetscong($model)
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
        $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Tên tài sản</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị thuê</th>';
        $result['message'] .= '<th style="text-align: center">Hợp đồng số</th>';
        $result['message'] .= '<th style="text-align: center">Thời hạn</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Đơn giá</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Thành tiền</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            $a_dm = array_column( GiaTaiSanCongDm::all()->toArray(), 'tentaisan','mataisan');
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr id="' . $tents->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td class="active" style="font-weight: bold">' . $a_dm[$tents->mataisan] . '</td>';
                $result['message'] .= '<td style="text-align: left;">' . $tents->dvthue . '</td>';
                $result['message'] .= '<td style="text-align: left;">' . $tents->hdthue . '</td>';
                $result['message'] .= '<td style="text-align: left;">' . $tents->ththue . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->dongiathue) . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->sotienthuenam) . '</td>';
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
