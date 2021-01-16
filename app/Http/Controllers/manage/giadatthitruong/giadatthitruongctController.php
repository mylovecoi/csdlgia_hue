<?php

namespace App\Http\Controllers\manage\giadatthitruong;

use App\DiaBanHd;
use App\GiaDatDiaBan;
use App\Model\manage\dinhgia\giadatthitruong\giadatthitruongct;
use App\Model\manage\dinhgia\giadaugiadat\DauGiaDat;
use App\Model\manage\dinhgia\giadaugiadat\DauGiaDatCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giadatthitruongctController extends Controller
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
        $model = giadatthitruongct::findOrFail($inputs['id']);
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
            $modeladd = giadatthitruongct::where('id',$inputs['id'])->first();
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
        
        $inputs['thoigianban'] = getDateToDb($inputs['thoigianban']);
        $inputs['thoigiangiakd'] = getDateToDb($inputs['thoigiangiakd']);
        $inputs['dientichdat'] = getDoubleToDb($inputs['dientichdat']);
        $inputs['dongiadat'] = getDoubleToDb($inputs['dongiadat']);
        $inputs['giatridat'] = getDoubleToDb($inputs['giatridat']);
        $inputs['dientichts'] = getDoubleToDb($inputs['dientichts']);
        $inputs['dongiats'] = getDoubleToDb($inputs['dongiats']);
        $inputs['giatrits'] = getDoubleToDb($inputs['giatrits']);
        $inputs['tonggiatri'] = getDoubleToDb($inputs['tonggiatri']);
        $inputs['giadaugia'] = getDoubleToDb($inputs['giadaugia']);
        $inputs['giathitruong'] = getDoubleToDb($inputs['giathitruong']);
        $m_chk = giadatthitruongct::where('id',$inputs['id'])->first();
        if($m_chk == null){
            unset($inputs['id']);
            giadatthitruongct::create($inputs);
        }else{
            $m_chk->update($inputs);
        }

        $result = $this->return_html($inputs, $result);
        $result['status'] = 'success';
        die(json_encode($result));
    }

    public function return_html(array $inputs, $result)
    {
        $model = giadatthitruongct::where('mahs', $inputs['mahs'])->get();
        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr class="text-center">';
        $result['message'] .= '<th rowspan="2" width="5%">STT</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Tên khu đất</th>';
        $result['message'] .= '<th colspan="3">Giá đất</th>';
        $result['message'] .= '<th colspan="3">Giá tài sản trên đất</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Tổng giá trị </th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Kết quả đấu giá </th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center" width="10%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '<tr class="text-center">';
        $result['message'] .= '<th>Diện<br>tích</th>';
        $result['message'] .= '<th>Đơn<br>giá</th>';
        $result['message'] .= '<th>Thành<br>tiền</th>';
        $result['message'] .= '<th>Diện<br>tích</th>';
        $result['message'] .= '<th>Đơn<br>giá</th>';
        $result['message'] .= '<th>Thành<br>tiền</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';


        $result['message'] .= '<tbody>';
        if (count($model) > 0) {
            $i=1;
            foreach ($model as $key => $ttbog) {
                $result['message'] .= '<tr>';
                $result['message'] .= '<td style="text-align: center">' . ($i++) . '</td>';
//                $result['message'] .= '<td>' . $ttbog->khuvuc . '</td>';
                $result['message'] .= '<td>' . $ttbog->tenkhudat . '</td>';
                $result['message'] .= '<td>' . dinhdangso($ttbog->dientichdat) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($ttbog->dongiadat) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->giatridat) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($ttbog->dientichts) . '</td>';
                $result['message'] .= '<td>' . dinhdangso($ttbog->dongiats) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->giatrits) . '</td>';
                $result['message'] .= '<td style="text-align: right;">' . dinhdangso($ttbog->tonggiatri) . '</td>';
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
