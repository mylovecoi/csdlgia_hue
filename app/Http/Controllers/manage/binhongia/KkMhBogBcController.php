<?php

namespace App\Http\Controllers\manage\binhongia;

use App\District;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBog;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBogCt;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\view\view_binhongia;
use App\Model\view\view_dmnganhnghe;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkMhBogBcController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/binhongia';
            $m_bog = view_dmnganhnghe::where('manganh', 'BOG')->get();
            $m_donvi = getDonViTongHop_dn('binhongia',session('admin')->level, session('admin')->madiaban);
            //$m_donvi = Town::where('mahuyen',$modeldmnghe->mahuyen)->get();

            return view('manage.bog.baocao.index')
                ->with('inputs',$inputs)
                ->with('m_donvi',$m_donvi)
                ->with('a_dm',array_column($m_bog->toarray(),'tennghe','manghe'))
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai mặt hàng bình ổn giá');
        }else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('binhongia',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manganh', 'BOG')->get();
            $model =  KkMhBog::where('trangthai','DD')->wherein('macqcq',array_column($m_donviql->toarray(),'madv'));
            //dd($model->get());
            if($inputs['madv'] != 'all') {
                $model = $model->where('macqcq', $inputs['macqcq']);
            }

            if($inputs['manghe'] != 'all') {
                $model = $model->where('manghe', $inputs['manghe']);
            }

            if($inputs['phanloai'] == 'ngaychuyen'){
                $model = $model->whereBetween('ngaychuyen',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }else{
                $model = $model->whereBetween('ngaynhan',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }

            $model = $model->get();
            //dd($model);
            $inputs['counths'] = count($model);
            $m_donviql = $m_donviql->wherein('madv',array_column($model->toarray(),'macqcq'));
            $m_com = Company::wherein('madv',array_column($model->toarray(),'madv'))->get();
//            if(session('admin')->level == 'T'){
//                $inputs['dvcaptren'] = '';
//                $inputs['dv'] = getGeneralConfigs()['tendonvi'];
//                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
//            }elseif(session('admin')->level == 'H'){
//                $modeldv = District::where('mahuyen',session('admin')->mahuyen)->first();
//                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
//                $inputs['dv'] = $modeldv->tendvhienthi;
//                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
//            }else{
//                $modeldv = Town::where('maxa',session('admin')->maxa)
//                    ->where('mahuyen',session('admin')->mahuyen)->first();
//                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
//                $inputs['dv'] = $modeldv->tendvhienthi;
//                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
//            }
//            $m_donviql = $m_donviql->wherein('madv',array_column($m_nghe->toarray(),'madv'));
//            if(\session('admin')->level == 'SSA'){
//
//            }else{
//
//            }
            return view('manage.bog.baocao.bc1')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_nghe',array_column($m_nghe->toarray(),'tennghe','manghe'))
                ->with('a_com',array_column($m_com->toarray(),'tendn','madv'))
                ->with('modeldvql',$m_donviql)
                //->with('modeldmnghe',$modeldmnghe)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai, đăng ký giá mặt hàng bình ổn giá');
        }else
            return view('errors.notlogin');
    }

    public function bc2(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('binhongia',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manganh', 'BOG')->get();
            $model =  KkMhBog::where('trangthai','DD')->wherein('macqcq',array_column($m_donviql->toarray(),'madv'));
            //dd($model->get());
            if($inputs['madv'] != 'all') {
                $model = $model->where('macqcq', $inputs['macqcq']);
            }

            if($inputs['manghe'] != 'all') {
                $model = $model->where('manghe', $inputs['manghe']);
            }

            if($inputs['phanloai'] == 'ngaychuyen'){
                $model = $model->whereBetween('ngaychuyen',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }else{
                $model = $model->whereBetween('ngaynhan',[getDateToDb($inputs['tungay']), getDateToDb($inputs['denngay'])]);
            }

            $model = $model->get();
            //dd($model);
            $inputs['counths'] = count($model);
            $m_donviql = $m_donviql->wherein('madv',array_column($model->toarray(),'macqcq'));
            $m_com = Company::wherein('madv',array_column($model->toarray(),'madv'))->get();
            $modelct = KkMhBogCt::whereIn('mahs',array_column($model->toarray(),'mahs'))->get();

            return view('manage.bog.baocao.bc2')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_nghe',array_column($m_nghe->toarray(),'tennghe','manghe'))
                ->with('a_com',array_column($m_com->toarray(),'tendn','madv'))
                ->with('modeldvql',$m_donviql)
                ->with('modelct',$modelct)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai');
        }else
            return view('errors.notlogin');
    }
}
