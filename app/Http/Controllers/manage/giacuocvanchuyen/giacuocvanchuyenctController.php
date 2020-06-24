<?php

namespace App\Http\Controllers\manage\giacuocvanchuyen;

use App\Model\manage\dinhgia\giacuocvanchuyen\giacuocvanchuyenct;
use App\Model\manage\dinhgia\GiaDvGdDtCt;
use App\Model\manage\dinhgia\giadvgddtdm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giacuocvanchuyenctController extends Controller
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
        $inputs['giavc1'] = getDoubleToDb($inputs['giavc1']);
        $inputs['giavc2'] = getDoubleToDb($inputs['giavc2']);
        $inputs['giavc3'] = getDoubleToDb($inputs['giavc3']);
        $inputs['giavc4'] = getDoubleToDb($inputs['giavc4']);
        $inputs['giavc5'] = getDoubleToDb($inputs['giavc5']);

        $m_chk = giacuocvanchuyenct::where('id',$inputs['id'])->first();
        if($m_chk == null){
            unset($inputs['id']);
            giacuocvanchuyenct::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = giacuocvanchuyenct::where('mahs',$inputs['mahs'])->get();
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
        $model = giacuocvanchuyenct::findOrFail($id);
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
        $chk = giacuocvanchuyenct::where('id',$inputs['id'])->first();
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
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th rowspan="2" style="text-align: center" width="2%">STT</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Loại hình<br>vận chuyển</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Tên<br>hàng hóa</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Bậc<br>hàng hóa</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Từ<br>km</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Đến<br>km</th>';
        $result['message'] .= '<th colspan="5" style="text-align: center">Giá cước</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center" width="10%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th style="text-align: center">Loại 1</th>';
        $result['message'] .= '<th style="text-align: center">Loại 2</th>';
        $result['message'] .= '<th style="text-align: center">Loại 3</th>';
        $result['message'] .= '<th style="text-align: center">Loại 4</th>';
        $result['message'] .= '<th style="text-align: center">Loại 5</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody>';
        $i=1;
        if (count($model) > 0) {
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr>';
                $result['message'] .= '<td style="text-align: center">' . ($i++) . '</td>';
                $result['message'] .= '<td class="active">' . $tents->phanloai. '</td>';
                $result['message'] .= '<td>' . $tents->tencuoc. '</td>';
                $result['message'] .= '<td>' . $tents->bachh. '</td>';
                $result['message'] .= '<td>' . $tents->tukm. '</td>';
                $result['message'] .= '<td>' . $tents->denkm. '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->giavc1) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->giavc2) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->giavc3) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->giavc4) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($tents->giavc5) . '</td>';
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
