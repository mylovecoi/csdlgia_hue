<?php

namespace App\Http\Controllers\manage\giayin;

use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBog;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBogCt;
use App\Model\system\company\Company;
use App\Model\view\view_dmnganhnghe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiayInBcController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $inputs['url'] = '/giayin';
            $m_giayin = view_dmnganhnghe::where('manghe', 'GIAY')->get();
            $m_donvi = getDonViTongHop_dn('giayin',session('admin')->level, session('admin')->madiaban);

            return view('manage.giayin.baocao.index')
                ->with('inputs',$inputs)
                ->with('m_donvi',$m_donvi)
                ->with('a_dm',array_column($m_giayin->toarray(),'tennghe','manghe'))
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai giá giấy');
        }else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('giayin',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manghe', 'GIAY')->get();
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

            return view('manage.giayin.baocao.bc1')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_nghe',array_column($m_nghe->toarray(),'tennghe','manghe'))
                ->with('a_com',array_column($m_com->toarray(),'tendn','madv'))
                ->with('modeldvql',$m_donviql)
                //->with('modeldmnghe',$modeldmnghe)
                ->with('pageTitle', 'Báo cáo tổng hợp kê khai, đăng ký giá giấy');
        }else
            return view('errors.notlogin');
    }

    public function bc2(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donviql = getDonViTongHop_dn('giayin',session('admin')->level, session('admin')->madiaban);
            //lấy theo đơn vị tổng hợp nếu lấy all thì chỉ lấy trong $m_donvi
            $m_nghe = view_dmnganhnghe::where('manghe', 'GIAY')->get();
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

            return view('manage.giayin.baocao.bc2')
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
