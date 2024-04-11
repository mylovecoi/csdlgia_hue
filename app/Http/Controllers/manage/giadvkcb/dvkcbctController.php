<?php

namespace App\Http\Controllers\manage\giadvkcb;

use App\DvKcbCt;
use App\Model\manage\dinhgia\giaspdvci\trogiatrocuocct;
use App\Model\manage\dinhgia\giaspdvci\trogiatrocuocdm;
use App\Model\manage\dinhgia\GiaTaiSanCongDm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\dinhgia\giadvkcb\dvkcbct as GiadvkcbDvkcbct;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ColectionImport;

class dvkcbctController extends Controller
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
        $model = DvKcbCt::findOrFail($id);
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
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $modelupdate = DvKcbCt::where('id',$inputs['id'])->first();
            // $inputs['giadv'] = getDoubleToDb($inputs['giadv']);
            $inputs['giatoithieu'] = getDoubleToDb($inputs['giatoithieu']);
            $inputs['giatoida'] = getDoubleToDb($inputs['giatoida']);
            $modelupdate->update($inputs);

            $model = DvKcbCt::where('mahs',$inputs['mahs'])->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Mã dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center">Tên sản phẩm, dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Đơn <br>vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center" width="10%">Giá tối thiểu</th>';
            $result['message'] .= '<th style="text-align: center" width="10%">Giá tối đa</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';
            $result['message'] .= '<tbody id="ttts">';
            if(count($model) > 0){
                foreach($model as $key=>$tents){
                    $result['message'] .= '<tr id="'.$tents->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td>'.$tents->madichvu.'</td>';
                    $result['message'] .= '<td class="active" style="font-weight: bold">'.$tents->tenspdv.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tents->dvt.'</td>';
                    // $result['message'] .= '<td style="text-align: right;font-weight: bold">'. dinhdangsothapphan($tents->giadv,5).'</td>';
                    $result['message'] .= '<td style="text-align: right;font-weight: bold">'. dinhdangsothapphan($tents->giatoithieu,5).'</td>';
                    $result['message'] .= '<td style="text-align: right;font-weight: bold">'. dinhdangsothapphan($tents->giatoida,5).'</td>';
                    $result['message'] .= '<td>'.$tents->ghichu.'</td>';
                    $result['message'] .= '<td>';
                    $result['message'] .= '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem(' . $tents->id . ');"><i class="fa fa-edit"></i>&nbsp;Nhập giá</button>';
                    $result['message'] .= '</td>';
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

    public function store(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $inputs['dongia'] = getMoneyToDb($inputs['dongia']);
        $inputs['trangthai'] = 'CXD';
        $m_chk = trogiatrocuocct::where('maspdv',$inputs['maspdv'])->where('mahs',$inputs['mahs'])->first();
        if($m_chk == null){
            trogiatrocuocct::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = trogiatrocuocct::where('mahs',$inputs['mahs'])->get();
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
        $model = trogiatrocuocct::findOrFail($id);
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
        trogiatrocuocct::where('id',$inputs['id'])->first();
        $model = trogiatrocuocct::where('mahs',$inputs['mahs'])->get();
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
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="5%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Mô tả</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Mức giá</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        if (count($model) > 0) {
            $a_dm = array_column( trogiatrocuocdm::all()->toArray(), 'tenspdv','maspdv');
            foreach ($model as $key => $tents) {
                $result['message'] .= '<tr id="' . $tents->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td class="active" style="font-weight: bold">' . $a_dm[$tents->maspdv] . '</td>';
                $result['message'] .= '<td style="text-align: right;font-weight: bold">' . number_format($tents->dongia) . '</td>';
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

    public function importexcel_chitiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //Do mã char('A') = 65
            //Chuyển mã A,B,C về 0,1,2,3,...
            $inputs["madichvu"] = ord(strtoupper($inputs["madichvu"])) - 65;
            $inputs["phanloai"] = ord(strtoupper($inputs["phanloai"])) - 65;
            $inputs["giatoithieu"] = ord(strtoupper($inputs["giatoithieu"])) - 65;
            $inputs["giatoida"] = ord(strtoupper($inputs["giatoida"])) - 65;
            $inputs["ghichu"] = ord(strtoupper($inputs["ghichu"])) - 65;

            $file = $request->file('fexcel');

            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0];//Mặc định lấy Sheet 1
            //Gán lại dòng
            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) : $inputs['dendong'];

            for ($i = $inputs['tudong']-1; $i <= ($inputs['dendong']); $i++) {
                //dd($data[$i]);
                if (!isset($data[$i][$inputs['madichvu']])) {
                    continue; //Mã hàng hoá rỗng => thoát
                }
                $chitiet = GiadvkcbDvkcbct::where('mahs', $inputs['mahs'])->where('madichvu', $data[$i][$inputs['madichvu']])->first();
                if ($chitiet != null) {
                    $chitiet->phanloai = $data[$i][$inputs['phanloai']];
                    $chitiet->giatoithieu = chkDbl($data[$i][$inputs['giatoithieu']]);
                    $chitiet->giatoida = chkDbl($data[$i][$inputs['giatoida']]);
                    $chitiet->ghichu = $data[$i][$inputs['ghichu']];
                    $chitiet->save();
                }
            }
            return redirect('/giadvkcb/new?manhom='.$inputs['manhom'].'&madv='.$inputs['madv'].'&act=true'.'&mahs='.$inputs['mahs']);
        } else
            return view('errors.notlogin');
    }
}
