<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Model\system\dsdiaban;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ColectionImport;

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
            $inputs['gialk'] = chkDbl($inputs['gialk']);
            $inputs['gia'] = chkDbl($inputs['gia']);
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
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . dinhdangsothapphan($tents->gialk,2) . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . dinhdangsothapphan($tents->gia,2) . '</td>';
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

    public function importexcel_chitiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //Do mã char('A') = 65
            //Chuyển mã A,B,C về 0,1,2,3,...
            $inputs["mahhdv"] = ord(strtoupper($inputs["mahhdv"])) - 65;
            $inputs["loaigia"] = ord(strtoupper($inputs["loaigia"])) - 65;
            $inputs["gialk"] = ord(strtoupper($inputs["gialk"])) - 65;
            $inputs["gia"] = ord(strtoupper($inputs["gia"])) - 65;
            $inputs["nguontt"] = ord(strtoupper($inputs["nguontt"])) - 65;

            $file = $request->file('fexcel');

            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0];//Mặc định lấy Sheet 1
            //Gán lại dòng
            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) : $inputs['dendong'];

            for ($i = $inputs['tudong']-1; $i <= ($inputs['dendong']); $i++) {
                //dd($data[$i]);
                if (!isset($data[$i][$inputs['mahhdv']])) {
                    continue; //Mã hàng hoá rỗng => thoát
                }
                $chitiet = GiaHhDvKCt::where('mahs', $inputs['mahs'])->where('mahhdv', $data[$i][$inputs['mahhdv']])->first();
                if ($chitiet != null) {
                    $chitiet->loaigia = $data[$i][$inputs['loaigia']];
                    $chitiet->gia = chkDbl($data[$i][$inputs['gia']]);
                    $chitiet->gialk = chkDbl($data[$i][$inputs['gialk']]);
                    $chitiet->nguontt = $data[$i][$inputs['nguontt']];
                    //dd($chitiet);
                    $chitiet->save();
                }
            }

            //return redirect('/giahhdvk/new?madv=' . $inputs['madv'].'&mattbc='.$inputs['matt'].'&thang='.$inputs['thang'].'&nam='.$inputs['nam'].'&madiaban='.$inputs['madiaban'].'&act=true');
            return redirect('/giahhdvk/new?madv=' . $inputs['madv'].'&mattbc='.$inputs['matt'].'&thang='.$inputs['thang'].'&nam='.$inputs['nam'].'&madiaban='.$inputs['madiaban'].'&act=true'.'&mahs='.$inputs['mahs']);
        } else
            return view('errors.notlogin');
    }

}
