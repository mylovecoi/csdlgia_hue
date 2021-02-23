<?php

namespace App\Http\Controllers\manage\kekhaigia\kkdvvt\vtxtx;

use App\Model\manage\kekhaigia\kkdvvt\vtxtx\KkGiaVtXtxCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaVtXtxCtController extends Controller
{
    public function store(Request $request){
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
        $inputs['gialk'] = getDoubleToDb($inputs['gialk']);
        $inputs['giakk'] = getDoubleToDb($inputs['giakk']);
        $inputs['gialk1'] = getDoubleToDb($inputs['gialk1']);
        $inputs['giakk1'] = getDoubleToDb($inputs['giakk1']);
        $inputs['gialk2'] = getDoubleToDb($inputs['gialk2']);
        $inputs['giakk2'] = getDoubleToDb($inputs['giakk2']);
        $model = KkGiaVtXtxCt::where('id',$inputs['id'])->first();
        unset($inputs['id']);
        if($model == null){            
            KkGiaVtXtxCt::create($inputs);
        }else{
            $model->update($inputs);
        }
        //làm hàm trả về dùng chung
        $result = $this->return_spdv(KkGiaVtXtxCt::where('mahs',$inputs['mahs'])->get());
        die(json_encode($result));
    }

    public function edit_2021_02_22(Request $request){
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
            $id = $inputs['id'];
            $model = KkGiaVtXtxCt::findOrFail($id);
            $result['message'] = '<div class="modal-body" id="ttpedit">';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Tên dịch vụ cung ứng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="tendvcuedit" id="tendvcuedit" class="form-control" value="'.$model->tendvcu.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Quy cách chất lượng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="qccledit" class="form-control" name="qccledit" cols="30" rows="3">'.$model->qccl.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Đơn vị tính</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="dvtedit" id="dvtedit" class="form-control" value="'.$model->dvt.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Giá kê khai hiện hành</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" style="text-align: right" id="gialkedit" name="gialkedit" class="form-control" data-mask="fdecimal" value="'.$model->gialk.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Giá kê khai mới</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" style="text-align: right" id="giakkedit" name="giakkedit" class="form-control" data-mask="fdecimal" value="'.$model->giakk.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Ghi chú</b><span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="ghichuedit" class="form-control" name="ghichuedit" cols="30" rows="3">'.$model->ghichu.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<input type="hidden" id="idedit" name="idedit" value="'.$model->id.'">';
            $result['message'] .= '</div>';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function edit(Request $request){
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
        $model = KkGiaVtXtxCt::findOrFail($inputs['id']);
        die($model);
    }

    public function update_2021_02_22(Request $request){
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
        $inputs['gialk'] = getDoubleToDb($inputs['gialk']);
        $inputs['giakk'] = getDoubleToDb($inputs['giakk']);
        if(isset($inputs['id'])){
            $modelkkgia = KkGiaVtXtxCt::where('id',$inputs['id'])->first();
            $modelkkgia->update($inputs);
            $model = KkGiaVtXtxCt::where('mahs',$inputs['mahs'])
                ->get();
            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Tên dịch vụ cung ứng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá <br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá <br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';
            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr id="'.$tt->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->tendvcu.'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tt->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tt->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->gialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk).'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tt->ghichu.'</td>';
                    $result['message'] .= '<td>'.
//                        '<button type="button" data-target="#modal-kkgialk" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgialk('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá liền kề</button>'.
//                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>'.
                        '<button type="button" data-target="#modal-pag" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editPag('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Phương án giá</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
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

    public function delete(Request $request){
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
            $modelkkgia = KkGiaVtXtxCt::where('id',$inputs['id'])->delete();
            $result = $this->return_spdv(KkGiaVtXtxCt::where('mahs',$inputs['mahs'])->get());
        }
        die(json_encode($result));
    }

    public function editpag(Request $request){
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
        $model = KkGiaVtXtxCt::findOrFail($id);
        die($model);
    }

    public function updatepag(Request $request){
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

            $inputs['sltgtt'] = getDoubleToDb($inputs['sltgtt']);

            $inputs['chiphinltt'] = getDoubleToDb($inputs['chiphinltt']);

            $inputs['chiphinctt'] = getDoubleToDb($inputs['chiphinctt']);

            $inputs['chiphikhtt'] = getDoubleToDb($inputs['chiphikhtt']);

            $inputs['chiphisxkddttt'] = getDoubleToDb($inputs['chiphisxkddttt']);

            $inputs['chiphisxctt'] = getDoubleToDb($inputs['chiphisxctt']);

            $inputs['chiphitctt'] = getDoubleToDb($inputs['chiphitctt']);

            $inputs['chiphibhtt'] = getDoubleToDb($inputs['chiphibhtt']);

            $inputs['chiphiqltt'] = getDoubleToDb($inputs['chiphiqltt']);

            $inputs['chiphidvktt'] = getDoubleToDb($inputs['chiphidvktt']);

            $modelkkgia = KkGiaVtXtxCt::where('id',$inputs['id'])->first();

            $modelkkgia->update($inputs);
            $model = KkGiaVtXtxCt::where('mahs',$inputs['mahs'])
                ->get();
            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Tên dịch vụ cung ứng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đơn vị<br>tính</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá <br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá <br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';
            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr id="'.$tt->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->tendvcu.'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tt->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tt->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->gialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk).'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tt->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>'.
                        '<button type="button" data-target="#modal-pag" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editPag('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Phương án giá</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
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

    public function return_spdv($model){
        $result = array(
            'status' => 'success',
            'message' => 'error',
        );

        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_4">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th rowspan="2" style="text-align: center" width="2%">STT</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Tên dịch vụ cung ứng</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Đơn vị<br>tính</th>';
        $result['message'] .= '<th colspan="3" style="text-align: center">Kê khai giá</th>';
        $result['message'] .= '<th colspan="3" style="text-align: center">Kê khai giá</th>';
        $result['message'] .= '<th colspan="3" style="text-align: center">Kê khai giá</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Ghi chú</th>';
        $result['message'] .= '<th rowspan="2" style="text-align: center">Thao tác</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th style="text-align: center">Số Km</th>';
        $result['message'] .= '<th style="text-align: center">Giá<br>kê<br>khai</th>';
        $result['message'] .= '<th style="text-align: center">Giá<br>liền<br>kề</th>';
        $result['message'] .= '<th style="text-align: center">Số Km</th>';
        $result['message'] .= '<th style="text-align: center">Giá<br>kê<br>khai</th>';
        $result['message'] .= '<th style="text-align: center">Giá<br>liền<br>kề</th>';
        $result['message'] .= '<th style="text-align: center">Số Km</th>';
        $result['message'] .= '<th style="text-align: center">Giá<br>kê<br>khai</th>';
        $result['message'] .= '<th style="text-align: center">Giá<br>liền<br>kề</th>';
        $result['message'] .= '</tr>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody>';
        $i=1;
        foreach ($model as $key => $tt) {
            $result['message'] .= '<tr>';
            $result['message'] .= '<td style="text-align: center">'.$i++.'</td>';
            $result['message'] .= '<td class="active">'.$tt->tendvcu.'</td>';
            $result['message'] .= '<td style="text-align: center">'.$tt->dvt.'</td>';
            $result['message'] .= '<td>'.$tt->sokm.'</td>';
            $result['message'] .= '<td style="text-align: right">'.number_format($tt->gialk).'</td>';
            $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk).'</td>';
            $result['message'] .= '<td>'.$tt->sokm1.'</td>';
            $result['message'] .= '<td style="text-align: right">'.number_format($tt->gialk1).'</td>';
            $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk1).'</td>';
            $result['message'] .= '<td>'.$tt->sokm2.'</td>';
            $result['message'] .= '<td style="text-align: right">'.number_format($tt->gialk2).'</td>';
            $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk2).'</td>';
            $result['message'] .= '<td style="text-align: left">'.$tt->ghichu.'</td>';
            $result['message'] .= '<td>' .
                '<button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
                '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>' .
                '<button type="button" data-target="#modal-pag" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editPag('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Phương án giá</button>';
            $result['message'] .= '</td>';
            $result['message'] .= '</tr>';
        }
        $result['message'] .= '</tbody>';
        $result['message'] .= '</table>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';
        return $result;
    }
}
