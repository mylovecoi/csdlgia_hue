<?php

namespace App\Http\Controllers\manage\giadatphanloai;


use App\GiaDatDiaBanDm;
use App\Model\manage\dinhgia\giadatphanloai\GiaDatPhanLoaiCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaDatPhanLoaiCtController extends Controller
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
        $inputs['banggiadat'] = getMoneyToDb($inputs['banggiadat']);
        $inputs['giacuthe'] = getMoneyToDb($inputs['giacuthe']);
        $m_chk = GiaDatPhanLoaiCt::where('id',$inputs['id'])->first();
        unset($inputs['id']);
        if( $m_chk == null){
            GiaDatPhanLoaiCt::create($inputs);
        }else{
            $m_chk->update($inputs);
        }
        $model = GiaDatPhanLoaiCt::where('mahs',$inputs['mahs'])->orderby('khuvuc')->orderby('maloaidat')->get();
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
        $model = GiaDatPhanLoaiCt::findOrFail($id);
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
        GiaDatPhanLoaiCt::where('id',$inputs['id'])->delete();
        $model = GiaDatPhanLoaiCt::where('mahs',$inputs['mahs'])->orderby('khuvuc')->orderby('maloaidat')->get();
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
        $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Tên đường, giới hạn, khu vực</th>';
        $result['message'] .= '<th style="text-align: center">Loại đất</th>';
        $result['message'] .= '<th style="text-align: center">Vị trí</th>';
        $result['message'] .= '<th style="text-align: center" width="8%">Giá đất<br>tại bảng giá</th>';
        $result['message'] .= '<th style="text-align: center" width="8%">Giá đất<br>cụ thể</th>';
        $result['message'] .= '<th style="text-align: center" width="8%">Hệ số<br>điều chỉnh</th>';
        $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';        
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody id="ttts">';
        $i=1;
        if (count($model) > 0) {
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr id>';
                $result['message'] .= '<td style="text-align: center">'.$i++.'</td>';
                $result['message'] .= '<td class="active" style="font-weight: bold">'.$tt->khuvuc.'</td>';
                $result['message'] .= '<td>'.($a_loaidat[$tt->maloaidat] ?? '').'</td>';
                $result['message'] .= '<td class="text-center">'.$tt->vitri.'</td>';
                $result['message'] .= '<td style="text-align: right;">'.dinhdangsothapphan($tt->banggiadat,4).'</td>';
                $result['message'] .= '<td style="text-align: right;">'.dinhdangsothapphan($tt->giacuthe,4).'</td>';
                $result['message'] .= '<td style="text-align: right;">'.dinhdangsothapphan($tt->hesodc,4).'</td>';
                $result['message'] .= '<td>' .
                    '<button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem(' . $tt->id . ');"><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
                    '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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
