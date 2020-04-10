<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\GiaHhDvKCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaHhDvKCtController extends Controller
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
        $model = GiaHhDvKCt::findOrFail($id);

        die($model);
    }

    public function update(Request $request){

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
            $modelupdate = GiaHhDvKCt::where('id',$inputs['id'])->first();
            $inputs['gialk'] = getDoubleToDb($inputs['gialk']);
            $inputs['gia'] = getDoubleToDb($inputs['gia']);
            $modelupdate->update($inputs);

            $result = $this->return_html($inputs);

        }

        die(json_encode($result));
    }

    /**
     * @param array $inputs
     * @param array $result
     * @return array
     */
    public function return_html(array $inputs): array
    {
        $result = array(
            'status' => 'success',
            'message' => '',
        );

        $model = GiaHhDvKCt::where('mahs', $inputs['mahs'])->get();
        $a_dm = array_column(DmHhDvK::all()->toarray(), 'tenhhdv', 'mahhdv');

        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Mã <br>hàng hóa<br> dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Tên hàng hóa dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Đặc điểm kỹ thuật</th>';
        $result['message'] .= '<th style="text-align: center">Đơn <br>vị<br> tính</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Giá kỳ trước</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Giá kỳ này</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr id="' . $tents->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td style="text-align: center">' . $tents->mahhdv . '</td>';
                $result['message'] .= '<td class="active" style="font-weight: bold">' . ($a_dm[$tents->mahhdv] ?? '') . '</td>';
                $result['message'] .= '<td>' . $tents->dacdiemkt . '</td>';
                $result['message'] .= '<td style="text-align: center">' . $tents->dvt . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->gialk) . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->gia) . '</td>';
                $result['message'] .= '<td>';
                $result['message'] .= '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem(' . $tents->id . ');"><i class="fa fa-edit"></i>&nbsp;Nhập giá</button>';
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
