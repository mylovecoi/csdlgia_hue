<?php

namespace App\Http\Controllers\system\company;

use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\Model\system\dmnganhnghekd\DmNganhKd;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CompanyLvCcController extends Controller
{
    //ko dùng
    public function getmanghe(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        $inputs = $request->all();
        $model = DmNgheKd::where('manganh', $inputs['manganh'])
            ->where('theodoi','TD')
            ->get();


        $result['message'] = '<select class="form-control" id="add_manghe" name="add_manghe">';
        $result['message'] .= '<option value="">--Chọn nghề kinh doanh--</option>';
        foreach ($model as $ct) {
            $result['message'] .= '<option value="' . $ct->manghe . '">' . $ct->tennghe . '</option>';
        }
        $result['message'] .= '</select>';
        $result['status'] = 'success';


        die(json_encode($result));
    }

    //chưa làm phần tùy chọn theo lĩnh vực hoạt động
    public function getdvql(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();
        $m_donvi = view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->wherein('level', ['T', 'H', 'X'])->get();
        $m_diaban = dsdiaban::wherein('level', ['T', 'H', 'X'])->get();

        $result['message'] = '<select class="form-control" id="macqcq" name="macqcq">';
        $result['message'] .= '<option value="">--Chọn đơn vị nhận hồ sơ--</option>';
        foreach ($m_diaban as $diaban) {
            $result['message'] .= '<optgroup label="'.$diaban->tendiaban.'">';
            $donvi = $m_donvi->where('madiaban', $diaban->madiaban);
            foreach ($donvi as $ct) {
                $result['message'] .= '<option value="'.$ct->madv.'">'.$ct->tendv.'</option>';
            }
            $result['message'] .= '</optgroup>';
        }

        $result['message'] .= '</select>';
        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function store(Request $request)
    {

        $inputs = $request->all();
        $model = CompanyLvCc::where('mahs',$inputs['mahs'])->where('manghe',$inputs['manghe'])->first();
        if ($model == null) {
            //$inputs['maspdv'] = getdate()[0];
            CompanyLvCc::create($inputs);
        } else {
            $model->update($inputs);
        }
        $model = CompanyLvCc::where('mahs',$inputs['mahs'])->get();
        $result = $this->return_html($model);

        die(json_encode($result));
    }

    public function store_cu(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        $inputs = $request->all();

        if (isset($inputs['mahs'])) {
            $check = CompanyLvCc::where('mahs',$inputs['mahs'])
                ->where('manganh',$inputs['manganh'])
                ->where('manghe',$inputs['manghe'])
                ->get()->count();
            if($check  == 0) {
                $inputs['trangthai'] = 'CXD';
                $modelkkgia = new CompanyLvCc();
                $modelkkgia->create($inputs);

                $model = CompanyLvCc::Leftjoin('town', 'town.maxa', '=', 'companylvcc.mahuyen')
                    ->join('dmnganhkd', 'dmnganhkd.manganh', '=', 'companylvcc.manganh')
                    ->join('dmnghekd', 'dmnghekd.manghe', '=', 'companylvcc.manghe')
                    ->select('companylvcc.*', 'town.tendv', 'dmnganhkd.tennganh', 'dmnghekd.tennghe')
                    ->where('companylvcc.mahs', $inputs['mahs'])
                    ->get();
                $result['message'] = '<div class="row" id="dsts">';
                $result['message'] .= '<div class="col-md-12">';
                $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
                $result['message'] .= '<thead>';
                $result['message'] .= '<tr>';
                $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
                $result['message'] .= '<th style="text-align: center">Mã ngành</th>';
                $result['message'] .= '<th style="text-align: center">Tên ngành</th>';
                $result['message'] .= '<th style="text-align: center">Mã nghề</th>';
                $result['message'] .= '<th style="text-align: center">Tên nghề</th>';
                $result['message'] .= '<th style="text-align: center">Đơn vị quản lý</th>';
                $result['message'] .= '<th style="text-align: center">Thao tác</th>';
                $result['message'] .= '</thead>';
                $result['message'] .= '<tbody>';
                if (count($model) > 0) {
                    foreach ($model as $key => $tt) {
                        $result['message'] .= '<tr id="' . $tt->id . '">';
                        $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                        $result['message'] .= '<td class="active">' . $tt->manganh . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $tt->tennganh . '</td>';
                        $result['message'] .= '<td style="text-align: center">' . $tt->manghe . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $tt->tennghe . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $tt->tendv . '</td>';
                        $result['message'] .= '<td>' .
                            '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getidedit(' . $tt->id . ');" ><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                            '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                            . '</td>';
                        $result['message'] .= '</tr>';
                    }
                    $result['message'] .= '</tbody>';
                    $result['message'] .= '</table>';
                    $result['message'] .= '</div>';
                    $result['message'] .= '</div>';
                    $result['status'] = 'success';
                }
            }else
                $result = array(
                    'status' => 'fail',
                    'message' => 'error',
                );

        } else {
            $check = CompanyLvCc::where('maxa',$inputs['maxa'])
                ->where('manganh',$inputs['manganh'])
                ->where('manghe',$inputs['manghe'])
                ->get()->count();
            if($check == 0) {
                $inputs['trangthai'] = 'XD';
                $modelkkgia = new CompanyLvCc();
                $modelkkgia->create($inputs);

                $model = CompanyLvCc::Leftjoin('town', 'town.maxa', '=', 'companylvcc.mahuyen')
                    ->join('dmnganhkd', 'dmnganhkd.manganh', '=', 'companylvcc.manganh')
                    ->join('dmnghekd', 'dmnghekd.manghe', '=', 'companylvcc.manghe')
                    ->select('companylvcc.*', 'town.tendv', 'dmnganhkd.tennganh', 'dmnghekd.tennghe')
                    ->where('companylvcc.maxa', $inputs['maxa'])
                    ->get();
                $result['message'] = '<div class="row" id="dsts">';
                $result['message'] .= '<div class="col-md-12">';
                $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
                $result['message'] .= '<thead>';
                $result['message'] .= '<tr>';
                $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
                $result['message'] .= '<th style="text-align: center">Mã ngành</th>';
                $result['message'] .= '<th style="text-align: center">Tên ngành</th>';
                $result['message'] .= '<th style="text-align: center">Mã nghề</th>';
                $result['message'] .= '<th style="text-align: center">Tên nghề</th>';
                $result['message'] .= '<th style="text-align: center">Đơn vị quản lý</th>';
                $result['message'] .= '<th style="text-align: center">Thao tác</th>';
                $result['message'] .= '</thead>';
                $result['message'] .= '<tbody>';
                if (count($model) > 0) {
                    foreach ($model as $key => $tt) {
                        $result['message'] .= '<tr id="' . $tt->id . '">';
                        $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                        $result['message'] .= '<td class="active">' . $tt->manganh . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $tt->tennganh . '</td>';
                        $result['message'] .= '<td style="text-align: center">' . $tt->manghe . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $tt->tennghe . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $tt->tendv . '</td>';
                        $result['message'] .= '<td>' .
                            '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getidedit(' . $tt->id . ');" ><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                            '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                            . '</td>';
                        $result['message'] .= '</tr>';
                    }
                    $result['message'] .= '</tbody>';
                    $result['message'] .= '</table>';
                    $result['message'] .= '</div>';
                    $result['message'] .= '</div>';
                    $result['status'] = 'success';
                }
            }else
                $result = array(
                    'status' => 'fail',
                    'message' => 'error',
                );

        }

        die(json_encode($result));
    }

    public function delete(Request $request)
    {
        $inputs = $request->all();
        $m_del = CompanyLvCc::where('id', $inputs['id'])->first();
        $m_del->delete();
        $model = CompanyLvCc::where('mahs',$m_del->mahs)->get();
        $result = $this->return_html($model);
        die(json_encode($result));
    }

    public function edit(Request $request){
        $inputs = $request->all();
        $model = CompanyLvCc::where('mahs',$inputs['mahs'])
            ->where('manghe',$inputs['manghe'])->first();
        //dd($model);
        die($model);
    }

    public function update(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        $inputs = $request->all();

        if (isset($inputs['mahs'])) {
            $modelkkgia = CompanyLvCc::where('id', $inputs['id'])
                ->first();
            $modelkkgia->mahuyen = $inputs['mahuyen'];
            $modelkkgia->save();

            $model = CompanyLvCc::join('town', 'town.maxa', '=', 'companylvcc.mahuyen')
                ->join('dmnganhkd', 'dmnganhkd.manganh', '=', 'companylvcc.manganh')
                ->join('dmnghekd', 'dmnghekd.manghe', '=', 'companylvcc.manghe')
                ->select('companylvcc.*', 'town.tendv', 'dmnganhkd.tennganh', 'dmnghekd.tennghe')
                ->where('companylvcc.mahs', $inputs['mahs'])
                ->get();
        } else {
            $modelkkgia = CompanyLvCc::where('id', $inputs['id'])
                ->first();
            $modelkkgia->mahuyen = $inputs['mahuyen'];
            $modelkkgia->save();

            $model = CompanyLvCc::join('town', 'town.maxa', '=', 'companylvcc.mahuyen')
                ->join('dmnganhkd', 'dmnganhkd.manganh', '=', 'companylvcc.manganh')
                ->join('dmnghekd', 'dmnghekd.manghe', '=', 'companylvcc.manghe')
                ->select('companylvcc.*', 'town.tendv', 'dmnganhkd.tennganh', 'dmnghekd.tennghe')
                ->where('companylvcc.maxa', $inputs['maxa'])
                ->get();
        }
        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Mã ngành</th>';
        $result['message'] .= '<th style="text-align: center">Tên ngành</th>';
        $result['message'] .= '<th style="text-align: center">Mã nghề</th>';
        $result['message'] .= '<th style="text-align: center">Tên nghề</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị quản lý</th>';
        $result['message'] .= '<th style="text-align: center">Thao tác</th>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody>';
        if (count($model) > 0) {
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr id="' . $tt->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td class="active">' . $tt->manganh . '</td>';
                $result['message'] .= '<td style="text-align: left">' . $tt->tennganh . '</td>';
                $result['message'] .= '<td style="text-align: center">' . $tt->manghe . '</td>';
                $result['message'] .= '<td style="text-align: left">' . $tt->tennghe . '</td>';
                $result['message'] .= '<td style="text-align: left">' . $tt->tendv . '</td>';
                $result['message'] .= '<td>' .
                    '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getidedit(' . $tt->id . ');" ><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                    '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                    . '</td>';
                $result['message'] .= '</tr>';
            }
            $result['message'] .= '</tbody>';
            $result['message'] .= '</table>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['status'] = 'success';
        }

        die(json_encode($result));
    }

    /**
     * @param array $inputs
     * @param array $result
     * @return array
     */
    public function return_html($model): array
    {
        $result = array(
            'status' => 'success',
            'message' => 'error',
        );

        $a_nghe = array_column(DmNgheKd::all()->toArray(), 'tennghe', 'manghe');
        $a_donvi = array_column(view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->wherein('level', ['T', 'H', 'X'])->get()->toArray(),
            'tendv', 'madv');
        $result['message'] = '<div class="row" id="dsts">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr>';
        $result['message'] .= '<th width="5%" style="text-align: center">STT</th>';
        $result['message'] .= '<th style="text-align: center">Tên ngành nghề kinh doanh</th>';
        $result['message'] .= '<th style="text-align: center">Đơn vị quản lý</th>';
        $result['message'] .= '<th width="15%"  style="text-align: center">Thao tác</th>';
        $result['message'] .= '</thead>';
        $result['message'] .= '<tbody>';
        if (count($model) > 0) {
            foreach ($model as $key => $tt) {
                $result['message'] .= '<tr id="' . $tt->id . '">';
                $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $result['message'] .= '<td style="text-align: left">' . ($a_nghe[$tt->manghe] ?? '') . '</td>';
                $result['message'] .= '<td style="text-align: left">' . ($a_donvi[$tt->macqcq] ?? '') . '</td>';
                $result['message'] .= '<td>' .
                    '<button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getidedit(&#39;' . $tt->manghe . '&#39;);" ><i class="fa fa-edit"></i>&nbsp;Sửa</button>' .
                    '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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
