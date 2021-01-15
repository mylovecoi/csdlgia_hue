<?php

namespace App\Http\Controllers\manage\gianuocsachsh;

use App\District;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocSachShDm;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocSh;
use App\Model\manage\dinhgia\gianuocsachsh\GiaNuocShCt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiaNuocShBcController extends Controller
{
    public function index(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modelhs = GiaNuocSh::where('madv',$inputs['madv'])->get();
            return view('manage.dinhgia.gianuocsh.reports.index')
                ->with('inputs', $inputs)
                ->with('modelhs',$modelhs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle','Báo cáo giá nước sạch sinh hoạt');
        }else
            return view('errors.notlogin');
    }

    public function Bc1(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = GiaNuocSachShDm::all();
            $modellk = $modelbc = null;
            if($inputs['mahslk'] != 'ALL'){
                $modellk = GiaNuocShCt::where('mahs',$inputs['mahslk'])->get();
            }
            if($inputs['mahsbc'] != 'ALL'){
                $modelbc = GiaNuocShCt::where('mahs',$inputs['mahsbc'])->get();
            }

            foreach($model as $ct) {
                $m_lk = isset($modellk) ? $modellk->where('doituongsd', $ct->doituongsd)->first() : null;
                $ct->gialk = $m_lk->giachuathue ?? 0;
                $ct->namlk = $m_lk->namchuathue ?? 0;
                $ct->gialk1 = $m_lk->giachuathue1 ?? 0;
                $ct->namlk1 = $m_lk->namchuathue1 ?? 0;
                $ct->gialk2 = $m_lk->giachuathue2 ?? 0;
                $ct->namlk2 = $m_lk->namchuathue2 ?? 0;
                $ct->gialk3 = $m_lk->giachuathue3 ?? 0;
                $ct->namlk3 = $m_lk->namchuathue3 ?? 0;
                $ct->gialk4 = $m_lk->giachuathue4 ?? 0;
                $ct->namlk4 = $m_lk->namchuathue4 ?? 0;

                $m_bc = isset($modelbc) ? $modelbc->where('doituongsd', $ct->doituongsd)->first() : null;
                $ct->giabc = $m_bc->giachuathue ?? 0;
                $ct->nambc = $m_bc->namchuathue ?? 0;
                $ct->giabc1 = $m_bc->giachuathue1 ?? 0;
                $ct->nambc1 = $m_bc->namchuathue1 ?? 0;
                $ct->giabc2 = $m_bc->giachuathue2 ?? 0;
                $ct->nambc2 = $m_bc->namchuathue2 ?? 0;
                $ct->giabc3 = $m_bc->giachuathue3 ?? 0;
                $ct->nambc3 = $m_bc->namchuathue3 ?? 0;
                $ct->giabc4 = $m_bc->giachuathue4 ?? 0;
                $ct->nambc4 = $m_bc->namchuathue4 ?? 0;
            }
            $a_kiemtra_lk = [
                'gialk'=>['gialk','namlk'],
                'gialk1'=>['gialk1','namlk1'],
                'gialk2'=>['gialk2','namlk2'],
                'gialk3'=>['gialk3','namlk3'],
                'gialk4'=>['gialk4','namlk4'],
            ];
            $a_kiemtra_bc = [
                'giabc'=>['giabc','nambc'],
                'giabc1'=>['giabc1','nambc1'],
                'giabc2'=>['giabc2','nambc2'],
                'giabc3'=>['giabc3','nambc3'],
                'giabc4'=>['giabc4','nambc4'],
            ];
            //kiểm tra để truyền số dòng, cột sang báo cáo
            $a_col_namlk = [];
            $a_col_gialk = [];
            foreach ($a_kiemtra_lk as $key=>$value) {
                if ($model->sum($key) > 0) {
                    $a_col_namlk[] = $value[1];
                    $a_col_gialk[] = $value[0];
                }
            }
            $a_col_nambc = [];
            $a_col_giabc = [];
            foreach ($a_kiemtra_bc as $key=>$value) {
                if ($model->sum($key) > 0) {
                    $a_col_nambc[] = $value[1];
                    $a_col_giabc[] = $value[0];
                }
            }

            $ttlk = GiaNuocSh::where('mahs',$inputs['mahslk'])->first();
            $ttbc = GiaNuocSh::where('mahs',$inputs['mahsbc'])->first();
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            $inputs['col_lk'] = count($a_col_gialk) == 0? 1 : count($a_col_gialk);
            $inputs['col_bc'] = count($a_col_giabc) == 0? 1 : count($a_col_giabc);
//            dd($inputs);
            return view('manage.dinhgia.gianuocsh.reports.BcGiaNuocSh1')
                ->with('model',$model)
                ->with('ttlk',$ttlk)
                ->with('ttbc',$ttbc)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('a_col_namlk',$a_col_namlk)
                ->with('a_col_nambc',$a_col_nambc)
                ->with('a_col_gialk',$a_col_gialk)
                ->with('a_col_giabc',$a_col_giabc)
                ->with('pageTitle','Báo cáo giá nước sạch sinh hoạt');
        }else
            return view('errors.notlogin');
    }

    public function Bc1_14_01_2020(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = GiaNuocSachShDm::all();
            dd($inputs);
            if($inputs['mahslk'] != 'ALL'){

            }
            if( !isset($inputs['mahslk']) || !isset($inputs['mahsbc'])) {
                return view('errors.noperm')
                    ->with('url', '')
                    ->with('message', 'Đơn vị báo cáo chưa có hồ sơ kê khai.');
            }
            foreach($model as $ct){
                $modellk = GiaNuocShCt::where('mahs',$inputs['mahslk'])
                    ->where('doituongsd',$ct->doituongsd)
                    ->first();
                $modelbc = GiaNuocShCt::where('mahs',$inputs['mahsbc'])
                    ->where('doituongsd',$ct->doituongsd)
                    ->first();
                $ct->gialk = $modellk->giachuathue ?? 0;
                $ct->giabc = $modelbc->giachuathue ?? 0;
            }
            $ttlk = GiaNuocSh::where('mahs',$inputs['mahslk'])->first();
            $ttbc = GiaNuocSh::where('mahs',$inputs['mahsbc'])->first();
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();

            return view('manage.dinhgia.gianuocsh.reports.BcGiaNuocSh1')
                ->with('model',$model)
                ->with('ttlk',$ttlk)
                ->with('ttbc',$ttbc)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('pageTitle','Báo cáo giá nước sạch sinh hoạt');
        }else
            return view('errors.notlogin');
    }

    function getBCLK(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $modelhs = GiaNuocSh::where('madv', $inputs['madv'])->get();

        $result = array(
            'status' => 'success',
            'message' => '',
        );
        $result['message'] = '<div id="row_bclk" class="row">';
        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<label><b>Báo cáo liền kề</b></label>';
        $result['message'] .= '<select name="mahslk" id="mahslk" class="form-control">';
        foreach ($modelhs as $hslk) {
            $result['message'] .= '<option value="' . $hslk->mahs . '">Số ' . $hslk->soqd . ' - Ngày ' . getDayVn($hslk->ngayapdung) . ' - ' . $hslk->mota . '</option>';
        }
        $result['message'] .= '</select>';
        $result['message'] .= '</div>';

        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<label><b>Báo cáo so sánh</b></label>';
        $result['message'] .= '<select name="mahsbc" id="mahsbc" class="form-control">';
        foreach ($modelhs as $hslk) {
            $result['message'] .= '<option value="' . $hslk->mahs . '">Số ' . $hslk->soqd . ' - Ngày ' . getDayVn($hslk->ngayapdung) . ' - ' . $hslk->mota . '</option>';
        }
        $result['message'] .= '</select>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';
        die(json_encode($result));
    }
}
