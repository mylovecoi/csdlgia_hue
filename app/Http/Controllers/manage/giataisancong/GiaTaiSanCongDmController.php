<?php

namespace App\Http\Controllers\manage\giataisancong;

use App\Model\manage\dinhgia\giadatphanloai\GiaDatPhanLoaiDm;
use App\Model\manage\dinhgia\GiaTaiSanCong;
use App\Model\manage\dinhgia\GiaTaiSanCongDm;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaTaiSanCongDmController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //$inputs['url'] = isset($inputs['phanloai']) ? ('/'.$inputs['phanloai']) : '/giathuetscong';
            $inputs['url'] = '/giathuetscong';
            $a_diaban = getDiaBan_NhapLieu(session('admin')->level, session('admin')->madiaban, false);
            //dd($a_diaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;

            $model = GiaTaiSanCongDm::where('madiaban', $inputs['madiaban'])->get();

            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            return view('manage.dinhgia.giataisancong.danhmuc.index')
                ->with('model', $model)
                ->with('a_dvt', $a_dvt)
                ->with('a_diaban', array_column($m_diaban->wherein('level',['T','H','X'])->toarray(),'tendiaban','madiaban'))
                //->with('a_diaban', getDiaBan_HoSo($m_diaban))
                ->with('inputs', $inputs)
                ->with('a_hientrang',getHienTrang_NhaXH())
                ->with('pageTitle', 'Danh mục giá tài sản công');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['giatri'] = getMoneyToDb($inputs['giatri']);
            $inputs['dientich'] = getMoneyToDb($inputs['dientich']);
            //dd($inputs);
            $check = GiaTaiSanCongDm::where('mataisan',$inputs['mataisan'])->first();

            if ($check == null) {
                $inputs['mataisan'] = getdate()[0];
                GiaTaiSanCongDm::create($inputs);
            } else {
                $check->update($inputs);
            }

            return redirect('/giathuetscong/danhmuc');

        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = GiaTaiSanCongDm::where('mataisan', $inputs['mataisan'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $chk = GiaTaiSanCong::where('mataisan',$inputs['mataisan'])->first();
            if($chk == null){
                GiaTaiSanCongDm::where('mataisan',$inputs['mataisan'])->delete();
                return redirect('giathuetscong/danhmuc');
            }else{
                return view('errors.duplicate')
                    ->with('message','Mã số này đã được sử dụng trong hồ sơ giá.')
                    ->with('url','/giathuetscong/danhmuc');
            }

        } else
            return view('errors.notlogin');
    }
}
