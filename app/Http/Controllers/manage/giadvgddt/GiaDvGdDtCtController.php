<?php

namespace App\Http\Controllers\manage\giadvgddt;

use App\Model\manage\dinhgia\GiaDvGdDtCt;
use App\Model\manage\dinhgia\giadvgddtdm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaDvGdDtCtController extends Controller
{
    public function store(Request $request)
    {
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $inputs['giathanhthi1'] = getDoubleToDb($inputs['giathanhthi1']);
        $inputs['gianongthon1'] = getDoubleToDb($inputs['gianongthon1']);
        $inputs['giamiennui1'] = getDoubleToDb($inputs['giamiennui1']);
        $inputs['giathanhthi2'] = getDoubleToDb($inputs['giathanhthi2']);
        $inputs['gianongthon2'] = getDoubleToDb($inputs['gianongthon2']);
        $inputs['giamiennui2'] = getDoubleToDb($inputs['giamiennui2']);
        $inputs['giathanhthi3'] = getDoubleToDb($inputs['giathanhthi3']);
        $inputs['gianongthon3'] = getDoubleToDb($inputs['gianongthon3']);
        $inputs['giamiennui3'] = getDoubleToDb($inputs['giamiennui3']);

        $m_chk = GiaDvGdDtCt::where('maspdv', $inputs['maspdv'])->where('mahs', $inputs['mahs'])->first();
        if ($m_chk == null) {
            GiaDvGdDtCt::create($inputs);
        } else {
            $m_chk->update($inputs);
        }
        $model = GiaDvGdDtCt::where('mahs', $inputs['mahs'])->get();
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
        $model = GiaDvGdDtCt::findOrFail($id);
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
        GiaDvGdDtCt::where('id',$inputs['id'])->delete();

        $model = GiaDvGdDtCt::where('mahs',$inputs['mahs'])->get();
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
        $result['message'] .= '<th rowspan="2" width="3%" style="text-align: center">STT</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Tên sản phẩm<br>dịch vụ</th>';
        $result['message'] .= '<th colspan="4" style="text-align: center">Mức thu học phí</th>';
        $result['message'] .= '<th colspan="4" style="text-align: center">Mức thu học phí</th>';
        $result['message'] .= '<th colspan="4" style="text-align: center">Mức thu học phí</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center" width="5%">Thao<br>tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th style="text-align: center">Năm<br>học</th>';
        $result['message'] .= '<th style="text-align: center">Thành<br>thị</th>';
        $result['message'] .= '<th style="text-align: center">Nông<br>thôn</th>';
        $result['message'] .= '<th style="text-align: center">Miền<br>núi</th>';

        $result['message'] .= '<th style="text-align: center">Năm<br>học</th>';
        $result['message'] .= '<th style="text-align: center">Thành<br>thị</th>';
        $result['message'] .= '<th style="text-align: center">Nông<br>thôn</th>';
        $result['message'] .= '<th style="text-align: center">Miền<br>núi</th>';

        $result['message'] .= '<th style="text-align: center">Năm<br>học</th>';
        $result['message'] .= '<th style="text-align: center">Thành<br>thị</th>';
        $result['message'] .= '<th style="text-align: center">Nông<br>thôn</th>';
        $result['message'] .= '<th style="text-align: center">Miền<br>núi</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody>';
        $i = 1;

        if (count($model) > 0) {
            $a_dm = array_column(giadvgddtdm::all()->toArray(), 'tenspdv', 'maspdv');
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr class="text-right">';
                $result['message'] .= '<td style="text-align: center">'.$i++.'</td>';
                $result['message'] .= '<td class="active text-left">' . ($a_dm[$tt->maspdv] ?? '') . '</td>';
                $result['message'] .= '<td class="text-center">' . $tt->namapdung1 . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->giathanhthi1) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->gianongthon1) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->giamiennui1) . '</td>';

                $result['message'] .= '<td class="text-center">' . $tt->namapdung2 . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->giathanhthi2) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->gianongthon2) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->giamiennui2) . '</td>';

                $result['message'] .= '<td class="text-center">' . $tt->namapdung3 . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->giathanhthi3) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->gianongthon3) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($tt->giamiennui3) . '</td>';
                $result['message'] .= '<td>';

                $result['message'] .= '<button type="button" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem(' . $tt->id . ')">';
                $result['message'] .= '<i class="fa fa-edit"></i>&nbsp;Sửa</button>';
                $result['message'] .= '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ')" >';
                $result['message'] .= '<i class="fa fa-trash-o"></i>&nbsp;Xóa</button>';

                $result['message'] .= '</td>';
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
