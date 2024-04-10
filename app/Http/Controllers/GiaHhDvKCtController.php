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
            $inputs["mahhdv"] = ord(strtoupper($inputs["mahhdv"])) - 65;
            $inputs["gialk"] = ord(strtoupper($inputs["gialk"])) - 65;
            $inputs["gia"] = ord(strtoupper($inputs["gia"])) - 65;

            $inputs['url'] = '/giahhdvk';
            $inputs['act'] = 'true';

            // $filename = $inputs['madv'] . '_' . getdate()[0];
            // $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            // $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            // $data = [];

            // Excel::load($path, function ($reader) use (&$data, $inputs) {
            //     $obj = $reader->getExcel();
            //     $sheet = $obj->getSheet(0);
            //     $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            // });
            // $a_data = array();
            // $inputs['dendong'] = $inputs['dendong'] > count($data) ? count($data) : $inputs['dendong'];
            // for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
            //     if($data[$i][$inputs['mahhdv']] == ''){
            //         continue;
            //     }
            //     $a_data[$data[$i][$inputs['mahhdv']]] = array(
            //         'gialk' => (isset($data[$i][$inputs['gialk']]) && $data[$i][$inputs['gialk']] != '' ? chkDbl($data[$i][$inputs['gialk']]) : 0),
            //         'gia' => (isset($data[$i][$inputs['gia']]) && $data[$i][$inputs['gia']] != '' ? chkDbl($data[$i][$inputs['gia']]) : 0),
            //     );
            // }

            $file = $request->file('fexcel');

            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0]; 

            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) : $inputs['dendong'];
            $a_data = array();

            for ($i = $inputs['tudong'] - 1; $i <= ($inputs['dendong']); $i++) {

                $a_data[] = array(
                    'mahs' => $inputs['mahs'],
                    'mahhdv' => trim($data[$i][$inputs['mahhdv']] ?? ''),
                    'gialk' => trim($data[$i][$inputs['gialk']] ?? ''),
                    'gia' => trim($data[$i][$inputs['gia']] ?? ''),
                );
            }

            $modelct = GiaHhDvKCt::where('mahs', $inputs['mahs'])->get();
            foreach ($modelct as $key=>$val){
                if(isset($a_data[$val->mahhdv])){
                    $val->gia = $a_data[$val->mahhdv]['gia'];
                    $val->gialk = $a_data[$val->mahhdv]['gialk'];
                    $val->save();
                }
            }
            // File::Delete($path);
            $model = GiaHhDvK::where('mahs', $inputs['mahs'])->first();
            if($model == null) {
                $model = new GiaHhDvK();
                $model->mahs = $inputs['mahs'];
                $model->matt = $inputs['matt'];
                $model->madiaban = $inputs['madiaban'];
                $model->madv = $inputs['madv'];
                $model->trangthai = 'CHT';
                $model->thang = $inputs['thang'];
                $model->nam = $inputs['nam'];
                $model->soqd = $inputs['soqd'];
                $model->thoidiem = $inputs['thoidiem'];
                $model->soqdlk = $inputs['soqdlk'];
                $model->thoidiemlk = $inputs['thoidiemlk'];
            }
            $a_diaban = array_column(dsdiaban::where('madiaban', $inputs['madiaban'])->get()->toarray(), 'tendiaban', 'madiaban');
            $a_tt = array_column(NhomHhDvK::where('matt', $inputs['matt'])->get()->toarray(), 'tentt', 'matt');
            $a_dm = array_column(DmHhDvK::where('matt', $inputs['matt'])->get()->toarray(), 'tenhhdv', 'mahhdv');

            return view('manage.dinhgia.giahhdvk.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('a_diaban', $a_diaban)
                ->with('a_tt', $a_tt)
                ->with('a_dm', $a_dm)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin giá hàng hóa dịch vụ khác');
        } else
            return view('errors.notlogin');
    }

}
