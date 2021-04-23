<?php

namespace App\Http\Controllers\congbo\dinhgia;

use App\DiaBanHd;
use App\Model\manage\dinhgia\giadaugiadat\DauGiaDat;
use App\Model\manage\dinhgia\giadaugiadat\DauGiaDatCt;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giadatdaugia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CongboGiaDauGiaDatController extends Controller
{
    public function index(Request $request){
        $inputs = $request->all();
        $inputs['url'] = '/cbgiadaugiadat';
        $a_diaban = getDiaBan_XaHuyen('ADMIN');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $model = view_giadatdaugia::where('congbo', 'DACONGBO');
        $model_dk = DauGiaDat::where('congbo', 'DACONGBO');
        if ($inputs['nam'] != 'all'){
            $model = $model->whereYear('thoidiem', $inputs['nam']);
            $model_dk = $model_dk->whereYear('thoidiem', $inputs['nam']);
        }
        $model = $model->get();
        $model_dk = $model_dk->where('ipf1','<>', '')->get();
        //$a_ts = array_column(giaspdvcidm::all()->toArray(),'tenspdv','maspdv');
        //$a_ts = array_column(GiaTaiSanCongDm::all()->toArray(),'tentaisan','mataisan');
        $a_donvi = array_column(view_dsdiaban_donvi::all()->toArray(),'tendv','madv');
        //dd($a_ts);
        return view('congbo.DinhGia.GiaDauGiaDat.index')
            ->with('model',$model)
            ->with('model_dk',$model_dk)
            ->with('inputs',$inputs)
            ->with('a_diaban',$a_diaban)
            ->with('a_donvi',$a_donvi)
            ->with('pageTitle','Thông tin giá sản phẩm dịch vụ công ích');
    }

    public function index_c(Request $request)
    {
        //if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 5;
            $inputs['tenduan'] = isset($inputs['tenduan']) ? $inputs['tenduan'] : '';
            $inputs['mahuyen'] = isset($inputs['mahuyen']) ? $inputs['mahuyen'] : 'all';
            $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : 'all';
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $huyens = DiaBanHd::where('level','H')
                ->get();
            $xas = DiaBanHd::where('level','X')
                ->get();
            $model = DauGiaDat::where('trangthai','CB');
            if($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem',$inputs['nam']);
            if($inputs['mahuyen'] != 'all') {
                $model = $model->where('mahuyen', $inputs['mahuyen']);
                $xas = DiaBanHd::where('level','X')
                    ->where('district',$inputs['mahuyen'])
                    ->get();
            }

            if($inputs['maxa'] != 'all')
                $model = $model->where('maxa', $inputs['maxa']);
            if($inputs['tenduan'] != '')
                $model = $model->where('tenduan','like', '%'.$inputs['tenduan'].'%');
            $model = $model->paginate($inputs['paginate']);

            foreach($model as $tt){
                $tenhuyen = DiaBanHd::where('level','H')
                    ->where('district',$tt->mahuyen)
                    ->first();
                $tenxa = DiaBanHd::where('level','X')
                    ->where('town',$tt->maxa)
                    ->first();
                $tt->tenhuyen = $tenhuyen->diaban;
                $tt->tenxa = $tenxa->diaban;
            }
            return view('congbo.DinhGia.GiaDauGiaDat.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('huyens',$huyens)
                ->with('xas',$xas)
                ->with('pageTitle','Thông tin hồ sơ đấu giá đất');
        //}else
        //    return view('errors.notlogin');
    }

    public function show($id)
    {
        $model = DauGiaDat::findOrFail($id);
        $modelct = DauGiaDatCt::where('mahs',$model->mahs)
            ->get();
        $modeldb = DiaBanHd::where('level','H')
            ->where('district',$model->mahuyen)
            ->first();
        $modelxa = DiaBanHd::where('level','X')
            ->where('town',$model->maxa)
            ->first();

        $inputs['dvcaptren'] = getGeneralConfigs()['tendvcqhienthi'];
        $inputs['dv'] = getGeneralConfigs()['tendvhienthi'];
        $inputs['diadanh'] = getGeneralConfigs()['diadanh'];

        return view('congbo.DinhGia.GiaDauGiaDat.show')
            ->with('model',$model)
            ->with('modelct',$modelct)
            ->with('modeldb',$modeldb)
            ->with('modelxa',$modelxa)
            ->with('inputs',$inputs)
            ->with('pageTitle','Hồ sơ đấu giá đất');
    }

}
