<?php

namespace App\Http\Controllers\manage\gianuocsachsh;

use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocShCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaNuocShCtController extends Controller
{
    public function edit(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $id = $inputs['id'];
        $model = GiaNuocShCt::findOrFail($id);

        die($model);
    }

    public function update(Request $request){
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
            $inputs['giachuathue'] = getDoubleToDb($inputs['giachuathue']);
            $inputs['giachuathue1'] = getDoubleToDb($inputs['giachuathue1']);
            $inputs['giachuathue2'] = getDoubleToDb($inputs['giachuathue2']);
            $inputs['giachuathue3'] = getDoubleToDb($inputs['giachuathue3']);
            $inputs['giachuathue4'] = getDoubleToDb($inputs['giachuathue4']);
            $modelkkgia = GiaNuocShCt::where('id',$inputs['id'])->first();
            $modelkkgia->update($inputs);
            $sonam = $inputs['dennam'] - $inputs['tunam'] > 0 ? $inputs['dennam'] - $inputs['tunam'] + 1 : 1;
            $model = GiaNuocShCt::where('mahs',$inputs['mahs'])->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th rowspan="2" width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th rowspan="2" style="text-align: center">Mục đích sử dụng </th>';
            $result['message'] .= '<th colspan="'.($sonam).'" style="text-align: center">Đơn giá</th>';
            $result['message'] .= '<th rowspan="2" style="text-align: center" width="10%">Thao tác</th>';
            $result['message'] .= '</tr>';

            $result['message'] .= '<tr>';
                for($i=0; $i< $sonam; $i++){
                    $result['message'] .= '<th width="7%" style="text-align: center">'.($inputs['tunam'] + $i).'</th>';
                }
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){

                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr id="'.$tt->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="success">'.$tt->doituongsd.'</td>';

                    for($i=0; $i < $sonam; $i++){
                        $col= $i > 0 ?'giachuathue'.$i : 'giachuathue';
                        $result['message'] .= '<td class="active">'.number_format($tt->$col).'</td>';
                    }

                    $result['message'] .= '<td>'.
                        '<button type="button" class="btn btn-default btn-xs mbs" onclick="edittt('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Sửa</button>'
                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }
}
