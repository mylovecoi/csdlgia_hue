<?php

namespace App\Http\Controllers\manage\giavangngoaite;

use App\DmHhDvK;
use App\GiaHhDvKCt;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaitect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giavangngoaitectController extends Controller
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
        $model = giavangngoaitect::findOrFail($id);

        die($model);
    }

    public function update(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'permission denied',
        );

        if(!Session::has('admin')) {            
            return response()->json($result);
        }
        $inputs = $request->all();
        
        //dd($request);
        if(isset($inputs['id'])){
            $modelupdate = giavangngoaitect::where('id',$inputs['id'])->first();            
            $inputs['gia'] = getDoubleToDb($inputs['gia']);
            $inputs['giaban'] = getDoubleToDb($inputs['giaban']);
            $modelupdate->update($inputs);
            $result = $this->return_html($inputs);
        }
        return response()->json($result);
    }

    /**
     * @param array $inputs
     * @param array $result
     * @return array
     */
    public function return_html(array $inputs)
    {
        $result = array(
            'status' => 'success',
            'message' => '',
        );

        $model = giavangngoaitect::where('mahs', $inputs['mahs'])->get();

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
        $result['message'] .= '<th style="text-align: center" width="10%">Giá mua</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Giá bán</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr id="' . $tents->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td style="text-align: center">' . $tents->mahhdv . '</td>';
                $result['message'] .= '<td class="active" style="font-weight: bold">' . ($tents->tenhhdv) . '</td>';
                $result['message'] .= '<td>' . $tents->dacdiemkt . '</td>';
                $result['message'] .= '<td style="text-align: center">' . $tents->dvt . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->gia) . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->giaban) . '</td>';
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
