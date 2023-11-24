<?php

namespace App\Http\Controllers\manage\binhongia;

use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBogCt;
use App\Model\system\dmdvt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkMhBogCtController extends Controller
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
        //dd($inputs);
        $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
        if (count($chk_dvt) == 0) {
            dmdvt::insert(['dvt' => $inputs['dvt']]);
        }

        $inputs['gialk'] = getDoubleToDb($inputs['gialk']);
        $inputs['giakk'] = getDoubleToDb($inputs['giakk']);
        //$inputs['trangthai'] = 'CXD';

        $model = KkMhBogCt::where('id',$inputs['id'])->first();
        unset($inputs['id']);
        //dd($model);
        if($model != null){
            $model->update($inputs);
        }else{
            KkMhBogCt::create($inputs);
        }

        // $model = KkMhBogCt::where('mahs', $inputs['mahs'])->orderby('plhh')->get();
        $model = KkMhBogCt::where('mahs', $inputs['mahs'])->get();

        $result = $this->return_html($model);
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
        // $model = KkMhBogCt::where('mahs',$inputs['mahs'])->first();
        $model = KkMhBogCt::findOrFail($id);
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
        //dd($request);
        $inputs = $request->all();
        if(isset($inputs['id'])){
            KkMhBogCt::where('id',$inputs['id'])->delete();
            $model = KkMhBogCt::where('mahs',$inputs['mahs'])->orderby('plhh')->get();
            die(json_encode($this->return_html($model)));
        }
        die(json_encode($result));
    }

    public function editnhapkhau(Request $request){
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
        $model = KkMhBogCt::findOrFail($id);

        die($model);
    }

    public function updatenhapkhau(Request $request){
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
            $inputs['nksanluongtt'] = getDoubleToDb($inputs['nksanluongtt']);
            $inputs['nkgiamuacktt'] = getDoubleToDb($inputs['nkgiamuacktt']);
            $inputs['nkthuett'] = getDoubleToDb($inputs['nkthuett']);
            $inputs['nkthuettdbtt'] = getDoubleToDb($inputs['nkthuettdbtt']);
            $inputs['nkthuephiktt'] = getDoubleToDb($inputs['nkthuephiktt']);
            $inputs['nktienktt'] = getDoubleToDb($inputs['nktienktt']);
            $inputs['nkchiphitctt'] = getDoubleToDb($inputs['nkchiphitctt']);
            $inputs['nkchiphibhtt'] = getDoubleToDb($inputs['nkchiphibhtt']);
            $inputs['nkchiphiqltt'] = getDoubleToDb($inputs['nkchiphiqltt']);
            $inputs['nkgiathanh1sptt'] = getDoubleToDb($inputs['nkgiathanh1sptt']);
            $inputs['nkloinhuandktt'] = getDoubleToDb($inputs['nkloinhuandktt']);
            $inputs['nkthuegtgtktt'] = getDoubleToDb($inputs['nkthuegtgtktt']);
            $inputs['nkgiabandktt'] = getDoubleToDb($inputs['nkgiabandktt']);
            $modelup = KkMhBogCt::where('id',$inputs['id'])->first()->update($inputs);

            $model = KkMhBogCt::where('mahs',$inputs['mahs'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Tên hàng hoá<br>dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách<br>Chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá <br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá <br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttmh){
                    $result['message'] .= '<tr id="'.$ttmh->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttmh->tenhh.'</td>';
                    $result['message'] .= '<td class="active">'.$ttmh->quycach.'</td>';
                    $result['message'] .= '<td class="active">'.$ttmh->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right;font-weight: bold;">'.dinhdangsothapphan($ttmh->gialk,5).'</td>';
                    $result['message'] .= '<td style="text-align: right;font-weight: bold;">'.dinhdangsothapphan($ttmh->giakk,5).'</td>';
                    $result['message'] .= '<td>'.$ttmh->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editmhbog('.$ttmh->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttmh->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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

    public function return_html($model){
        $result = array(
            'status' => 'success',
            'message' => '',
        );

        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Phân loại hàng<br>hoá, dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Tên hàng hoá<br>dịch vụ</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
        $result['message'] .= '<th style="text-align: center">Mức giá <br>liền kề</th>';
        $result['message'] .= '<th style="text-align: center">Mức giá <br>kê khai</th>';
        $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
        $result['message'] .= '<th style="text-align: center" width="15%">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';

        $result['message'] .= '<tbody>';

        foreach ($model as $key => $ttmh) {
            $result['message'] .= '<tr id="' . $ttmh->id . '">';
            $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
            $result['message'] .= '<td>' . $ttmh->plhh . '</td>';
            $result['message'] .= '<td class="active">' . $ttmh->tenhh . '</td>';
            $result['message'] .= '<td class="text-center">' . $ttmh->dvt . '</td>';
            $result['message'] .= '<td style="text-align: right;">' . dinhdangsothapphan($ttmh->gialk, 5) . '</td>';
            $result['message'] .= '<td style="text-align: right;">' . dinhdangsothapphan($ttmh->giakk, 5) . '</td>';
            $result['message'] .= '<td>' . $ttmh->ghichu . '</td>';
            $result['message'] .= '<td>' .
                '<button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editmhbog(' . $ttmh->id . ');"><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
                '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $ttmh->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                . '</td>';
            $result['message'] .= '</tr>';
        }
        $result['message'] .= '</tbody>';
        $result['message'] .= '</table>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';

        return $result;
    }

}
